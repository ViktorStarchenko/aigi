<?php
/**
 * /premium/class-relevanssi-wp-cli-command.php
 *
 * @package Relevanssi_Premium
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */

/**
 * Relevanssi Premium WP CLI command.
 *
 * Implements the WP CLI support for Relevanssi Premium.
 */
class Relevanssi_WP_CLI_Command extends WP_CLI_Command {

	/**
	 * Rebuilds the index or reindexes one post.
	 *
	 * ## OPTIONS
	 *
	 * [--target=<target>]
	 * : What to index. No value means everything. Valid values are
	 * "taxonomies" and "users" to index taxonomy terms and user profiles
	 * respectively.
	 * ---
	 * options:
	 *   - post_types
	 *   - taxonomies
	 *   - users
	 * ---
	 *
	 * [--post=<post_ID>]
	 * : Post ID, if you only want to reindex one post.
	 *
	 * [--limit=<limit>]
	 * : Number of posts you want to index at one go.
	 *
	 * [--extend=<extend>]
	 * : If true, do not truncate the index or index users and taxonomies.
	 * If false, first truncate the index, then index user profiles and
	 * taxonomy terms.
	 * ---
	 * default: false
	 * options:
	 *   - true
	 *   - false
	 * ---
	 *
	 * [--index_debug=<debug>]
	 * : If true, display debugging information when indexing a single post.
	 * ---
	 * default: false
	 * options:
	 *   - true
	 *   - false
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp relevanssi index
	 *     wp relevanssi index --post=1
	 *     wp relevanssi index --target=taxonomies
	 *     wp relevanssi index --target=users
	 *     wp relevanssi index --post=1 --index_debug=true
	 *     wp relevanssi index --limit=100
	 *     wp relevanssi index --extend=true --limit=100
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function index( $args, $assoc_args ) {
		remove_filter( 'relevanssi_search_ok', '__return_true' );

		$post_id = null;
		if ( isset( $assoc_args['post'] ) ) {
			$post_id = $assoc_args['post'];
		}

		$limit = null;
		if ( isset( $assoc_args['limit'] ) ) {
			$limit = $assoc_args['limit'];
		}

		$extend = false;
		if ( isset( $assoc_args['extend'] ) ) {
			$extend = $assoc_args['extend'];
		}

		$debug = false;
		if ( isset( $assoc_args['index_debug'] ) ) {
			$debug = $assoc_args['index_debug'];
		}

		$target = null;
		if ( isset( $assoc_args['target'] ) ) {
			$target = $assoc_args['target'];
		}

		if ( 'taxonomies' === $target ) {
			relevanssi_index_taxonomies();
			WP_CLI::success( 'Done!' );
		} elseif ( 'users' === $target ) {
			relevanssi_index_users();
			WP_CLI::success( 'Done!' );
		} elseif ( 'post_types' === $target ) {
			relevanssi_index_post_type_archives();
			WP_CLI::success( 'Done!' );
		} else {
			if ( isset( $post_id ) ) {
				$n = relevanssi_index_doc( $post_id, true, relevanssi_get_custom_fields(), true, $debug );
				switch ( $n ) {
					case -1:
						WP_CLI::error( "No such post: $post_id!" );
						break;
					case 'hide':
						WP_CLI::error( "Post $post_id is excluded from indexing." );
						break;
					case 'donotindex':
						WP_CLI::error( "Post $post_id is excluded from indexing by the relevanssi_do_not_index filter." );
						break;
					default:
						WP_CLI::success( "Reindexed post $post_id!" );
				}
			} else {
				$verbose              = false;
				list( $complete, $n ) = relevanssi_build_index( $extend, $verbose, $limit );

				$completion = 'Index is not complete yet.';
				if ( $complete ) {
					$completion = 'Index is complete.';
				}

				WP_CLI::success( "$n posts indexed. $completion" );
			}
		}
	}

	/**
	 * Empties the Relevanssi index.
	 *
	 * ## EXAMPLES
	 *
	 *     wp relevanssi truncate_index
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function truncate_index( $args, $assoc_args ) {
		$result = relevanssi_truncate_index();
		switch ( $result ) {
			case false:
				WP_CLI::error( "Couldn't truncate the Relevanssi database!" );
				break;
			default:
				WP_CLI::success( 'Relevanssi database truncated.' );
		}
	}

	/**
	 * Adds a stopword to the list of stopwords and removes it from the index.
	 *
	 * ## OPTIONS
	 *
	 * <stopword>...
	 * : Stopwords to add.
	 *
	 * ## EXAMPLES
	 *
	 *     wp relevanssi add_stopword stop halt seis
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function add_stopword( $args, $assoc_args ) {
		if ( is_array( $args ) ) {
			foreach ( $args as $stopword ) {
				if ( relevanssi_add_single_stopword( $stopword ) ) {
					WP_CLI::success( "Stopword added: $stopword" );
				} else {
					WP_CLI::error( "Couldn't add stopword: $stopword!" );
				}
			}
		} else {
			WP_CLI::error( 'No stopwords listed.' );
		}
	}

	/**
	 * Removes a stopword from the list of stopwords. Reindex to get it back to the index.
	 *
	 * ## OPTIONS
	 *
	 * <stopword>...
	 * : Stopwords to remove.
	 *
	 * ## EXAMPLES
	 *
	 *     wp relevanssi remove_stopword stop halt seis
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function remove_stopword( $args, $assoc_args ) {
		$verbose = false;
		if ( is_array( $args ) ) {
			foreach ( $args as $stopword ) {
				if ( relevanssi_remove_stopword( $stopword, $verbose ) ) {
					WP_CLI::success( "Stopword removed: $stopword" );
				} else {
					WP_CLI::error( "Couldn't remove stopword: $stopword!" );
				}
			}
		} else {
			WP_CLI::error( 'No stopwords listed.' );
		}
	}

	/**
	 * Empties the Relevanssi logs.
	 *
	 * ## EXAMPLES
	 *
	 *     wp relevanssi reset_log
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function reset_log( $args, $assoc_args ) {
		$verbose = false;
		$result  = relevanssi_truncate_logs( $verbose );
		switch ( $result ) {
			case false:
				WP_CLI::error( "Couldn't reset the logs!" );
				break;
			default:
				WP_CLI::success( 'Relevanssi log truncated.' );
		}
	}

	/**
	 * Shows common words in the index.
	 *
	 * ## OPTIONS
	 *
	 * [--limit=<limit>]
	 * : How many words to show. Defaults to 25.
	 *
	 * ## EXAMPLES
	 *
	 *     wp relevanssi common
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function common( $args, $assoc_args ) {
		$wp_cli = true;
		$limit  = 25;
		if ( isset( $assoc_args['limit'] ) && is_numeric( $assoc_args['limit'] ) ) {
			$limit = $assoc_args['limit'];
		}

		$words = relevanssi_common_words( $limit, $wp_cli );
		if ( is_array( $words ) ) {
			foreach ( $words as $word ) {
				WP_CLI::log( sprintf( '%s (%d)', $word->term, $word->cnt ) );
			}
		} else {
			WP_CLI::error( 'No words returned.' );
		}
	}

	/**
	 * Reads the attachment content for all attachments that haven't been read
	 * yet.
	 *
	 * ## EXAMPLES
	 *
	 *      wp relevanssi read_attachments
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function read_attachments( $args, $assoc_args ) {
		$attachment_posts = relevanssi_get_posts_with_attachments( 0 );
		WP_CLI::log( 'Found ' . count( $attachment_posts ) . ' attachments to read.' );
		foreach ( $attachment_posts as $post_id ) {
			$exit_and_die = false;
			$response     = relevanssi_index_pdf( $post_id, $exit_and_die );
			if ( $response['success'] ) {
				WP_CLI::log( "Successfully read the content for post $post_id." );
			} else {
				WP_CLI::log( "Couldn't read the post $post_id: " . $response['error'] );
			}
		}
	}

	/**
	 * Removes all attachment content for all posts. Use with care! Does not
	 * reindex the posts or remove them from the index.
	 *
	 * ## EXAMPLES
	 *
	 *      wp relevanssi remove_attachment_content
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function remove_attachment_content( $args, $assoc_args ) {
		delete_post_meta_by_key( '_relevanssi_pdf_content' );
		delete_post_meta_by_key( '_relevanssi_pdf_error' );

		WP_CLI::log( 'Removed all attachment content for posts.' );
	}

	/**
	 * Regenerates the related posts for all posts.
	 *
	 * ## OPTIONS
	 *
	 * [--post_type=<post_types>]
	 * : A comma-separated list of post types to cover. If empty, generate the post
	 * types chosen in the Related posts options, or if that's empty, all public post
	 * types.
	 *
	 * [--post_objects=<post_objects>]
	 * : If true, doesn't generate the related posts HTML code and instead stores the
	 * post objects of the related posts in the transient. If false, the transient
	 * will contain the generated related posts HTML code. Default false.
	 * ---
	 * default: false
	 * options:
	 *   - true
	 *   - false
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *      wp relevanssi regenerate_related
	 *      wp relevanssi regenerate_related --post_type=post,page
	 *
	 * @param array $args       Command arguments (not used).
	 * @param array $assoc_args Command arguments as associative array.
	 */
	public function regenerate_related( $args, $assoc_args ) {
		relevanssi_flush_related_cache();

		$settings = get_option( 'relevanssi_related_settings', relevanssi_related_default_settings() );

		if ( isset( $settings['enabled'] ) && 'off' === $settings['enabled'] ) {
			WP_CLI::error( 'Related posts feature is disabled.' );
		}

		$post_types = array();
		if ( isset( $settings['append'] ) && ! empty( $settings['append'] ) ) {
			// Related posts are automatically appended to certain post types, so
			// regenerate the related posts for those post types.
			$post_types = explode( ',', $settings['append'] );
		} else {
			// Nothing set, so regenerate for all public post types.
			$pt_args    = array(
				'public' => true,
			);
			$post_types = get_post_types( $pt_args, 'names' );
		}

		if ( $assoc_args['post_type'] ) {
			$post_types = explode( ',', $assoc_args['post_type'] );
		}

		$post_objects = false;
		if ( $assoc_args['post_objects'] ) {
			if ( filter_var( $assoc_args['post_objects'], FILTER_VALIDATE_BOOLEAN ) ) {
				$post_objects = true;
			}
		}

		$post_args = array(
			'post_type'      => $post_types,
			'fields'         => 'ids',
			'posts_per_page' => -1,
		);
		$posts     = get_posts( $post_args ); // Get all posts for the wanted post types.
		$count     = count( $posts );
		WP_CLI::log( 'Regenerating related posts for post types ' . implode( ', ', $post_types ) . ", total $count posts." );

		$progress = relevanssi_generate_progress_bar( 'Regenerating', $count );

		foreach ( $posts as $post_id ) {
			relevanssi_related_posts( $post_id, $post_objects );
			$progress->tick();
		}

		$progress->finish();
		WP_CLI::success( 'Done!' );
	}
}

WP_CLI::add_command( 'relevanssi', 'Relevanssi_WP_Cli_Command' );

/**
 * Generates a WP CLI progress bar.
 *
 * If WP CLI is enabled, creates a progress bar using WP_CLI\Utils\make_progress_bar().
 *
 * @param string $title Title of the progress bar.
 * @param int    $count Total count for the bar.
 */
function relevanssi_generate_progress_bar( $title, $count ) {
	$progress = null;
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		$progress = WP_CLI\Utils\make_progress_bar( $title, $count );
	}
	return $progress;
}

add_filter( 'relevanssi_search_ok', 'relevanssi_cli_query_ok', 10, 2 );
/**
 * Sets the relevanssi_search_ok true for searches.
 *
 * @param boolean  $ok    Whether it's ok to do a Relevanssi search or not.
 * @param WP_Query $query The query object.
 *
 * @return boolean Whether it's ok to do a Relevanssi search or not.
 */
function relevanssi_cli_query_ok( $ok, $query ) {
	if ( $query->is_search() ) {
		return true;
	}
	return $ok;
}
