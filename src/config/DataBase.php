<?php
class DataBase {
	private $dbHost = 'localhost';
	private $dbUser = 'vulzsite_admin';
	private $dbPassword = '4IufG)KHR)sI';
	private $dbName = 'vulzsite_api';

	public function connection() {
		$pdo = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$pdo->exec("set names utf8mb4");

		return $pdo;
	}
}