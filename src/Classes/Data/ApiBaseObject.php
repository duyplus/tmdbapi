<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Data\Person;

class ApiBaseObject
{
    //------------------------------------------------------------------------------
    // Class Constants
    //------------------------------------------------------------------------------

    const MEDIA_TYPE_MOVIE = 'movie';
    const CREDITS_TYPE_CAST = 'cast';
    const CREDITS_TYPE_CREW = 'crew';
    const MEDIA_TYPE_TV = 'tv';

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    protected $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the ApiObject
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    /**
     * 	Get the ApiObject id
     *
     * 	@return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     * 	Get the ApiObject Poster
     *
     * 	@return string
     */
    public function getPoster()
    {
        return $this->crawl['poster_path'];
    }

    /**
     * 	Get the ApiObjects vote average
     *
     * 	@return int
     */
    public function getVoteAverage()
    {
        return $this->crawl['vote_average'];
    }

    /**
     * 	Get the ApiObjects vote count
     *
     * 	@return int
     */
    public function getVoteCount()
    {
        return $this->crawl['vote_count'];
    }

    /**
     * Get the ApiObjects Cast
     * @return array of Person
     */
    public function getCast()
    {
        return $this->getCredits(self::CREDITS_TYPE_CAST);
    }

    /**
     * Get the Cast or the Crew of an ApiObject
     * @param string $key
     * @return array of Person
     */
    protected function getCredits($key)
    {
        $persons = [];
        foreach ($this->crawl['credits'][$key] as $data) {
            $persons[] = new Person($data);
        }
        return $persons;
    }

    /**
     * Get the ApiObject crew
     * @return array of Person
     */
    public function getCrew()
    {
        return $this->getCredits(self::CREDITS_TYPE_CREW);
    }

    /**
     *  Get Generic.
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     * 	@param string $item The item of the $data array you want
     * 	@return array|mixed|null Returns the entire data array, a specific item, or null if the item does not exist.
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
} 