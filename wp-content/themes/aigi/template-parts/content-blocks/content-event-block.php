

<?php if (get_sub_field('content')) :
    $content = get_sub_field('content');


    if ($content['resource_type'] == 'upcoming') {

        $temp = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'event',
                'post_status' => 'publish',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'event_group',
                        'field'    => 'slug',
                        'terms'    => array('event', 'masterclass'),
                    ),
                    array(
                        'taxonomy' => 'event_type',
                        'field'    => 'slug',
                        'terms'    => array('upcoming-events'),
                    ),
                ),
            )
        );
        $featured_posts = $temp;

    } else if ($content['resource_type'] == 'custom') {
        $featured_posts = $content['event'];
    }

endif ?>

<?php if (get_sub_field('attributes')) :
    $attributes = get_sub_field('attributes');
endif ?>

<?php
$background_texture = '';
if ($attributes['background']['background_texture']) :
    $background_texture_classes = $attributes['background']['background_texture'];
    $background_texture = implode(" ", $background_texture_classes);
endif;
?>

<?php
$padding = '';
if ($attributes['padding']) :
    foreach ($attributes['padding'] as $key=>$value) {
        $padding .=' ' . strval($value) . ' ';
    }
endif;
?>

<?php
$border = '';
if ($attributes['border']) :
    foreach ($attributes['border'] as $key=>$value) {
        $border .=' ' . strval($value) . ' ';
    }
endif;
?>

<?php
$classes = '';
//if ($attributes['wrappers']['section_wrapper']) {
//    $classes .= ' ' . $attributes['wrappers']['section_wrapper'] . ' ';
//}
if ($attributes['section_class']) {
    $classes .= ' ' . $attributes['section_class'] . ' ';
}
if ($attributes['margin']['margin_top']) {
    $classes.= ' ' . $attributes['margin']['margin_top'] . ' ';
}
if ($attributes['margin']['margin_bottom']) {
    $classes.= ' ' . $attributes['margin']['margin_bottom'] . ' ';
}
if ($attributes['background']['background_image']) {
    $classes.= '  bg-image ';
}
$bg_color = '';
if ($attributes['background']['background_color']) {
    $bg_color =  $attributes['background']['background_color'];
}

$bg_color_preset = '';
if ($attributes['background']['bg_color_preset']) {
    $bg_color_preset =  $attributes['background']['bg_color_preset'];
}
?>


<?php if ($attributes) : ?>
    <style>
        .acf-section-<?php echo $attributes['uniq_id']; ?> {
        <?php if ($attributes['background']['background_color']) : ?>
            /*background-color: */<?php //echo $attributes['background']['background_color']; ?>/*;*/
        <?php endif ?>
        <?php if ($attributes['background']['background_image']) : ?>
            /*background-image: url(*/<?php //echo $attributes['background']['background_image']['url']; ?>/*);*/
        <?php endif ?>
        <?php if ($attributes['section_height']['height_numbers']) : ?>
            height: <?php echo $attributes['section_height']['height_numbers']; ?><?php echo $attributes['section_height']['height_value']; ?>
        <?php endif ?>

        }
        @media (max-width: 767px) {
            .acf-section-<?php echo $attributes['uniq_id']; ?> {
            <?php if ($attributes['section_height']['height_numbers_mobile']) : ?>
                height: <?php echo $attributes['section_height']['height_numbers_mobile']; ?><?php echo $attributes['section_height']['height_value_mobile']; ?>
            <?php endif ?>
            }
        }
    </style>
<?php endif // end padding styles ?>


<section
        class="post-slider-section event-block-section wrapper-full-width acf-section-<?php echo get_row_index() . ' '; ?>
