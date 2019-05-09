<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT','C:' .DS. 'xampp' .DS. 'htdocs'.DS.'OOP');
   // C:\xampp\htdocs\OOP
defined('INCLUEDS_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once("new_config.php");
require_once("Database.php");
require_once("Db_object.php");
require_once("User.php");
require_once("Photo.php");
require_once("functions.php");
require_once("Session.php");













?>