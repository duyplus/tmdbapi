<?php
namespace Duyplus\TMDBApi\Classes\Data;

class Episode
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;
    private $idTVS;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Episode
     *  @param int $idTVShow The TVShow's id
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
     *  Get the Episode's id
     *
     *  @return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     *  Get the Episode's name
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
     *  Get the Episode's number
     *
     *  @return int
     */
    public function getEpisodeNumber()
    {
        return $this->crawl['episode_number'];
    }

    /**
     *  Get the Episode's overview
     *
     *  @return string
     */
    public function getOverview()
    {
        return $this->crawl['overview'];
    }

    /**
     *  Get the Episode's still
     *
     *  @return string
     */
    public function getStill()
    {
        return $this->crawl['still_path'];
    }

    /**
     *  Get the Episode's AirDate
     *
     *  @return string
     */
    public function getAirDate()
    {
        return $this->crawl['air_date'];
    }

    /**
     *  Get the Episode's vote average
     *
     *  @return int
     */
    public function getVoteAverage()
    {
        return $this->crawl['vote_average'];
    }

    /**
     *  Get the Episode's vote count
     *
     *  @return int
     */
    public function getVoteCount()
    {
        return $this->crawl['vote_count'];
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
     *  Get the JSON representation of the Episode
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 