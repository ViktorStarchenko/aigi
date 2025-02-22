=== Relevanssi Premium - A Better Search ===
Contributors: msaari
Donate link: https://www.relevanssi.com/
Tags: search, relevance, better search
Requires at least: 4.9
Requires PHP: 7.0
Tested up to: 5.5.3
Stable tag: 2.11.0

Relevanssi Premium replaces the default search with a partial-match search that sorts results by relevance. It also indexes comments and shortcode content.

== Description ==

Relevanssi replaces the standard WordPress search with a better search engine, with lots of features and configurable options. You'll get better results, better presentation of results - your users will thank you.

= Key features =
* Search results sorted in the order of relevance, not by date.
* Fuzzy matching: match partial words, if complete words don't match.
* Find documents matching either just one search term (OR query) or require all words to appear (AND query).
* Search for phrases with quotes, for example "search phrase".
* Create custom excerpts that show where the hit was made, with the search terms highlighted.
* Highlight search terms in the documents when user clicks through search results.
* Search comments, tags, categories and custom fields.

= Advanced features =
* Adjust the weighting for titles, tags and comments.
* Log queries, show most popular queries and recent queries with no hits.
* Restrict searches to categories and tags using a hidden variable or plugin settings.
* Index custom post types and custom taxonomies.
* Index the contents of shortcodes.
* Google-style "Did you mean?" suggestions based on successful user searches.
* Automatic support for [WPML multi-language plugin](http://wpml.org/).
* Automatic support for [s2member membership plugin](http://www.s2member.com/).
* Advanced filtering to help hacking the search results the way you want.
* Search result throttling to improve performance on large databases.
* Disable indexing of post content and post titles with a simple filter hook.
* Multisite support.

= Premium features (only in Relevanssi Premium) =
* PDF content indexing.
* Search result throttling to improve performance on large databases.
* Improved spelling correction in "Did you mean?" suggestions.
* Searching over multiple subsites in one multisite installation.
* Indexing and searching user profiles.
* Weights for post types, including custom post types.
* Limit searches with custom fields.
* Index internal links for the target document (sort of what Google does).
* Search using multiple taxonomies at the same time.

Relevanssi is available in two versions, regular and Premium. Regular Relevanssi is and will remain free to download and use. Relevanssi Premium comes with a cost, but will get all the new features. Standard Relevanssi will be updated to fix bugs, but new features will mostly appear in Premium. Also, support for standard Relevanssi depends very much on my mood and available time. Premium pricing includes support.

= Relevanssi in Facebook =
You can find [Relevanssi in Facebook](https://www.facebook.com/relevanssi). Become a fan to follow the development of the plugin, I'll post updates on bugs, new features and new versions to the Facebook page.

= Other search plugins =
Relevanssi owes a lot to [wpSearch](https://wordpress.org/extend/plugins/wpsearch/) by Kenny Katzgrau. Relevanssi was built to replace wpSearch, when it started to fail.

Search Unleashed is a popular search plugin, but it hasn't been updated since 2010. Relevanssi is in active development and does what Search Unleashed does.



== Installation ==

1. Extract all files from the ZIP file, and then upload the plugin's folder to /wp-content/plugins/.
1. If your blog is in English, skip to the next step. If your blog is in other language, rename the file *stopwords* in the plugin directory as something else or remove it. If there is *stopwords.yourlanguage*, rename it to *stopwords*.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to the plugin settings and build the index following the instructions there.

To update your installation, simply overwrite the old files with the new, activate the new version and if the new version has changes in the indexing, rebuild the index.

= Note on updates =
If it seems the plugin doesn't work after an update, the first thing to try is deactivating and reactivating the plugin. If there are changes in the database structure, those changes do not happen without a deactivation, for some reason.

= Changes to templates =
None necessary! Relevanssi uses the standard search form and doesn't usually need any changes in the search results template.

If the search does not bring any results, your theme probably has a query_posts() call in the search results template. That throws Relevanssi off. For more information, see [The most important Relevanssi debugging trick](http://www.relevanssi.com/knowledge-base/query_posts/).

= How to index =
Check the options to make sure they're to your liking, then click "Save indexing options and build the index". If everything's fine, you'll see the Relevanssi options screen again with a message "Indexing successful!"

If something fails, usually the result is a blank screen. The most common problem is a timeout: server ran out of time while indexing. The solution to that is simple: just return to Relevanssi screen (do not just try to reload the blank page) and click "Continue indexing". Indexing will continue. Most databases will get indexed in just few clicks of "Continue indexing". You can follow the process in the "State of the Index": if the amount of documents is growing, the indexing is moving along.

If the indexing gets stuck, something's wrong. I've had trouble with some plugins, for example Flowplayer video player stopped indexing. I had to disable the plugin, index and then activate the plugin again. Try disabling plugins, especially those that use shortcodes, to see if that helps. Relevanssi shows the highest post ID in the index - start troubleshooting from the post or page with the next highest ID. Server error logs may be useful, too.

= Using custom search results =
If you want to use the custom search results, make sure your search results template uses `the_excerpt()` to display the entries, because the plugin creates the custom snippet by replacing the post excerpt.

If you're using a plugin that affects excerpts (like Advanced Excerpt), you may run into some problems. For those cases, I've included the function `relevanssi_the_excerpt()`, which you can use instead of `the_excerpt()`. It prints out the excerpt, but doesn't apply `wp_trim_excerpt()` filters (it does apply `the_content()`, `the_excerpt()`, and `get_the_excerpt()` filters).

To avoid trouble, use the function like this:

`<?php if (function_exists('relevanssi_the_excerpt')) { relevanssi_the_excerpt(); }; ?>`

See Frequently Asked Questions for more instructions on what you can do with Relevanssi.

= The advanced hacker option =
If you're doing something unusual with your search and Relevanssi doesn't work, try using `relevanssi_do_query()`. See [Knowledge Base](http://www.relevanssi.com/knowledge-base/relevanssi_do_query/).

= Uninstalling =
To uninstall the plugin remove the plugin using the normal WordPress plugin management tools (from the Plugins page, first Deactivate, then Delete). If you remove the plugin files manually, the database tables and options will remain.

= Combining with other plugins =
Relevanssi doesn't work with plugins that rely on standard WP search. Those plugins want to access the MySQL queries, for example. That won't do with Relevanssi. [Search Light](http://wordpress.org/extend/plugins/search-light/), for example, won't work with Relevanssi.

Some plugins cause problems when indexing documents. These are generally plugins that use shortcodes to do something somewhat complicated. One such plugin is [MapPress Easy Google Maps](http://wordpress.org/extend/plugins/mappress-google-maps-for-wordpress/). When indexing, you'll get a white screen. To fix the problem, disable either the offending plugin or shortcode expansion in Relevanssi while indexing. After indexing, you can activate the plugin again.

== Frequently Asked Questions ==

= Where is the Relevanssi search box widget? =
There is no Relevanssi search box widget.

Just use the standard search box.

= Where are the user search logs? =
See the top of the admin menu. There's 'User searches'. There. If the logs are empty, please note showing the results needs at least MySQL 5.

= Displaying the number of search results found =

The typical solution to showing the number of search results found does not work with Relevanssi. However, there's a solution that's much easier: the number of search results is stored in a variable within $wp_query. Just add the following code to your search results template:

`<?php echo 'Relevanssi found ' . $wp_query->found_posts . ' hits'; ?>`

= Advanced search result filtering =

If you want to add extra filters to the search results, you can add them using a hook. Relevanssi searches for results in the _relevanssi table, where terms and post_ids are listed. The various filtering methods work by listing either allowed or forbidden post ids in the query WHERE clause. Using the `relevanssi_where` hook you can add your own restrictions to the WHERE clause.

These restrictions must be in the general format of ` AND doc IN (' . {a list of post ids, which could be a subquery} . ')`

For more details, see where the filter is applied in the `relevanssi_search()` function. This is stricly an advanced hacker option for those people who're used to using filters and MySQL WHERE clauses and it is possible to break the search results completely by doing something wrong here.

There's another filter hook, `relevanssi_hits_filter`, which lets you modify the hits directly. The filter passes an array, where index 0 gives the list of hits in the form of an array of post objects and index 1 has the search query as a string. The filter expects you to return an array containing the array of post objects in index 0 (`return array($your_processed_hit_array)`).

= Direct access to query engine =
Relevanssi can't be used in any situation, because it checks the presence of search with the `is_search()` function. This causes some unfortunate limitations and reduces the general usability of the plugin.

You can now access the query engine directly. There's a new function `relevanssi_do_query()`, which can be used to do search queries just about anywhere. The function takes a WP_Query object as a parameter, so you need to store all the search parameters in the object (for example, put the search terms in `$your_query_object->query_vars['s']`). Then just pass the WP_Query object to Relevanssi with `relevanssi_do_query($your_wp_query_object);`.

Relevanssi will process the query and insert the found posts as `$your_query_object->posts`. The query object is passed as reference and modified directly, so there's no return value. The posts array will contain all results that are found.

= Sorting search results =
If you want something else than relevancy ranking, you can use orderby and order parameters. Orderby accepts $post variable attributes and order can be "asc" or "desc". The most relevant attributes here are most likely "post_date" and "comment_count".

If you want to give your users the ability to sort search results by date, you can just add a link to http://www.yourblogdomain.com/?s=search-term&orderby=post_date&order=desc to your search result page.

Order by relevance is either orderby=relevance or no orderby parameter at all.

= Filtering results by date =
You can specify date limits on searches with `by_date` search parameter. You can use it your search result page like this: http://www.yourblogdomain.com/?s=search-term&by_date=1d to offer your visitor the ability to restrict their search to certain time limit (see [RAPLIQ](http://www.rapliq.org/) for a working example).

The date range is always back from the current date and time. Possible units are hour (h), day (d), week (w), month (m) and year (y). So, to see only posts from past week, you could use by_date=7d or by_date=1w.

Using wrong letters for units or impossible date ranges will lead to either defaulting to date or no results at all, depending on case.

Thanks to Charles St-Pierre for the idea.

= Displaying the relevance score =
Relevanssi stores the relevance score it uses to sort results in the $post variable. Just add something like

`echo $post->relevance_score`

to your search results template inside a PHP code block to display the relevance score.

= Did you mean? suggestions =
To use Google-style "did you mean?" suggestions, first enable search query logging. The suggestions are based on logged queries, so without good base of logged queries, the suggestions will be odd and not very useful.

To use the suggestions, add the following line to your search result template, preferably before the have_posts() check:

`<?php if (function_exists('relevanssi_didyoumean')) { relevanssi_didyoumean(get_search_query(), "<p>Did you mean: ", "?</p>", 5); }?>`

The first parameter passes the search term, the second is the text before the result, the third is the text after the result and the number is the amount of search results necessary to not show suggestions. With the default value of 5, suggestions are not shown if the search returns more than 5 hits.

= Search shortcode =
Relevanssi also adds a shortcode to help making links to search results. That way users can easily find more information about a given subject from your blog. The syntax is simple:

`[search]John Doe[/search]`

This will make the text John Doe a link to search results for John Doe. In case you want to link to some other search term than the anchor text (necessary in languages like Finnish), you can use:

`[search term="John Doe"]Mr. John Doe[/search]`

Now the search will be for John Doe, but the anchor says Mr. John Doe.

One more parameter: setting `[search phrase="on"]` will wrap the search term in quotation marks, making it a phrase. This can be useful in some cases.

= Restricting searches to categories and tags =
Relevanssi supports the hidden input field `cat` to restrict searches to certain categories (or tags, since those are pretty much the same). Just add a hidden input field named `cat` in your search form and list the desired category or tag IDs in the `value` field - positive numbers include those categories and tags, negative numbers exclude them.

This input field can only take one category or tag id (a restriction caused by WordPress, not Relevanssi). If you need more, use `cats` and use a comma-separated list of category IDs.

You can also set the restriction from general plugin settings (and then override it in individual search forms with the special field). This works with custom taxonomies as well, just replace `cat` with the name of your taxonomy.

If you want to restrict the search to categories using a dropdown box on the search form, use a code like this:

`<form method="get" action="<?php bloginfo('url'); ?>">
	<div><label class="screen-reader-text" for="s">Search</label>
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
<?php
	wp_dropdown_categories(array('show_option_all' => 'All categories'));
?>
	<input type="submit" id="searchsubmit" value="Search" />
	</div>
</form>`

This produces a search form with a dropdown box for categories. Do note that this code won't work when placed in a Text widget: either place it directly in the template or use a PHP widget plugin to get a widget that can execute PHP code.

= Restricting searches with taxonomies =

You can use taxonomies to restrict search results to posts and pages tagged with a certain taxonomy term. If you have a custom taxonomy of "People" and want to search entries tagged "John" in this taxonomy, just use `?s=keyword&people=John` in the URL. You should be able to use an input field in the search form to do this, as well - just name the input field with the name of the taxonomy you want to use.

It's also possible to do a dropdown for custom taxonomies, using the same function. Just adjust the arguments like this:

`wp_dropdown_categories(array('show_option_all' => 'All people', 'name' => 'people', 'taxonomy' => 'people'));`

This would do a dropdown box for the "People" taxonomy. The 'name' must be the keyword used in the URL, while 'taxonomy' has the name of the taxonomy.

= Automatic indexing =
Relevanssi indexes changes in documents as soon as they happen. However, changes in shortcoded content won't be registered automatically. If you use lots of shortcodes and dynamic content, you may want to add extra indexing. Here's how to do it:

`if (!wp_next_scheduled('relevanssi_build_index')) {
	wp_schedule_event( time(), 'daily', 'relevanssi_build_index' );
}`

Add the code above in your theme functions.php file so it gets executed. This will cause WordPress to build the index once a day. This is an untested and unsupported feature that may cause trouble and corrupt index if your database is large, so use at your own risk. This was presented at [forum](http://wordpress.org/support/topic/plugin-relevanssi-a-better-search-relevanssi-chron-indexing?replies=2).

= Highlighting terms =
Relevanssi search term highlighting can be used outside search results. You can access the search term highlighting function directly. This can be used for example to highlight search terms in structured search result data that comes from custom fields and isn't normally highlighted by Relevanssi.

Just pass the content you want highlighted through `relevanssi_highlight_terms()` function. The content to highlight is the first parameter, the search query the second. The content with highlights is then returned by the function. Use it like this:

`if (function_exists('relevanssi_highlight_terms')) {
    echo relevanssi_highlight_terms($content, get_search_query());
}
else { echo $content; }`

= Multisite searching =
To search multiple blogs in the same WordPress network, use the `searchblogs` argument. You can add a hidden input field, for example. List the desired blog ids as the value. For example, searchblogs=1,2,3 would search blogs 1, 2, and 3.

The features are very limited in the multiblog search, none of the advanced filtering works, and there'll probably be fairly serious performance issues if searching common words from multiple blogs.

= What is tf * idf weighing? =

It's the basic weighing scheme used in information retrieval. Tf stands for *term frequency* while idf is *inverted document frequency*. Term frequency is simply the number of times the term appears in a document, while document frequency is the number of documents in the database where the term appears.

Thus, the weight of the word for a document increases the more often it appears in the document and the less often it appears in other documents.

= What are stop words? =

Each document database is full of useless words. All the little words that appear in just about every document are completely useless for information retrieval purposes. Basically, their inverted document frequency is really low, so they never have much power in matching. Also, removing those words helps to make the index smaller and searching faster.

== Known issues and To-do's ==
* Known issue: In general, multiple Loops on the search page may cause surprising results. Please make sure the actual search results are the first loop.
* Known issue: Relevanssi doesn't necessarily play nice with plugins that modify the excerpt. If you're having problems, try using relevanssi_the_excerpt() instead of the_excerpt().
* Known issue: When a tag is removed, Relevanssi index isn't updated until the post is indexed again.

== Thanks ==
* Cristian Damm for tag indexing, comment indexing, post/page exclusion and general helpfulness.
* Marcus Dalgren for UTF-8 fixing.
* Warren Tape.
* Mohib Ebrahim for relentless bug hunting.
* John Blackbourn for amazing internal link feature and other fixes.
* John Calahan for extensive 2.0 beta testing.

== Changelog ==
= 2.11.0 =
* New feature: There's now a "Debugging" tab in the Relevanssi settings, letting you see how the Relevanssi index sees posts. This is familiar to Premium users, but is now available in the free version as well.
* New feature: The SEO Framework plugin is now supported and posts set excluded from the search in SEO Framework settings will be excluded from the index.
* New feature: There's a new option, "Expand highlights". Enabling it makes Relevanssi expand partial-word highlights to cover the full word. This is useful when doing partial matching and when using a stemmer.
* New feature: Relevanssi can now generate excerpts that show multiple snippets from the post. You can adjust the number of excerpts displayed from the excerpt settings. Individual excerpt parts are wrapped in `span` tags with the class `excerpt_part` for styling.
* New feature: New filter hook `relevanssi_excerpt_part` allows you to modify the excerpt parts before they are combined together.
* New feature: New filter hook `relevanssi_excerpts` lets you filter the array of excerpts before the highlights are added.
* New feature: Relevanssi now supports an arbitrary number of levels in the `field_%_subfield_%_subfield` notation for flexible ACF fields.
* New feature: Improved compatibility with Oxygen Builder. Relevanssi automatically indexes the Oxygen Builder content and cleans it up. New filter hooks `relevanssi_oxygen_section_filters` and `relevanssi_oxygen_section_content` allow easier filtering of Oxygen content to eg. remove unwanted sections.
* Changed behaviour: The "Uncheck this for non-ASCII highlights" option has been removed. Highlights are now done in a slightly different way that should work in all cases, including for example Cyrillic text, thus this option is no longer necessary.
* Changed behaviour: The `index_pdfs` WP CLI command has been retired. It has been replaced with two separate commands: `remove_attachment_contents` removes all read attachment contents from the database and `read_attachments` reads all attachment content from files that haven't been read yet.
* Changed behaviour: Relevanssi excerpts are now wrapped in `span` tags.
* Minor fix: Removes the warning about non-numeric values when using a redirect for the first time.
* Minor fix: Fixes phrase searching using non-US alphabet.
* Minor fix: Sometimes the `relevanssi_user_index_ok` filter would get a user ID and not the object. This is now fixed: it's always an object.
* Minor fix: Excluding posts from the block editor didn't work properly: the post would be marked excluded, but would not actually be removed from the index until the next reindexing of the whole database. This works now as expected.
* Minor fix: Relevanssi would break admin searching for hierarchical post types. This is now fixed, Relevanssi won't do that anymore.
* Minor fix: Relevanssi indexing now survives better shortcodes that change the global `$post`.
* Minor fix: Warnings about missing `relevanssi_update_counts` function are now removed.
* Minor fix: Paid Membership Pro support now takes notice of the "filter queries" setting.
* Minor fix: OR logic didn't work correctly when two phrases both had the same word (for example "freedom of speech" and "free speech"). The search would always be an AND search in those cases. That has been fixed.
* Minor fix: Relevanssi no longer blocks the Pretty Links admin page search.
* Minor fix: The "Respect 'exclude_from_search'" setting did not work if no post type parameter was included in the search parameters.
* Minor fix: The category inclusion and exclusion setting checkboxes on the Searching tab didn't work. The setting was saved, but the checkboxes wouldn't appear.

= 2.10.3 =
* New feature: Multisite searching now supports date parameters.
* New feature: Both `relevanssi_fuzzy_query` and `relevanssi_term_where` now get the current search term as a parameter.
* New feature: New filter hook `relevanssi_tabs` can be used to adjust the tabs in Relevanssi settings page to add, modify or delete the tabs.
* Major fix: The `post_relevanssi_related` action hook did not fire at all, causing possible problems if `pre_relevanssi_related` set something that `post_relevanssi_related` was supposed clear out. The default behaviour isn't a problem, but some custom solutions may be.
* Minor fix: Relevanssi database tables don't have PRIMARY keys, only UNIQUE keys. In case this is a problem (for example on Digital Ocean servers), deactivate and activate Relevanssi to fix the problem.
* Minor fix: When `posts_per_page` was set to -1, the `max_num_pages` was incorrectly set to the number of posts found. It should, of course, be 1.
* Minor fix: Excluding from logs didn't work if user IDs had spaces between them ('user_a, user_b'). This is now fixed for good, the earlier fix didn't work.
* Minor fix: When indexing, users are now counted in a different way, so that the `relevanssi_user_indexing_args` filter hook is applied and the count reflects the actual number of users indexed.

= 2.10.2 =
* New feature: Wildcard operators ? (any one letter) and * (zero or more letters) can be used inside words, if enabled by setting the `relevanssi_wildcard_search` filter to `true`.
* New feature: New filter hook `relevanssi_term_where` lets you filter the term WHERE conditional for the search query.
* Minor fix: Doing the document count updates asynchronously caused problems in some cases (eg. importing posts). Now the document count is only updated after a full indexing and once per week.
* Minor fix: Phrase matching has been improved to make it possible to search for phrases that include characters like the ampersand.

= 2.10.1 =
* New feature: New filter hook `relevanssi_didyoumean_alphabet` to replace the default Latin alphabet with something more suited to your site.
* Major fix: Changes in WooCommerce 4.4.0 broke the Relevanssi searches. This makes the WooCommerce search work again.
* Minor fix: Excluding from logs didn't work if user IDs had spaces between them ('user_a, user_b'). Now the extra spaces don't matter.
* Minor fix: The asynchronous doc count action in the previous version could cause an infinite loop with the Snitch logger plugin. This is prevented now: the async action doesn't run after indexing unless a post is actually indexed.
* Minor fix: Relevanssi indexing procedure was triggered for autosaved drafts, causing possible problems with the asynchronous doc count action.
* Minor fix: The `relevanssi_index_custom_fields` filter hook was not applied when doing phrase matching, thus phrases could not be found when they were in custom fields added with the filter.
* Minor fix: Apostrophes in redirect queries didn't work. That is now fixed and saving a query with an apostrophe works and will redirect.

= 2.10.0 =
* Changed behaviour: Relevanssi now requires PHP 7.
* Changed behaviour: Relevanssi now sorts strings with strnatcasecmp() instead of strcasecmp(), leading to a more natural results with strings that include numbers.
* Changed behaviour: Relevanssi init is now moved from priority 10 to priority 1 on the `init` hook to avoid problems with missing TablePress compatibility.
* New feature: Content wrapped in the `noindex` tags is no longer used for excerpts.
* New feature: The `[et_pb_fullwidth_code]` shortcode is now removed completely, including the contents, when Relevanssi is indexing and building excerpts.
* New feature: Relevanssi now shows a warning when a multisite site is not public, as that will lead to no search results because Relevanssi doesn't search non-public sites.
* New feature: The redirects tab now shows the number of times each redirect has been used.
* Major fix: Relevanssi didn't index new comments when they were added; when a post was indexed or the whole index rebuilt, comment content was included. We don't know how long this bug has existed, but it is now fixed. Rebuild the index to get all comment content included in the index.
* Minor fix: Phrase matching did not work correctly in visible custom fields.
* Minor fix: TablePress support could cause halting errors if posts were inserted before Relevanssi has loaded itself (on `init` priority 10). These errors will no longer happen.
* Minor fix: Relevanssi only updates doc count on `relevanssi_insert_edit()` when the post is indexed.
* Minor fix: Counting document count is a slow process that has slowed down opening the indexing tab. It's now done asynchronously. Thanks to Mike Garrett.

= 2.9.0 =
* New feature: New function `relevanssi_get_related_post_ids()` returns an array of related post IDs for a post.
* New feature: New function `relevanssi_get_related_post_objects()` returns an array of related post objects for a post.
* New feature: New filter hook `relevanssi_related_output_objects` is the same as `relevanssi_related_output` but for `relevanssi_get_related_post_objects()`.
* New feature: New filter hook `relevanssi_get_approved_comments_args` filters the arguments to `get_approved_comments` in comment indexing. This can be used to index custom comment types, for example.
* Changed behaviour: Relevanssi related posts code has been split into separate functions. The `relevanssi_related_posts()` functions like before, but if you don't want the HTML code, check the new functions.
* Deprecated: Using relevanssi_related_posts() with `$just_objects` or `$no_template` set to `true` is deprecated. Use `relevanssi_get_related_post_objects()` and `relevanssi_get_related_post_ids()` instead.
* Minor fix: The related posts transient field uses a different name for storing objects or HTML, to avoid problems in case both styles are used at the same time.
* Minor fix: Indexing subscriber profiles from the admin interface has stopped working at some point, likely due to some changes in WordPress. It is now noticed and fixed.
* Minor fix: If running in multisite environment, `relevanssi_get_post_status()` includes the blog ID in the cache key in addition to post ID to avoid clashes where same post ID in different blogs have different statuses.
* Minor fix: General improvements to the post caching in multisite environments.
* Minor fix: Options that are used in admin backend only are no longer autoloaded on every page load.

= 2.8.2 =
* Minor fix: Using phrases in the post part targeting didn't work. It works much better now, but may still have some oddities in some cases.
* Minor fix: Media Library searches failed if Relevanssi was enabled in the WP admin, but the `attachment` post type wasn't indexed. Relevanssi will no longer block the default Media Library search in these cases.
* Minor fix: Adds more backwards compatibility for the `relevanssi_indexing_restriction` change, there's now an alert on indexing tab if there's a problem.

= 2.8.1 =
* New feature: New filter hook `relevanssi_post_content_after_shortcodes` filters the post content after shortcodes have been processed but before the HTML tags are stripped.
* Minor fix: Adds more backwards compatibility for the `relevanssi_indexing_restriction` change.

= 2.8.0 =
* New feature: New filter hook `relevanssi_block_to_render` makes it possible to filter Gutenberg blocks before they are rendered to HTML.
* New feature: New filter hook `relevanssi_admin_search_blocked_post_types` makes it easy to block Relevanssi from searching a specific post type in the admin dashboard. There's built-in support for Reusable Content Blocks `rc_blocks` post type, for example.
* New feature: Relevanssi metabox and the Gutenberg sidebar now show the reason why a post is not indexed. You can find the reason at the "How Relevanssi sees this post" feature.
* New feature: When creating excerpts Relevanssi tries to remove the disabled shortcodes.
* Changed behaviour: Relevanssi has been blocked in the admin Media Library searches since 2012. There seems to be no reason not to use Relevanssi there, so Relevanssi is now used for admin Media Library searches, if admin searching is enabled in the first place.
* Changed behaviour: Relevanssi now applies minimum word length when tokenizing search query terms.
* Changed behaviour: Content stopwords are removed from the search queries when doing excerpts and highlights. When Relevanssi uses the untokenized search terms for excerpt-building, stopwords are removed from those words. This should lead to better excerpts.
* Changed behaviour: The `relevanssi_indexing_restriction` filter hook has a changed format. Instead of a string value, the filter now expects an array with the MySQL query in the index 'mysql' and a reason in string format in 'reason'. There's some temporary backwards compatibility for this.
* Minor fix: Synonym indexing for AND searches didn't work for taxonomy terms.
* Minor fix: Post part targeting didn't work well with partial matching or numeric search terms.
* Minor fix: Using `post_parent` from the URL parameters didn't work.
* Minor fix: Improves handling of content stopwords in partial matched searches.
* Minor fix: Polylang filtered out users and taxonomy terms from the results in some cases. That's still implemented in a fairly hackish way, but it's been made more robust now.
* Minor fix: Improves handling of emoji in indexing. If the database supports emoji, they are allowed, otherwise they are encoded.
* Minor fix: The `relevanssi_words` option no longer autoloads (it's a big one).

== Upgrade notice ==
= 2.11.0
* Improved excerpts, all around bug fixes.

= 2.10.3 =
* Bug fix for `post_relevanssi_related` action hook, small bug fixes.

= 2.10.2 =
* Wildcard search, performance improvements.

= 2.10.1 =
* WooCommerce 4.4 compatibility, other corrections.

= 2.10.0 =
* Fixes broken comment indexing; rebuild the index after the update to get comments included.

= 2.9.0 =
* Major changes in the related posts functions, small fixes to multisite searches.

= 2.8.2 =
* More backwards support for the `relevanssi_indexing_restriction` change.

= 2.8.1 =
* Eliminates problems with the WooCommerce, Yoast SEO and SEO Press indexing filters.

= 2.8.0 =
* Relevanssi is now used in Media Library. Excerpt-building and highlighting is improved.