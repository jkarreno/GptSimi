<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__.'/');
$dotenv->load();


$conn=mysqli_connect($_ENV['HOST_DATA_BASE'], $_ENV['USER_DATA_BASE'], $_ENV['PASS_DATA_BASE'], $_ENV['DATA_BASE']);



//Created with human intelligence by @jkarreno 2026
//move your stars
//be preprared
?>