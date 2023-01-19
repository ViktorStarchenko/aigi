<?php $terms =  wp_get_post_terms( get_the_id(), 'resource_type', array('fields' => 'names') );?>
<?php
$type = '';
$resource_bg_extended = '';
$tag_title = '';
$data_video_suf = '';
 if($terms[0] == 'Video') {
     $type = 'video';
     $resource_bg_extended = 'extended';
     $data_video_suf = random_int(0, 999);
 } else if ($terms[0] == 'Link') {
     $type = 'link';
 } else if ($terms[0] == 'Diagram') {
    if (get_field('diagram_type') == 'Table') {
        $type = 'table';
    } else if (get_field('diagram_type') == 'Rightaligned' || get_field('add_diagram')) {
        $type = 'image';
        $resource_bg_extended = 'extended';
    }
 } else if ($terms[0] == 'File') {
     $type = 'file';
 } else if ($terms[0] == 'Example' || $terms[0] == 'Reflection Questions') {
     $term_list = wp_get_post_terms(get_the_ID(), 'resource_tag', array("fields" => "names"));
     $the_tags = implode(", ", $term_list);
     if($the_tags == 'Tips'):

         $tag_title = 'Tips: ';
     else:
         $tag_title = 'Example: ';
     endif;
     $type = 'tips';
 } else if ($terms[0] == 'Publication') {
     $type = 'publication';
     if (get_field('td_resource_image')) {
         $resource_bg_extended = 'extended';
     }
 }
 ?>
<div class="single-resource__container <?php echo $type;?> <?php echo $resource_bg_extended;?> post-status-<?php echo get_post_status(get_the_ID()); ?>">
    <div class="single-resource__bg <?php echo $resource_bg_extended;?>"></div>
    <div class="single-resource__inner">
        <div class="single-resource__header">
            <div class="single-resource__title">
                <?php if (get_post_status(get_the_ID()) == 'publish') {?>
                    <?php if ($terms[0] == 'Reflection Questions') { ?>
                        <span><? echo (get_field('add_heading')) ? get_field('add_heading') : 'Reflection Questions' ?></span>
                    <?php } else { ?>
                        <a href="<?php echo  get_the_permalink(get_the_ID()) ?>"><?=$tag_title?><?php the_title();?></a>
                    <?php } ?>

                <?php } else if (get_post_status(get_the_ID()) == 'draft') { ?>
                    <?php if ($terms[0] == 'Reflection Questions') { ?>
                        <span><? echo (get_field('add_heading')) ? get_field('add_heading') : 'Reflection Questions' ?></span>
                    <?php } else { ?>
                        <span><?=$tag_title?><?php the_title();?></span>
                    <?php } ?>
                <?php } ?>

            </div>
            <span class="single-resource__icon  <?php echo $type;?>"></span>
        </div>
        <div class="single-resource__body">

            <?php if(get_field('youtube_code')): ?>
                <div class="resource-video__wrap">
