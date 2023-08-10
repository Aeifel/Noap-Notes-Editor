<?php


$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'project';

$con = mysqli_connect($servername, $username, $password, $database);

if(!$con){
    echo "Failed to connect to the server!";
    //exit();
}


