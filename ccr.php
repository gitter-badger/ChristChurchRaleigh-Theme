<?php
/*
    __    __             _
   / /_  / /_  _____    (_)___ ___  ___________
  / __ \/ / / / / _ \  / / __ `/ / / / ___/ __ \
 / /_/ / / /_/ /  __/ / / /_/ / /_/ / /__/ /_/ /
/_.___/_/\__,_/\___/_/ /\__,_/\__, /\___/\____/
                  /___/      /____/  thebluejay.co */

namespace Grav\Theme;

use Grav\Common\Theme;

class Ccr extends Theme
{
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

		$this->enable([
			'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
		]);
	}

	public function onTwigSiteVariables()
	{
		$this->grav['assets']
			->addCSS('theme://css/slippry.css,', 15)
			->addCss('theme://css-compiled/styles.css', 15);

		$this->grav['assets']
			->addJs('jquery', 101)
			->addJs('theme://js/slippry.min.js')
			->addJs('theme://js/script.js')
			->addJs('theme://js/ui.js');
	}
}
