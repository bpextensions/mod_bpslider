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
    <div class="row" style="background-image:url('<?php echo $slide_image ?>');">

        <!-- Desktop layout-->
        <div class="span4 offset8 visible-desktop visible-tablet">
            <div class="wrapper">
                <?php if (!empty($slide_title)): ?>
                    <h4 class="title"><?php echo $slide_title ?></h4>
                <?php endif ?>
                <?php if (!empty($slide_text)): ?>
                    <div class="text">
                        <?php echo $slide_text ?>
                    </div>
                <?php endif ?>
                <?php if ($slide_button): ?>
                    <a href="<?php echo ModBPSliderHelper::getButtonUrl($slide) ?>" class="btn btn-primary">
                        <?php echo $slide_button_title ?>
                    </a>
                <?php endif ?>
            </div>
        </div>

        <!-- Mobile layout-->
        <div class="span12 hidden-desktop hidden-tablet">
            <div class="wrapper">
                <?php if (!empty($slide_title)): ?>
                    <h4 class="title"><?php echo $slide_title ?></h4>
                <?php endif ?>
                <?php if (!empty($slide_text)): ?>
                    <div class="text">
                        <?php echo $slide_text ?>
                    </div>
                <?php endif ?>
                <?php if ($slide_button): ?>
                    <a href="<?php echo ModBPSliderHelper::getButtonUrl($slide) ?>" class="btn btn-primary">
                        <?php echo $slide_button_title ?>
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <img src="<?php echo $slide_image ?>" alt="<?php echo htmlentities($slide_title) ?>">
<?php endif ?>
