<?php
$servername='localhost';
$username='root';
$password='';
$dbname='logindb';
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
    die('Couldnt Connect to the Sql Server' .mysql_error());
}