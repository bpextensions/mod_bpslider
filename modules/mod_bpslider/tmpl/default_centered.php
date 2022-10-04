<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 */

use BPExtensions\Module\BPSlider\Site\Helper\BPToolbarHelper;

defined('_JEXEC') or die;

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
    <div class="text-center swiper-bg-image d-flex align-items-center"
		<?php if (!empty($slide_image)): ?> style="background-image:url('<?php echo $slide_image ?>');"<?php endif ?>>

        <div class="row justify-content-center align-items-center">

            <!-- Desktop layout-->
            <div class="col-12 col-lg-8 col-xl-6">
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
                        <a href="<?php echo BPToolbarHelper::getButtonUrl($slide) ?>" class="btn btn-outline-light">
							<?php echo $slide_button_title ?>
                        </a>
					<?php endif ?>
                </div>
            </div>

        </div>

    </div>
<?php else: ?>
    <div
            class="swiper-bg-image" <?php if (!empty($slide_image)): ?> style="background-image:url('<?php echo $slide_image ?>');"<?php endif ?>>
        <img src="<?php echo $slide_image ?>" alt="<?php echo htmlentities($slide_title) ?>"
             style="width:100%;opacity:0">
    </div>
<?php endif ?>
