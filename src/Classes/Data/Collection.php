<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Data\Movie;

class Collection
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the Collection
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     * 	Get the Collection's id
     *
     * 	@return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     * 	Get the Collection's name
     *
     * 	@return string
     */
    public function getName()
    {
        return $this->crawl['name'];
    }

    /**
     * 	Get the Collection's poster
     *
     * 	@return string
     */
    public function getPoster()
    {
        return $this->crawl['poster_path'];
    }

    /**
     * 	Get the Collection's backdrop
     *
     * 	@return string
     */
    public function getBackdrop()
    {
        return $this->crawl['backdrop_path'];
    }

    /**
     * 	Get the Collection's movies
     *
     * 	@return Movie[]
     */
    public function getMovies()
    {
        $movies = [];

        foreach ($this->crawl['parts'] as $data) {
            $movies[] = new Movie($data);
        }

        return $movies;
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
     * 	Get the JSON representation of the Collection
     *
     * 	@return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 