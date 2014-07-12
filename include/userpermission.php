<?php
/*This function will test whether the user has the access permission */
function userpermission()
{
	if(isset($_SESSION["usr_id"]))	
	{


		  $db = new mysqli("localhost","root","test","evenup");
		  if($db->connect_error)
		  {
		    die("Connect error ({$db->connect_errno}) {$db->connect_error}");
		  }
		  $id = mysqli_escape_string($db,$_SESSION["id"]);
		  $result = $db->query("SELECT * FROM `userapps` WHERE `usr_id` = '$id';");

		  /*Check whether the user is already registered in the database with that ID*/
		  if($result->num_rows>0)
		  { 
		  	return 1;
		  }
		  else
		  	return 0;
	}
	else
		return 0;


}


?>