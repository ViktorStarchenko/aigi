<?php
/*
* Template Name: Donation page
* Template Post Type: page
*/
?>

<?php get_header(); ?>
<main id="content" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="main-inner search-page">
            <div class="wrapper-full-width content-wrapper">
                <div class="wrapper-1245 content-wrapper">
                    <div class="donation__heading_section">
                        <?php if (get_field('header_section')['title']) {?>
                            <div class="donation__heading_title">
                                <p ><?php echo get_field('header_section')['title']; ?></p>
                            </div>
                        <?php } ?>
                        <?php if (get_field('header_section')['description']) {?>
                            <div class="donation__heading_description">
                                <?php echo get_field('header_section')['description']; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="wrapper-1245 content-wrapper">
                <div class="donation-details">
                    <div class="donation__image">
                        <?php if (get_field('donation_details')['image']) {?>
                            <img src="<?php echo get_field('donation_details')['image']['url'] ?>" alt="<?php echo get_field('donation_details')['image']['title']; ?>">
                        <?php } ?>
                    </div>
                    <div class="donation__content">
                        <?php if (get_field('donation_details')['title']) {?>
                            <div class="donation__title">
                                <p><?php echo get_field('donation_details')['title']; ?></p>
                            </div>
                        <?php } ?>
                        <?php if (get_field('donation_details')['description']) {?>
                            <div class="donation__description">
                                <?php echo get_field('donation_details')['description']; ?>
                            </div>
                        <?php } ?>
                        <?php if (get_field('donation_details')['donorbox_widget']) {?>
                            <div class="donation__widget">
                                <?php echo get_field('donation_details')['donorbox_widget']; ?>
                            </div>
                        <?php } ?>
                    </div>

                </div>



            </div>
            <?php get_template_part('template-parts/layout', 'page-after-content-blocks'); ?>
        </div>

    <?php endwhile; endif; ?>
    <footer class="footer">

    </footer>
</main>

<?php get_footer(); ?>







