<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener lista de todos los cursos
$app->get('/courses/getall', function(Request $request, Response $response) {
	$sql = 'SELECT * FROM tbl_course';
	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);

		if($result->rowCount() > 0) {
			$courses['courses'] = $result->fetchAll(PDO::FETCH_OBJ);

			echo json_encode($courses);
		} else {
			echo json_encode(array('Error' => 'No existen datos en la base de datos.'));
		}

		$result = null;
		$db = null;
	} catch(PDOException $e)  {
		echo json_encode(array('Error' => $e->getMessage()));
	}
});

//Obtener lista de cursos favoritos
$app->get('/courses/getfavorites/{iduser}', function(Request $request, Response $response) {
	$idUser = $request->getAttribute("iduser");

	$sql = 'SELECT B.id, B.courseName, B.courseCode FROM tbl_favorite_courses A 
			INNER JOIN tbl_course B ON A.courseId = B.id AND userId = ' . $idUser;

	try {
		$db = new DataBase();
		$db = $db->connection();
		$result = $db->query($sql);

		if($result->rowCount() > 0) {
			$courses['courses'] = $result->fetchAll(PDO::FETCH_OBJ);
			
			echo json_encode($courses);
		} else {
			echo json_encode(array('Error' => 'No tienes cursos agregados.'));
		}

		$result = null;
		$db = null;
	} catch(PDOException $e)  {
		echo json_encode(array('Error' => $e->getMessage()));
	}
});

//agregar curso a lista de favoritos
$app->post("/courses/addfavorite", function(Request $request, Response $response)
{
	$userId = $request->getParam("userId");
	$courseId = $request->getParam("courseId");

	$sql = "INSERT INTO tbl_favorite_courses values (DEFAULT, NOW(), :userId, :courseId)";
	try {
		$pdo = new DataBase();
		$pdo = $pdo->Connection();
		$result = $pdo->prepare($sql);

		$result->bindParam("userId", $userId);
		$result->bindParam("courseId", $courseId);

		$result->execute();

		echo json_encode(array('Info' => 'Curso agregado con exito.'));

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		echo json_encode(array('Error' => $e->getMessage()));
	}
});

//Quitar curso a lista de favoritos
$app->delete("/courses/unfavoritecourse/{iduser}/{idcourse}", function(Request $request, Response $response)
{
	$idCourse = $request->getAttribute("idcourse");
	$idUser = $request->getAttribute("iduser");

	$sql = 'DELETE FROM tbl_favorite_courses WHERE userId = :idUser AND courseId = :idCourse';
	try {
		$pdo = new DataBase();
		$pdo = $pdo->Connection();
		$result = $pdo->prepare($sql);

		$result->bindParam('idCourse', $idCourse);
		$result->bindParam('idUser', $idUser);

		$result->execute();

		if($result->rowCount() > 0) {
			echo json_encode(array('Info' => 'Curso quitado con exito'));
		} else {
			echo json_encode(array('Error' => 'No tienes el curso como favorito.'));
		}

		$result = null;
		$pdo = null;
	} catch(PDOException $e) {
		echo json_encode(array('Error' => $e->getMessage()));
	}
});