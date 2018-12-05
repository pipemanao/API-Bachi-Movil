<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener Lista de estudiantes
$app->get("/students", function(Request $request, Response $response)
{
  $sql = "SELECT * FROM students";
  try
  {
    $pdo = new DataBase();
    $pdo = $pdo->Connection();
    $result = $pdo->query($sql);

    if($result->rowCount() > 0)
    {
      $students = $result->fetchAll(PDO::FETCH_OBJ);

       echo json_encode($students);
    }
    else
    {
      echo json_encode(array("Error" => "No existen datos en la base de datos."));
    }

    $result = null;
    $pdo = null;
  }
  catch(PDOException $e)
  {
    echo json_encode(array("Error" => $e.getMessage()));
  }
});

//Obtener estudiante por id
$app->get("/students/{id}", function(Request $request, Response $response)
{
  $id = $request->getAttribute("id");
  $sql = "SELECT * FROM students WHERE idstudent = " . $id;
  try
  {
    $pdo = new DataBase();
    $pdo = $pdo->Connection();
    $result = $pdo->query($sql);

    if($result->rowCount() > 0)
    {
      $students = $result->fetchAll(PDO::FETCH_OBJ);

       echo json_encode($students);
    }
    else
    {
      echo json_encode(array("Error" => "No existen datos en la base de datos."));
    }

    $result = null;
    $pdo = null;
  }
  catch(PDOException $e)
  {
    echo json_encode(array("Error" => $e.getMessage()));
  }
});

//agregar estudiante
$app->post("/students/new", function(Request $request, Response $response)
{
  $name = $request->getParam("name");
  $lastName = $request->getParam("lastname");
  $rut = $request->getParam("rut");

  $sql = "INSERT INTO students values (DEFAULT, :name, :lastname, :rut)";
  try
  {
    $pdo = new DataBase();
    $pdo = $pdo->Connection();
    $result = $pdo->prepare($sql);

    $result->bindParam("name", $name);
    $result->bindParam("lastname", $lastName);
    $result->bindParam("rut", $rut);

    $result->execute();

    echo json_encode(array("Info" => "Nuevo estudiante Creado."));

    $result = null;
    $pdo = null;
  }
  catch(PDOException $e)
  {
    echo json_encode(array("Error" => $e.getMessage()));
  }
});

//editar estudiante
$app->put("/students/edit/{id}", function(Request $request, Response $response)
{
  $id = $request->getAttribute("id");
  $name = $request->getParam("name");
  $lastName = $request->getParam("lastname");
  $rut = $request->getParam("rut");

  $sql = "UPDATE students SET name = :name, lastname = :lastname, rut = :rut WHERE idstudent = :id";
  try
  {
    $pdo = new DataBase();
    $pdo = $pdo->Connection();
    $result = $pdo->prepare($sql);

    $result->bindParam("name", $name);
    $result->bindParam("lastname", $lastName);
    $result->bindParam("rut", $rut);
    $result->bindParam("id", $id);

    $result->execute();

    if($result->rowCount() > 0)
    {
      echo json_encode(array("Info" => "Estudiante modificado correctamente."));
    }
    else
    {
      echo json_encode(array("Error" => "No existen datos en la base de datos."));
    }

    $result = null;
    $pdo = null;
  }
  catch(PDOException $e)
  {
    echo json_encode(array("Error" => $e.getMessage()));
  }
});

//eliminar estudiante
$app->delete("/students/delete/{id}", function(Request $request, Response $response)
{
  $id = $request->getAttribute("id");

  $sql = "DELETE FROM students WHERE idstudent = :id";
  try
  {
    $pdo = new DataBase();
    $pdo = $pdo->Connection();
    $result = $pdo->prepare($sql);

    $result->bindParam("id", $id);

    $result->execute();

    if($result->rowCount() > 0)
    {
      echo json_encode(array("Info" => "Estudiante eliminado correctamente."));
    }
    else
    {
      echo json_encode(array("Error" => "No existen datos en la base de datos."));
    }

    $result = null;
    $pdo = null;
  }
  catch(PDOException $e)
  {
    echo json_encode(array("Error" => $e.getMessage()));
  }
});
