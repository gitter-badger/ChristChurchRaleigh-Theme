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
use RocketTheme\Toolbox\Event\Event;

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
		$site_number = $this->config->get('theme.acs.site_number');

		// build an acs api request header
		$request_header = array(
			'username' => $this->config->get('theme.acs.username'),
			'password' => $this->config->get('theme.acs.password'),
		);

		// instantiate the acs api to be used in twig
		$this->acs_api = new Acs( $site_number, $request_header );

		$this->enable([
			'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
			'onPageContentRaw' => ['onPageContentRaw', 0],
		]);
	}

	public function onTwigSiteVariables()
	{
		$twig = $this->grav['twig'];

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

		// paramless calls
		$acs = $this->acs_api;

		// paramed called
		$twig->twig_vars['acs'] = $acs;
	}

	public function onPageContentRaw(Event $e)
	{
		$output = '';
        $content = $e['page']->getRawContent();

        //$expanders = preg_split(":(</?expanders>):", $content, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);

        //dump($expanders);
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

	/**
	 * Get Location IDs for use in lists
	 */
	static public function getLocationIDs()
	{
		// get grav so we can get plugin config
		$grav = Grav::instance();
		$config = $grav['config']['plugins']['acs'];
		// get the acs site number
		$site_number = $config['site_number'];
		// build an acs api request header
		$request_header = array(
			'username' => $config['username'],
			'password' => $config['password'],
		);
		// build an acs api request
		$acs = new Acs( $site_number, $request_header);
		$locations = json_decode($acs->getFSListOfLocations());
		// build the new locations array to use in the blueprint
		$locationsArray = [];
		foreach($locations as $location) {
			$locationsArray[$location->LocationId] = $location->LocationName;
		}
		// return locations
		return $locationsArray;
	}

	/**
	 * Get Calendar IDs for use in lists
	 */
	static public function getCalendarIDs()
	{
		// get grav so we can get plugin config
		$grav = Grav::instance();
		$config = $grav['config']['plugins']['acs'];
		// get the acs site number
		$site_number = $config['site_number'];
		// build an acs api request header
		$request_header = array(
			'username' => $config['username'],
			'password' => $config['password'],
		);
		// build an acs api request
		$acs = new Acs( $site_number, $request_header);
		$calendars = json_decode($acs->getFSListOfCalendars());
		// build the new calendar array to use in the blueprint
		$calendarsArray = [];
		foreach($calendars as $calendar) {
			$calendarsArray[$calendar->CalendarId] = $calendar->Name;
		}
		// return calendar
		return $calendarsArray;
	}

	static public function getEventTaxonomyIDs()
	{
		$grav = \Grav\Common\Grav::instance();
		$taxonomies = $grav['grav']['taxonomy']->taxonomy();

		$events = [];
		foreach( $taxonomies['event'] as $key => $team) {
			$events[$key] = ucwords($key);
		}

		return $events;
	}

	static public function getTeamTaxonomyIDs()
	{
		$grav = \Grav\Common\Grav::instance();
		$taxonomies = $grav['grav']['taxonomy']->taxonomy();

		$teams = [];
		foreach( $taxonomies['team'] as $key => $team) {
			$teams[$key] = ucwords($key);
		}

		return $teams;
	}

}
