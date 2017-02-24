# Hair Salon

#### Epicodus PHP Week 3, 3 Lab, 2/2017

#### By Stella Huayhuaca

## Description

This lab is about experimenting with PHP and installing the silex and Twig frameworks and extending to mySQL.

## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Mac.
* See https://getcomposer.org/ for details on installing _composer_.
* See https://mamp.info/ for details on installing _MAMP_.
* Use MAMP `http://localhost:8888/phpmyadmin/` and `to_do.sql.zip` to import a `to_do` database.
* Use same MAMP website to copy to_do database to `to_do_test` database (if you would like to try PHPUnit tests).
* Use MAMP
* Clone project
* From project root, run > `composer install --prefer-source --no-interaction`
* To run PHPUnit tests from root > `vendor/bin/phpunit tests`
* From web folder in project, Start PHP > `php -S localhost:8000`
* In web browser open `localhost:8000`

## Known Bugs
* No known bugs

## Support and contact details
* No support

## Technologies Used
* PHP
* MAMP
* mySQL
* Composer
* PHPUnit
* Silex
* Twig
* HTML
* CSS
* Bootstrap
* Git

## Copyright (c)
* 2017 Stella Huayhuaca.

## License
* MIT

## Specifications
* Start MySQL.
* Start phpunit dependency.
* Create the database with tables and columns.
* Create Restaurant Class with name, cuisine_id.
* Create Cuisine Class with type.
* Test for functionality.
* Build class methods according to tests.
* Silex and Twig Dependencies
* Initial Silex framework
* Add classes functionality to routes.
* Twig forms

## MySQL commands used:
* start servers in MAMP
* /applications/mamp/library/bin/mysql --host=localhost -uroot -proot
* Create database hair_salon;
* Use hair_salon;
* Create table stylists(id serial primary key, name varchar(255));
* Create table clients(id serial primary key, name varchar(255), stylist_id int);
* use hair_salon_test ; (after creating a copy(structure only) in /phpmyadmin browser.)


|Behavior|Input|Output|
|--------|-----|------|
|Stylist added|the owner enters a stylist name in a form |a list shows the new name added.|
|Stylist selected|Selects the name of a stylist |takes to a new page where owner can add names of his clients.|
|Client added|owner inputs name of the client in the form|a list show the name of the clients being added.|
|Name of stylist is edited|owner edits the stylist information |new name is assigned to stylist.|
|Stylist list is deleted|owner clicks delete all button to start from scratch|the list of stylists disappears.|
|a client is removed from list|owner clicks on the delete button next to the client|the list shows all the clients minus the one who was removed.|


* End specifications
