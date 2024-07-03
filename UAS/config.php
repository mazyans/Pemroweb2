<?php
$servername = "localhost";
$username = "root";
$password = ""; // update this with your MySQL password
$dbname = "uefa2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
