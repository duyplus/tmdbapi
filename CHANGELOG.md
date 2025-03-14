# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-03-14

### Major Changes
- Restructured the entire library for compatibility with CodeIgniter 4
- Reorganized directories according to PSR-4 standards
- Updated namespaces and class structure
- Added return types for all methods
- Improved error handling and null checking

### Added
- Added new TMDB configuration class compatible with CI4
- Added new methods for searching movies by year
- Improved documentation and usage instructions

### Fixed
- Fixed invalid JSON handling
- Improved error handling for invalid API keys
- Fixed errors when accessing non-existent properties

## [0.7] - 2025-01-01

- Updated functions Configuration
- Fixed multi function

## [0.6] - 2017-06-18

- Implemented function for multiSearch
- Added example for multiSearch
- Fixed examples

## [0.5] - 2016-04-02

- Made a class for configuration to load external configs
- Updated functions list
- Changed a few functions to use config object
- Changed package structure of the project

## [0.4] - 2016-04-01

- Added config file
- Some code changes to use config file
- Some formal corrections inside comments
- (Hopefully) Corrected Versioning

## [0.3] - 2015-01-17

- Upgrade by [/alvaro-octal/TMDB-PHP-API](https://github.com/alvaro-octal/TMDB-PHP-API).
- Some modifications and dedicated classes added.

## [0.2] - 2012-11-07

- Fixed issue #2 (Object created in class php file)
- Added functions latestMovie, nowPlayingMovies (thank's to steffmeister)

## [0.1] - 2012-02-12

- This is the first version of the class without inline documentation or testing
- Forked from [glamorous/TMDb-PHP-API](https://github.com/glamorous/TMDb-PHP-API)