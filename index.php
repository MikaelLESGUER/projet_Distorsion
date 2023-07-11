<?php
require './managers/UserManager.php';

$host = "db.3wa.io";
$port = "3306";
$dbName = "mikaellesguer_phpj9";
$username = "mikaellesguer";
$password = "0dcd5a19fb0aa70c0c7bf17951b99a78";

$manager = new UserManager($dbName, $port, $host, $username, $password);

require './models/Users.php';
require './controllers/UserController.php';
$controller = new UserController($manager);

require './services/Router.php';
?>