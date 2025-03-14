<?php
namespace Duyplus\TMDBApi\Classes\Config;

class APIConfiguration
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Configuration
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Configuration's base URL for images
     *
     *  @return string
     */
    public function getImageBaseURL()
    {
        return $this->crawl['images']['base_url'];
    }

    /** 
     *  Get the Configuration's secure base URL for images
     *
     *  @return string
     */
    public function getSecureImageBaseURL()
    {
        return $this->crawl['images']['secure_base_url'];
    }

    /** 
     *  Get the Configuration's list of sizes for backdrops
     *
     *  @return string[]
     */
    public function getBackdropSizes()
    {
        return $this->crawl['images']['backdrop_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for logos
     *
     *  @return string[]
     */
    public function getLogoSizes()
    {
        return $this->crawl['images']['logo_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for posters
     *
     *  @return string[]
     */
    public function getPosterSizes()
    {
        return $this->crawl['images']['poster_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for profiles
     *
     *  @return string[]
     */
    public function getProfileSizes()
    {
        return $this->crawl['images']['profile_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for stills
     *
     *  @return string[]
     */
    public function getStillSizes()
    {
        return $this->crawl['images']['still_sizes'];
    }

    /**
     *  Get Generic.<br>
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     *  @param string $item The item of the $data array you want
     *  @return array
     */
    public function get($item = '')
    {
        return (empty($item)) ? $this->crawl : $this->crawl[$item];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /** 
     *  Get the JSON representation of the Configuration
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 