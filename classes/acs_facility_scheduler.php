<?php

namespace Grav\Theme\CCR;

/**
 * ACS Facility Scheduler Rest API
 */
trait ACSFacilityScheduler {

	/**
	 * Events
	 * http://wiki.acstechnologies.com/display/DevCom/Events
	 */
	
	public function getFSListOfCalendars()
	{
		$method = 'GET';
		$uri = "/calendars";

		return $this->request( $uri, $method );
	}

	public function getFSListOfEvents( $params = null, $toArray = true )
	{
		$start_date = isset($params['start_date']) ? $params['start_date'] : date('m/d/Y');
		$end_date = isset($params['end_date']) ? $params['end_date'] : date('m/d/Y', ( time() + (60 * 60 * 24 * 365) ));

		$calender_ids = $this->buildIdCsvFromArray( $params['calendarIDs']);
		$location_ids = $this->buildIdCsvFromArray( $params['locationIDs']);

		$method = 'GET';
		$uri = "/events";
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

		$response = $this->request( $uri, $method );

		if ( $toArray ) {
			$response = json_decode($response);
			return $response->Page;
		}
		else {
			return $response;
		}
	}

	/**
	 * Locations
	 * http://wiki.acstechnologies.com/display/DevCom/Locations
	 */

	public function getFSListOfLocations()
	{
		$method = 'GET';
		$uri = "/locations";

		return $this->request( $uri, $method );
	}
}