<?php

class DataBase {
  private $dbHost = "localhost";
  private $dbUser = "root";
  private $dbPassword = "";
  private $dbName = "api";

  public function connection() {
    $pdo = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    return $pdo;
  }
}