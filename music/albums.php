<?php
session_start();
if( !isset($_SESSION['username']) )
    header("Location:/users/login.php");
try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');

    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	// $sql="create table Albums ( 
    //     username VARCHAR(30),
    //     artist VARCHAR(230),
    //     album_title VARCHAR(250),
    //     genre VARCHAR(100),
    //     is_favorite BOOLEAN,
    //     FOREIGN KEY (username) REFERENCES Users(username)
    //     )";
	// $query=$dbhandler->query($sql);
    // echo "Table is created successfully";
}
catch(PDOException $e){
	echo $e->getMessage();
	die();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My music</title>
    
    <link rel="shortcut icon" type="image/png" href="/static/favicon.ico"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
    <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet">
    <link rel="stylesheet" type="text/css" href="/static/music/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="/static/music/js/main.js"></script>

    <style>
        body {
          background-image: url("images/background.jpg");
          background-size: cover;
        }
        .material-icons{
            display: inline-flex;
            vertical-align: bottom;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">

        <!-- Header -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/users/login.php">My music</a>
        </div>

        <!-- Items -->
        <div class="collapse navbar-collapse" id="topNavBar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp; Albums</a></li>
                <li class=""><a href="/music/all_songs.php?username=<?php echo $_GET['username']?>"><span class="glyphicon glyphicon-music" aria-hidden="true"></span>&nbsp; Songs</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/users/logout.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp; Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<div class="albums-container container-fluid">

    <!-- Albums -->
    <div class="row">
        <div class="col-sm-12">
            <h3><?php 
                    if ( isset($_GET['username']) )    
                        echo $_GET['username']; 
                    else
                        header("Location:/users/login.php");
                ?>'s Albums</h3>
        </div>
    
        <!-- Fetch albums -->
        <?php

            try{
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
            
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query=$dbhandler->query('select * from Albums');
                
                while($r=$query->fetch(PDO::FETCH_ASSOC))
                {
                    if ( $r['username'] == $_GET['username'] )
                    {
                        echo "<div class='col-sm-2' style='font-size: 10px'>";
                        if ( $r[is_private]==1 )
                            echo "<pre><i class = 'material-icons'>lock</i>";
                        else if ( $r[is_private]==0 )
                            echo "<pre><i class = 'material-icons'>group</i>";
                        echo "<h3>",$r['album_title'],"</h3>",$r['artist'],"<br>",$r['genre'],"<br>",
                        "<h4><i class = 'material-icons'>remove_red_eye</i> <a href='/music/songs.php?username=",$_GET['username'],"&album=",$r['album_title'],"'>View Album</a></h4>",
                        "<h4><i class = 'material-icons'>delete</i> <a href='/music/delete_album.php?username=",$_GET['username'],"&album=",$r['album_title'],"'>Delete Album</a></h4>",
                        "<h4><i class = 'material-icons'>share</i> <a href='/music/all_users.php?username=",$_GET['username'],"&album=",$r['album_title'],"'>Share Album</a></h4>",
                        "</pre>"; 
                        echo "</div>";
                    }
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }

        ?>

        <div class="col-sm-12">
            <br>
            <a href="/music/add_album.php?username=<?php echo $_GET['username'] ?>">
                <button type="button" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp; Add an Album
                </button>
            </a>
        </div>
        
    </div>
    <hr>
    <!-- Shared albums -->
    <div class="row">
        <div class="col-sm-12">
            <h3>Recieved Albums</h3>
        </div>
    
        <!-- Fetch recieved albums -->
        <div class="col-sm-12" style="font-size: 10px">
        <?php

            try{
                $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
            
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query=$dbhandler->query('select * from Albums natural join Shared_Albums');
                
                while($r=$query->fetch(PDO::FETCH_ASSOC))
                {
                    
                    if ( $r['Reciever'] == $_GET['username'] )
                    {
                        echo "<div class='col-sm-2' style='font-size: 10px'>";
                        echo "<pre><h3>",$r['album_title'],"</h3>",$r['artist'],"<br>",$r['genre'],"<br>",
                        "<h4><i class = 'material-icons'>remove_red_eye</i> <a href='/music/songs.php?username=",$_GET['username'],"&reciever=",$r['Reciever'],"&album=",$r['album_title'],"'>View Album</a></h4>",
                        "<h4><i class = 'material-icons'>remove_red_eye</i> <a href='/music/delete_shared_album.php?username=",$_GET['username'],"&reciever=",$r['Reciever'],"&album=",$r['album_title'],"'>Remove Album</a></h4>",
                        "<h4>Shared by: $r[Owner]</h4>",
                        "</pre>"; 
                        echo "</div>";
                    }
                   
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }

        ?>
        
    </div>    

</div>

</body>
</html>


