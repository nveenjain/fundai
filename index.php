<?php
session_start();
?>
<?php
if(isset($_SESSION['name'])){
    header("Location:submit.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <title>fundai</title>
    <style>
        body{
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div id="login-overlay" class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" align="center">Login</h4>
            </div>
            <div class="modal-body panel-body" style="padding-top:10%;padding-bottom: 10%" >
                <div class="row">
                    <div class="col-xs-6 col-md-6 col-md-offset-3">
                        <div class="well">
                            <form id="loginForm" method="POST" action="function.php" novalidate="novalidate">
                                <div class="form-group " >
                                    <label for="username" class="control-label">Username</label>
                                    <input type="text"  class="form-control" id="username" name="username" value="" required="required" title="Please enter you username" placeholder="YYAA00****">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" required="required" title="Please enter your password">
                                    <span class="help-block"></span>
                                </div>
                                <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                                <button type="submit" class="btn btn-primary ">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#loginForm').addEventListener('submit',function(e){
            e.preventDefault();
            document.querySelector("#loginForm>button").classList.add("disabled");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if (this.readyState==4 && this.status==200) {
                        var msg = document.querySelector('#loginErrorMsg');
                    if (this.responseText=="Success") {
                        msg.classList.remove('hide');
                        msg.style.color = "green";
                        msg.innerHTML = this.responseText+", Redirecting to Submit Page";
                        window.location = "./submit.php";
                    }else{
                        msg.classList.remove('hide');
                        msg.style.color = "red";
                        msg.innerHTML = this.responseText;
                        document.querySelector("#loginForm>button").classList.remove("disabled");

                    }
                }
            };
            
            xmlhttp.open("POST","function.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("username="+document.querySelector("#username").value+"&password="+document.querySelector("#password").value);
        });
    </script>
</body>
</html>