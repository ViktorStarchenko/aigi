<?php

$organization = get_field('organization',$post);

if ($organization) { ?>
    <div class="post-details__item organisation-info" style="font-size: 14px;line-height: 22px;letter-spacing: 0.08em;margin-bottom: 32px;">
        <div class="post-details__heading">Organisation</div>
        <?php if ($organization['name']) { ?>
            <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
                <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Name: </span>
                <p class="single-event__pricing-type"><?= $organization['name']; ?></p></div>
        <?php } ?>

        <?php if ($organization['about']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">About: </span>
            <?= $organization['about']; ?></div>
        <?php } ?>

        <?php if ($organization['purpose']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Purpose: </span>
            <?= $organization['purpose']; ?></div>
        <?php } ?>

        <?php if ($organization['sector']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Sector: </span>
            <?= $organization['sector']; ?></div>
        <?php } ?>

        <?php if ($organization['locations']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Location/s: </span>
            <?= $organization['locations']; ?></div>
        <?php } ?>

        <?php if ($organization['incorporated']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Incorporated?: </span>
            <?= $organization['incorporated']; ?></div>
        <?php } ?>

        <?php if ($organization['governance_features']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Governance features: </span>
            <?= $organization['governance_features']; ?></div>
        <?php } ?>

        <?php if ($organization['achievements']) : ?>
            <div class="post-details__text" style="margin-bottom: 16px;">
                <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Achievements: </span>
                <ul class="rounded-list">
                    <?php foreach ($organization['achievements'] as $achievements) : ?>
                        <li><?php echo $achievements['item']; ?></li>
                    <?php endforeach ?>
                </ul>

            </div>
        <?php endif ?>

        <?php if ($organization['website']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">Website: </span>
            <a target="_blank" href="<?= $organization['website']; ?>"><?= $organization['website']; ?></a>
        </div>
        <?php } ?>

        <?php if ($organization['this_profile_last_updated']) { ?>
        <div class="post-details__text inline" style="margin-bottom: 16px;display: inline">
            <span class="single-event__pricing-type" style="font-weight: bold; font-size: 15.78px; line-height: 20px;display: flex;align-items: center;letter-spacing: 0.02em; color: #131032cc;">This profile last updated: </span>
            <?= $organization['this_profile_last_updated']; ?></div>
        <?php } ?>
    </div>
<?php }
