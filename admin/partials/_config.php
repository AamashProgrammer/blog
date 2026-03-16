<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$database = "blog";

$conn = mysqli_connect($server_name,$user_name,$password,$database);

if(!$conn){
    die("connection Failed");
}
?>