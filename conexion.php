<?php

//echo $seconecto;
$host = "localhost";
$user = "root";
$pass = ""; //Baiz4pl.123
$dbname = "pyainventarios";

try{
	$db = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
	//echo "Conecto bien!";
}catch(Exception $e){
	die('Error:'.$e->GetMessage());
}

//$db2 = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);


?>