<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBname = "loginsys";

$mysqli = mysqli_connect($servername, $dBUsername, $dBPassword, $dBname);

if(!$mysqli){
    die("Connection Failed: ".mysqli_connect_error());
}
