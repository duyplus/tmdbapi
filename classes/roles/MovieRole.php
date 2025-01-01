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

class MovieRole extends Role
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a MovieRole
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
     *  Get the Movie's title of the role
     *
     *  @return string
     */
    public function getMovieTitle()
    {
        return $this->_data['title'];
    }

    /** 
     *  Get the Movie's id
     *
     *  @return int
     */
    public function getMovieID()
    {
        return $this->_data['id'];
    }

    /** 
     *  Get the Movie's original title of the role
     *
     *  @return string
     */
    public function getMovieOriginalTitle()
    {
        return $this->_data['original_title'];
    }

    /** 
     *  Get the Movie's release date of the role
     *
     *  @return string
     */
    public function getMovieReleaseDate()
    {
        return $this->_data['release_date'];
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