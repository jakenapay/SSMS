<?php
$servername = "sql113.epizy.com";
$username = "epiz_33456032";
$password = "Gj0ObY8oc33";

// Create connection
$conn = new mysqli($servername, $username, $password);
date_default_timezone_set("Asia/Manila");
$now = date("Y-m-d H:i:s");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
