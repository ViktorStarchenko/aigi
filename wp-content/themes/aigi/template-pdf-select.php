<?php
/*
Template Name: PDF Select
*/

get_header(); ?>

<div class="row" id="content-wrap">
	<div class="row" id="sidebar-right-wrapper">

		<?php get_sidebar('left'); ?>
		
		<div class="temp-cont">
			<?php //get_search_form(); ?>
			<div id="content" class="select-pdf">
				
				<h2><a href="<?php echo home_url(); ?>/pdf-layout?all">Full Toolkit</a></h2>
	

					<?php
		
		$taxonomy = 'topic';
		$terms = get_terms($taxonomy);
		if ($terms) {
			foreach($terms as $term) {

				echo '<ul>';
			    echo '<li class="parent"><h2><a href="'. home_url() .'/pdf-layout-topic?'. $term->slug .'">'.$term->name.'</a></h2></li>'; 
				   		?>
				   		<?php
						 	query_posts( array( 'post_type' => 'toolkit', 'topic' => $term->name, 'order' => 'ASC' ) );
							if ( have_posts() ) : while ( have_posts() ) : the_post();
						?>

						<?php

					$url = get_permalink($post->ID); 
					$path = explode('/', $url);
					
					?>

							<li class="child"><a href="<?php echo home_url(); ?>/pdf-layout?<?php echo $path[sizeof($path)-1]; ?>"><?php the_title(); ?></a></li>
							<?php endwhile; endif; wp_reset_query(); ?>
				<?php echo '</ul>';
		}}
		 	
	?>

			</div>
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>