<?php

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

/**
 * @package     ${package}
 * @subpage     ${package}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

/**
 * @var Registry $params
 */

JHtml::_('jquery.framework');
$doc->addScript(ModBPSliderHelper::getAssetUrl('/modules/mod_bpslider/assets/module.js'), ['version' => 'auto']);
$doc->addStyleSheet(ModBPSliderHelper::getAssetUrl('/modules/mod_bpslider/assets/module.css'), ['version' => 'auto']);
$doc->addStyleSheet(ModBPSliderHelper::getAssetUrl('/modules/mod_bpslider/assets/theme.css'), ['version' => 'auto']);

// Fix slider height for vertical height
if ($effect === 'slide-vertical')
{
	$doc->addScriptDeclaration("
        jQuery(function($){
        
            var {$id}CountHeight = function(){
                var maxHeight = $min_height;
                var slides = $('#$id .swiper-slide>div') 
                slides.each(function(idx,el){
                    var h = $(el).outerHeight();
                    if( h>maxHeight) maxHeight = h; 
                });
                slides.each(function(idx,el){
                    $(el).css('height', maxHeight+'px');
                });
                
                $('#$id').css('height', maxHeight+'px');
            }
            
            {$id}CountHeight();
            $(window).resize({$id}CountHeight);
        });
    ");
}

// Min slider height
if ($min_height)
{
	$doc->addStyleDeclaration("
        #$id .swiper-slide>div{min-height: {$min_height}px};
    ");
}

$options = json_encode((object) $options);
$doc->addScriptDeclaration("
    jQuery(function($){
        var ModBPSlider{$module->id} = new Swiper('#$id', $options);
    });
");
?>
<div class="modbpslider<?php echo $moduleclass_sfx ?> bootstrap2">

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
            <div class="swiper-button-next" id="<?php echo $id ?>-swiper-button-next"></div>
            <div class="swiper-button-prev" id="<?php echo $id ?>-swiper-button-prev"></div>
        <?php endif ?>

        <?php if ($pagination): ?>
            <!-- Add Pagination -->
            <div class="swiper-pagination" id="<?php echo $id ?>-swiper-pagination"></div>
        <?php endif ?>

    </div>

</div>
