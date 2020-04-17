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
                <li class=""><a href="/music/albums.php?username=<?php echo $_GET['username']?>"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp; Albums</a></li>
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

<div class="col-sm-6 col-md-5">

<div class="panel panel-default">
    <div class="panel-body">

        <table  class="table">
            <thead>
            <tr>
                <th>
                <h3>Users</h3>
                </th>
                <th>
                <nav class="navbar navbar-light bg-light justify-content-between">   
                <th>
                    <form action="search.php?username=<?php echo $_GET[username]; ?>&album=<?php echo $_GET[album]; ?>" method="post" class="form-inline" style="text-align:right;">
                        <input name="search_string" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </th>
                </nav>
                </th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan=3>
                <?php
                    try{
                        
                        $sql=$dbhandler->query("select username from Users WHERE username NOT IN (select Reciever from Shared_Albums WHERE album_title='$_GET[album]') and username LIKE '%$_POST[search_string]%'");
                        
                        echo "<form action='share.php?owner=$_GET[username]&album=$_GET[album]' method='post'>";
                        while($r=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                            if ( $r['username'] != $_GET['username'] )
                            {
                                echo "<tr>";
                                echo "<td colspan=3><input type='checkbox' name='$r[username]' value='share'> " . $r['username'] .  '</br></td>';
                                echo "</tr>";
                            }
                        }
                        echo "<td><input class='btn btn-info' type='submit' name='submit' value='Share'/></td></form>";
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

        <table  class="table">
            <thead>
            <tr>
                <th>
                <h3>Shared Users</h3>
                </th>
                
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan=3>
                <?php
                    try{
                        
                        $sql=$dbhandler->query("select username from Users WHERE username IN (select Reciever from Shared_Albums WHERE album_title='$_GET[album]') and username LIKE '%$_POST[search_string]%'");

                        echo "<form method='post' action='delete_shared_album.php?username=$_GET[username]&album=$_GET[album]'>";
                        $rows=0;
                        while($r=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                            if ( $r['username'] != $_GET['username'] )   
                            {
                                echo "<tr>";
                                echo "<td colspan=3><input type='checkbox' name='$r[username]' value='unshare'> " . $r['username'] .  '</br></td>';
                                echo "</tr>";
                            }
                        }
                        echo "<td><input class='btn btn-info' type='submit' name='submit' value='Unshare'/></td></form>";
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