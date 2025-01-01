<?php
namespace duyplus\tmdbapi\classes\roles;

use duyplus\tmdbapi\classes\data\Role;

/**
 *  This class handles all the data you can get from the api Configuration
 *
 *	@package TMDB_V3_API_PHP
 *  @author Alvaro Octal
 *  @version 0.7
 *  @date 20/01/2015
 *  @updated 31/12/2024
 *  @link https://github.com/duyplus/tmdbapi
 *  @copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class TVShowRole extends Role
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a TVShowRole
     */
    public function __construct($data, $idPerson)
    {
        $this->_data = $data;
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
        return $this->_data['name'];
    }

    /** 
     *  Get the TVShow's id
     *
     *  @return int
     */
    public function getTVShowID()
    {
        return $this->_data['id'];
    }

    /** 
     *  Get the TVShow's original title of the role
     *
     *  @return string
     */
    public function getTVShowOriginalTitle()
    {
        return $this->_data['original_name'];
    }

    /** 
     *  Get the TVShow's release date of the role
     *
     *  @return string
     */
    public function getTVShowFirstAirDate()
    {
        return $this->_data['first_air_date'];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     *  Get the JSON representation of the Episode
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->_data, JSON_PRETTY_PRINT);
    }
}
?>