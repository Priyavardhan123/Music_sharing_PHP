<?php
    $valid = "";
    if ( isset ($_GET['valid']) )
    {
        if ( $_GET['valid']==0 )
            $valid = "invalid";
        else 
            $valid = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    
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
                <li class=""><a href="/users/register.php/">Register</a></li>
                <li class="active"><a href="/users/login.php/">Log In</a></li>
            </ul>
        </div>

    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Log In</h3>
                        <?php
                            echo '<font color="red">',$valid,'</font>';
                        ?>
                    <form class="form-horizontal" role="form" action="/users/login_user.php/" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrfmiddlewaretoken" value="3Yl8QuvOChuPGip2fHK4LHmaEuF0wKZ9Zl41nlVv8TunlG2yLCkfwwmH5tSjpEKF">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_username">
                                Username:
                            </label>
                            <div class="col-sm-10">
                                <input id="id_username" maxlength="30" name="username" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_password">
                                Password:
                            </label>
                            <div class="col-sm-10">
                                <input id="id_password" maxlength="30" name="password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Submit</button>
                                &nbsp;&nbsp;&nbsp;
                                <!-- <a href="/password-reset.php/">Forgot Password?</a> -->
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    Don't have an account? <a href="/users/register.php/">Click here</a> to register.
                </div>
            </div>
        </div>
    </div>

</div>


</body>
</html>
