<?php
$con1 = mysqli_connect('localhost', 'root', '');
$con = mysqli_connect("localhost", "root", "", "content_linkage");
mysqli_set_charset($con, 'utf8');

mysqli_connect('localhost', 'root', '') or die(mysqli_error());
mysqli_select_db($con, 'content_linkage') or die(mysqli_error());

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "content_linkage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
?>

