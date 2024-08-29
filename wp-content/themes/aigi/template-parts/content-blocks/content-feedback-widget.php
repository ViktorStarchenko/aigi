<?php
$feedback_widget = get_field('feedback_widget', 'options');
if ($feedback_widget['enable'] == true) { ?>
    <div class="provide-feedback-widget">
        <div class="popup_item_wrapper" data-popup="">
            <div class="popup_button btn-body  btn-m-blue Between " tabindex="0">
            <span class="btn-inner">
                <?= $feedback_widget['widget_button_text']; ?>
            </span>
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
                                            <?php if (!empty($feedback_widget['title'])) : ?>
                                                <div class="form-title"><?= get_the_title();?>: <?php echo $feedback_widget['title']; ?></div>
                                            <?php endif ?>
                                            <?php if (!empty($feedback_widget['description'])) : ?>
                                                <div class="form-desc"><?php echo $feedback_widget['description']; ?></div>
                                            <?php endif ?>
                                        </div>

                                        <?php if (!empty($feedback_widget['form_id'])) : ?>
                                            <div class=""><?php echo do_shortcode('[gravityform id="'. $feedback_widget['form_id'] .'" title="false" description="false" ajax="true" tabindex="49"]');?></div>
                                        <?php endif ?>
                                    </div>
                                </div>

                            </div>
                            <div class="popup_content_footer">
                                <img src="/wp-content/themes/aigi/assets/images/group.svg" alt="group">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>