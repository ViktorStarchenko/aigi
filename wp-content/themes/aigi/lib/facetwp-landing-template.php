<div class="content-wrapper wrapper-1245">
    <div class="post-tile__list landing-page search-page__results">

        <?php get_template_part('template-parts/layout', 'posts-list'); ?>

    </div>

    <div class="search-pagination">

        <div class="search-pagination__info">
            You've viewed <span class="search-pagination__per-page"><?php echo FWP()->facet->pager_args['per_page']; ?></span> of <span class="search-pagination__total-rows"><?php echo FWP()->facet->pager_args['total_rows']; ?></span> events
        </div>
        <?php echo do_shortcode('[facetwp facet="pager_"]'); ?>

    </div>

</div>