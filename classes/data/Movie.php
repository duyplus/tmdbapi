<?php
namespace duyplus\tmdbapi\classes\data;

use duyplus\tmdbapi\classes\data\Company;
use duyplus\tmdbapi\classes\data\Genre;
use duyplus\tmdbapi\classes\data\Person;
use duyplus\tmdbapi\classes\data\Review;

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

class Movie extends ApiBaseObject
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

	private $_tmdb;

	//------------------------------------------------------------------------------
	// Get Variables
	//------------------------------------------------------------------------------

	/** 
	 * 	Get the Movie's title
	 *
	 * 	@return string
	 */
	public function getTitle()
	{
		return $this->_data['title'];
	}

	/** 
	 * 	Get the Movie's tagline
	 *
	 * 	@return string
	 */
	public function getTagline()
	{
		return $this->_data['tagline'];
	}

	/** 
	 * 	Get the Movie Directors IDs
	 *
	 * 	@return array(int)
	 */
	public function getDirectorIds()
	{
		$director_ids = [];
		$crew = $this->getCrew();
		/** @var Person $crew_member */
		foreach ($crew as $crew_member) {
			if ($crew_member->getJob() === Person::JOB_DIRECTOR) {
				$director_ids[] = $crew_member->getID();
			}
		}
		return $director_ids;
	}

	/** 
	 * 	Get the Movie's trailers
	 *
	 * 	@return array
	 */
	public function getTrailers()
	{
		return $this->_data['trailers'];
	}

	/** 
	 * 	Get the Movie's trailer
	 *
	 * 	@return string
	 */
	public function getTrailer()
	{
		$trailers = $this->getTrailers();
		return $trailers['youtube'][0]['source'];
	}

	/** 
	 * 	Get the Movie's genres
	 *
	 * 	@return Genre[]
	 */
	public function getGenres()
	{
		$genres = array();
		foreach ($this->_data['genres'] as $data) {
			$genres[] = new Genre($data);
		}
		return $genres;
	}

	/** 
	 * 	Get the Movie's reviews
	 *
	 * 	@return Review[]
	 */
	public function getReviews()
	{
		$reviews = array();
		foreach ($this->_data['review']['result'] as $data) {
			$reviews[] = new Review($data);
		}
		return $reviews;
	}

	/**
	 * 	Get the Movie's companies
	 *
	 * 	@return Company[]
	 */
	public function getCompanies()
	{
		$companies = array();
		foreach ($this->_data['production_companies'] as $data) {
			$companies[] = new Company($data);
		}
		return $companies;
	}

	//------------------------------------------------------------------------------
	// Import an API instance
	//------------------------------------------------------------------------------

	/**
	 *	Set an instance of the API
	 *
	 *	@param $tmdb An instance of the api, necessary for the lazy load
	 */
	public function setAPI($tmdb)
	{
		$this->_tmdb = $tmdb;
	}

	//------------------------------------------------------------------------------
	// Export
	//------------------------------------------------------------------------------

	/** 
	 * 	Get the JSON representation of the Movie
	 *
	 * 	@return string
	 */
	public function getJSON()
	{
		return json_encode($this->_data, JSON_PRETTY_PRINT);
	}


	/**
	 * @return string
	 */
	public function getMediaType()
	{
		return self::MEDIA_TYPE_MOVIE;
	}
}
