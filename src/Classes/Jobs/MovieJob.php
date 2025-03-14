<?php
namespace Duyplus\TMDBApi\Classes\Jobs;

class MovieJob
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    protected $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a MovieJob
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
     *  Get the Movie's title
     *
     *  @return string
     */
    public function getMovieTitle()
    {
        return $this->crawl['title'];
    }

    /** 
     *  Get the Movie's id
     *
     *  @return int
     */
    public function getMovieID()
    {
        return $this->crawl['id'];
    }

    /** 
     *  Get the Movie's original title
     *
     *  @return string
     */
    public function getMovieOriginalTitle()
    {
        return $this->crawl['original_title'];
    }

    /** 
     *  Get the Movie's release date
     *
     *  @return string
     */
    public function getMovieReleaseDate()
    {
        return $this->crawl['release_date'];
    }

    /** 
     *  Get the Movie's poster
     *
     *  @return string
     */
    public function getPoster()
    {
        return $this->crawl['poster_path'];
    }

    /** 
     *  Get the Movie's job
     *
     *  @return string
     */
    public function getMovieJob()
    {
        return $this->crawl['job'];
    }

    /** 
     *  Get the Movie's department
     *
     *  @return string
     */
    public function getMovieDepartment()
    {
        return $this->crawl['department'];
    }

    /** 
     *  Get the Movie's overview
     *
     *  @return string
     */
    public function getMovieOverview()
    {
        return $this->crawl['overview'];
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
     *  Get the JSON representation of the MovieJob
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
}