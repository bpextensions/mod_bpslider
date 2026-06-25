<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 */

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;

// phpcs:enable PSR1.Files.SideEffects

use BPExtensions\Module\BPSlider\Site\Helper\SliderHelper;

/**
 * @var boolean $has_desc
 * @var boolean $slide_button
 * @var string  $slide_image
 * @var string $slide_image_mobile
 * @var string  $slide_button_title
 * @var string  $slide_title
 * @var object  $slide
 */

?>
<?php if ($has_desc): ?>
    <div class="text-center swiper-bg-image d-flex align-items-center h-100">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <!-- Desktop layout-->
                <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="wrapper modbpslider-padding px-4 py-3">
					    <?php if (!empty($slide_title)): ?>
                            <h3 class="title my-2"><?php echo SliderHelper::nl($slide_title, '<span class="d-none d-md-block"></span> ') ?></h3>
					    <?php endif ?>
					    <?php if (!empty($slide_text)): ?>
                            <div class="text my-2">
							    <?php echo $slide_text ?>
                            </div>
					    <?php endif ?>
					    <?php if ($slide_button): ?>
                            <a href="<?php echo SliderHelper::getButtonUrl($slide) ?>"
                               class="btn btn-outline-light my-2">
							    <?php echo $slide_button_title ?>
                            </a>
					    <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php else: ?>
    <div class="swiper-bg-image">
        <img src="<?php
        echo $slide_image ?>" alt="<?php
        echo htmlentities($slide_title) ?>" class="w-100 opacity-0 d-none d-md-block">
        <img src="<?php
        echo $slide_image_mobile ?>" alt="<?php
        echo htmlentities($slide_title) ?>" class="w-100 opacity-0 d-block d-md-none">
    </div>
<?php endif ?>
