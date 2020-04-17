<?php
    session_start();
    if( !isset($_SESSION['username']) )
        header("Location:/users/login.php");
    try{
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
    
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query=$dbhandler->query('select * from Albums');
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
    <title>Add Song to <?php
                    if ( isset($_GET['album']))
                        echo "$_GET[album]"; 
                    // else
                        // header("Location:/users/login.php");
                ?>
    </title>    
    <link rel="shortcut icon" type="image/png" href="/static/favicon.ico"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/static/music/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="/static/music/js/main.js"></script>
    <style>
        body {
          background-image: url("images/background.jpg");
          background-size: cover;
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
                <li class="active"><a href="/music/albums.php?username=<?php echo $_GET['username'] ?>"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp; Albums</a></li>
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

<div class="container-fluid">

    <div class="row">

        <!-- Left Album Info -->
        <div class="col-sm-4 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                <h1>
                        <?php
                            echo $_GET['album'];
                        ?>    
                        <small>
                            <?php
                                while($r=$query->fetch(PDO::FETCH_ASSOC))
                                {
                                    if ( $r['album_title'] == $_GET['album'] )
                                    {
                                        echo $r['genre']; 
                                    }
                                }
                            ?>
                        </small>
                    </h1>
                    <h2>
                        <?php
                            $query=$dbhandler->query('select * from Albums');
                            while($r=$query->fetch(PDO::FETCH_ASSOC))
                            {
                                if ( $r['album_title'] == $_GET['album'] )
                                {
                                    echo $r['artist']; 
                                }
                            }
                        ?>
                    </h2>
                </div>
            </div>
        </div>

        <!-- Right Song Info -->
        <div class="col-sm-8 col-md-9">

            <ul class="nav nav-pills" style="margin-bottom: 10px;">
                <li role="presentation"><a href="/music/songs.php?username=<?php echo $_GET['username']?>&album=<?php echo $_GET['album']?>">View All</a></li>
                <li role="presentation" class="active"><a href="#">Add New Song</a></li>
            </ul>

            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Add a New Song</h3>
                    
                    <form class="form-horizontal" action="upload.php" method="post">
                        
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <span class="text-danger small"></span>
                        </div>
                        <label class="control-label col-sm-2" for="song_title"><label for="id_song_title">Song title:</label></label>
                        <div class="col-sm-10"><input type="text" name="song_title" maxlength="250" required id="id_song_title"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <span class="text-danger small"></span>
                        </div>
                        <label class="control-label col-sm-2" for="song_title"><label for="id_audio_file">Audio file:</label></label>
                        <div class="col-sm-10"><input type="file" name="audio_file" id="audio_file" required></div>
                    </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input class="btn btn-success" type="submit" name="submit" value="submit"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
