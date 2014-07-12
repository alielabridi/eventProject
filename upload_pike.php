<?php
	
	require_once('connect.php');

	$allowedExts = array("jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
	&& in_array($extension, $allowedExts)) 
	{
		  if ($_FILES["file"]["error"] > 0) {
		    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		  } else {
		    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		    echo "Type: " . $_FILES["file"]["type"] . "<br>";
		    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
		    if (file_exists("img/upload/events/" . $_FILES["file"]["name"])) {
		      echo $_FILES["file"]["name"] . " already exists. ";
		    } else {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "img/upload/events/" . $_FILES["file"]["name"]);
		      echo "Stored in: " . "img/upload/events/" . $_FILES["file"]["name"];
		    }
	  	}
	}

	else {
	  echo "Invalid file";
	}

	// define variables and set to empty values
	$nameErr = $emailErr = $genderErr = $websiteErr = "";
	$event_name = $event_description = $event_place = $comment = $website = "";

	  if (empty($_POST["event_name"]) || empty($_POST["event_description"]) || empty($_POST["event_place"]) ) {
	    $nameErr = "Name is required";
	  } else {
	    $event_name = test_input($_POST["event_name"]);
	    $event_description = test_input($_POST["event_name"]);
	    $event_place = test_input($_POST["event_name"]);
	    // check if name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z ]*$/",$event_name) && !preg_match("/^[a-zA-Z ]*$/",$event_description) && !preg_match("/^[a-zA-Z ]*$/",$event_place) ) {
	      $nameErr = "Only letters and white space allowed"; 
	    }
	  }

	  if (!empty($_POST["event_date"]) || !empty($_POST["event_time"]) || !empty($_POST["usr_create"]) ) {
	  		$event_date = test_input($_POST["event_date"]);
		    $event_time = test_input($_POST["event_time"]);
		    $usr_create = test_input($_POST["usr_create"]);
	  }else{
	  		echo 'messing fields'
	  }



?>