<?php
include 'config.php';
function get_query($query) { 
	$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
	if ($mysqli->connect_errno) { 
		echo "Извините, возникла проблема на сайте"; 
		echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: \n"; 
		echo "Номер ошибки: " . $mysqli->connect_errno . "\n"; 
		echo "Ошибка: " . $mysqli->connect_error . "\n"; 
	exit; 
	} 
	$mysqli->query("SET NAMES utf8"); 
	if (!$result = $mysqli->query($query)) { 
		echo "Извините, возникла проблема в работе сайта."; 
		echo "Ошибка: Наш запрос не удался и вот почему: \n"; 
		echo "Запрос: " . $sql . "\n"; 
		echo "Номер ошибки: " . $mysqli->errno . "\n"; 
		echo "Ошибка: " . $mysqli->error . "\n"; 
	exit; 
	} 
	if ($result->num_rows === 0) { 
		$result->free(); 
		$mysqli->close(); 
		return null; 
	} 
	$i = 0; 
	while ($actor = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
		$ret[$i] = $actor; 
		$i++; 
	} 
	$result->free(); 
	$mysqli->close(); 
	return $ret; 
} 

function query($query) { 
	$mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
	if ($mysqli->connect_errno) { 
		echo "Извините, возникла проблема на сайте"; 
		echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: \n"; 
		echo "Номер ошибки: " . $mysqli->connect_errno . "\n"; 
		echo "Ошибка: " . $mysqli->connect_error . "\n"; 
		exit; 
	} 
	$mysqli->query("SET NAMES utf8"); 
	if (!$result = $mysqli->query($query)) { 
		echo "Извините, возникла проблема в работе сайта."; 
		echo "Ошибка: Наш запрос не удался и вот почему: \n"; 
		echo "Запрос: " . $sql . "\n"; 
		echo "Номер ошибки: " . $mysqli->errno . "\n"; 
		echo "Ошибка: " . $mysqli->error . "\n"; 
		exit; 
	} 
	return $mysqli->insert_id; $mysqli->close(); 
} 
?>