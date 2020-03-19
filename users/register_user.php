<?php
try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
	echo "Connection is established...<br/>";
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="insert into Users (username,password,email) values ( '$_POST[username]','$_POST[password]','$_POST[email]')";
	$query=$dbhandler->query($sql);
    echo "Data is inserted successfully";
    header("Location:/music/albums.php?username=$_POST[username]");

	
}
catch(PDOException $e){
	echo $e->getMessage();
	die();
}


?>