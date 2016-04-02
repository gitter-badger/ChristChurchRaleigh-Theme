<?php

namespace Grav\Theme;

use Grav\Common\Theme;

class Pure extends Theme
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
			->addCss('theme://css-compiled/styles.css', 15);

		$this->grav['assets']
			->add('jquery', 101)
			->addJs('theme://js/script.js')	
			->addJs('theme://js/ui.js');		
	}
}