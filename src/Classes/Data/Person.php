<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Roles\MovieRole;
use Duyplus\TMDBApi\Classes\Roles\TVShowRole;

class Person
{
    // Media Type
    const MEDIA_TYPE_PERSON = 'person';

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of the Person
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     *  Get the Person's name
     *
     *  @return string
     */
    public function getName()
    {
        return $this->crawl['name'];
    }

    /**
     *  Get the Person's id
     *
     *  @return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     *  Get the Person's profile image
     *
     *  @return string
     */
    public function getProfile()
    {
        return $this->crawl['profile_path'];
    }

    /**
     *  Get the Person's birthday
     *
     *  @return string
     */
    public function getBirthday()
    {
        return $this->crawl['birthday'];
    }

    /**
     *  Get the Person's place of birth
     *
     *  @return string
     */
    public function getPlaceOfBirth()
    {
        return $this->crawl['place_of_birth'];
    }

    /**
     *  Get the Person's imdb id
     *
     *  @return string
     */
    public function getImbdID()
    {
        return $this->crawl['imdb_id'];
    }

    /**
     *  Get the Person's popularity
     *
     *  @return int
     */
    public function getPopularity()
    {
        return $this->crawl['popularity'];
    }

    /**
     *  Get the Person's job
     *
     *  @return string
     */
    public function getJob()
    {
        return $this->crawl['job'];
    }

    /**
     *  Get the Person's movie roles
     *
     *  @return MovieRole[]
     */
    public function getMovieRoles()
    {
        $movieRoles = array();

        foreach ($this->crawl['movie_credits']['cast'] as $data) {
            $movieRoles[] = new MovieRole($data);
        }

        return $movieRoles;
    }

    /**
     *  Get the Person's TV show roles
     *
     *  @return TVShowRole[]
     */
    public function getTVShowRoles()
    {
        $tvShowRole = array();

        foreach ($this->crawl['tv_credits']['cast'] as $data) {
            $tvShowRole[] = new TVShowRole($data);
        }

        return $tvShowRole;
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

    /**
     *  Get the Media Type
     *
     *  @return string
     */
    public function getMediaType()
    {
        return self::MEDIA_TYPE_PERSON;
    }
} 