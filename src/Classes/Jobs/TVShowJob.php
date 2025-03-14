<?php
namespace Duyplus\TMDBApi\Classes\Jobs;

class TVShowJob
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    protected $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a TVShowJob
     *  @param int|null $personId The person id
     */
    public function __construct($data, $personId = null)
    {
        $this->crawl = $data;
        if ($personId !== null) {
            $this->crawl['person_id'] = $personId;
        }
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the TVShow's title
     *
     *  @return string
     */
    public function getTVShowName()
    {
        return $this->crawl['name'];
    }

    /** 
     *  Get the TVShow's id
     *
     *  @return int
     */
    public function getTVShowID()
    {
        return $this->crawl['id'];
    }

    /** 
     *  Get the TVShow's original title
     *
     *  @return string
     */
    public function getTVShowOriginalTitle()
    {
        return $this->crawl['original_name'];
    }

    /** 
     *  Get the TVShow's release date
     *
     *  @return string
     */
    public function getTVShowFirstAirDate()
    {
        return $this->crawl['first_air_date'];
    }

    /** 
     *  Get the TVShow's poster
     *
     *  @return string
     */
    public function getPoster()
    {
        return $this->crawl['poster_path'];
    }

    /** 
     *  Get the TVShow's job
     *
     *  @return string
     */
    public function getTVShowJob()
    {
        return $this->crawl['job'];
    }

    /** 
     *  Get the TVShow's department
     *
     *  @return string
     */
    public function getTVShowDepartment()
    {
        return $this->crawl['department'];
    }

    /** 
     *  Get the TVShow's overview
     *
     *  @return string
     */
    public function getTVShowOverview()
    {
        return $this->crawl['overview'];
    }

    /** 
     *  Get the TVShow's episode count
     *
     *  @return int
     */
    public function getTVShowEpisodeCount()
    {
        return $this->crawl['episode_count'];
    }

    /**
     *  Get Generic.<br>
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
     *  Get the JSON representation of the TVShowJob
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 