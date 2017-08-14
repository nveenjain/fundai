<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>FUNDAI</title>
    <style>
        h1{
            text-align: center;
        }
        body {
            background-color: #A5A5A2;
        }
    </style>
</head>
<body>
<header>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" id="navtabs" data-toggle="collapse" data-target="#navtab" data-whatever="@mdo">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navtab">
            <ul class="nav navbar-nav navbar-left">
                <li >
                    <a class="btn btn-info" id="goto_submit"  data-whatever="@mdo">
                        <strong>Go To Submit Page</strong>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right navtabbar ">
                <li >
                    <a  href="#" class="btn btn-info ">
                        <strong>Students name</strong>
                    </a>
                </li>
                <li >
                    <a href="./logout.php" class="btn btn-danger navbar-right">
                        <strong>Log out</strong>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
<div id="login-overlay" class="modal-dialog" >
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="ch_pass_form" align="center">Change Password</h4>
        </div>
        <div class="modal-body panel-body" style="padding-top:10%;padding-bottom: 10%" >
            <div class="row">
                <div class="col-xs-8 col-md-8 col-md-offset-2">
                    <div class="well">
                        <form id="loginForm" method="POST" action="" novalidate="novalidate">
                            <div class="form-group " >
                                <label for="old_password" class="control-label">Old Password</label>
                                <input type="password"  class="form-control" id="old_password" name="old_password" value="" required="required" title="Please enter you Old Password" placeholder="YYAA00****">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="control-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" value="" required="required" title="Please enter your New Password">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="con_new_password" class="control-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="con_new_password" name="con_new_password" value="" required="required" title="Please confirm your New Password">
                                <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                            <button type="submit" class="btn btn-primary ">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>