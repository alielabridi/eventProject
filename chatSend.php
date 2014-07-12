<?php 

require_once('connect.php');
session_start();
$post = htmlentities(strip_tags($_POST['post']));

$query = $connect->query("
	INSERT INTO messages(user_receive, user_send, user_message)
	VALUES('{$_SESSION['id']}','{$post}')
");

?>