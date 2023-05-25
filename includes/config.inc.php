<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ssms";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
date_default_timezone_set("Asia/Manila");
$now = date("Y-m-d H:i:s");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}   
