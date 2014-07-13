<?php

try{
	$connect = new PDO("mysql:host=localhost;dbname=eventapp",'root','junior/9,');

}catch(Exception $e){
	die("Error".$e->getMessage());
}

$hostname_mysqli = "localhost";
$username_mysqli = "root";
$password_mysqli = "junior/9,";
$database_mysqli = "eventapp";

?>