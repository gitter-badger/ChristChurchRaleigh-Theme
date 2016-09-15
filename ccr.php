<?php
/*
  _          _ _                             
 | |        (_) |                            
 | |__   ___ _| |_ _____ __ ___   __ _ _ __  
 | '_ \ / _ \ | __|_  / '_ ` _ \ / _` | '_ \ 
 | | | |  __/ | |_ / /| | | | | | (_| | | | |
 |_| |_|\___|_|\__/___|_| |_| |_|\__,_|_| |_|      
                      kaleb heitzman (c) 2016   */

namespace Grav\Theme;

require_once __DIR__.'/classes/acs.php';

use Grav\Common\Theme;

class Ccr extends Theme
{
	/**
	 * ACS API
	 */
	protected $acs_api;

	public static function getSubscribedEvents()
	{
		return [
			'onThemeInitialized' => ['onThemeInitialized', 0]
		];
	}

	public function onThemeInitialized()
	{
		if ($this->isAdmin()) {
			$this->active = false;
			return;
		}

		// get the acs site number
		$site_number = $this->config->get('plugins.acs.site_number');

		// build an acs api request header
		$request_header = array(
			'username' => $this->config->get('plugins.acs.username'),
			'password' => $this->config->get('plugins.acs.password'),
		);

		// instantiate the acs api to be used in twig
		$this->acs_api = new Acs( $site_number, $request_header );

		$this->enable([
			'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
		]);
	}

	public function onTwigSiteVariables()
	{
		$this->grav['assets']
			->addCSS('theme://css/slippry.css,', 15)
			->addCss('theme://css/compiled/styles.css', 15)
			->addCss('theme://css/custom.css', 15);

		$this->grav['assets']
			->addJs('jquery', 101)
			->addJs('theme://js/compiled/crafted.js')
			->addJs('theme://js/slippry.min.js')
			->addJs('theme://js/script.js')
			->addJs('theme://js/ui.js');
	}

	public function fetchSoundcloudAudio()
	{
		// build our API URL
		$url = "http://api.soundcloud.com/reslove.json?"
			. "url=http://soundcloud.com"
			. "USERNAME"
			. "&client_id=CLIENTID";

		// grab the contents of the URL
		$user_json = file_get_contents($url);

		// decode the JSON to a PHP Object
		$user = json_decode($user_json);

		// print out the User ID
		echo $user->id;
	}
}
