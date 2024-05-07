<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasemen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Input Data Pertandingan</h2>
    <form action="submit.php" method="POST">
        <label for="nama">Nama Negara:</label>
        <select name="nama" id="nama">
            <option value="Korea Selatan U-23">Korea Selatan U-23</option>
            <option value="Jepang U-23">Jepang U-23</option>
            <option value="Tiongkok U-23">Tiongkok U-23</option>
            <option value="Uni Emirat Arab U-23">Uni Emirat Arab U-23</option>
        </select><br>
        <label for="pertandingan">Jumlah Pertandingan:</label>
        <input type="number" name="pertandingan" id="pertandingan" required><br>
        <label for="menang">Jumlah Menang:</label>
        <input type="number" name="menang" id="menang" required><br>
        <label for="seri">Jumlah Seri:</label>
        <input type="number" name="seri" id="seri" required><br>
        <label for="kalah">Jumlah Kalah:</label>
        <input type="number" name="kalah" id="kalah" required><br>
        <label for="operator">Nama Operator:</label>
        <input type="text" name="operator" id="operator" required><br>
        <label for="nim">NIM Mahasiswa:</label>
        <input type="text" name="nim" id="nim" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