<!--                    <object width="100%" height="100%"><param name="movie" value="https://www.youtube.com/v/--><?php //the_field('youtube_code'); ?><!--?wmode=transparent&version=3&amp;hl=en_US&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="https://www.youtube.com/v/--><?php //the_field('youtube_code'); ?><!--?version=1&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" width="460" height="264" allowscriptaccess="always" allowfullscreen="true"></embed></object>-->
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php the_field('youtube_code'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php endif; ?>

            <?php if(get_field('add_file')  && $terms[0] == 'Video'): ?> <!-- Video -->
                <div class="resource-video__wrap">
                    <div class="online__video-wrap">
                        <video  preload="metadata" class="paused online-video" data-watched="false" data-issetsrc="false" data-video="<?php echo get_the_ID()?>-<?php echo $data_video_suf ?>" playsinline="" webkit-playinginline="" heght="auto" width="100%" src="<?php echo get_field('add_file')['url']?>">
                        </video>
                        <div class="video-button-wrap">
                            <button id="online__video-button" class="play online__video-button fist-lesson-button" data-video="<?php echo get_the_ID()?>-<?php echo $data_video_suf ?>">
                                <span class="play-button-body"></span>
                            </button>
                        </div>
                        <div class="video-pause-wrap" data-video="<?php echo get_the_ID()?>-<?php echo $data_video_suf ?>">
                            <button id="online__video-pause-button" class="pause"></button></div>
                    </div>
                </div>
            <?php endif ?>

            <?php if (get_field('add_diagram')) : ?> <!-- Diagram -->
<!--                <div class="resource-image__wrap">-->
<!--                    <picture>-->
<!--                        <img src="--><?php //echo get_field('add_diagram');?><!--" alt="--><?php //the_title();?><!--">-->
<!--                    </picture>-->
<!--                </div>-->
                <div class="popup_item_wrapper resource-image__wrap" data-popup="">
                    <img class="popup_button zoom-popup_button zoom-popup_button-<?php echo get_the_ID(); ?>" id="popup-main-wrapper-<?php echo get_the_ID(); ?>" src="<?php echo get_field('add_diagram');?>" alt="<?php the_title();?>">

                    <div class="popup-main-wrapper">
                        <div class="item_popup_wrapper">
                            <div class="popup_overlay"></div>

                            <div class="popup_content_wrapper download-pdf">
                                <div class="item_popup_content_inner">
                                    <div class="popup_close_button popup_close_button-<?php echo get_the_ID(); ?>"></div>
                                    <div class="download-pdf__wrapper modal modal-content">
                                        <div class="post-content-form">
                                            <div class="scholarship-open-form__wrapper zoom">
                                                <img class="media" src="<?php echo get_field('add_diagram');?>" alt="<?php the_title();?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="popup_content_footer">
                                        <img src="/wp-content/themes/aigi/assets/images/group.svg" alt="footer">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endif ?>

            <?php if (get_field('td_resource_image')) : ?> <!-- Publication -->
                <div class="resource-image__wrap">
                    <picture>
                        <img src="<?php echo get_field('td_resource_image')['url'];?>" alt="<?php echo get_field('td_resource_image')['title'];?>">
                    </picture>
                </div>
            <?php endif ?>

<!--            --><?php //if (get_field('preview_thumbnail')) : ?>
<!--                <div class="resource-image__wrap">-->
<!--                    <picture>-->
<!--                        <img src="--><?php //echo get_field('preview_thumbnail');?><!--" alt="--><?php //the_title();?><!--">-->
<!--                    </picture>-->
<!--                </div>-->
<!--            --><?php //endif ?>

<!--            --><?php //if (get_field('add_image')) : ?>
<!--                <div class="resource-image__wrap">-->
<!--                    <picture>-->
<!--                        <img src="--><?php //echo get_field('add_image');?><!--" alt="--><?php //the_title();?><!--">-->
<!--                    </picture>-->
<!--                </div>-->
<!--            --><?php //endif ?>

            <?php if(get_field('add_text') && $terms[0] == 'Example'): ?> <!-- Example -->
                <div class="resource__text">
                    <?php the_field('add_text'); ?>
                </div>
            <?php elseif(get_field('add_text') && !($terms[0] == 'Example')) : ?>
                <div class="resource__text">
                    <?php the_field('add_text'); ?>
                </div>
            <?php endif; ?>

            <?php if(get_field('td_resource_content')): ?> <!--publication -->
            <div class="resource__text">
                <?php the_field('td_resource_content'); ?>
            </div>
            <?php endif ?>

            <?php if(get_field('add_link')): ?> <!-- Link -->
                <div class="resource-link">
                    <a target="_blank" href="<?php echo get_field('add_link'); ?>"><?php echo parse_url(get_field('add_link'), PHP_URL_HOST); ?></a>
                </div>
            <?php endif; ?>


            <?php if(get_field('td_resource_download')['file']): ?> <!--publication -->
                <div class="resource-link file">
                    <a target="_blank" href="<?php echo get_field('td_resource_download')['file']; ?>"><?php echo get_field('td_resource_download')['link_text']; ?></a>
                </div>
            <?php endif; ?>

            <?php if(get_field('add_file') && !($terms[0] == 'Video')): ?> <!-- Video -->
                <div class="resource-link file">
                    <a href="<?php echo get_field('add_file'); ?>" download><?php echo aigi_get_filename_from_url( get_field('add_file') ); ?></a>
                </div>
            <?php endif; ?>

            <?php if(get_field('how_to_use')): ?>
            <div class="resource__text">
                <p><strong>How To Use:</strong><br/><?php echo get_field('how_to_use'); ?><p>
            </div>

                <?php endif; ?>

        </div>

        <div class="single-resource__footer"></div>
    </div>

</div>


<script>
    jQuery( window ).on('load resize', function() {
        if (jQuery(window).width() > 992) {

            zoom({
                active: "zoom-active", // Class added to container when it is zoomed
                transition: "zoom-transition", // Class added to images when they are being animated, class is removed after animation is finished
                visible: "visible", // Class added to images after they are loaded,
                zoom: "zoom" // Image container class
            }, {
                scaleDefault: 2, // Used on doubleclick, doubletap and resize
                scaleDifference: 0.1, // Used on wheel zoom
                scaleMax: 10, // Maximum zoom
                scaleMin: 1, // Minimum zoom
                scrollDisable: true, // Disable page scrolling when zooming an image
                transitionDuration: 900, // This should correspond with zoom-transition transition duration
                doubleclickDelay: 300 // // Delay between clicks - used when scripts decides if user performed doubleclick or not
            }, (function ($container, zoomed) {
                console.log(zoomed); // Callback, gets triggered whenever active class is added/removed from container, value of zoomed is true or false
            }));

        }

    })
</script>

<!--<script type="text/javascript">-->
<!--    zoom();-->
<!--</script>-->
<?php wp_reset_query(); ?>
