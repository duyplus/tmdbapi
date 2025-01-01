# TMDBAPI #

TMDB API v3 PHP Library - wrapper to [API](https://developers.themoviedb.org/3/) version 3 of [themoviedb.org](http://themoviedb.org). With the TMDB API v3 PHP Library, you can easily access information about movies, actors, reviews, genres, and many other related data. The library supports basic HTTP requests and automatically handles JSON responses, enabling you to quickly and efficiently integrate TMDB functionalities into your PHP projects with flexibility.

[![GitHub tag](https://img.shields.io/github/v/release/duyplus/tmdbapi?style=for-the-badge)](https://github.com/duyplus/tmdbapi/releases/?include_prereleases)
![GitHub last commit](https://img.shields.io/github/last-commit/duyplus/tmdbapi?style=for-the-badge)

## Installation

You can install the TMDB API via Composer:

```bash
composer require duyplus/tmdbapi
```

## Requirements ##
- PHP 5.3.x or higher
- cURL
- TMDB API Key (get key from [here](https://www.themoviedb.org/settings/api))

## Documentation ##

[View document](https://duyplus.github.io/tmdbapi/index.html)

## Changelog ##

[View changelog](https://github.com/duyplus/tmdbapi/blob/master/CHANGELOG.md)

## Initialize the class ##
If you have a $conf array

```php
use duyplus\tmdbapi\TMDB;
// if you have a $conf array - (See LIB_ROOT/configuration/default.php as an example)
$tmdb = new TMDB($conf);
```

If you have no $conf array it uses the default conf but you need to have an API Key

```php
use duyplus\tmdbapi\TMDB;
// if you have no $conf it uses the default config
$tmdb = new TMDB();
//Insert your API Key of TMDB
//Necessary if you use default conf
$tmdb->setAPIKey('YOUR_API_KEY');
```

## Movies ##
### Search a Movie ###

```php
//Title to search for
$title = 'back to the future';
$movies = $tmdb->searchMovie($title);
// returns an array of Movie Object
foreach ($movies as $movie) {
    echo $movie->getTitle() . '<br>';
}
```

returns an array of [Movie](https://duyplus.github.io/tmdbapi/class-Movie.html) Objects.
### Get a Movie ###
You should take a look at the Movie class [Documentation](https://duyplus.github.io/tmdbapi/class-Movie.html) and see all the info you can get from a Movie Object.

```php
$idMovie = 11;
$movie = $tmdb->getMovie($idMovie);
// returns a Movie Object
echo $movie->getTitle();
```

returns a [Movie](https://duyplus.github.io/tmdbapi/class-Movie.html) Object.
## TV Shows ##
### Search a TV Show ###

```php
// Title to search for
$title = 'breaking bad';
$tvShows = $tmdb->searchTVShow($title);
foreach ($tvShows as $tvShow) {
    echo $tvShow->getName() . '<br>';
}
```

returns an array of [TVShow](https://duyplus.github.io/tmdbapi/class-TVShow.html) Objects.
### Get a TVShow ###
You should take a look at the TVShow class [Documentation](https://duyplus.github.io/tmdbapi/class-TVShow.html) and see all the info you can get from a TVShow Object.

```php
$idTVShow = 1396;
$tvShow = $tmdb->getTVShow($idTVShow);
// returns a TVShow Object
echo $tvShow->getName();
```

returns a [TVShow](https://duyplus.github.io/tmdbapi/class-TVShow.html) Object.
### Get a TVShow's Season ###
You should take a look at the Season class [Documentation](https://duyplus.github.io/tmdbapi/class-Season.html) and see all the info you can get from a Season Object.

```php
$idTVShow = 1396;
$numSeason = 2;
$season = $tmdb->getSeason($idTVShow, $numSeason);
// returns a Season Object
echo $season->getName();
```

returns a [Season](https://duyplus.github.io/tmdbapi/class-Season.html) Object.
### Get a TVShow's Episode ###
You should take a look at the Episode class [Documentation](https://duyplus.github.io/tmdbapi/class-Episode.html) and see all the info you can get from a Episode Object.

```php
$idTVShow = 1396;
$numSeason = 2;
$numEpisode = 8;
$episode = $tmdb->getEpisode($idTVShow, $numSeason, $numEpisode);
// returns a Episode Object
echo $episode->getName();
```

returns a [Episode](https://duyplus.github.io/tmdbapi/class-Episode.html) Object.
## Persons ##
### Search a Person ###

```php
// Name to search for
$name = 'Johnny';
$persons = $tmdb->searchPerson($name);
foreach ($persons as $person) {
    echo $person->getName() . '<br>';
}
```

returns an array of [Person](https://duyplus.github.io/tmdbapi/class-Person.html) Objects.
### Get a Person ###
You should take a look at the Person class [Documentation](https://duyplus.github.io/tmdbapi/class-Person.html) and see all the info you can get from a Person Object.

```php
$idPerson = 85;
$person = $tmdb->getPerson($idPerson);
// returns a Person Object
echo $person->getName();
```

returns a [Person](https://duyplus.github.io/tmdbapi/class-Person.html) Object.
### Get Person's Roles ###
You should take a look at the Role class [Documentation](https://duyplus.github.io/tmdbapi/class-Role.html) and see all the info you can get from a Role Object.

```php
$movieRoles = $person->getMovieRoles();
foreach ($movieRoles as $movieRole) {
    echo $movieRole->getCharacter() . ' in ' . $movieRole->getMovieTitle() . '<br>';
}
```

returns an array of [MovieRole](https://duyplus.github.io/tmdbapi/class-MovieRole.html) Objects.

```php
$tvShowRoles = $person->getTVShow();
foreach ($tvShowRoles as $tvShowRole) {
    echo $tvShowRole->getCharacter() . ' in ' . $tvShowRole->getMovieName() . '<br>';
}
```

returns an array of [TVShowRole](https://duyplus.github.io/tmdbapi/class-TVShowRole.html) Objects.
## Collections ##
### Search a Collection ###

```php
// Name to search for
$name = 'the hobbit';
$collections = $tmdb->searchCollection($name);
foreach ($collections as $collection) {
    echo $collection->getName() . '<br>';
}
```

returns an array of [Collection](https://duyplus.github.io/tmdbapi/class-Collection.html) Objects.
### Get a Collection ###
You should take a look at the Collection class [Documentation](https://duyplus.github.io/tmdbapi/class-Collection.html) and see all the info you can get from a Collection Object.

```php
$idCollection = 121938;
$collection = $tmdb->getCollection($idCollection);
// returns a Collection Object
echo $collection->getName();
```

returns a [Collection](https://duyplus.github.io/tmdbapi/class-Collection.html) Object.
## Companies ##
### Search a Company ###

```php
// Name to search for
$name = 'Sony';
$companies = $tmdb->searchCompany($name);
foreach ($companies as $company) {
    echo $company->getName() . '<br>';
}
```

returns an array of [Company](https://duyplus.github.io/tmdbapi/class-Company.html) Objects.
### Get a Company ###
You should take a look at the Company class [Documentation](https://duyplus.github.io/tmdbapi/class-Company.html) and see all the info you can get from a Company Object.

```php
$idCompany = 34;
$company = $tmdb->getCompany($idCompany);
// returns a Company Object
echo $company->getName();
```

returns a [Company](https://duyplus.github.io/tmdbapi/class-Company.html) Object.

## Credits ##

@author [Pixelead0](https://twitter.com/pixelead0) also on [Github](https://github.com/pixelead0)<br/>
@author [Deso85](https://twitter.com/Cizero) also on [Github](https://github.com/deso85)<br/>
Forked from a similar [project](https://github.com/buibr/tmdbapi) by [Burhan Ibrahimi](https://github.com/buibr)

## License ##

This project is licensed under the [MIT License](https://github.com/duyplus/tmdbapi/blob/master/LICENSE). See the LICENSE file for details.
