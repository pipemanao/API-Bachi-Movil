<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener Lista de estudiantes
$app->get('/courses/getall', function(Request $request, Response $response) {
    $sql = 'SELECT * FROM tbl_course';
    try {
        $db = DataBase::connection();
        $result = $db->query($sql);

        if($result->rowCount() > 0) {
            $courses = $result->fetchAll(PDO::FETCH_OBJ);

            echo json_encode($courses);
        } else {
            echo json_encode(array('Error' => 'No existen datos en la base de datos.'));
        }

        $result = null;
        $db = null;
    } catch(PDOException $e)  {
        echo json_encode(array('Error' => $e.getMessage()));
    }
});