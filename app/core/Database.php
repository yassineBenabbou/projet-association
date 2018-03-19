<?php
/**
 * Projet, Base de donn�es
 *
 * @package  Project
 * @author   Yassine Benabbou <benabbou.yassine@yahoo.fr>
 */

abstract class Database {
	private static $db;


	public static function connect() {
		static::$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);		
		static::$db->exec('SET NAMES utf8');		
	}

	public static function query($query, $params = []) {
		$stmt = static::$db->prepare($query);
		$stmt->execute($params);

		return $stmt->fetchObject();
	}	

	public static function queryAll($query, $params = []) {
		$objects = [];

		$stmt = static::$db->prepare($query);
		$stmt->execute($params);

		while ($object = $stmt->fetchObject()) {
			$objects[] = $object;
		}

		return $objects;
	}

	public static function getPDO() {
		return static::$db;
	}

	// public static function getParams($properties = []) {
	// 	$subQuery = "";
	// 	foreach($properties as $key => $value) {
	// 		$subQuery .= " :{$key}";
	// 		if(end($properties) !== $value) $subQuery .= ',';
	// 	}

	// 	return $subQuery;
	// }

	// public static function getFields($properties = []) {
	// 	$subQuery = "";
	// 	foreach ($properties as $key => $value) {
	// 		$query .= "{$key}";
	// 		if(end($properties) !== $value) $query .= ', ';
	// 	}

	// 	return $subQuery;
	// }	
}