<?php
/*
Template Name: PDF Layout Topic
*/

get_header(); ?>

<div class="row" id="content-wrap">
	<div class="row" id="sidebar-right-wrapper">

		<?php get_sidebar('left'); ?>
		
		<div class="temp-cont">
			<?php //get_search_form(); ?>
			<div id="content" class="single-toolkit">
				<a id="pdf-back-button" href="<?php echo home_url(); ?>/pdf-select">< Back</a>
				<?php
					$current_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
					$the_path = parse_url($current_url, PHP_URL_QUERY);
					//$the_path = str_replace('-', ' ', $the_path);
					//$the_path = explode(' ', $the_path, 2);
					//$the_path = reset($the_path) . '.' . end($the_path);

				?>
				

				<?php
					$args=array(
					  //'toolkit' => $the_path,
					  'topic' => $the_path,
					  'post_type' => 'toolkit',
					  'post_status' => 'publish',
					  'posts_per_page' => -1,
					  'orderby' => 'meta_value',
					  'order' =>  'ASC',
					  'caller_get_posts'=> 1
					);
					$my_query = null;
					$my_query = new WP_Query($args);
					if( $my_query->have_posts() ) {
					  while ($my_query->have_posts()) : $my_query->the_post(); ?>
					    <h1><?php the_title(); ?></h1>
					    <?php the_content(); ?>
					    <?php
					  endwhile;
					}
					wp_reset_query();
				?> 


			</div>
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>