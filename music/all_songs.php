<?php
session_start();
if( !isset($_SESSION['username']) )
    header("Location:/users/login.php");
    try{
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=phpmyadmin','phpmyadmin','pkp010900');
    
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
    <link rel="stylesheet" type="text/css" href="/static/music/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="/static/music/js/main.js"></script>

    <style>
        body {
          background-image: url("images/background.jpg");
          background-size: contain;
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
                <li class=""><a href="/music/albums.php?username=<?php echo $_GET['username']?>"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp; Albums</a></li>
                <li class="active"><a href="#"><span class="glyphicon glyphicon-music" aria-hidden="true"></span>&nbsp; Songs</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/music/follow_user.php?username=<?php echo $_SESSION['username'] ?>">
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>&nbsp; Follow Users
                    </a>
                </li>
                <li>
                    <a href="/music/my_profile.php?username=<?php echo $_SESSION['username'] ?>">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; My Profile
                    </a>
                </li>  
                <li>
                    <a href="/users/logout.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp; Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<div class="col-sm-8 col-md-7">



<div class="panel panel-default">
    <div class="panel-body">

        <h3>All Songs</h3>

        

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Audio File</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
            <?php
                try{
                    $query=$dbhandler->query('select * from Songs natural join Users');
                    
                    while($r=$query->fetch(PDO::FETCH_ASSOC))
                    {
                        if ( $r['username'] == $_GET['username'] )
                        {
                            echo "<tr>";
                            echo "<td>", $r['song_title'],"<br></td>"; 
                            echo "<td><audio controls>
                                        <source src='/music/uploads/$r[audio_file]' type='audio/mpeg'>",".mp3</audio><br></td>";
                            
                        }
                        
                    }
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    die();
                }
            ?>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

</div>
</body>
</html>