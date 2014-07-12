<?php
    $xmlDoc=new DOMDocument();

    //get the q parameter from URL
    $q=$_GET["q"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
          $hint="";

          $interests_query = $connect->query("
              SELECT *
              FROM interests
              WHERE interest_name LIKE '$q%'
              ORDER BY interest_name Asc 
          ");

           while($interest = $interests_query->fetch()){
                $inter_id = $interest['interest_id'];
                $inter_name = $interest['interest_name'];
                $hint=$hint."<li class='cat-item cat-item-2'><a href='/events.php?interest=$inter_id'>$inter_name</a></li>";
            }
      }else{
          $hint="";

          $interests_query = $connect->query("
              SELECT *
              FROM interests
              ORDER BY interest_name Asc 
          ");

           while($interest = $interests_query->fetch()){
                $inter_id = $interest['interest_id'];
                $inter_name = $interest['interest_name'];
                $hint=$hint."<li class='cat-item cat-item-2'><a href='/events.php?interest=$inter_id'>$inter_name</a></li>";
            }
      }      

    // Set output to "no suggestion" if no hint were found
    // or to the correct values
    if ($hint=="") {
      $response="";
    } else {
      $response=$hint;
    }

    //output the response
echo $response;
?>