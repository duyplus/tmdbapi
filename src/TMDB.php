<?php
namespace Duyplus\TMDBApi;

use Duyplus\TMDBApi\Classes\Config\APIConfiguration;
use Duyplus\TMDBApi\Classes\Config\Configuration;
use Duyplus\TMDBApi\Classes\Data\Collection;
use Duyplus\TMDBApi\Classes\Data\Company;
use Duyplus\TMDBApi\Classes\Data\Episode;
use Duyplus\TMDBApi\Classes\Data\Genre;
use Duyplus\TMDBApi\Classes\Data\Movie;
use Duyplus\TMDBApi\Classes\Data\Person;
use Duyplus\TMDBApi\Classes\Data\Season;
use Duyplus\TMDBApi\Classes\Data\TVShow;

/**
 * TMDB API v3 PHP class - wrapper to API version 3 of 'themoviedb.org
 * API Documentation: https://developers.themoviedb.org/3/
 * Documentation and usage in README file
 * 
 * Updated for compatibility with CodeIgniter 4 and modern PHP
 *
 * 	Function List
 *   	public function  __construct($config = null)
 *		public function setAPIKey($apikey)
 *   	public function setLang($lang = "en")
 *   	public function getLang()
 *   	public function setTimeZone($timezone = 'Europe/Berlin')
 *   	public function getTimeZone()
 *   	public function setAdult($adult = false)
 *   	public function getAdult()
 *   	public function setDebug($debug = false)
 *   	public function getDebug()
 *   	public function getAPIConfig()
 *   	public function getImageURL($size = "original")
 *   	public function getDiscoverMovies($page = 1)
 *   	public function getDiscoverTVShows($page = 1)
 *   	public function getDiscoverMovie($page = 1)
 *   	public function getLatestMovie()
 *   	public function getNowPlayingMovies($page = 1)
 *   	public function getPopularMovies($page = 1)
 *   	public function getTopRatedMovies($page = 1)
 *   	public function getUpcomingMovies($page = 1)
 *   	public function getLatestTVShow()
 *   	public function getOnTheAirTVShows($page = 1)
 *   	public function getAiringTodayTVShows($page = 1, $timeZone = null)
 *   	public function getTopRatedTVShows($page = 1)
 *   	public function getPopularTVShows($page = 1)
 *   	public function getLatestPerson()
 *		public function getPopularPersons($page = 1)
 *		public function getMovie($idMovie, $appendToResponse = null)
 *		public function getTVShow($idTVShow, $appendToResponse = null)
 *		public function getSeason($idTVShow, $numSeason, $appendToResponse = null)
 *		public function getEpisode($idTVShow, $numSeason, $numEpisode, $appendToResponse = null)
 *		public function getPerson($idPerson, $appendToResponse = null)
 *		public function getCollection($idCollection, $appendToResponse = null)
 *		public function getCompany($idCompany, $appendToResponse = null)
 *		public function searchMovie($movieTitle)
 *		public function searchTVShow($tvShowTitle)
 *		public function searchPerson($personName)
 *		public function searchCollection($collectionName)
 *		public function searchCompany($companyName)
 *		public function find($id, $external_source = 'imdb_id')
 *		public function getTimezones()
 *		public function getJobs()
 *		public function getMovieGenres()
 *		public function getTVGenres()
 *		public function getMoviesByGenre($idGenre, $page = 1)
 *		public function multiSearch($searchQuery)
 *
 *		private function loadConfig()
 *   	private function setConfig($config)
 *   	private function getConfig()
 *   	private function call($action, $appendToResponse = '')
 *
 *
 * 	URL LIST:
 *   	configuration		http://api.themoviedb.org/3/configuration
 * 		Image				http://cf2.imgobject.com/t/p/original/IMAGEN.jpg #### echar un ojo ####
 * 		Search Movie		http://api.themoviedb.org/3/search/movie
 * 		Search Person		http://api.themoviedb.org/3/search/person
 * 		Movie Info			http://api.themoviedb.org/3/movie/11
 * 		Casts				http://api.themoviedb.org/3/movie/11/casts
 * 		Posters				http://api.themoviedb.org/3/movie/11/images
 * 		Trailers			http://api.themoviedb.org/3/movie/11/trailers
 * 		translations		http://api.themoviedb.org/3/movie/11/translations
 * 		Alternative titles 	http://api.themoviedb.org/3/movie/11/alternative_titles
 *
 * 		Collection Info 	http://api.themoviedb.org/3/collection/11
 * 		Person images		http://api.themoviedb.org/3/person/287/images
 */

