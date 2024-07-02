<?php
include 'koneksi.php';

// Ambil nilai dari form
$country_id = $_POST['country'];
$win = $_POST['menang'];
$draw = $_POST['seri'];
$loss = $_POST['kalah'];
$points = $_POST['point'];

// Contoh: $group_id harus disesuaikan dengan cara Anda menyimpan atau mengelola group_id dari form HTML Anda
$group_id = 1; // Contoh: ganti dengan cara Anda mendapatkan group_id dari form HTML Anda

// Query untuk menyimpan data ke dalam tabel group_country
$query = "INSERT INTO group_results (group_id, country_id, win, draw, loss, points)
          VALUES ('$group_id', '$country_id', '$win', '$draw', '$loss', '$points')";

// Lakukan query
if ($koneksi->query($query) === TRUE) {
    echo "Data berhasil disimpan.";
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

// Tutup koneksi ke database
$koneksi->close();
?>
