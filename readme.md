# Story Engine WebHook plugin for WordPress

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/KITMedia/wp-story-engine.git)
[![Build Status](https://travis-ci.org/KITMedia/wp-story-engine.svg?branch=develop)](https://travis-ci.org/KITMedia/wp-story-engine)
[![GitHub release](https://img.shields.io/github/release/KITMedia/wp-story-engine.svg)](https://github.com/KITMedia/wp-story-engine/archive/develop.zip)

This plugin creates an endpoint for Story Engine to publish content.

## WORK IN PROGRESS - TODO
1. Test endpoints (malfunctional tests commented) / migration tests
2. Test continued overall

## Requirements
* WordPress version 4.9 and up
* PHP 5.6 and up

## Plugin install

### Manually
Download latest tag/release as zip archive and upload via wp-admin. Please note that you will have to keep track of updates manually. 

### Automatic (preferred)
This way of installing will ensure that the latest version of this plugin will be available in your WP installation. 
1. Install WordPress GitHub Updater plugin from [https://github.com/afragen/github-updater](https://github.com/afragen/github-updater)
2. Install this plugin via wp-admin / GitHub Updater page

## Packagist
The plugin is pushed to Packagist for usage via composer if wanted.

## Development

### Git Workflow
Releases of this plugin is version controlled via Git Flow with develop and master branches.

### Development environment
Please contact us to get more info about development environment provided to this plugin.

### PHPUnit
Attention! `composer update` before any unit testing!

We run docker containers to unit tests in real WordPress (no mock).
[https://github.com/frozzare/docker-wptest](https://github.com/frozzare/docker-wptest)
[https://github.com/wpup/test-suite](https://github.com/wpup/test-suite)
Special thanks to Frozzare!

To initialize tests with docker, run: `docker run --name mysql -e MYSQL_ALLOW_EMPTY_PASSWORD=true -d mysql:latest`

To run tests, in the plugin folder, eg: `docker run -e WP_VERSION=4.9 --rm -v $(pwd):/opt --link mysql frozzare/wptest:5.6 vendor/bin/phpunit`

PHPUnit testing with docker:
[https://youtu.be/9CEoapNrrSc](Video)


### Code Style Sniff locally
PSR is used, validate style with:
Attention! `composer update` before any style check!
`vendor/bin/phpcs --ignore=*/vendor/* .`

## Data
Gist example data (incoming json to endpoint): [https://gist.github.com/chredd/05dcdde86a48c8558ba70c5fe95514c5](https://gist.github.com/chredd/05dcdde86a48c8558ba70c5fe95514c5)

## Roadmap
This is the preliminary roadmap of the plugin.

* Support for Category mappings.
* Support for mapping image sizes from Story Engine to WordPress image sizes.
* (More to come)