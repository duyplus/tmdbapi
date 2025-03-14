<?php
namespace Duyplus\TMDBApi\Classes\Roles;

use Duyplus\TMDBApi\Classes\Data\Role;

class MovieRole extends Role
{
    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of the MovieRole
     *  @param int|null $idPerson The Person id
     */
    public function __construct($data, $idPerson = null)
    {
        parent::__construct($data, $idPerson);
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     *  Get the Movie's title
     *
     *  @return string
     */
    public function getMovieTitle()
    {
        return $this->get('title');
    }

    /**
     *  Get the Movie's id
     *
     *  @return int
     */
    public function getMovieID()
    {
        return $this->get('id');
    }

    /**
     *  Get the Movie's original title
     *
     *  @return string
     */
    public function getMovieOriginalTitle()
    {
        return $this->get('original_title');
    }

    /**
     *  Get the Movie's release date
     *
     *  @return string
     */
    public function getMovieReleaseDate()
    {
        return $this->get('release_date');
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     *  Get the JSON representation of the MovieRole
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->get(), JSON_PRETTY_PRINT);
    }
} 