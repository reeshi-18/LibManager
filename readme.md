# Library@SDSLabs

This project is written in PHP using the MVC framework.

This project uses Toro PHP for routing and Twig as Template engine

## Setup

* Clone this repository and cd to the directory.

* Install all the dependencies and generate classmaps `composer install` (make sure you have composer install before you do so).

* Copy the sample config file `config\sample.config.php to config\config.php`.

* Modify the config file `config\config.cfg`.

* Copy the vhost file `config/library.sdslabs.local.conf` to your apache's `sites-available` directory as `library.sdslabs.local.conf` and modify it.

* Enable the vhost using the a2ensite command and modify your `/etc/hosts` file accordingly.

* Import the database schema. Edit the `config\config.cfg` file to update the db_name field. Set this to the name given to the db into which you imported the schema.

* Make sure your mod_rewrite is enabled `sudo a2enmod rewrite` and `restart apache`

* The site can be accessed at `library.sdslabs.local/`

## Testing

Navigate to the directory and run the command
`composer dump-autoload`

Navigate to the public directory of the folder and run the following command

`php -S localhost:3000`

This will start the development server.
