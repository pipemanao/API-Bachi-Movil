<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/config/DataBase.php';

$app = new \Slim\App;



// Carga de rutas para los servicios
require 'src/routes/Courses.php';

$app->run();