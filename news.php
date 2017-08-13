<?php
session_start();
if(isset($_SESSION['name'])){
	header("Content-type:application/json");
	require('db.php');
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";		
$dbn = new pdo($dsn,$user,$pass);
$row=$dbn->query("SELECT * FROM `group`");  
// $row->execute();//execute the query  
$json_data= Array();//create the array  
$json_data["data"] = $row->fetchAll(PDO::FETCH_NUM); 
//built in PHP function to encode the data in to JSON format
echo json_encode($json_data);
}else{
	header("Location:index.php");
}
?>