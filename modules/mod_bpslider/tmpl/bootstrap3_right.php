<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 *
 */

defined('_JEXEC') or die;

?>
<?php if ($has_desc): ?>
    <div class="row swiper-bg-image" <?php if (!empty($slide_image)): ?> style="background-image:url('<?php echo $slide_image ?>');"<?php endif ?>>

        <!-- Desktop layout-->
        <div class="col-xs-12 col-lg-4 col-lg-offset-8">
            <div class="wrapper modbpslider-padding">
                <?php if (!empty($slide_title)): ?>
                    <h4 class="title"><?php echo $slide_title ?></h4>
                <?php endif ?>
                <?php if (!empty($slide_text)): ?>
                    <div class="text">
                        <?php echo $slide_text ?>
                    </div>
                <?php endif ?>
                <?php if ($slide_button): ?>
                    <a href="<?php echo ModBPSliderHelper::getButtonUrl($slide) ?>" class="btn btn-outline-primary">
                        <?php echo $slide_button_title ?>
                    </a>
                <?php endif ?>
            </div>
        </div>

    </div>
<?php else: ?>
    <div class="swiper-bg-image" <?php if (!empty($slide_image)): ?> style="background-image:url('<?php echo $slide_image ?>');"<?php endif ?>>
        <img src="<?php echo $slide_image ?>" alt="<?php echo htmlentities($slide_title) ?>"
             style="width:100%;opacity:0">
    </div>
<?php endif ?>
