<div class="map-marker__container tooltip-test">
    <div class="map-marker__body">
        <div class="map-marker__head">
            <div class="map-marker__location">
                <div class="map-marker__location-text">
                    <?php echo get_field('c_studies_locationtion', get_the_id())['address']['state_short']; ?>
                </div>
            </div>
            <span class="map-marker__pub-date"><?php echo date("M d Y", strtotime(get_the_date())); ?></span>
        </div>
    </div>
    <span class="map-marker-content"><?php the_title(); ?></span>
    <div class="map-marker__footer"></div>
</div>