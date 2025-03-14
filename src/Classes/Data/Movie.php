<?php
namespace Duyplus\TMDBApi\Classes\Data;

use Duyplus\TMDBApi\Classes\Data\Company;
use Duyplus\TMDBApi\Classes\Data\Genre;
use Duyplus\TMDBApi\Classes\Data\Person;
use Duyplus\TMDBApi\Classes\Data\Review;

class Movie extends ApiBaseObject
{
    // Media Type
    const MEDIA_TYPE_MOVIE = 'movie';

    /**
     *  Get the Movie's title
     *
     *  @return string
     */
    public function getTitle()
    {
        return $this->crawl['title'];
    }

    /**
     *  Get the Movie's tagline
     *
     *  @return string
     */
    public function getTagline()
    {
        return $this->crawl['tagline'];
    }

    /**
     *  Get the Movie Director's IDs
     *
     *  @return array
     */
    public function getDirectorIds()
    {
        $director_ids = [];

        $crew = $this->crawl['credits']['crew'];

        foreach ($crew as $crew_member) {
            if ($crew_member['job'] === 'Director') {
                $director_ids[] = $crew_member['id'];
            }
        }

        return $director_ids;
    }

    /**
     *  Get the Trailers
     *
     *  @return array
     */
    public function getTrailers()
    {
        if (isset($this->crawl['trailers'])) {
            return $this->crawl['trailers'];
        }

        return [];
    }

    /**
     *  Get the Trailer
     *
     *  @return string
     */
    public function getTrailer()
    {
        $trailers = $this->getTrailers();

        if (count($trailers) > 0) {
            $trailer = $trailers[0];
            return $trailer['url'];
        }

        return '';
    }

    /**
     *  Get the Movie's Genres
     *
     *  @return Genre[]
     */
    public function getGenres()
    {
        $genres = [];

        foreach ($this->crawl['genres'] as $data) {
            $genres[] = new Genre($data);
        }

        return $genres;
    }

    /**
     *  Get the Movie's Reviews
     *
     *  @return Review[]
     */
    public function getReviews()
    {
        $reviews = [];

        if (!empty($this->crawl['reviews']['results'])) {
            foreach ($this->crawl['reviews']['results'] as $data) {
                $reviews[] = new Review($data);
            }
        }

        return $reviews;
    }

    /**
     *  Get the Movie's Companies
     *
     *  @return Company[]
     */
    public function getCompanies()
    {
        $companies = [];

        if (!empty($this->crawl['production_companies'])) {
            foreach ($this->crawl['production_companies'] as $data) {
                $companies[] = new Company($data);
            }
        }

        return $companies;
    }

    /**
     *  Set the TMDB API
     *
     *  @param  \Duyplus\TMDBApi\TMDB $tmdb TMDB API Object
     */
    public function setAPI($tmdb)
    {
        $this->_tmdb = $tmdb;
    }

    /**
     *  Get the Movie's Cast
     *
     *  @return Person[]
     */
    public function getCast()
    {
        $cast = [];

        foreach ($this->crawl['credits']['cast'] as $data) {
            $cast[] = new Person($data);
        }

        return $cast;
    }

    /**
     *  Get the JSON representation of the Movie
     *
     *  @return string
     */
    public function getJSON()
    {
        return json_encode($this->crawl, JSON_PRETTY_PRINT);
    }

    /**
     *  Get the Media Type
     *
     *  @return string
     */
    public function getMediaType()
    {
        return self::MEDIA_TYPE_MOVIE;
    }
} 