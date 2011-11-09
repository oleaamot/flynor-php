<?php
/**
 * Avinor PHP API Library
 * @version 1.1
 * @author Flamur Mavraj - OXODesign TEAM
 * @link http://www.oxodesign.no/avinorPhpApi
 * @name avinor
 * @license Domain Public
 */
class avinor{
	
	private $timeFrom;
	private $timeTo;
	private $airport;
	private $direction;
	private $lastUpdate;
	private $apiRequestUri = "";
	
	protected $apiUrlFlights 	= "http://flydata.avinor.no/XmlFeed.asp?";
	protected $apiUrlFlightStatus 	= "http://flydata.avinor.no/flightStatuses.asp";
	protected $apiUrlAirportNames	= "http://flydata.avinor.no/airportNames.asp";
	protected $apiUrlAirlineNames	= "http://flydata.avinor.no/airlineNames.asp";
	
	public $statusCodes = array();
	public $airlineNames = array (
		/**
		 * Avinor does not have thoose airline codes
		 * on their airline search api, so we created manually.
		 */
		'YK' => array('code' => 'YK', 'name' => 'Cyprus Turkish Airlines'),
		'MSC'=> array('code' => 'MSC', 'name' => 'Air Cairo'),
		'CF' => array('code' => 'CF',  'name' => 'City Airline')
	);
	public $airportNames= array();
	public $flights		= array();

	public function __construct() {
	
		/**
		 * Fetch airline names into an array
		 * Fetch airport names into an array
		 * Fetch flight status codes into an array
		 */
		$this->fetchAirlineNames()
			 ->fetchAirportNames()
			 ->fetchFlightStatusCodes();
			 
		return true;
	}

	
	/**
	 * Return airport
	 * @return string
	 */
	public function getAirport(){
		return $this->airport;
	}
	
	/**
	 * Return current airport
	 * @return array
	 */
	public function getCurrentAirport(){
		return $this->airportNames[$this->airport];
	}
	
	/**
	 * Return array of airport names
	 * @return array
	 */
	public function getAirportList(){
		return $this->airportNames;
	}
	
	/**
	 * Define value for timeFrom
	 * @param int $time
	 * @return avinor
	 */
	public function setTimeFrom($time){
		$this->timeFrom = (int) $time;
		
		return $this;
	}
	
	/**
	 * Define value for timeTo
	 * @param int $time
	 * @return avinor
	 */
	public function setTimeTo($time){
		$this->timeTo = (int) $time;
		
		return $this;
	}
	
	/**
	 * Define airport
	 * @param string $airport
	 * @return avinor
	 */
	public function setAirport($airport){
		$this->airport = $airport;
		
		return $this;
	}
	
	/**
	 * Define direction
	 * @param string $direction
	 * @return avinor
	 */
	public function setDirection($direction){
		$this->direction = $direction;
		
		return $this;
	}
	
	/**
	 * Define lastUpdate
	 * @param string $lastUpdate
	 * @return avinor
	 */
	public function setLastUpdate($lastUpdate){
		$this->lastUpdate = $lastUpdate;
		
		return $this;
	}
	
	/**
	 * Build flight request query
	 * @return avinor
	 */
	private function buildRequestQuery(){
		$this->apiRequestUri = $this->apiUrlFlights;
		$this->apiRequestUri.= (isset($this->airport) ? 'airport=' . urlencode($this->airport) : '');
		$this->apiRequestUri.= (isset($this->timeTo) ? '&timeTo=' . urlencode($this->timeTo) : '');
		$this->apiRequestUri.= (isset($this->timeFrom) ? '&timeFrom=' . urlencode($this->timeFrom) : '');
		$this->apiRequestUri.= (isset($this->direction) ? '&direction=' . urlencode($this->direction) : '');
		$this->apiRequestUri.= (isset($this->lastUpdate) ? '&lastUpdate=' . urlencode($this->lastUpdate) : '');
		
		return $this;
	}
	
	
	/**
	 * Get result of request. 
	 * It returns the result or boolean if something goes wrong
	 * @return array/boolean
	 */
	public function getResult(){
		try{
			// Check if airport is set, if not throw an exception
			if(!isset($this->airport))
				throw new Exception('Airport is not defined!');
			
			
			// Build flight request query
			$this->buildRequestQuery();
			
			// Get xml from the server
			$xml = new SimpleXMLElement($this->apiRequestUri, null, true);

			// Parse the XML output
			foreach($xml->flights->flight as $flight){
				// Create an array with the name of the airports the plane has been through
				$viaAirport = null;
				if(isset($flight->via_airport)){
					$viaAirport = array();
					$viaAirports = explode(",", (string) $flight->via_airport);
					foreach($viaAirports as $via){
						$viaAirport[] = $this->airportNames[(string) $via];
					}
				}
				
				$this->flights[(string) $flight['uniqueID']] = array(
					'airport'		=> $this->airportNames[(string) $flight->airport],
					'flightId'		=> (string) $flight->flight_id,
					'airline'		=> (isset($this->airlineNames[(string) $flight->airline]) ? 
											$this->airlineNames[(string) $flight->airline] : 
											array('code' => (string) $flight->airline, 'name' => (string) $flight->airline)
										),
					'domInt'		=> (string) $flight->dom_int,
					'scheduleTime'	=> (string) $flight->schedule_time,
					'direction'		=> (string) $flight->arr_dep,
					'viaAirport'	=> $viaAirport,
					'checkIn'		=> (isset($flight->check_in) ? (string) $flight->check_in : null),
					'gate'			=> (isset($flight->gate) ? (string) $flight->gate : null),
					'status'		=> (isset($flight->status) ? 
											array(
												'code' => $this->statusCodes[(string) $flight->status['code']],
												'time' => (string) $flight->status['time']
											) : null
										),
					'belt'	=> (isset($flight->belt) ? (string) $flight->belt : null)		
				);
			}
		}catch (Exception $e){
			echo "Error: " . $e->getMessage();
			return false;
		}
		
		return $this->flights;
	}
	
