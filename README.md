# BP Slider

![PHP 7.2](https://github.com/bpextensions/mod_bpslider/workflows/PHP%207.2-8.0/badge.svg)

Joomla! 3 responsive slider module based on Swiper and Bootstrap.

## Features

- Manage slides:
  - Image
  - Title
  - Text
  - Button (title, url)
  - Layout
    - Enable arrows
  - Enable dots
  - Enable automatic slide change
  - Manage slide change time and delay
  - Enable slides loop
  - Minimum slider height
- Build to work with Bootstrap 4,3 and 2
- Available translations:
  - English
  - Polish

## Requirements

- PHP 7.2+
- Joomla 3.9.x

## How to build from repository

### Build requirements

- PHP 7.2
- Composer
- Node/Npm

### Build process

If you are a developer, and you are willing to build extension from this repo you will need Composer installed globally.
Here are instructions how to build installation package from scratch.

- Prepare a clean Joomla! installation
- Clone this repo on your installation or cope its contents straight to your Joomla! root directory
- Run `composer install`
- Run `composer build`
- Your installation zip files should now be read in `/.build` directory.

## Changelog

### v1.0.5
- Re-licensing to match JED requirements ...
- Fixed the slide background position.

### v1.0.4

- Added missing Polish translations.
- Added minimum slider height setting.

### v1.0.3
- Added updates server, fixed some npm requirements.

### v1.0.2
- Just fixing release tag.

### v1.0.1
- Tests successful. Initial release.

### v1.0.0 beta
- Initial release.