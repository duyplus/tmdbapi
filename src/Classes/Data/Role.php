<?php
namespace Duyplus\TMDBApi\Classes\Data;

class Role
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    protected $crawl;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a Role
     *  @param int|null $personId The person id
     */
    public function __construct($data, $personId = null)
    {
        $this->crawl = $data;
        if ($personId !== null) {
            $this->crawl['person_id'] = $personId;
        }
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Role's character
     *
     *  @return string|null
     */
    public function getCharacter()
    {
        return isset($this->crawl['character']) ? $this->crawl['character'] : null;
    }

    /** 
     *  Get the Movie's credit id
     *
     *  @return string|null
     */
    public function getCreditID()
    {
        return isset($this->crawl['credit_id']) ? $this->crawl['credit_id'] : null;
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