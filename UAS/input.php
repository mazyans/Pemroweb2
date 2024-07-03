<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country_id = $_POST['country'];
    $wins = $_POST['wins'];
    $draws = $_POST['draws'];
    $losses = $_POST['losses'];
    $points = ($wins * 3) + ($draws * 1);

    $sql = "INSERT INTO results (country_id, wins, draws, losses, points) VALUES ($country_id, $wins, $draws, $losses, $points)";
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Team Data</title>
</head>
<body>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
