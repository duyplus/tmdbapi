<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Data\Season;

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
        return $this->crawl['name'];
    }

    /**
     * 	Get the TVShow's original name
     *
     * 	@return string
     */
    public function getOriginalName()
    {
        return $this->crawl['original_name'];
    }

    /**
     * 	Get the TVShow's number of seasons
     *
     * 	@return int
     */
    public function getNumSeasons()
    {
        return $this->crawl['number_of_seasons'];
    }

    /**
     *  Get the TVShow's number of episodes
     *
     * 	@return int
     */
    public function getNumEpisodes()
    {
        return $this->crawl['number_of_episodes'];
    }

    /**
     *  Get a TVShow's season
     *
     *  @param int $numSeason The season number
     * 	@return Season
     */
    public function getSeason($numSeason)
    {
        $data = null;

        foreach ($this->crawl['seasons'] as $season) {
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

        foreach ($this->crawl['seasons'] as $data) {
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
        return $this->crawl['backdrop_path'];
    }

    /**
     * 	Get the TVShow's Overview
     *
     * 	@return string
     */
    public function getOverview()
    {
        return $this->crawl['overview'];
    }

    /**
     * 	Get if the TVShow is in production
     *
     * 	@return boolean
     */
    public function getInProduction()
    {
        return $this->crawl['in_production'];
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
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return self::MEDIA_TYPE_TV;
    }
} 