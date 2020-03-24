
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    
    <link rel="shortcut icon" type="image/png" href="/static/favicon.ico"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
                <li class="active"><a href="/users/register.php">Register</a></li>
                <li class=""><a href="/users/login.php">Log In</a></li>
            </ul>
        </div>

    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Register for an Account</h3>
                    
        <form class="form-horizontal" role="form" action="register_user.php" method="post">
                        
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <span class="text-danger small"></span>
                </div>
                <label class="control-label col-sm-3" for="song_title"><label for="id_username">Username:</label></label>
                <div class="col-sm-9"><input type="text" name="username" maxlength="150" required id="id_username"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <span class="text-danger small"></span>
                </div>
                <label class="control-label col-sm-3" for="song_title"><label for="id_email">Email address:</label></label>
                <div class="col-sm-9"><input type="email" name="email" maxlength="254" id="id_email"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <span class="text-danger small"></span>
                </div>
                <label class="control-label col-sm-3" for="song_title"><label for="id_password">Password:</label></label>
                <div class="col-sm-9"><input type="password" name="password" required id="id_password"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
            </div>
            <div class="panel-footer">
                Already have an account? <a href="/users/login.php">Click here</a> to log in.
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>
