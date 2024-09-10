<?php
/*
* Template Name: Landing page 2 Big Map
* Template Post Type: page
*/

?>

<?php get_header(); ?>

<?php
$post_type = get_field('landing_page')['post_type'];
$event_group = '';
if ($post_type == 'event') {
    if (get_field('landing_page')['event_term']) {
        $event_group = get_field('landing_page')['event_term'];
        $event_group = $event_group->slug;
    }

}
$news_group = '';
if ($post_type == 'news') {
    if (get_field('landing_page')['news_term']) {
        $news_group = get_field('landing_page')['news_term'];
        $news_group = $news_group->slug;
    }

}
?>
    <main class="main-landing-page-big-map" id="content" role="main">
        <!--    <div class="section">-->
        <!--        <div class="wrapper">-->
        <!--            <div class="hero-slider" style="height: 548px; width: 100%; background: var(--color-error)" ></div>-->
        <!--        </div>-->
        <!--    </div>-->
        <div class="main-inner main-inner--big-map <?php echo ($post_type == 'case_studies') ? 'map-enable' : ''; ?> <?php echo ($post_type == 'governance-stories') ? 'map-enable' : ''; ?>">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php get_template_part('template-parts/layout', 'page-before-content-blocks'); ?>

            <div class="wrapper-1245">
                <div class="content-wrapper wrapper-1245">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content" itemprop="mainContentOfPage">
                            <?php the_content(); ?>
                        </div>
                    </article>
                </div>
            </div>


            <div class="wrapper-full-width">
                <div class="landing__filter-block <?php echo $post_type; ?>" id="" data-post-type="<?php echo $post_type; ?>" data-event-group="<?php echo (isset($event_group)) ? $event_group : '' ?>" data-news-group="<?php echo (isset($news_group)) ? $news_group : '' ?>">
                    <!--                    <a class="my-reset-btn btn-body btn-white" onclick="FWP.reset()" style="position: absolute; right: 0; top: 0;">RESET</a>-->
                    <div class="landing__filter-inner">
                        <div class="landing__filter-header">
                            <div class="filter-button">
                                <img class="filter-button__filter filter-button__img" src="/wp-content/themes/aigi/assets/images/filter.svg" alt="filter">
                                <img class="filter-button__close filter-button__img" src="/wp-content/themes/aigi/assets/images/close-blue.svg" alt="close">
                            </div>
                            <div class="landing__filter-heading"><?= get_field('landing_page')['heading']; ?></div>

                            <?php if ($post_type == 'event') { ?>
                                <div class="landing__filter-heading event-type-filter-mob">
                                    <div class="landing__filter-input">
                                        <?php echo do_shortcode('[facetwp facet="landing_event_type"]'); ?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="landing__filter-list global-search__filter" id="global-search__filter">
                            <div class="landing__filter-item post-type">
                                <div class="landing__filter-title">post type</div>
                                <div class="landing__filter-input"><?php echo do_shortcode('[facetwp facet="post_type"]'); ?></div>
                            </div>


                            <?php if (get_field('landing_page')['post_type'] == 'event') : ?>
                                <!--Add Enents group-->
                                <div class="landing__filter-item post-type">
                                    <div class="landing__filter-title">event group</div>
                                    <div class="landing__filter-input"><?php echo do_shortcode('[facetwp facet="events_group"]'); ?></div>
                                </div>
                            <?php endif ?>

                            <?php if (get_field('landing_page')['post_type'] == 'news') : ?>
                                <!--Add News group-->
                                <div class="landing__filter-item post-type">
                                    <div class="landing__filter-title">news group</div>
                                    <div class="landing__filter-input"><?php echo do_shortcode('[facetwp facet="news_group"]'); ?></div>
                                </div>
                            <?php endif ?>

                            <?php if (get_field('landing_page')['filter_item']) : ?>
                                <?php foreach (get_field('landing_page')['filter_item'] as $filter_item) : ?>
                                    <div class="landing__filter-item visible <?php echo $filter_item['filter_name']; ?>">
                                        <div class="landing__filter-title"><?= $filter_item['title']; ?></div>
                                        <div class="landing__filter-input"><?php echo do_shortcode('[facetwp facet="'. $filter_item['filter_name'] .'"]'); ?></div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>

                    </div>
                </div>
            </div>

            <?php if ($post_type == 'case_studies' || $post_type == 'governance-stories') : ?>
                <?php $map_filter =  get_field('landing_page')['map_filter'] ?>
                <div class="wrapper-full-width pos-relative">
                    <div class="landing__filter-map">
                        <?php echo do_shortcode('[facetwp facet="'.$map_filter.'"]'); ?>
                    </div>

                    <div class="landing-small-list-wrapper">
                        <?php echo do_shortcode('[facetwp template="landing_page_small_list_result"]'); ?>
                        <div class="search-pagination search-pagination-small-list">

                            <div class="search-pagination__info">
                                You've viewed <span class="search-pagination__per-page"><?php echo FWP()->facet->pager_args['per_page']; ?></span> of <span class="search-pagination__total-rows"><?php echo FWP()->facet->pager_args['total_rows']; ?></span> events
                            </div>
                            <?php echo do_shortcode('[facetwp facet="pager_"]'); ?>

                        </div>
                    </div>
                </div>
            <?php endif ?>


        </div>
        <?php get_template_part('template-parts/layout', 'page-after-content-blocks'); ?>

        <?php endwhile; endif; ?>
        </div>

    </main>
    <script>
        jQuery( window ).on('load resize', function() {

            let landing__filter_width = jQuery('.landing__filter-item.visible').width();
            jQuery('.landing__filter-item.visible').css('max-width', landing__filter_width + 'px' );

        })

    </script>
<?php get_footer(); ?>