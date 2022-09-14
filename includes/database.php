<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'todo_list';

//database connection
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
//check if database is working
if(!$conn){
    die('Database connection failed');

}
?>