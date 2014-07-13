<?php
 /* include the mysql connect file */
 require_once('connect.php');

// include required files form Facebook SDK
 
// added in v4.0.5
require_once( 'include/Facebook/FacebookHttpable.php' );
require_once( 'include/Facebook/FacebookCurl.php' );
require_once( 'include/Facebook/FacebookCurlHttpClient.php' );
 
// added in v4.0.0
require_once( 'include/Facebook/FacebookSession.php' );
require_once( 'include/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'include/Facebook/FacebookRequest.php' );
require_once( 'include/Facebook/FacebookResponse.php' );
require_once( 'include/Facebook/FacebookSDKException.php' );
require_once( 'include/Facebook/FacebookRequestException.php' );
require_once( 'include/Facebook/FacebookOtherException.php' );
require_once( 'include/Facebook/FacebookAuthorizationException.php' );
require_once( 'include/Facebook/GraphObject.php' );
require_once( 'include/Facebook/GraphSessionInfo.php' );
 
// added in v4.0.5
use Facebook\FacebookHttpable;
use Facebook\FacebookCurl;
use Facebook\FacebookCurlHttpClient;
 
// added in v4.0.0
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
 
// start session
session_start();
 
// init app with app id and secret
FacebookSession::setDefaultApplication( '563460800438057','36e24b9369287738867bc35e7cb54fdf' );
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( $facebook_path.'index.php' );
 
// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
  
  // validate the access_token to make sure it's still valid
  try {
    if ( !$session->validate() ) {
      $session = null;
    }
  } catch ( Exception $e ) {
    // catch any exceptions
    $session = null;
  }
  
} else {
  // no session exists
  
  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
  } catch( Exception $ex ) {
    // When validation fails or other local issues
    echo $ex->message;
  }
  
}
 
// see if we have a session
if ( isset( $session ) ) {
  
  // save the session
  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
  
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject()->asArray();


  $db = new mysqli($hostname_mysqli,$username_mysqli,$password_mysqli,$database_mysqli);
  if($db->connect_error)
  {
    die("Connect error ({$db->connect_errno}) {$db->connect_error}");
  }
  $id = mysqli_escape_string($db,$graphObject["id"]);
  $result = $db->query("SELECT * FROM `userapps` WHERE `Facebook_ID` = $id;");

  /*Check whether the user is already registered in the database with that ID*/
  if($result->num_rows>0)
    { 
    // if user recognized set a session
    $_SESSION['usr_id']=$graphObject["id"];
    header("location: events.php");
    }
  else {
    header('Location: include/Facebook_SignUp.html');
  }


  
} 
else {
  // show login url
  $params = array(
    'scope' => 'email',
  );
  $loginUrl =  $helper->getLoginUrl($params);
  ?>

<!DOCTYPE html>
<html>

<head>
	<title>Pikelife</title>
<style>
body 
{
	background:url('images/Wall.jpg') no-repeat;	
	background-color: #c53334;
}
.top_banner{
	background-color: white;
	height:60px;
	width:100%;
	z-index: 3;
	position: fixed;
	top: 0px;
	left: 0px;
	right: 0px;
	border-bottom: 1px solid rgba(0,0,0,0.15);

}
img{
	position: relative;
	left: 100px;
	top: 10px;
}
.text_adver{
	background-color:rgba(0, 0, 0, 0.5);
	height:160px;
	width: 700px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 20px;
	position: absolute;
	top: 100px;
	left: 100px;
	color: white;
	padding: 0px 30px 20px 50px;
	border-radius: 40px 40px 40px 40px;
}
.face_book{
	text-align: center;
	background-color:rgba(0, 0, 0, 0.5);
	height:160px;
	width: 300px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 20px;
	position: absolute;
	top: 100px;
	left: 930px;
	color: white;
	padding: 15px 20px 5px 20px;
	border-radius: 40px 40px 40px 40px;
}
</style>

<link rel="stylesheet" href="css/auth-buttons.css">

    <!-- prettyify -->
    <link rel="stylesheet" href="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.css">
    <script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>

</head>

<body>
	<div class='top_banner'><img src="images/logo_home.png"></div>
	<div class="text_adver">
	      <h3>The best experiences of life, only happen once with friends.</h3>
	      PikeLife gives you the opportunity to create small activities, gather your friends, and have everyone share pictures, documents and feedbacks of your events.
	</div>
	<div class="face_book">
	      <h3>Start Now</h3>
	      <p><a class="btn-auth btn-facebook large" href="<?= $helper->getLoginUrl($params) ?>">Sign in with <b>Facebook</b></a></p>
	      
	</div>
	<div id="fb-root"></div>

	

</body>

</html>
<?php
}
?>