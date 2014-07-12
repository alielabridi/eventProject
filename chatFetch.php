<?php

require_once('connect.php');

$query = $connect->query("

SELECT U1.user_username, chat.user_message
FROM chat
JOIN userapps U1 ON U1.user_id = chat.chat_user_sender
JOIN userapps U2 ON U2.user_id = chat.chat_user_receiver


ORDER BY chat_date Asc

");

while($chat = $query->fetch()){
	?>
		<li ><img alt='' src='http://1.gravatar.com/avatar/5bea567fcf9dd1022d9224e07bf194a5?s=50&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite><?php echo $chat['user_username']; ?>:</cite> <em>2013-04-29 08:41:31</em> <a href="http://localhost/GreatBox/?p=213#comment-9" title="Nguyen Duc on Praesent Et Urna Turpis Sadips">You are right, that's an oversight on my part. Using ...</a></p><div class="clear"></div></li>
		<a href='#'><?php echo $chat['user_username']; ?></a>
		<p><?php echo $row['user_message']; ?></p>

	<?php
}

?>