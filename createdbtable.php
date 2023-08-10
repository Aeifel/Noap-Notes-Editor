<?php

session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'project';
$table = 'data';

// to establish a connection first
$con = mysqli_connect($servername, $username, $password);

if(!$con){
    echo "Oops! Connection could not be made!<br>";
    echo "Error: ".mysqli_connect_error();
} else {
    echo " Connection created successfully!<br>";
}

// to create a database 
$sql1 = "CREATE DATABASE $database";
$db = mysqli_query($con, $sql1);

if(!$db){
    echo "Oops! Database could not be created!<br>";
    echo "Error: ".mysqli_error($con)."<br>";
} else {
    echo "Database created Successfully!<br>";
}

// to establish a connection to the database
$con2 = mysqli_connect($servername, $username, $password, $database);
if(!$con2){
    echo "<p color = 'red'>Oops! Connection to the database could not be made!<br></p>";
    echo "<p>Error: ".mysqli_connect_error()."</p><br>";
} else {
    echo " Connection to the database created successfully!<br>";
}

// to create a table
$sql2 = "CREATE TABLE project.data ( ID INT(11) NOT NULL AUTO_INCREMENT , Title VARCHAR(255) NOT NULL ,
Content TEXT NOT NULL , Date_Created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , Date_Edited 
TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (ID), UNIQUE (Title))
 ENGINE = InnoDB;";

$tb = mysqli_query($con2, $sql2);

if(!$tb){
    echo "Oops! Table could not be created!<br>";
    echo "Error: ".mysqli_error($con2)."<br>";
} else {
    echo "Table created Successfully!<br>";
}

$sql3 = "ALTER TABLE data ADD Font VARCHAR(11) NOT NULL AFTER Date_Edited, ADD Size VARCHAR(11) NOT NULL AFTER Font;";

$tbedit = mysqli_query($con2, $sql3);

if(!$tb){
    echo "Oops! Table could not be edited!<br>";
    echo "Error: ".mysqli_error($con2)."<br>";
} else {
    echo "Table edited Successfully!<br>";
}

// link to index.php
echo "<a href = './Project ALmost Completed/index.php'>Click here to go to index";
?>

    