class TMDB
{
	/**
	 * @var string url of API TMDB
	 */
	const API_URL = "https://api.themoviedb.org/3/";

	/**
	 * @var Configuration
	 */
	private $config;

	/**
	 * @var APIConfiguration
	 */
	private $apiconfig;

	/**
	 * Construct Class
	 *
	 * @param array|null $config The necessary configuration
	 */
	public function __construct($config = null)
	{
		// Set configuration
		$this->setConfig($config);
		// Load the API configuration
		if (!$this->loadConfig()) {
			if (function_exists('log_message')) {
				log_message('error', 'TMDB API: Unable to read configuration, verify that the API key is valid');
			}
			throw new \RuntimeException('Unable to read configuration, verify that the API key is valid');
		}
	}

	//------------------------------------------------------------------------------ 
	// Configuration Parameters 
	//------------------------------------------------------------------------------ 

	/**
	 *  Set configuration parameters
	 *
	 * 	@param array $config
	 */
	private function setConfig($config)
	{
		$this->config = new Configuration($config);
	}

	/**
	 * 	Get the config parameters
	 *
	 * 	@return Configuration
	 */
	private function getConfig(): Configuration
	{
		return $this->config;
	}

	//------------------------------------------------------------------------------ 
	// API Key 
	//------------------------------------------------------------------------------ 

	/**
	 *  Set the API Key
	 *
	 * 	@param string $apikey
	 * 	@return void
	 */
	public function setAPIKey(string $apikey): void
	{
		$this->getConfig()->setAPIKey($apikey);
	}

	//------------------------------------------------------------------------------ 
	// Language 
	//------------------------------------------------------------------------------ 

	/**
	 *  Set the language
	 *	By default english
	 *
	 * 	@param string $lang
	 * 	@return void
	 */
	public function setLang(string $lang = 'en'): void
	{
		$this->getConfig()->setLang($lang);
	}

	/**
	 * 	Get the language
	 *
	 * 	@return string
	 */
	public function getLang(): string
	{
		return $this->getConfig()->getLang();
	}

	//------------------------------------------------------------------------------ 
	// TimeZone 
	//------------------------------------------------------------------------------ 

	/**
	 *  Set the timezone
	 *	By default 'Europe/London'
	 *
	 * 	@param string $timezone
	 * 	@return void
	 */
	public function setTimeZone(string $timezone = 'Europe/Berlin'): void
	{
		$this->getConfig()->setTimeZone($timezone);
	}

	/**
	 * 	Get the timezone
	 *
	 * 	@return string
	 */
	public function getTimeZone(): string
	{
		return $this->getConfig()->getTimeZone();
	}

	//------------------------------------------------------------------------------ 
	// Adult Content 
	//------------------------------------------------------------------------------ 

	/**
	 *  Set adult content flag
	 *	By default false
	 *
	 * 	@param boolean $adult
	 * 	@return void
	 */
	public function setAdult(bool $adult = false): void
	{
		$this->getConfig()->setAdult($adult);
	}

	/**
	 * 	Get the adult content flag
	 *
	 * 	@return boolean
	 */
	public function getAdult(): bool
	{
		return $this->getConfig()->getAdult();
	}

	//------------------------------------------------------------------------------ 
	// Debug Mode 
	//------------------------------------------------------------------------------ 

