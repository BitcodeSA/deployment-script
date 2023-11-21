# Changelog

#### Changes into version 0.0.2:

* Remove some unused classes and files.
* Prevent the script from running in the production environment using config var `allow_in_production`.
* Specify the commands that should be run in Production by specified it in the config var `production`, if not specified
  the *default commands* will be used.
