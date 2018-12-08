<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once 'src/config/DataBase.php';

$app = new \Slim\App;

// Carga de rutas para los servicios
require_once 'src/routes/Courses.php';

$app->run();