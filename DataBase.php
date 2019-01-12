<?php
class DataBase {
	private $dbHost = 'localhost';
	private $dbUser = 'info104';
	private $dbPassword = 'tcs20182';
	private $dbName = 'info10420182';

	public function connection() {
		$pdo = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$pdo->exec("set names utf8mb4");

		return $pdo;
	}
}