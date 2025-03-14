<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Data\Episode;

class Season
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;
    private $idTVS;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Season
     *  @param int $idTVShow The id of the TVShow
     */
    public function __construct($data, $idTVShow = 0)
    {
        $this->crawl = $data;
        $this->idTVS = $idTVShow;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     *  Get the Season's id
     *
     *  @return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     *  Get the Season's name
     *
     *  @return string
     */
    public function getName()
    {
        return $this->crawl['name'];
    }

    /**
     *  Get the TVShow id
     *
     *  @return int
     */
    public function getTVShowID()
    {
        return $this->idTVS;
    }

    /**
     *  Get the Season's number
     *
     *  @return int
     */
    public function getSeasonNumber()
    {
        return $this->crawl['season_number'];
    }

    /**
     *  Get the Season's number of episodes
     *
     *  @return int
     */
    public function getNumEpisodes()
    {
        return count($this->crawl['episodes']);
    }

    /**
     *  Get the Season's episodes
     *
     *  @param int $numEpisode The episode number
     *  @return Episode
     */
    public function getEpisode($numEpisode)
    {
        return new Episode($this->crawl['episodes'][$numEpisode], $this->getTVShowID());
    }

    /**
     *  Get the Season's episodes
     *
     *  @return Episode[]
     */
    public function getEpisodes()
    {
        $episodes = array();

        foreach ($this->crawl['episodes'] as $data) {
            $episodes[] = new Episode($data, $this->getTVShowID());
        }

        return $episodes;
    }

    /**
     *  Get the Season's poster
     *
     *  @return string
     */
    public function getPoster()
    {
        return $this->crawl['poster_path'];
    }

    /**
     *  Get the Season's AirDate
     *
     *  @return string
     */
    public function getAirDate()
    {
        if (isset($this->crawl['air_date'])) {
            return $this->crawl['air_date'];
        }

        return '';
    }

    /**
     *  Get Generic.
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     *  @param string $item The item of the $data array you want
     *  @return array|mixed|null Returns the entire data array, a specific item, or null if the item does not exist.
     */
    public function get($item = '')
    {
        if (empty($item)) {
            return $this->crawl;
        }
        if (array_key_exists($item, $this->crawl)) {
            return $this->crawl[$item];
        }
        return null;
    }

    /**
     *  Get the JSON representation of the Season
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 