	/**
	 *  Set debug mode
	 *	By default false
	 *
	 * 	@param boolean $debug
	 * 	@return void
	 */
	public function setDebug(bool $debug = false): void
	{
		$this->getConfig()->setDebug($debug);
	}

	/**
	 * 	Get debug status
	 *
	 * 	@return boolean
	 */
	public function getDebug(): bool
	{
		return $this->getConfig()->getDebug();
	}

	//------------------------------------------------------------------------------ 
	// Config 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Loads the configuration of the API
	 *
	 * 	@return boolean
	 */
	private function loadConfig()
	{
		$this->apiconfig = new APIConfiguration($this->call('configuration'));
		return !empty($this->apiconfig);
	}

	/**
	 * 	Get Configuration of the API
	 *
	 * 	@return APIConfiguration
	 */
	public function getAPIConfig(): APIConfiguration
	{
		return $this->apiconfig;
	}

	//------------------------------------------------------------------------------ 
	// Get Variables 
	//------------------------------------------------------------------------------ 

	/**
	 *	Get the URL images
	 * 	You can specify the width, by default original
	 *
	 * 	@param string $size A String like 'w185' where you specify the image width
	 * 	@return string
	 */
	public function getImageURL(string $size = 'original'): string
	{
		return $this->apiconfig->getImageBaseURL() . $size;
	}

