<?php
// proses_login.php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($query);
    
    if ($result->num_rows == 1) {
    
        echo "Login berhasil!";

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Username atau password salah.";
    }
}
?>
