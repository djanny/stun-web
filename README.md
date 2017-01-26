# stun-web
STUN/TURN pilot web interface

This is the main landing page for STUN/TURN pilot.
It requires eduGAIN AAI authentiacation, 
and provides STUN/TURN credentials.


Development dependencies:
* PHP
* Composer - Dependency Manager for PHP

Development steps:
* Updating dependencies (including require-dev)
composer update
* Generating optimized autoload files (before loading on production)
composer dump-autoload --optimize

* Init npm
npm install