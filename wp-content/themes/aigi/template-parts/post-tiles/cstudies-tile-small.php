<?php
$post_type = get_post_type( get_the_ID() );
$appearance = get_field('appearance');
?>

<div class="post-tile__wrap small <?= $post_type; ?> post-<?php echo get_the_ID(); ?>  <?php echo ($appearance['disable_header_footer_on_mobile'] == false) ? 'mob-style-2' : '' ?> post-item" data-id="<?php echo get_the_ID(); ?>">

    <div class="post-tile__content">
        <div class="post-tile__content-header">
            <div class="post-tile__left">
                <?php if (get_field('c_studies_locationtion')['address']): ?>
                    <span class="post-tile__location"><a href="https://maps.google.com/?q=<?php echo get_field('c_studies_locationtion')['address']['lat'];?>,<?php echo get_field('c_studies_locationtion')['address']['lng'];?>" target="_blank"><?php echo get_field('c_studies_locationtion')['address']['address']?></a></span>
                <?php endif ?>
            </div>

            <div class="post-tile__right">
                <span class="post-tile__pub-date"><?php echo date("M d Y", strtotime(get_the_date())); ?></span>
            </div>
        </div>
        <div class="post-tile__content-body">
            <div class="post-tile__tags">
                <?php $term_list = wp_get_post_terms( get_the_ID(), 'content_tags', array('fields' => 'all') );
                foreach ($term_list as $term) : ?>
                    <a class="content-tags__item" href="/search?_content_tags=<?php echo $term->slug ?>" data-tem-id="<?php echo  $term->term_id ?>"><?php echo $term->name ?></a>
                <?php endforeach ?>
            </div>

            <a href="<?=  get_the_permalink(get_the_ID()) ?>" class="post-tile__title">
                <span><?php the_title(); ?></span>
            </a>
            <div class="post-tile__excerpt">
                <div class="expandable-text-block">
                    <div class="expandable-text-content">
                        <p>
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    </div>
                    <div class="expandable-toggle-button">Show more</div>
                </div>
            </div>
        </div>
        <div class="post-tile__content-footer">
            <a href="<?=  get_the_permalink(get_the_ID()) ?>" target="" class="btn-body btn-white arrow after Between">
                <span class="btn-inner">READ MORE</span>
            </a>
        </div>

    </div>

</div>
