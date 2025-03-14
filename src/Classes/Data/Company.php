<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Data\Movie;

class Company
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the Company
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     * 	Get the Company's id
     *
     * 	@return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     * 	Get the Company's name
     *
     * 	@return string
     */
    public function getName()
    {
        return $this->crawl['name'];
    }

    /**
     * 	Get the Company's description
     *
     * 	@return string
     */
    public function getDescription()
    {
        return $this->crawl['description'];
    }

    /**
     * 	Get the Company's headquarters
     *
     * 	@return string
     */
    public function getHeadquarters()
    {
        return $this->crawl['headquarters'];
    }

    /**
     * 	Get the Company's logo
     *
     * 	@return string
     */
    public function getLogo()
    {
        return $this->crawl['logo_path'];
    }

    /**
     * 	Get the Company's homepage
     *
     * 	@return string
     */
    public function getHomepage()
    {
        return $this->crawl['homepage'];
    }

    /**
     * 	Get the Company's movies
     *
     * 	@return Movie[]
     */
    public function getMovies()
    {
        if (!isset($this->crawl['movies']['results'])) {
            return [];
        }

        $movies = [];

        foreach ($this->crawl['movies']['results'] as $data) {
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
     * 	Get the JSON representation of the Company
     *
     * 	@return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 