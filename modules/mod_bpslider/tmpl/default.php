<?php

/**
 * @package     ${package}
 * @subpage     ${package}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

use BPExtensions\Module\BPSlider\Site\Helper\AssetsHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\WebAsset\WebAssetManager;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

/**
 * @var Registry        $params
 * @var AssetsHelper    $assetsHelper
 * @var WebAssetManager $assetsManager
 * @var array           $options
 * @var array           $slides
 * @var stdClass        $module
 * @var string          $effect
 * @var string          $moduleclass_sfx
 * @var string          $layout
 * @var int             $id
 * @var int             $min_height
 * @var boolean         $navigation
 * @var boolean         $pagination
 */

// Add module assets
$assetsManager->useScript('jquery');
$assetsHelper->addEntryPointAssets('module'); // <- Module core assets (required)
$assetsHelper->addEntryPointAssets('theme'); // <- Module basic styling (optional)

// Fix slider height for vertical height
if ($effect === 'slide-vertical')
{
	$assetsManager->addInlineScript("
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
	$assetsManager->addInlineStyle("
        #$id .swiper-slide>div{min-height: {$min_height}px};
    ");
}

$options = json_encode($options, JSON_FORCE_OBJECT);
$assetsManager->addInlineScript("
    jQuery(function($){
        var ModBPSlider{$module->id} = new mod_bpslider_Swiper('#$id', $options);
    });
");
?>
<div class="modbpslider<?php echo $moduleclass_sfx ?>">

    <div id="<?php echo $id ?>" class="swiper">
        <div class="swiper-wrapper align-items-stretch">
			<?php foreach ($slides as $slide):
				$slide_title = $slide->title;
				$slide_image = $slide->image;
				$slide_text = $slide->text;
				$slide_button = $slide->button;
				$slide_button_type = $slide->button_type;
				$slide_button_title = $slide->button_title;
				$has_desc = (!empty($slide_title) || !empty($slide_text));
				?>
                <div class="swiper-slide h-auto">
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
