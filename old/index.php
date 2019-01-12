<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/config/DataBase.php';

$app = new \Slim\App;

// Carga de rutas para los servicios
require 'src/routes/Courses.php';
require 'src/routes/Information.php';

function sendOkResponse($message, $response) {
	$newResponse = $response->withStatus(200)->withHeader('Content-type', 'application/json')
												->withHeader('Access-Control-Allow-Origin', '*');
	$newResponse->getBody()->write($message);
	return $newResponse;
}

$app->run();