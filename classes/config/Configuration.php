<?php
namespace duyplus\tmdbapi\classes\config;

/**
 *  This class handles all the data you can get from the api Configuration
 *
 *	@package TMDB_V3_API_PHP
 *  @author Alvaro Octal
 *  @version 0.7
 *  @date 20/01/2015
 *  @updated 31/12/2024
 *  @link https://github.com/duyplus/tmdbapi
 *  @copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Configuration
{

	//------------------------------------------------------------------------------
	// Class Variables
	//------------------------------------------------------------------------------

	private $apikey = '';
	private $lang = 'en';
	private $timezone = 'Europe/Berlin';
	private $adult = false;
	private $debug = false;

	/**
	 *	Data Return Configuration - Manipulate if you want to tune your results
	 */
	private $appender = [
		'movie' => array('account_states', 'alternative_titles', 'credits', 'images', 'keywords', 'release_dates', 'videos', 'translations', 'similar', 'reviews', 'lists', 'changes', 'rating'),
		'tvshow' => array('account_states', 'alternative_titles', 'changes', 'content_rating', 'credits', 'external_ids', 'images', 'keywords', 'rating', 'similar', 'translations', 'videos'),
		'season' => array('changes', 'account_states', 'credits', 'external_ids', 'images', 'videos'),
		'episode' => array('changes', 'account_states', 'credits', 'external_ids', 'images', 'rating', 'videos'),
		'person' => array('movie_credits', 'tv_credits', 'combined_credits', 'external_ids', 'images', 'tagged_images', 'changes'),
		'collection' => array('images'),
		'company' => array('movies'),
	];

	//------------------------------------------------------------------------------
	// Constructor
	//------------------------------------------------------------------------------

	/**
	 *  Construct Class
	 *
	 *  @param array $cnf An array with the configuration data
	 */
	public function __construct($cnf = null)
	{
		// Check if config is given and use default if not
		// Note: There is no API Key inside the default conf
		if (!isset($cnf)) {
			require_once __DIR__ . '/../../configuration/Default.php';
		}
		$this->setAPIKey(isset($cnf['apikey']) ? $cnf['apikey'] : null);
		$this->setLang(isset($cnf['lang']) ? $cnf['lang'] : 'en');
		$this->setTimeZone(isset($cnf['timezone']) ? $cnf['timezone'] : 'UTC');
		$this->setAdult(isset($cnf['adult']) ? (bool) $cnf['adult'] : false);
		$this->setDebug(isset($cnf['debug']) ? (bool) $cnf['debug'] : false);
	}


	//------------------------------------------------------------------------------
	// Set Variables
	//------------------------------------------------------------------------------

	/**
	 *  Set the API Key
	 *
	 *  @param string $apikey
	 */
	public function setAPIKey($apikey)
	{
		$this->apikey = $apikey;
	}

	/**
	 *  Set the language code
	 *
	 *  @param string $lang
	 */
	public function setLang($lang)
	{
		$this->lang = $lang;
	}

	/**
	 *  Set the timezone
	 *
	 *  @param string $timezone
	 */
	public function setTimeZone($timezone)
	{
		$this->timezone = $timezone;
	}

	/**
	 *  Set the adult flag
	 *
	 *  @param boolean $adult
	 */
	public function setAdult($adult)
	{
		$this->adult = $adult;
	}

	/**
	 *  Set the debug flag
	 *
	 *  @param boolean $debug
	 */
	public function setDebug($debug)
	{
		$this->debug = $debug;
	}

	/**
	 *  Set an appender for a special type
	 *
	 *  @param array $appender
	 *  @param string $type
	 */
	public function setAppender($appender, $type)
	{
		$this->appender[$type] = $appender;
	}

	//------------------------------------------------------------------------------
	// Get Variables
	//------------------------------------------------------------------------------

	/**
	 *  Get the API Key
	 *
	 *  @return string
	 */
	public function getAPIKey()
	{
		return $this->apikey;
	}

	/**
	 *  Get the language code
	 *
	 *  @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}

	/**
	 *  Get the timezone
	 *
	 *  @return string
	 */
	public function getTimeZone()
	{
		return $this->timezone;
	}

	/**
	 *  Get the adult string
	 *
	 *  @return string
	 */
	public function getAdult()
	{
		return ($this->adult) ? 'true' : 'false';
	}

	/**
	 *  Get the debug flag
	 *
	 *  @return boolean
	 */
	public function getDebug()
	{
		return $this->debug;
	}

	/**
	 *  Get the appender array for a type
	 *
	 *  @return array
	 */
	public function getAppender($type)
	{
		return $this->appender[$type];
	}
}

?>