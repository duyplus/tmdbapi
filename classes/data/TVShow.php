<?php
namespace duyplus\tmdbapi\classes\data;

use duyplus\tmdbapi\classes\data\Season;

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

class TVShow extends ApiBaseObject
{
    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     * 	Get the TVShow's name
     *
     * 	@return string
     */
    public function getName()
    {
        return $this->_data['name'];
    }

    /**
     * 	Get the TVShow's original name
     *
     * 	@return string
     */
    public function getOriginalName()
    {
        return $this->_data['original_name'];
    }

    /**
     * 	Get the TVShow's number of seasons
     *
     * 	@return int
     */
    public function getNumSeasons()
    {
        return $this->_data['number_of_seasons'];
    }

    /**
     *  Get the TVShow's number of episodes
     *
     * 	@return int
     */
    public function getNumEpisodes()
    {
        return $this->_data['number_of_episodes'];
    }

    /**
     *  Get a TVShow's season
     *
     *  @param int $numSeason The season number
     * 	@return int
     */
    public function getSeason($numSeason)
    {
        $data = null;

        foreach ($this->_data['seasons'] as $season) {
            if ($season['season_number'] == $numSeason) {
                $data = $season;
                break;
            }
        }
        return new Season($data);
    }

    /**
     *  Get the TvShow's seasons
     *
     * 	@return Season[]
     */
    public function getSeasons()
    {
        $seasons = array();

        foreach ($this->_data['seasons'] as $data) {
            $seasons[] = new Season($data, $this->getID());
        }

        return $seasons;
    }

    /**
     * 	Get the TVShow's Backdrop
     *
     * 	@return string
     */
    public function getBackdrop()
    {
        return $this->_data['backdrop_path'];
    }

    /**
     * 	Get the TVShow's Overview
     *
     * 	@return string
     */
    public function getOverview()
    {
        return $this->_data['overview'];
    }

    /**
     * 	Get if the TVShow is in production
     *
     * 	@return boolean
     */
    public function getInProduction()
    {
        return $this->_data['in_production'];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     * 	Get the JSON representation of the TVShow
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
        return self::MEDIA_TYPE_TV;
    }
}