<?php
namespace Duyplus\TMDBApi\Classes\Roles;

use Duyplus\TMDBApi\Classes\Data\Role;

class TVShowRole extends Role
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a TVShowRole
     *  @param int|null $idPerson The person id
     */
    public function __construct($data, $idPerson = null)
    {
        parent::__construct($data, $idPerson);
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the TVShow's title of the role
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
     *  Get the TVShow's original title of the role
     *
     *  @return string
     */
    public function getTVShowOriginalTitle()
    {
        return $this->crawl['original_name'];
    }

    /** 
     *  Get the TVShow's release date of the role
     *
     *  @return string
     */
    public function getTVShowFirstAirDate()
    {
        return $this->crawl['first_air_date'];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     *  Get the JSON representation of the TVShowRole
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 