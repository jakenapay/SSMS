<?php
$servername = "sql113.epizy.com";
$username = "epiz_33456032";
$password = "Gj0ObY8oc33";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
