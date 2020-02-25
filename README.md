# MyBeamLabel

## Installation

After installing the site, import configuration
```
drush cim
```
Translate strings for custom modules and templates (Not needed):
```
drush locale-check && drush locale-update && drush cr 
```
Generate content from Invisio:
```
drupal beam_migrator:content 
```
Generate menu_links from jimbeam.com (Only english):
```
drupal beam_migrator:menu
```
Export variables defined in Bowmore Administration:
```
drupal beam_administration:export 
```
Import these variables:
```
drupal beam_administration:import 
```
Import codes from CSV (Example for DE):
```
drupal beam_migrator:beam_code --filename='import_10k.csv' --country='DE'
```
Load entities and store in cache:
```
drupal beam_migrator:entity_load --type='beam_code'
```
In Vars Form (branch master) set .jimbeam as domain. Other branches (for devel) set current url or delete this.webDomain 
in locationBox.js and ageGate.js (compile after) to get current url.

This application and jimbeam web have same cookies.

