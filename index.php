<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require "src/config/DataBase.php";

$app = new \Slim\App;
//require "../src/routes/Students.php";

//Obtener estudiante por id
$app->get("/test/{id}", function(Request $request, Response $response) {
  $id = $request->getAttribute("id");
  echo $id;
});

$app->run();


/*$authenticateForRole = function ( $role = 'member' ) {
    return function () use ( $role ) {
        $user = User::fetchFromDatabaseSomehow();
        if ( $user->belongsToRole($role) === false ) {
            $app = \Slim\Slim::getInstance();
        }
    };
};

$app = new \Slim\App;
$app->get('/foo', function () {
    //Display admin control panel
    echo "hi";
});*/

/*
$app->get("/api", function(Request $request, Response $response)
{
  $headers = $request->getHeader('HTTP_AUTHORIZATION');
  var_dump($headers);
});*/
// require "../src/routes/Students.php";

/*
if($token == "123123")
{
  require "../src/routes/Students.php";
}else {
  echo json_encode(array(
    "Error" => "Token incorrecto"
  ));
}*/
