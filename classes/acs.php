<?php
/**
 * ACS Rest API
 *
 * This php library for ACS Rest API was developed using information found at
 * http://wiki.acstechnologies.com/display/DevCom/Access+ACS+REST+API.
 */

namespace Grav\Theme;

include 'access_acs.php';
include 'acs_church_life.php';
include 'acs_facility_scheduler.php';

/**
 * Class AcsRestApi
 */
class ACS {

	// use the following traits
	use CCR\AccessACS;
	use CCR\ACSFacilityScheduler;
	use CCR\ACSChurchLife;


	/**
	 * ACS Site Number
	 */
	protected $site_number;

	/**
	 * Request Header to be sent with each api call
	 */
	protected $request_header;

	/**
	 * Class construct
	 */
	public function __construct( $site_number, $request_header )
	{
		// get the acs site number
		$this->site_number = $site_number;	
		// get the request header
		$this->request_header = $request_header;
	}

	/**
	 * Build an HTTP Basic Auth Request to ACS API
	 * @param  string $uri
	 * @param  string $method
	 * @return JSON
	 */
	private function request( $uri = null, $method = 'GET' )
	{
		$baseUri = 'https://secure.accessacs.com/api_accessacs_mobile/v2/';
		$requestUri = "${baseUri}$this->site_number${uri}";

		$curl_h = curl_init($requestUri);

		// http basic auth
		curl_setopt($curl_h, CURLOPT_USERPWD, $this->request_header['username'] . ':' . $this->request_header['password']);
		curl_setopt($curl_h, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($curl_h);

		return $response;
	}

	/**
	 * Helper Functions
	 */
	private function buildIdCsvFromArray( $items = null )
	{
		if( is_null($items) )
			return;

		$ids = [];
		foreach ($items as $key => $item) {
			if ($item === true) {
				array_push($ids, $key);
			}
		}

		return join(',', $ids);
	}
}