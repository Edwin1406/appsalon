<?php 

require 'funciones.php';
require 'database.php';
require_once __DIR__ . '/../vendor/autoload.php';
// echo __DIR__;

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);