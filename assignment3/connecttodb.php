<?php

/*
        Programmer Name: 00
        Assignment: 3
        Course: CS3319
        Date: November 25th, 2022
*/

/*
Creates database connection.
*/

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "cs3319";
$dbname = "assign2db";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno())
{
    die("Database connection failed :" . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>