acf-section-<?php echo $attributes['uniq_id']. ' '; ?><?php echo $classes ?><?= $background_texture; ?><?= $padding; ?><?= $border; ?> <?= $bg_color_preset; ?>" id="<?php  echo ($attributes['section_id'] ? $attributes['section_id'] :''); ?>" style="background-image: url(<?php echo $attributes['background']['background_image']['url']; ?>); <?php  echo ($bg_color ?  'background-color: ' . $bg_color . ';' :''); ?> ">
    <div class="bg-overlay <?php  echo ($attributes['background']['enable_overlay'] == true ?  ' active ' : ''); ?>"></div>
    <div class="wrapper-1245 content-wrapper">
        <div class="rslider__header">
            <div class="rslider__header-top">
                <div class="rslider__heading"><?= $content['heading']; ?></div>
                <div class="rslider_nav rslider_nav-<?php echo $attributes['uniq_id'];?> slider-arrows"></div>
            </div>
            <div class="rslider__desc"><?= $content['event_subtitle'] ?></div>

        </div>
    </div>
    <div class="wrapper-1245 content-wrapper landing-page">


            <div class="rslider__wrapper">
                <?php

                if( $featured_posts ) { ?>
                <div class="slider post-slider post-slider-<?php echo $attributes['uniq_id'];?> rslider__resources">


                        <?php foreach( $featured_posts as $post ) :
                            $post_type = get_post_type( $post->ID );
                        setup_postdata( $post ); ?>
                    <?php


                        $post_type = get_post_type( get_the_ID() );
                        $event_group =  wp_get_post_terms( get_the_ID(), 'event_group');
                        $appearance = get_field('appearance');
                    ?>
                    <div>
                        <div class="post-tile__wrap <?= $post_type; ?> post-<?php echo get_the_ID(); ?>">
                            <div class="post-tile__mob-header">
                                <div class="post-tile__tags">
                                    <?php $term_list = wp_get_post_terms( get_the_ID(), 'content_tags', array('fields' => 'all') );
                                    foreach ($term_list as $term) :
                                        ?>
                                        <a class="content-tags__item" href="/search?/?_content_tags=<?php echo $term->slug ?>" data-tem-id="<?php echo  $term->term_id ?>"><?php echo $term->name ?></a>
                                    <?php endforeach ?>
                                </div>
                                <?php $googleCalendarLink = googleCalendarLink() ?>
                                <a href="<?php echo $googleCalendarLink ?>" target="_blank" class="add-to-calendar"></a>
                            </div>
                            <div class="post-tile__img-box">
                                <div class="post-tile__img">
                                    <?php if (get_the_post_thumbnail_url( get_the_ID(), 'full' )) { ?>
                                        <a href="<?= get_the_permalink(get_the_ID()) ?>">
                                            <img class="post-tile__thumb" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?>" alt="<?php the_title(); ?>">
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= get_the_permalink(get_the_ID()) ?>"></a>
                                    <?php } ?>
                                </div>

                                <div class="btn-group f-start m-center">

                                    <a href="<?php echo $googleCalendarLink ?>" target="_blank" class="btn-body  btn-transparent  calendar  after  Between " tabindex="0">
                                        <span class="btn-inner">Add to Calendar</span>
                                    </a>
                                    <a href="<?=  get_the_permalink(get_the_ID()) ?>" target="" class="btn-body btn-h-secondary-blue triangle after Between" tabindex="0">
                                        <span class="btn-inner">View Details</span>
                                    </a>
                                </div>

                            </div>


                            <div class="post-tile__content">
                                <div class="post-tile__content-header">
                                    <div class="post-tile__left">
                                        <?php if (get_field('location')['address']): ?>
                                            <span class="post-tile__location"><a href="https://maps.google.com/?q=<?php echo get_field('location')['address']['lat'];?>,<?php echo get_field('location')['address']['lng'];?>" target="_blank"><?php echo get_field('location')['address']['address']?></a></span>
                                        <?php endif ?>

                                        <?php if (get_field('events_details')['start_date']) : ?>
                                            <span class="post-tile__pub-date"><?php echo date("M d Y", strtotime(get_field('events_details')['start_date']))?></span>
                                        <?php endif ?>
                                    </div>

                                    <div class="post-tile__right">

                                    </div>
                                </div>
                                <div class="post-tile__content-body">
                                    <div class="post-tile__tags">
                                        <?php $term_list = wp_get_post_terms( get_the_ID(), 'content_tags', array('fields' => 'all') );
                                        foreach ($term_list as $term) : ?>
                                            <a class="content-tags__item" href="/search?_content_tags=<?php echo $term->slug ?>" data-tem-id="<?php echo  $term->term_id ?>"><?php echo $term->name ?></a>
                                        <?php endforeach ?>
                                    </div>

                                    <div class="post-tile__title">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                    <div class="post-tile__excerpt"><p><?php echo get_custom_excerpt(get_the_excerpt(), 213, true) ?></p></div>
                                </div>
                                <div class="post-tile__content-footer">
                                    <div class="post-tile__pricing-block">
                                        <?php if (get_field('pricing')['freepaid'] == 'paid') : ?>
                                            <div class="post-tile__pricing-title">
                                                Event Pricing
                                            </div>
                                            <div class="post-tile__pricing-list">
                                                <?php if (get_field('pricing')['early_bird']) : ?>
                                                    <div class="post-tile__pricing-item">
                                                        <span class="post-tile__pricing-type">Early Bird</span>
                                                        <span class="post-tile__pricing-price">$<?php echo get_field('pricing')['early_bird']; ?></span>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (get_field('pricing')['full_price']) : ?>
                                                    <div class="post-tile__pricing-item">
                                                        <span class="post-tile__pricing-type">Full Price</span>
                                                        <span class="post-tile__pricing-price">$<?php echo get_field('pricing')['full_price']; ?></span>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (get_field('pricing')['partner_price']) : ?>
                                                    <div class="post-tile__pricing-item">
                                                        <span class="post-tile__pricing-type">Partner Price</span>
                                                        <span class="post-tile__pricing-price">$<?php echo get_field('pricing')['partner_price']; ?></span>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (get_field('pricing')['date_rate']) : ?>
                                                    <div class="post-tile__pricing-item">
                                                        <span class="post-tile__pricing-type">Date Rate</span>
                                                        <span class="post-tile__pricing-price">$<?php echo get_field('pricing')['date_rate']; ?></span>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        <?php elseif (get_field('pricing')['freepaid'] == 'free') : ?>
                                            <div class="post-tile__pricing-title">
                                                Event Pricing
                                            </div>
                                            <div class="post-tile__pricing-list">
                                                <div class="post-tile__pricing-item">
                                                    <span class="post-tile__pricing-type">Free</span>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                            </div>
                            <div class="post-tile__slider">

                                <?php
                                $speakers = get_field('speakers');
                                ?>
                                <?php if ($speakers) : ?>
                                    <div class="speakers-slider__heading">
                                        Speakers
                                    </div>
                                    <div class="speakers-slider slider">
                                        <?php foreach ($speakers as $speaker) : ?>
                                            <div>
                                                <div class="speakers-slider__item">
                                                    <div class="speakers-slider__img">
                                                        <?php if (get_the_post_thumbnail_url( $speaker->ID, 'full' )) : ?>
                                                            <img src="<?php echo get_the_post_thumbnail_url( $speaker->ID, 'full' ) ?> " alt="<?= $speaker->post_title ?>">
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="speakers-slider__content">
                                                        <div class="speakers-slider__name">
                                                            <?= $speaker->post_title ?>
                                                        </div>
                                                        <div class="speakers-slider__position">
                                                            <?php echo substr(get_the_excerpt( $speaker->ID), 0,25) ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                    <div class="speakers-slider__nav"></div>
                                <?php endif?>
                            </div>

                            <div class="post-tile__mob-footer">
                                <a href="<?=  get_the_permalink(get_the_ID()) ?>" target="" class="  btn-body  btn-h-secondary-blue  triangle  after  Between " tabindex="0">
                                    <span class="btn-inner">View Details</span>
                                </a>
                            </div>

                        </div>
                    </div>

                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>




                </div>

                <?php } else { ?>

                <div class="rslider__item rslider__resource-item no_events_message">
                    <div class="rslider__item-header" data-height="rsliderHeader">
                                <span class="rslider__item-header-link" href="<?=  get_the_permalink($post->ID) ?>">
                                    <img src="/wp-content/themes/aigi/assets/images/elements-news.svg" alt="news">
                                </span>
                    </div>
                    <div class="rslider__item-body">
                        <div class="no_events_message__content">
                            <?php if ($content['no_events_message']['title']) {?>
                                <span class="rslider__title" data-height="NewsrsliderTitle"><?= $content['no_events_message']['title']; ?></span>
                            <?php } ?>
                            <?php if ($content['no_events_message']['text']) { ?>
                                <div class="rslider__excerpt" data-height="NewsrsliderDesc"><?php echo $content['no_events_message']['text']; ?></div>
                            <?php } ?>
                        </div>

                        <?php if ($content['no_events_message']['enable_button']) {?>
                            <div class="popup_item_wrapper" data-popup="">

                                <div href="#" target="" class="popup_button btn-body  btn-h-secondary-blue  triangle  after  Between" tabindex="0">
                                    <span class="btn-inner"><?= $content['no_events_message']['button_text']; ?></span>
                                </div>


                                <div class="popup-main-wrapper" id="popup-main-wrapper">
                                    <div class="item_popup_wrapper">
                                        <div class="popup_overlay"></div>
                                        <div class="popup_content_wrapper scholarship w-1016">
                                            <div class="item_popup_content_inner">
                                                <div class="popup_close_button"></div>
                                                <div class="scholarship-open__wrapper modal modal-content">
                                                    <div class="post-content-form">
                                                        <div class="scholarship-open-form__wrapper">
                                                            <div class="form-heading">
                                                                <?php if ($content['no_events_message']['modal_title']) {?>
                                                                    <div class="form-title"><?php echo $content['no_events_message']['modal_title']; ?></div>
                                                                <?php } ?>
                                                                <?php if ($content['no_events_message']['modal_text']) { ?>
                                                                    <div class="form-desc"><?php echo $content['no_events_message']['modal_text']; ?></div>
                                                                <?php } ?>

                                                            </div>

                                                            <?php if ($content['no_events_message']['form_id']) : ?>
                                                                <div class=""><?php echo do_shortcode('[gravityform id="'. $content['no_events_message']['form_id'] .'" title="false" description="false" ajax="true" tabindex="49"]');?></div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="popup_content_footer">
                                                    <img src="/wp-content/themes/aigi/assets/images/group.svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>


                    </div>

                </div>

                <?php } ?>
            </div>


    </div>

</section>

<script>
    // Sticky to right sliders

    $('.post-slider-<?php echo $attributes['uniq_id'];?>').slick({
        // variableWidth: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: <?php echo json_encode($content['enable_autoplay']);?>,
        autoplaySpeed: 2000,
        // centerMode: true,
        // centerPadding: '16px',
        adaptiveHeight: true,
        arrows: true,
        appendArrows:'.rslider_nav-<?php echo $attributes['uniq_id'];?>.slider-arrows',
        prevArrow:'<span class="slider-arrow prev"></span>',
        nextArrow:'<span class="slider-arrow next"></span>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    centerPadding: false,
                }
            },
            {
                breakpoint: 580,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    centerPadding: false,
                }
            }

        ]
    });
</script>
