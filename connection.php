<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "cattle_farm_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname))
{
    die("failed to connect !");
}