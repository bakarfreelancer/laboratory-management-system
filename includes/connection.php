<?php
$host = 'localhost';
$dbname = 'lab';
$username = 'root';
$password = 'root'; //change this to ''

$conn = mysqli_connect($host, $username, $password, $dbname);
ob_start();
session_start();

?>