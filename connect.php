<?php

try{
	$connect = new PDO("mysql:host=localhost;dbname=eventapp",'root','junior/9,');

}catch(Exception $e){
	die("Error".$e->getMessage());
}

?>