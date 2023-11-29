<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 */

defined('_JEXEC') or die;

use BPExtensions\Module\BPSlider\Site\Helper\SliderHelper;

/**
 * @var boolean $has_desc
 * @var boolean $slide_button
 * @var string  $slide_image
 * @var string  $slide_button_title
 * @var string  $slide_title
 * @var object  $slide
 */

?>
<?php if ($has_desc): ?>
    <div class="swiper-bg-image d-flex align-items-center h-100" <?php if (!empty($slide_image)): ?> style="background-image:url('<?php echo $slide_image ?>');"<?php endif ?>>
        <div class="container-fluid">
            <div class="row justify-content-end align-items-center">

                <!-- Desktop layout-->
                <div class="col-12 col-lg-6 col-xl-4">
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
    <div class="swiper-bg-image" <?php if (!empty($slide_image)): ?> style="background-image:url('<?php echo $slide_image ?>');"<?php endif ?>>
        <img src="<?php echo $slide_image ?>" alt="<?php echo htmlentities($slide_title) ?>"
             style="width:100%;opacity:0">
    </div>
<?php endif ?>
