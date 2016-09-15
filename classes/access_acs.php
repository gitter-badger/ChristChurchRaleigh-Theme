<?php

namespace Grav\Theme\CCR;

/**
 * Access ACS Rest API Class
 */
trait AccessACS {

	/**
	 * Calendars
	 */

	public function getAccessListOfCalendars()
	{
		$method = 'GET';
		$uri = "/accesscalendars";

		return $this->request( $uri, $method );
	}

	public function getAccessListOfLocations()
	{
		$method = 'GET';
		$uri = "/accesslocations";

		return $this->request( $uri, $method );
	}

	public function getAccessListOfEvents( $params = null )
	{
		$start_date = isset($params['start_date']) ? $params['start_date'] : date('m/d/Y');
		$end_date = isset($params['end_date']) ? $params['end_date'] : date('m/d/Y', ( time() + (60 * 60 * 24 * 365) ));

		$calender_ids = $this->buildIdCsvFromArray( $params['calendarIDs']);
		$location_ids = $this->buildIdCsvFromArray( $params['locationIDs']);

		$method = 'GET';
		$uri = "/accessevents";
		$query = '';

		if ( ! is_null( $start_date ) )
			$query = $query . "&startdate=" . $start_date;

		if ( ! is_null( $end_date ) )
			$query = $query . "&stopdate=" . $end_date;

		if ( ! is_null( $calender_ids ) )
			$query = $query . "&Calendarid=" . $calender_ids;

		if ( ! is_null( $location_ids ) )
			$query = $query . "&Locationid=" . $location_ids;

		if (strlen($query) > 2) {
			$uri = $uri . '?' . $query;
		}

		return $this->request( $uri, $method );
	}

	public function getAccessEventDetails( $event_id = null )
	{
		$method = 'GET';
		$uri = "/accessevents/${event_id}";

		return $uri;
	}

	/**
	 * Change Requests
 	 */

	/**
	 * Comments
	 */

	/**
	 * Connections
	 */

	/**
	 * Individuals
	 */

	/**
	 * Online Giving
	 */

	public function getAccessOnlineGiving()
	{
		$method = "GET";
		$uri = "/onlinegiving";

		return $this->request($uri, $method);
	}

	/**
	 * Organizations
	 */

	/**
	 * Users and Security
	 */
	
}