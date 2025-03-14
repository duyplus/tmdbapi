<?php
namespace Duyplus\TMDBApi\Classes\Data;

class Genre
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the Genre
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     * 	Get the Genre's id
     *
     * 	@return int
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     * 	Get the Genre's name
     *
     * 	@return string
     */
    public function getName()
    {
        return $this->crawl['name'];
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
} 