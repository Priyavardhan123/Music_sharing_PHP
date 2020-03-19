<?php
try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
	echo "Connection is established...<br/>";
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="insert into Albums (username,artist,album_title,genre) values ( '$_GET[username]','$_POST[artist]','$_POST[album_title]','$_POST[genre]')";
	$query=$dbhandler->query($sql);
    header("Location:/music/albums.php?username=$_GET[username]");
	
}
catch(PDOException $e){
	echo $e->getMessage();
	die();
}


?>