<?php

// Include the ORM library
require_once('idiorm.php');

$host = '127.0.0.1';
$user = 'root';
$pass = 'September1';
$database = 'pos';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);


ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