	/**
	 * Fetch flight status codes into an array
	 * @return avinor
	 */
	private function fetchFlightStatusCodes(){
		if(isset($_SESSION['catch']['statusCodes'])){
			$this->statusCodes = unserialize($_SESSION['catch']['statusCodes']);
			return $this;
		}
	
		$xml = new SimpleXMLElement($this->apiUrlFlightStatus, null, true);
	
		foreach($xml->flightStatus as $status){
			$this->statusCodes[(string) $status["code"]] = array(
				'code'	=> (string) $status["code"],
				'no' 	=> (string) $status['statusTextNo'],
				'en' 	=> (string) $status['statusTextEn']
			);	
		}
		
		$_SESSION['catch']['statusCodes'] = serialize($this->statusCodes);
		
		return $this;
	}
	
	/**
	 * Fetch airline names into an array
	 * @return avinor
	 */
	private function fetchAirlineNames(){
		if(isset($_SESSION['catch']['airlineNames'])){
			$this->airlineNames = unserialize($_SESSION['catch']['airlineNames']);
			return $this;
		}
			
		$xml = new SimpleXMLElement($this->apiUrlAirlineNames, null, true);
		
		foreach($xml->airlineName as $airline){
			$this->airlineNames[(string) $airline["code"]] = array(
				'code' => (string) $airline["code"],
				'name' => (string) $airline["name"]
			);
		}
		
		$_SESSION['catch']['airlineNames'] = serialize($this->airlineNames);
		
		return $this;
	}
	
	/**
	 * Fetch airport names into an array
	 * @return avinor
	 */
	private function fetchAirportNames(){
		if(isset($_SESSION['catch']['airportNames'])){
			$this->airportNames = unserialize($_SESSION['catch']['airportNames']);
			return $this;
		}
	
		$xml = new SimpleXMLElement($this->apiUrlAirportNames, null, true);
		
		foreach($xml->airportName as $airport){
			$this->airportNames[(string) $airport["code"]] = array(
				'code' => (string) $airport["code"],
				'name' => (string) $airport["name"]
			);
		}
		
		$_SESSION['catch']['airportNames'] = serialize($this->airportNames);
		
		return $this;
	}

	
	/*
  
	determine which language out of an available set the user prefers most
	
	$available_languages        array with language-tag-strings (must be lowercase) that are available
	$http_accept_language    a HTTP_ACCEPT_LANGUAGE string (read from $_SERVER['HTTP_ACCEPT_LANGUAGE'] if left out)
	*/

	public function accept_language ($available_languages,$http_accept_language="auto") {

		// if $http_accept_language was left out, read it from the HTTP-Header

		if ($http_accept_language == "auto") $http_accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		
		// standard  for HTTP_ACCEPT_LANGUAGE is defined under
		// http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.4
		// pattern to find is therefore something like this:
		//    1#( language-range [ ";" "q" "=" qvalue ] )
		// where:
		//    language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" )
		//    qvalue         = ( "0" [ "." 0*3DIGIT ] )
		//            | ( "1" [ "." 0*3("0") ] )

		preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" .
			       "(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i",
			       $http_accept_language, $hits, PREG_SET_ORDER);
		
		// default language (in case of no hits) is the first in the array

		$bestlang = $available_languages[0];
		$bestqval = 0;
		
		foreach ($hits as $arr) {
			// read data from the array of this hit
			$langprefix = strtolower ($arr[1]);
			if (!empty($arr[3])) {
				$langrange = strtolower ($arr[3]);
				$language = $langprefix . "-" . $langrange;
			}
			else $language = $langprefix;
			$qvalue = 1.0;
			if (!empty($arr[5])) $qvalue = floatval($arr[5]);
			
			// find q-maximal language 
			if (in_array($language,$available_languages) && ($qvalue > $bestqval)) {
				$bestlang = $language;
				$bestqval = $qvalue;
			}
			// if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does)
			else if (in_array($languageprefix,$available_languages) && (($qvalue*0.9) > $bestqval)) {
				$bestlang = $languageprefix;
				$bestqval = $qvalue*0.9;
			}
		}

		return $bestlang;
	}	
}
