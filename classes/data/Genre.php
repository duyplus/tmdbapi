<?php
namespace duyplus\tmdbapi\classes\data;

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

class Genre
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Collection
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Genre's name
     *
     *  @return string
     */
    public function getName()
    {
        return $this->_data['name'];
    }

    /** 
     *  Get the Genre's id
     *
     *  @return int
     */
    public function getID()
    {
        return $this->_data['id'];
    }
}
?>