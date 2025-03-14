<?php
namespace Duyplus\TMDBApi\Classes\Data;

class Review
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the Review
     */
    public function __construct($data)
    {
        $this->crawl = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     * 	Get the Review's id
     *
     * 	@return string
     */
    public function getID()
    {
        return $this->crawl['id'];
    }

    /**
     * 	Get the Review's author
     *
     * 	@return string
     */
    public function getAuthor()
    {
        return $this->crawl['author'];
    }

    /**
     * 	Get the Review's content
     *
     * 	@return string
     */
    public function getContent()
    {
        return $this->crawl['content'];
    }

    /**
     * 	Get the Review's url
     *
     * 	@return string
     */
    public function getUrl()
    {
        return $this->crawl['url'];
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
     * 	Get the JSON representation of the Review
     *
     * 	@return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }
} 