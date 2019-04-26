<?php

/**
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights},  All rights reserved.
 * @license     ${license.name}; see ${license.url}
 * @author      ${author.name}
 */

use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

/**
 * Helper for mod_bpslider
 */
abstract class ModBPSliderHelper
{

    /**
     * Get button url from slide parameters.
     *
     * @param object $slide Slide object.
     * @return string
     * @since 1.0.0
     */
    public static function getButtonUrl(object $slide): string
    {
        switch ($slide->button_type) {
            case 'article':
                return Route::_(ContentHelperRoute::getArticleRoute($slide->button_article));
                break;
            case 'menu':
                return Route::_('index.php?Itemid=' . $slide->button_menu);

                break;
            default:
                return $slide->button_url;
        }
    }

    /**
     * Get asset url.
     *
     * @param string $url Asset regular url.
     * @return string
     */
    public static function getAssetUrl(string $url): string
    {
        $manifest = json_decode(file_get_contents(JPATH_SITE . '/modules/mod_bpslider/assets/manifest.json'), true);

        $url = ltrim($url, '/');
        if (key_exists($url, $manifest)) {
            $url = $manifest[$url];
        }

        return $url;
    }

}