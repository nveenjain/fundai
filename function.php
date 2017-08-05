<?php
error_reporting(E_ALL);
session_start();
require('db.php');
if(($_SERVER["REQUEST_URI"])=='/fundai/fundai/function.php'){
	header("Location:index.php");
}
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new pdo($dsn,$user,$pass);
	
	$username = '16JE002342';
	$password = '16JE002343';
	login($username,$password,$pdo);
	function login($username,$password,$pdo){
		if(preg_match("{\b[0-9]{2}(JE|MT|JR)[0-9]{6}\b}", $username) && !preg_match("*\s*", $username)){
		}else{
			echo "Please Enter Valid Username/Password";
			return 0;
		}
		$q = $pdo->prepare("SELECT * FROM users WHERE username= ?");
		$q->execute([$username]);
		$data = $q->fetch();
		if($data){
			if($data[2]===md5(sha1($data[3].$password."y"))){
				echo "Success";
				$session['name']=$username;
			}else echo "Please Enter Valid Username/Password";
		}else if( $password === $username ) {
			$salt = md5(time());
			$password = md5(sha1($salt.$username."y"));
			$q = $pdo->prepare("INSERT INTO users VALUES(NULL,?,?,?)");
			$q->execute([$username,$password,$salt]);
			if ($q) {
				echo "Done";
				$session['name']=$username;
			}
		}else{
			echo "Please Enter Valid Username and Password";
		}
	}
	
?>