	//------------------------------------------------------------------------------ 
	// Get Lists of Discover 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Discover Movies
	 *
	 * 	@return Movie[]
	 */
	public function getDiscoverMovies(int $page = 1): array
	{
		$movies = array();
		$result = $this->call('discover/movie', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 * 	Discover TVShows
	 *	@add by tnsws
	 *
	 * 	@param int $page
	 * 	@return TVShow[]
	 */
	public function getDiscoverTVShows(int $page = 1): array
	{
		$tvShows = array();
		$result = $this->call('discover/tv', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}

	//------------------------------------------------------------------------------ 
	// Get Lists of Discover 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Discover Movie
	 *
	 * 	@param int $page
	 * 	@return array
	 */
	public function getDiscoverMovie(int $page = 1): array
	{
		$movies = array();
		$result = $this->call('discover/movie', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	//------------------------------------------------------------------------------ 
	// Get Featured Movies 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Get latest Movie
	 *
	 * 	@return Movie
	 */
	public function getLatestMovie(): Movie
	{
		return new Movie($this->call('movie/latest'));
	}

	/**
	 *  Get Now Playing Movies
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getNowPlayingMovies(int $page = 1): array
	{
		$movies = array();
		$result = $this->call('movie/now_playing', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 *  Get Popular Movies
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getPopularMovies(int $page = 1): array
	{
		$movies = array();
		$result = $this->call('movie/popular', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 *  Get Top Rated Movies
	 *	@add by tnsws
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getTopRatedMovies(int $page = 1): array
	{
		$movies = array();
		$result = $this->call('movie/top_rated', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 *  Get Upcoming Movies
	 *	@add by tnsws
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getUpcomingMovies(int $page = 1): array
	{
		$movies = array();
		$result = $this->call('movie/upcoming', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	//------------------------------------------------------------------------------ 
	// Get Featured TVShows 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Get latest TVShow
	 *
	 * 	@return TVShow
	 */
	public function getLatestTVShow(): TVShow
	{
		return new TVShow($this->call('tv/latest'));
	}

	/**
	 *  Get On The Air TVShows
	 *
	 * 	@param int $page
	 * 	@return TVShow[]
	 */
	public function getOnTheAirTVShows(int $page = 1): array
	{
		$tvShows = array();
		$result = $this->call('tv/on_the_air', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}

	/**
	 *  Get Airing Today TVShows
	 *
	 * 	@param int $page
	 * 	@param string $timezone
	 * 	@return TVShow[]
	 */
	public function getAiringTodayTVShows(int $page = 1, ?string $timeZone = null): array
	{
		$timeZone = (isset($timeZone)) ? $timeZone : $this->getConfig()->getTimeZone();
		$tvShows = array();
		$result = $this->call('tv/airing_today', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}

	/**
	 *  Get Top Rated TVShows
	 *
	 * 	@param int $page
	 * 	@return TVShow[]
	 */
	public function getTopRatedTVShows(int $page = 1): array
	{
		$tvShows = array();
		$result = $this->call('tv/top_rated', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}

	/**
	 *  Get Popular TVShows
	 *
	 * 	@param int $page
	 * 	@return TVShow[]
	 */
	public function getPopularTVShows(int $page = 1): array
	{
		$tvShows = array();
		$result = $this->call('tv/popular', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}

	//------------------------------------------------------------------------------ 
	// Get Featured Persons 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Get latest Person
	 *
	 * 	@return Person
	 */
	public function getLatestPerson(): Person
	{
		return new Person($this->call('person/latest'));
	}

	/**
	 * 	Get Popular Persons
	 *
	 * 	@param int $page
	 * 	@return Person[]
	 */
	public function getPopularPersons(int $page = 1): array
	{
		$persons = array();
		$result = $this->call('person/popular', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$persons[] = new Person($data);
		}
		return $persons;
	}

	//------------------------------------------------------------------------------ 
	// API Call 
	//------------------------------------------------------------------------------ 

	/**
	 * Makes the call to the API and retrieves the data as a JSON
	 *
	 * @param string $action API specific function name for the URL
	 * @param string $appendToResponse The extra append of the request
	 * @return array
	 */
	private function call($action, $appendToResponse = '')
	{
		$url = self::API_URL . $action . '?api_key=' . $this->getConfig()->getAPIKey() . 
			'&language=' . $this->getConfig()->getLang() . 
			'&append_to_response=' . implode(',', (array) $appendToResponse) . 
			'&include_adult=' . ($this->getConfig()->getAdult() ? 'true' : 'false');

		if ($this->getConfig()->getDebug()) {
			if (function_exists('log_message')) {
				log_message('debug', 'TMDB API Request: ' . $url);
			} else {
				echo '<pre><a href="' . $url . '">check request</a></pre>';
			}
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$results = curl_exec($ch);
		
		if (curl_errno($ch)) {
			if (function_exists('log_message')) {
				log_message('error', 'TMDB API Error: ' . curl_error($ch));
			}
			return [];
		}
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		if ($httpCode >= 400) {
			if (function_exists('log_message')) {
				log_message('error', 'TMDB API HTTP Error: ' . $httpCode);
			}
			return [];
		}
		
		$decoded = json_decode($results, true);
		return is_array($decoded) ? $decoded : [];
	}

	//------------------------------------------------------------------------------ 
	// Get Data Objects 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Get a Movie
	 *
	 * 	@param int $idMovie The Movie id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Movie
	 */
	public function getMovie(int $idMovie, $appendToResponse = null): Movie
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('movie');
		return new Movie($this->call('movie/' . $idMovie, $appendToResponse));
	}

	/**
	 * 	Get a TVShow
	 *
	 * 	@param int $idTVShow The TVShow id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return TVShow
	 */
	public function getTVShow(int $idTVShow, $appendToResponse = null): TVShow
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('tvshow');
		return new TVShow($this->call('tv/' . $idTVShow, $appendToResponse));
	}

	/**
	 * 	Get a Season
	 *
	 *  @param int $idTVShow The TVShow id
	 *  @param int $numSeason The Season number
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Season
	 */
	public function getSeason(int $idTVShow, int $numSeason, $appendToResponse = null): Season
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('season');
		return new Season($this->call('tv/' . $idTVShow . '/season/' . $numSeason, $appendToResponse), $idTVShow);
	}

	/**
	 * 	Get a Episode
	 *
	 *  @param int $idTVShow The TVShow id
	 *  @param int $numSeason The Season number
	 *  @param int $numEpisode the Episode number
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Episode
	 */
	public function getEpisode(int $idTVShow, int $numSeason, int $numEpisode, $appendToResponse = null): Episode
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('episode');
		return new Episode($this->call('tv/' . $idTVShow . '/season/' . $numSeason . '/episode/' . $numEpisode, $appendToResponse), $idTVShow);
	}

	/**
	 * 	Get a Person
	 *
	 * 	@param int $idPerson The Person id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Person
	 */
	public function getPerson(int $idPerson, $appendToResponse = null): Person
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('person');
		return new Person($this->call('person/' . $idPerson, $appendToResponse));
	}

	/**
	 * 	Get a Collection
	 *
	 * 	@param int $idCollection The Collection id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Collection
	 */
	public function getCollection(int $idCollection, $appendToResponse = null): Collection
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('collection');
		return new Collection($this->call('collection/' . $idCollection, $appendToResponse));
	}

	/**
	 * 	Get a Company
	 *
	 * 	@param int $idCompany The Company id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Company
	 */
	public function getCompany(int $idCompany, $appendToResponse = null): Company
	{
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()->getAppender('company');
		return new Company($this->call('company/' . $idCompany, $appendToResponse));
	}

	//------------------------------------------------------------------------------ 
	// Searches 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Search Multi
	 *
	 * 	@param string $query The query to search for
	 * 	@param int $page
	 * 	@return array
	 */
	public function multiSearch(string $query, int $page = 1): array
	{
		$searchResults = array(
			Movie::MEDIA_TYPE_MOVIE => array(),
			TVShow::MEDIA_TYPE_TV => array(),
			Person::MEDIA_TYPE_PERSON => array(),
		);
		
		$result = $this->call('search/multi', '&query=' . urlencode($query) . '&page=' . $page);
		
		if (!isset($result['results']) || empty($result['results'])) {
			return $searchResults;
		}
		
		foreach ($result['results'] as $data) {
			if ($data['media_type'] === Movie::MEDIA_TYPE_MOVIE) {
				$searchResults[Movie::MEDIA_TYPE_MOVIE][] = new Movie($data);
			} elseif ($data['media_type'] === TVShow::MEDIA_TYPE_TV) {
				$searchResults[TVShow::MEDIA_TYPE_TV][] = new TVShow($data);
			} elseif ($data['media_type'] === Person::MEDIA_TYPE_PERSON) {
				$searchResults[Person::MEDIA_TYPE_PERSON][] = new Person($data);
			}
		}
		return $searchResults;
	}

	/**
	 *  Search Movie
	 *
	 * 	@param string $movieTitle The title of a Movie
	 * 	@return Movie[]
	 */
	public function searchMovie(string $movieTitle): array
	{
		$movies = array();
		$result = $this->call('search/movie', '&query=' . urlencode($movieTitle));
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 *  Search TVShow
	 *
	 * 	@param string $tvShowTitle The title of a TVShow
	 * 	@return TVShow[]
	 */
	public function searchTVShow(string $tvShowTitle): array
	{
		$tvShows = array();
		$result = $this->call('search/tv', '&query=' . urlencode($tvShowTitle));
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}

	/**
	 *  Search Person
	 *
	 * 	@param string $personName The name of the Person
	 * 	@return Person[]
	 */
	public function searchPerson(string $personName): array
	{
		$persons = array();
		$result = $this->call('search/person', '&query=' . urlencode($personName));
		foreach ($result['results'] as $data) {
			$persons[] = new Person($data);
		}
		return $persons;
	}

	/**
	 *  Search Collection
	 *
	 * 	@param string $collectionName The name of the Collection
	 * 	@return Collection[]
	 */
	public function searchCollection(string $collectionName): array
	{
		$collections = array();
		$result = $this->call('search/collection', '&query=' . urlencode($collectionName));
		foreach ($result['results'] as $data) {
			$collections[] = new Collection($data);
		}
		return $collections;
	}

	/**
	 *  Search Company
	 *
	 * 	@param string $companyName The name of the Company
	 * 	@return Company[]
	 */
	public function searchCompany(string $companyName): array
	{
		$companies = array();
		$result = $this->call('search/company', '&query=' . urlencode($companyName));
		foreach ($result['results'] as $data) {
			$companies[] = new Company($data);
		}
		return $companies;
	}

	//------------------------------------------------------------------------------ 
	// Find 
	//------------------------------------------------------------------------------ 

	/**
	 *  Find
	 *
	 * 	@param string $id The ID from external source
	 * 	@param string $external_source The external source (e.g., 'imdb_id')
	 * 	@return array
	 */
	public function find(string $id, string $external_source = 'imdb_id'): array
	{
		$found = array();
		$result = $this->call('find/' . $id, '&external_source=' . urlencode($external_source));
		foreach ($result['movie_results'] as $data) {
			$found['movies'][] = new Movie($data);
		}
		foreach ($result['person_results'] as $data) {
			$found['persons'][] = new Person($data);
		}
		foreach ($result['tv_results'] as $data) {
			$found['tvshows'][] = new TVShow($data);
		}
		foreach ($result['tv_season_results'] as $data) {
			$found['seasons'][] = new Season($data);
		}
		foreach ($result['tv_episode_results'] as $data) {
			$found['episodes'][] = new Episode($data);
		}
		return $found;
	}

	//------------------------------------------------------------------------------ 
	// API Extra Info 
	//------------------------------------------------------------------------------ 

	/**
	 * 	Get Timezones
	 *
	 * 	@return array
	 */
	public function getTimezones(): array
	{
		return $this->call('timezones/list');
	}

	/**
	 * 	Get Jobs
	 *
	 * 	@return array
	 */
	public function getJobs(): array
	{
		return $this->call('job/list');
	}

	/**
	 * 	Get Movie Genres
	 *
	 * 	@return Genre[]
	 */
	public function getMovieGenres(): array
	{
		$genres = array();
		$result = $this->call('genre/movie/list');
		foreach ($result['genres'] as $data) {
			$genres[] = new Genre($data);
		}
		return $genres;
	}

	/**
	 * 	Get TV Genres
	 *
	 * 	@return Genre[]
	 */
	public function getTVGenres(): array
	{
		$genres = array();
		$result = $this->call('genre/tv/list');
		foreach ($result['genres'] as $data) {
			$genres[] = new Genre($data);
		}
		return $genres;
	}

	/**
	 *  Get Movies by Genre
	 *
	 *  @param int $idGenre
	 * 	@param int $page
	 * 	@return Movie[]
	 */
	public function getMoviesByGenre(int $idGenre, int $page = 1): array
	{
		$movies = array();
		$result = $this->call('genre/' . $idGenre . '/movies', '&page=' . $page);
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 * Search Movies by Year
	 *
	 * @param int $year
	 * @param int $page
	 * @return array
	 */
	public function searchMoviesByYear(int $year, int $page = 1): array
	{
		$movies = array();
		$result = $this->call('discover/movie', '&page=' . $page . "&year=" . $year);
		
		if (!isset($result['results'])) {
			return $movies;
		}
		
		foreach ($result['results'] as $data) {
			$movies[] = new Movie($data);
		}
		return $movies;
	}

	/**
	 * Get TVShows by Year
	 *
	 * @param int $year
	 * @param int $page
	 * @return array
	 */
	public function searchTVShowsByYear(int $year, int $page = 1): array
	{
		$tvShows = array();
		$result = $this->call('discover/tv', '&page=' . $page . "&first_air_date_year=" . $year);
		
		if (!isset($result['results'])) {
			return $tvShows;
		}
		
		foreach ($result['results'] as $data) {
			$tvShows[] = new TVShow($data);
		}
		return $tvShows;
	}
} 