<?php
class Database {
	public static function db_connect()
	{
		$parameters = include(ROOT. '/config/db_options.php');
		$host = $parameters['host'];
		$db_name = $parameters['db_name'];
		$user = $parameters['user'];
		$password = $parameters['password'];

		$db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $user, $password);
		$db->exec("set names utf8");
		return $db;
	}
}
