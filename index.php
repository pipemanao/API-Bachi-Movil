<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/config/DataBase.php';

$app = new \Slim\App;
// $app->withHeader('Content-type', 'application/json');
// $app->withHeader('Access-Control-Allow-Origin', '*');
// $app->response->headers->set('Content-Type', 'application/json');
// $app->response->headers->set('Access-Control-Allow-Origin', '*');


// Carga de rutas para los servicios
require 'src/routes/Courses.php';

function sendOkResponse($message, $response) {
	$newResponse = $response->withStatus(200)->withHeader('Content-type', 'application/json')
												->withHeader('Access-Control-Allow-Origin', '*');
	$newResponse->getBody()->write($message);
	return $newResponse;
}

$app->run();