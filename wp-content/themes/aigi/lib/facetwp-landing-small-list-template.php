
<div class="content-wrapper content-wrapper-small-list ">
    <div class="landing__filter-heading"><?= get_field('landing_page', get_the_ID())['heading']; ?></div>
    <div class="post-tile__list small landing-page search-page__results">

        <?php get_template_part('template-parts/layout', 'posts-list-small'); ?>

    </div>


</div>