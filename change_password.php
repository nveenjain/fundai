<?php
    session_start();
    if(isset($_SESSION['name'])){
        if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['con_new_password']) && strlen($_POST['new_password'])>=8){
            if($_POST['con_new_password']===$_POST['new_password']){
                require('db.php');
                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";      
                $pdo = new pdo($dsn,$user,$pass);
                $q = $pdo->prepare("SELECT username,password,salt FROM `users` WHERE username=:uid");
                $q->bindParam(":uid",$_SESSION['name']);
                $q->execute();
                if($q->rowCount()){
                    $data = $q->fetch();
                    
                     if($data[1]===md5(sha1($data[2].$_POST["old_password"]."y"))){
                        $new = md5(sha1($data[2].$_POST["new_password"]."y"));
                        $nq = $pdo->prepare("UPDATE `users` SET `password`=? WHERE `username`=?");
                        $nq->bindParam(1,$new);
                        $nq->bindParam(2,$_SESSION['name']);
                        $nq->execute();
                        if($nq->rowCount()){
                            $error = "<h3 style='color:green'>Successfully Changed the Password</h3>";
                        }else{
                            $error = "<h3>Some error occurred</h3>";
                            
                        }
                     }
                }
            }else{
                $error="<h3>Password you entered did not match</h3>";
            }
        }else{$error = "<h3 style='color:red'>Please Enter all the fields and the new password must be greated than 8 characters</h3>";}
    }else header("Location:index.php");

?><!DOCTYPE html>
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
            padding-top: 2%;
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
                    <a class="btn btn-info" id="goto_submit" href="submit.php" data-whatever="@mdo">
                        <strong>Home</strong>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right navtabbar ">
                <li >
                    <a  href="#" class="btn btn-info ">
                        <strong>Change Password</strong>
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
                                <input type="password"  class="form-control" id="old_password" name="old_password" value="" required="required" title="Please enter you Old Password">
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
                            <div id="loginErrorMsg" class="alert alert-error"><?php echo $error; ?></div>
                            <button type="submit" class="btn btn-primary ">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer start here-->

<footer>
    <div class="container">
        <div class="row ">
            <div class="footer-col col-md-6">
                <h1>Locate Us</h1>
                <ul class="social-networks">
                    <li><a href="#" onclick="newPopup('https://www.facebook.com/')" title="CSES">
                        <i class="icon-circled icon-bgdark icon-dribbble icon-2x fa fa-fw fa-facebook"></i></a></li>
                    <li>
                        <a href="#" onclick="newPopup('http://share.here.com/r/mylocation/e-eyJuYW1lIjoiQ29tcHV0ZXIgU2NpZW5jZSBhbmQgRW5naW5lZXJpbmcgU29jaWV0eSIsImFkZHJlc3MiOiJDb21wdXRlciBTY2llbmNlICYgRW5naW5lZXJpbmcgRGVwYXJ0bWVudCwgSW5kaWFuIFNjaG9vbCBPZiBNaW5lcywgRGhhbmJhZCIsImxhdGl0dWRlIjoyMy44MTUxOCwibG9uZ2l0dWRlIjo4Ni40NDA0OCwicHJvdmlkZXJOYW1lIjoiZmFjZWJvb2siLCJwcm92aWRlcklkIjoxNDUyOTYzMTg0OTY5MjU0fQ==?link=directions&fb_locale=en_US&ref=facebooke')" class="btn-social btn-outline">
                            <i class="icon-circled icon-bgdark icon-twitter icon-2x fa fa-fw fa-map-marker"></i></a>
                    </li>
                </ul>
            </div>
            <div class="footer-col col-md-6">
                <p class="copyright">
                <div class="credits">
                    <a href="" onclick="newPopup('http://csesociety.in/')" >CSE Society</a>
                </div>
                &copy; IIT(ISM) Dhanbad<br>
                Computer Science & Engineering<br>
                Technological Avenue<br>
                IIT (ISM) ,Dhanbad, Jharkhand 82600

                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>