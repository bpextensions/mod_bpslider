<?php

use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

/**
 * @package     ${package}
 * @subpage     ${package}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

JHtml::_('jquery.framework');
$doc->addScript(ModBPSliderHelper::getAssetUrl('/modules/mod_bpslider/assets/module.js'), ['version' => 'auto']);
$doc->addStyleSheet(ModBPSliderHelper::getAssetUrl('/modules/mod_bpslider/assets/module.css'), ['version' => 'auto']);

// Process options
$options = [
    'speed' => $transition_time
];

if ($navigation) {
    $options['navigation'] = [
        'nextEl' => '#' . $id . ' .swiper-button-next',
        'prevEl' => '#' . $id . ' .swiper-button-prev',
    ];
}

if ($pagination) {
    $options['pagination'] = [
        'el' => '#' . $id . ' .swiper-pagination',
        'clickable' => true
    ];
}

if ($autoplay) {
    $options['autoplay'] = [
        'delay' => $autoplay_delay
    ];
}

if ($loop) {
    $options['loop'] = 'true';
}

$options = json_encode((object)$options);
$doc->addScriptDeclaration("
    jQuery(function($){
        var ModBPSlider{$module->id} = new Swiper('#$id', $options);
    });
");
?>
<div class="modbpslider<?php echo $moduleclass_sfx ?> bootstrap3">

    <div id="<?php echo $id ?>" class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide):
                $slide_title = $slide->title;
                $slide_image = $slide->image;
                $slide_text = $slide->text;
                $slide_button = $slide->button;
                $slide_button_type = $slide->button_type;
                $slide_button_title = $slide->button_title;
                $has_desc = (!empty($slide_title) or !empty($slide_text));
                ?>
                <div class="swiper-slide">
                    <?php require ModuleHelper::getLayoutPath('mod_bpslider', $layout . '_' . $slide->layout) ?>
                </div>
            <?php endforeach ?>
        </div>

        <?php if ($navigation): ?>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        <?php endif ?>

        <?php if ($pagination): ?>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        <?php endif ?>

    </div>

</div>
