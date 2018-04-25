# Story Engine WebHook plugin for WordPress

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/KITMedia/wp-story-engine.git)
[![Build Status](https://travis-ci.org/KITMedia/wp-story-engine.svg?branch=develop)](https://travis-ci.org/KITMedia/wp-story-engine)
[![GitHub release](https://img.shields.io/github/release/KITMedia/wp-story-engine.svg)](https://github.com/KITMedia/wp-story-engine/archive/develop.zip)

This plugin creates an endpoint for Story Engine to publish it's content.

## WORK IN PROGRESS - TODO
1. Test endpoints (malfunctional tests commented)
1. Body type "number" => h3 with class="number"
1. Paragraph with class="size"
1. Image sideloaded
1. Image role data concatinate with text
1. Divider => center large full image sideloaded
1. List with ul and ol
1. Blockquote with class="align"
1. Remove debug data via param in settings
1. Delete endpoint
1. Categories

### Done w17-2018
1. Remove monolog logging.
1. Convert Log to debug and add it to post data
1. Token added to post url as param
1. Admin refresh token in options
1. Remove PHP Shorttags
1. Date only to gmt
1. Response code 400 for invalid data
1. Response code 500 at errors

## Requirements
* WordPress version 4.9 and up
* PHP 5.6 and up

## Plugin install
...

## Packagist
The plugin is pushed to Packagist for usage via composer if wanted.

## Official WordPress repository
The plugin is published to the official WordPress repository at [https://wordpress.org/plugins/](https://wordpress.org/plugins/).

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
