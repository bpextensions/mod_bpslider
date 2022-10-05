/*
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 *
 */

import jquery from 'jquery';
import 'swiper/css/bundle';
import Swiper from 'swiper/bundle';

// Expose jQuery
const $ = jquery;
global.$ = global.jQuery = $;

window.mod_bpslider_Swiper = global.mod_bpslider_Swiper = Swiper;