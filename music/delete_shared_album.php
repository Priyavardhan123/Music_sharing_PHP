<?php
try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
    
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="delete from Shared_Albums where album_title='$_GET[album]' and Reciever='$_GET[reciever]'";
    $query=$dbhandler->query($sql);
    header("Location:/music/albums.php?username=$_GET[username]");
}
catch(PDOException $e){
	echo $e->getMessage();
	die();
}
?>