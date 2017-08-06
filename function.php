<?php
session_start();
	function login($username,$password,$pdo){
		if(preg_match("{\b[0-9]{2}(JE|MT|JR)[0-9]{6}\b}", $username) && !preg_match("*\s*", $username)){
		$q = $pdo->prepare("SELECT * FROM users WHERE username= ?");
		$q->execute([$username]);
		$data = $q->fetch();
		if($data){
			if($data[2]===md5(sha1($data[3].$password."y"))){
				echo "Success";
				$_SESSION['name']=$username;
			}else echo "Please Enter Valid Username/Password";
		}else if( $password === $username ) {
			$salt = md5(time());
			$password = md5(sha1($salt.$username."y"));
			$q = $pdo->prepare("INSERT INTO users VALUES(NULL,?,?,?)");
			$q->execute([$username,$password,$salt]);
			if ($q) {
				echo "Success";
				$_SESSION['name']=$username;
			}
		}else{
			echo "Please Enter Valid Username and Password";
		}
		}else{
			echo "Please Enter Valid Username/Password";
		}
	}
	if(isset($_POST['username']) && isset($_POST['password'])){
		include('db.php');
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";		
		$pdo = new pdo($dsn,$user,$pass);
		login($_POST['username'],$_POST['password'],$pdo);
		
	}else{
		header("index.php");
	}

	
?>