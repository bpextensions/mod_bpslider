<?php
/*
 * @package     ${package}
 * @subpackage  ${subpackage}
 *
 * @copyright   Copyright (C) ${build.year} ${copyrights}, All rights reserved.
 * @license     ${license.name}; see ${license.url}
 *
 */

namespace BPExtensions\Module\BPSlider\Site\Helper;

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\WebAsset\WebAssetManager;
use RuntimeException;

class AssetsHelper
{

	/**
	 * Absolute path to the extension assets directory inside /media.
	 * @var string
	 *
	 * @since 2.0
	 */
	protected $media_directory_path = '';

	/**
	 * Name of a media directory inside /media
	 * @var string
	 *
	 * @since 2.0
	 */
	protected $media_directory = '';

	/**
	 * Assets manifest array.
	 * @var array
	 *
	 * @since 2.0
	 */
	protected $manifest = [];

	/**
	 * Entry points array.
	 * @var array
	 *
	 * @since 2.0
	 */
	protected $entrypoints = [];

	/**
	 * Assets manager instance.
	 * @var WebAssetManager
	 *
	 * @since 2.0
	 */
	protected $assetsManager;


	/**
	 * Create helper instance.
	 *
	 * @param   string           $media_directory  Name of a directory inside /media that holds extension assets.
	 * @param   WebAssetManager  $assetManager     Web assets manager.
	 *
	 * @since 2.0
	 */
	public function __construct(string $media_directory, WebAssetManager $assetManager)
	{
		$this->media_directory_path = JPATH_ROOT . '/media/' . $media_directory;
		$this->media_directory      = $media_directory;
		$this->assetsManager        = $assetManager;
	}

	/**
	 * Add entrypoint assets.
	 *
	 * @param   string  $entrypoint  Name of the entrypoint.
	 *
	 * @since 2.0
	 */
	public function addEntryPointAssets(string $entrypoint): void
	{

		// If there is no entry points
		if ($this->entrypoints === [])
		{
			$this->entrypoints = json_decode(file_get_contents($this->media_directory_path . '/entrypoints.json'), JSON_OBJECT_AS_ARRAY);
			$this->entrypoints = $this->entrypoints['entrypoints'];
		}

		// If entry point doesn't exist or is empty
		if (!array_key_exists($entrypoint, $this->entrypoints) || $this->entrypoints[$entrypoint] === [])
		{
			throw new RuntimeException("Could not find the entry point named [$entrypoint] in [media/$this->media_directory/entrypoints.json]!", 500);
		}

		$presetPrefix = $this->media_directory . '-' . $entrypoint . '#';

		// Include CSS assets
		if (array_key_exists('css', $this->entrypoints[$entrypoint]))
		{
			foreach ($this->entrypoints[$entrypoint]['css'] as $url)
			{
				$this->assetsManager->registerAndUseStyle($presetPrefix . pathinfo($url, PATHINFO_FILENAME), Uri::root(true) . ltrim($url, '/'));
			}
		}

		// Include JS assets
		if (array_key_exists('js', $this->entrypoints[$entrypoint]))
		{
			foreach ($this->entrypoints[$entrypoint]['js'] as $url)
			{
				$this->assetsManager->registerAndUseScript($presetPrefix . pathinfo($url, PATHINFO_FILENAME), Uri::root(true) . ltrim($url, '/'));
			}
		}
	}

	/**
	 * Find the URL of a certain asset.
	 *
	 * @param   string  $filename  Full filename to look for.
	 *
	 * @return string
	 *
	 * @since 2.0
	 */
	public function getAssetUrl(string $filename): string
	{

		// If there is no entry points data, load it
		if ($this->manifest === [])
		{
			$this->manifest = json_decode(file_get_contents($this->media_directory_path . '/manifest.json'), JSON_OBJECT_AS_ARRAY);
		}

		if (!array_key_exists("media/$this->media_directory/$filename", $this->manifest))
		{
			throw new RuntimeException("Could not find the asset file [media/$this->media_directory/$filename]!", 500);
		}

		return Uri::base() . $this->manifest["media/$this->media_directory/$filename"];
	}

}