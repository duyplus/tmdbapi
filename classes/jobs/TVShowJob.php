<?php
namespace duyplus\tmdbapi\classes\jobs;

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

class TVShowJob
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a TVShow job
     */
    public function __construct($data, $ipPerson)
    {
        $this->_data = $data;
        $this->_data['person_id'] = $ipPerson;
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
     *  Get the TVShow's original title
     *
     *  @return string
     */
    public function getTVShowOriginalTitle()
    {
        return $this->_data['original_name'];
    }

    /** 
     *  Get the TVShow's release date
     *
     *  @return string
     */
    public function getTVShowFirstAirDate()
    {
        return $this->_data['first_air_date'];
    }

    /** 
     *  Get the TVShow's poster
     *
     *  @return string
     */
    public function getPoster()
    {
        return $this->_data['backdrop_path'];
    }

    /** 
     *  Get the name of the job
     *
     *  @return string
     */
    public function getTVShowJob()
    {
        return $this->_data['job'];
    }

    /** 
     *  Get the job department
     *
     *  @return string
     */
    public function getTVShowDepartment()
    {
        return $this->_data['department'];
    }

    /** 
     *  Get the TVShow's overview
     *
     *  @return string
     */
    public function getTVShowOverview()
    {
        return $this->_data['overview'];
    }

    /** 
     *  Get the TVShow's episode count
     *
     *  @return string
     */
    public function getTVShowEpisodeCount()
    {
        return $this->_data['episode_count'];
    }


    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     *  Get the JSON representation of the TVShow job
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->_data, JSON_PRETTY_PRINT);
    }
}
?>