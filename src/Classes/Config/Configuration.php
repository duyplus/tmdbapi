<?php
namespace Duyplus\TMDBApi\Classes\Config;

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
	private $appender = array(
		'movie' => array('trailers', 'images', 'credits', 'translations', 'reviews'),
		'tvshow' => array('trailers', 'images', 'credits', 'translations', 'keywords'),
		'season' => array('trailers', 'images', 'credits', 'translations'),
		'episode' => array('trailers', 'images', 'credits', 'translations'),
		'person' => array('movie_credits', 'tv_credits', 'images'),
		'collection' => array('images'),
		'company' => array('movies'),
	);

	/**
	 *  Construct Class
	 *
	 *  @param array $config
	 */
	public function __construct($cnf = null)
	{
		// Path to configuration file if given
		if (is_string($cnf)) {
			if (file_exists($cnf)) {
				include($cnf);
				if (is_array($cnf)) {
					$this->configure($cnf);
				}
			}
		} elseif (is_array($cnf)) {
			$this->configure($cnf);
		} else {
			// Load default configuration
			$dir = dirname(__FILE__);
			$configDir = realpath($dir . '/../../Config');
			if (file_exists($configDir . '/Default.php')) {
				include($configDir . '/Default.php');
				$this->configure($cnf);
			}
		}
	}

	//------------------------------------------------------------------------------
	// Setup Functions
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
	 *  Set the appender for a type of result
	 *
	 *  @param string $type
	 *  @param array $data
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
	 *  Get the adult flag
	 *
	 *  @return boolean
	 */
	public function getAdult()
	{
		return $this->adult;
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
	 *  Get the appender for a type of result
	 *
	 *  @return array
	 */
	public function getAppender($type)
	{
		return $this->appender[$type];
	}

	//------------------------------------------------------------------------------
	// Private Methods
	//------------------------------------------------------------------------------

	/**
	 *  Configure the class variables
	 *
	 *  @param array $cnf
	 */
	private function configure($cnf)
	{
		if (isset($cnf['apikey'])) {
			$this->setAPIKey($cnf['apikey']);
		}
		if (isset($cnf['lang'])) {
			$this->setLang($cnf['lang']);
		}
		if (isset($cnf['timezone'])) {
			$this->setTimeZone($cnf['timezone']);
		}
		if (isset($cnf['adult'])) {
			$this->setAdult($cnf['adult']);
		}
		if (isset($cnf['debug'])) {
			$this->setDebug($cnf['debug']);
		}
		if (isset($cnf['appender']) && is_array($cnf['appender'])) {
			foreach ($cnf['appender'] as $type => $appender) {
				$this->setAppender($appender, $type);
			}
		}
	}
} 