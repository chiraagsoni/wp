<?php
include 'include/connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['msg'];
$q1=$_POST['q1'];
$q2=$_POST['q2'];
$q3=$_POST['q3'];
$q4=$_POST['q4'];

mysql_query("INSERT INTO artisans_feed(`Id`,`Name`,`Email`,`Message`) VALUES(NULL,'$name','$email','$msg')") 
		or die(mysql_error());
header('Location: index.html');

?>