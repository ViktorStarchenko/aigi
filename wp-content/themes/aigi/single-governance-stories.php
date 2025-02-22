<?php
/*
* Template Name: Single Case Studies
* Template Post Type: event
*/
?>

<?php get_header(); ?>
<main id="content" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="main-inner  <?php  echo ((get_field('header_slider')['enable'] == true) ? ' top-of-hero ' :''); ?>">

        <?php
        $terms =  get_the_terms( get_the_ID(), 'content_tags');
        ?>
        <div class="wrapper-1245 content-wrapper">
            <div class="has-sidebar  sidebar-right">
                <div class="col-sidebar">
                    <div class="col-sidebar__inner">

                        <div class="post-details">

                            <?php if (get_field('author')) : ?>
                                <div class="post-details__item author">
                                    <div class="post-details__heading">Written by</div>
                                    <?php foreach (get_field('author') as $author) : ?>
                                        <div class="post-details__text">
                                            <?php echo $author->post_title; ?>
                                            <?php if (get_field ('author_title', $author->ID)) : ?>
                                                <p><?php  echo get_field('author_title', $author->ID) ; ?></p>
                                            <?php endif ?>
                                        </div>
                                        <!--                                    <a class="post-details__link fancybox-inline show-modal" href="#author---><?php //echo $author->ID ?><!--">About the writter</a>-->
                                        <div class="popup_item_wrapper post-details__link" data-popup="">
                                            <div href="" class="popup_button">
                                                About the writter
                                            </div>

                                            <div class="popup-main-wrapper" id="popup-main-wrapper">
                                                <div class="item_popup_wrapper">
                                                    <div class="popup_overlay"></div>
                                                    <div class="popup_content_wrapper author">
                                                        <div class="item_popup_content_inner">
                                                            <div class="popup_close_button"></div>
                                                            <div class="social-share__wrapper modal modal-content">


                                                                <div class="partners_item_popup_header">
                                                                    <div class="author__image">
                                                                        <img alt="<?php echo $author->post_title; ?>" src="<?= get_the_post_thumbnail_url( $author->ID, 'full' ); ?>">
                                                                    </div>
                                                                    <div class="author__content">
                                                                        <p class="partners_item_popup_headline">Author Details</p>

                                                                        <?php if ($author->post_title) : ?>
                                                                            <div class="popup-address">
                                                                                <p><?php echo $author->post_title; ?></p>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <?php if (get_field('author_title', $author->ID)) : ?>
                                                                            <div class="popup-address">
                                                                                <p><?php  echo get_field('author_title', $author->ID) ; ?></p>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <?php if ($author->post_content) : ?>
                                                                            <div class="popup-address">
                                                                                <p><?php echo $author->post_content; ?></p>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <?php if (get_field('social_links', $author->ID)): ?>
                                                                            <div class="">
                                                                                <div class="social-links__heading ">Event's Social Links:</div>
                                                                                <div class="social-links">
                                                                                    <?php foreach (get_field('social_links', $author->ID) as $social_links) : ?>
                                                                                        <div class="social-links__item">
                                                                                            <a class="social-links__item-link" href="<?= $social_links['link'] ?>" target="_blank">
                                                                                                <i class="<?= $social_links['icon'] ?>"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php endforeach ?>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif ?>


                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="popup_content_footer"></div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            <?php endif ?>

                            <?php if (get_field('c_studies_locationtion')['enable'] == true) { ?>
                                <?php if (get_field('c_studies_locationtion')['address']) : ?>
                                    <div class="post-details__item">
                                        <div class="post-details__heading">Location</div>
                                        <div class="post-details__text"><?= get_field('c_studies_locationtion')['address']['address']; ?></div>
                                        <a href="https://maps.google.com/?q=<?php echo get_field('c_studies_locationtion')['address']['lat'];?>,<?php echo get_field('c_studies_locationtion')['address']['lng'];?>" target="_blank" class="post-details__link">View on map</a>
                                    </div>
                                <?php endif ?>
                            <?php } ?>


                            <?php
                            if( have_rows('field_61fced47d533a') ): //Organization
                            while ( have_rows('field_61fced47d533a') ) : the_row(); ?>
                                <?php if (get_sub_field('field_6322f1fcccc76')): ?>
                                    <div class="post-details__item organisation-info">
                                        <?php if (get_sub_field('field_6321885ce6292')) { //Name ?>
                                            <div class="post-details__heading"><?= get_sub_field('field_6321885ce6292'); ?></div>
                                        <?php } ?>

                                        <?php if(!empty($terms)): ?>
                                            <div class="content-tags">
                                                <?php foreach ($terms as $cur_term) : ?>
                                                    <div class="content-tags__item">
                                                        <span href="<?php echo get_term_link( $cur_term->term_id, $cur_term->taxonomy ) ?>"><?php echo $cur_term->name; ?></span>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>

                                        <?php if (get_sub_field('field_632188a2e6299')) { //Website ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Website: </span>
                                                <a target="_blank" href="<?= get_sub_field('field_632188a2e6299'); ?>"><?= get_sub_field('field_632188a2e6299'); ?></a>
                                            </div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_63218869e6293')) { //About ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">About: </span>
                                                <?= get_sub_field('field_63218869e6293'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_63218873e6294')) { //Purpose ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Purpose: </span>
                                                <?= get_sub_field('field_63218873e6294'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_632189e140b9a')) { //Based in/Locations ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Based in: </span>
                                                <?= get_sub_field('field_632189e140b9a'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_663c265fb6035')) { //Service area ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Service area: </span>
                                                <?= get_sub_field('field_663c265fb6035'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_6321887de6295')) { //Sector ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Sector: </span>
                                                <?= get_sub_field('field_6321887de6295'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_63218888e6296')) { //incorporated ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Incorporated?: </span>
                                                <?= get_sub_field('field_63218888e6296'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_63218891e6297')) { //Governance features ?>
                                            <div class="post-details__text rounded-list">
                                                <span class="single-event__pricing-type">Governance structures: </span>
                                                <?= get_sub_field('field_63218891e6297'); ?></div>
                                        <?php } ?>

                                        <?php if (get_sub_field('field_63218899e6298')) : //Achievements ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">Achievements: </span>
                                                <ul class="rounded-list">
                                                    <?php foreach (get_sub_field('field_63218899e6298') as $achievements) : ?>
                                                        <li><?php echo $achievements['item']; ?></li>
                                                    <?php endforeach ?>
                                                </ul>

                                            </div>
                                        <?php endif ?>

                                        <?php if (get_sub_field('field_632188c4e629b')) { //This profile last updated ?>
                                            <div class="post-details__text">
                                                <span class="single-event__pricing-type">This profile last updated: </span>
                                                <?= get_sub_field('field_632188c4e629b'); ?></div>
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile;  endif; ?>

                        </div>

                        <?php if (get_field('social_links')): ?>
                            <div class="post-details__item">
                                <div class="social-links__heading ">Event's Social Links:</div>
                                <div class="social-links">
                                    <?php foreach (get_field('social_links') as $social_links) : ?>
                                        <div class="social-links__item">
                                            <a class="social-links__item-link" href="<?= $social_links['link'] ?>" target="_blank">
                                                <i class="<?= $social_links['icon'] ?>"></i>
                                            </a>
                                        </div>
                                    <?php endforeach ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if (get_field('share_download')) : ?>
                            <?php get_template_part('template-parts/content-blocks/content', 'share-download', get_the_ID()); ?>
                        <?php endif ?>

                        <!--                        --><?php //if (get_field('share_download')) : ?>
                        <!--                            <div class="post-technical-block bordered content-item post-details__item">-->
                        <!--                                --><?php //if (get_field('share_download')['enable_share']) : ?>
                        <!--                                    --><?php //get_template_part('template-parts/content-blocks/content', 'social-share'); ?>
                        <!--                                --><?php //endif ?>
                        <!--                                --><?php //if (get_field('share_download')['enable_print']) : ?>
                        <!--                                    <div class="post-technical__item">-->
                        <!--                                        <div class="post-technical__title">Print</div>-->
                        <!--                                        <a class="post-technical__button print-button" href="#">-->
                        <!--                                            <img src="/wp-content/themes/aigi/assets/images/print.svg" alt="print">-->
                        <!--                                        </a>-->
                        <!--                                    </div>-->
                        <!--                                --><?php //endif ?>
                        <!--                                --><?php //if (get_field('share_download')['enable_download']) : ?>
                        <!--                                    <div class="post-technical__item">-->
                        <!--                                        <div class="post-technical__title">Download</div>-->
                        <!--                                        <a class="post-technical__button" href="--><?php //echo get_field('share_download')['download_file']['url']?><!--"  target="_blank">-->
                        <!--                                            <img src="/wp-content/themes/aigi/assets/images/download-big.svg" alt="download">-->
                        <!--                                        </a>-->
                        <!--                                    </div>-->
                        <!--                                --><?php //endif ?>
                        <!--                                --><?php //if (get_field('share_download')['enable_save']) : ?>
                        <!--                                    <div class="post-technical__item">-->
                        <!--                                        <div class="post-technical__title">Save</div>-->
                        <!--                                        <a class="post-technical__button" href="">-->
                        <!--                                            <img src="/wp-content/themes/aigi/assets/images/star-review.svg" alt="save">-->
                        <!--                                        </a>-->
                        <!--                                    </div>-->
                        <!--                                --><?php //endif ?>
                        <!---->
                        <!--                            </div>-->
                        <!--                        --><?php //endif ?>


                    </div>
                </div>
                <div class="col-content">
                    <div class="has-sidebar__inner">
                        <?php the_content() ?>
                        <?php $content_items = get_field('content_items'); ?>
                        <?php get_template_part('template-parts/content-blocks/content', 'custom-content', $content_items); ?>

                        <div class="footones_custom_wrapper">
                            <ul class="footones_custom_list"></ul>
                        </div>

                        <?php get_template_part( 'nav', 'below-single' ); ?>

                    </div>

                </div>

            </div>

        </div>


        <?php get_template_part('template-parts/layout', 'page-after-content-blocks'); ?>
        <?php endwhile; endif; ?>
        <footer class="footer">

        </footer>
</main>
<?php get_footer(); ?>
