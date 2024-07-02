<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Grup UEFA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Input Data Group UEFA</h1>

        <!-- Tabel Data Group A -->
        <h2 class="mt-5">Data Group A</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Group</th>
                    <th>Negara</th>
                    <th>Menang</th>
                    <th>Seri</th>
                    <th>Kalah</th>
                    <th>Point</th>
                </tr>
            </thead>
            <tbody>
    <?php
    include 'koneksi.php';

    $group_name = isset($_GET['group']) ? $_GET['group'] : 'A';

    // Query untuk mendapatkan data dari Group yang dipilih
    $result_data = $koneksi->query("SELECT g.group_name, c.country_name, gr.win, gr.draw, gr.loss, gr.points
                                    FROM group_results gr
                                    LEFT JOIN groups g ON gr.group_id = g.group_id
                                    LEFT JOIN countries c ON gr.country_id = c.country_id
                                    WHERE g.group_name = '$group_name'");

    // Memeriksa apakah query berhasil dieksekusi
    if ($result_data && $result_data->num_rows > 0) {
        // Menampilkan data dengan fetch_assoc() jika query berhasil
        while ($row = $result_data->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['group_name'] . "</td>";
            echo "<td>" . $row['country_name'] . "</td>";
            echo "<td>" . $row['win'] . "</td>";
            echo "<td>" . $row['draw'] . "</td>";
            echo "<td>" . $row['loss'] . "</td>";
            echo "<td>" . $row['points'] . "</td>";
            echo "<td><input type='checkbox' name='print_check[]' value='" . $row['country_name'] . "'></td>";
            echo "</tr>";
        }
    } else {
        // Menampilkan pesan jika query tidak mengembalikan hasil
        echo "<tr><td colspan='7'>Tidak ada data untuk grup $group_name.</td></tr>";
    }

    // Menutup koneksi ke database
    $koneksi->close();
    ?>
</tbody>

        </table>

        <!-- Form Input Data -->
        <h2 class="mt-5">Tambah Data</h2>
        <form action="save_data.php" method="post">
            <div class="mb-3">
                <label for="group">Pilih Grup:</label>
                <select id="group" name="group" class="form-select">
                    <option value="A">Grup A</option>
                    <option value="B">Grup B</option>
                    <option value="C">Grup C</option>
                    <option value="D">Grup D</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="country">Pilih Negara:</label>
                <select id="country" name="country" class="form-select">
                    <!-- Options dari basis data negara -->
                    <?php
                    include 'koneksi.php';

                    // Query untuk mendapatkan data negara
                    $result_countries = $koneksi->query("SELECT * FROM countries");

                    // Memeriksa apakah query berhasil dieksekusi
                    if ($result_countries && $result_countries->num_rows > 0) {
                        // Menampilkan opsi negara dalam bentuk dropdown
                        while ($row = $result_countries->fetch_assoc()) {
                            echo "<option value='" . $row['country_id'] . "'>" . $row['country_name'] . "</option>";
                        }
                    } else {
                        // Menampilkan pesan error jika query negara tidak mengembalikan hasil
                        echo "<option value=''>Tidak ada negara tersedia.</option>";
                    }

                    // Menutup koneksi ke database
                    $koneksi->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="menang">Menang:</label>
                <input type="text" id="menang" name="menang" class="form-control">
            </div>
            <div class="mb-3">
                <label for="seri">Seri:</label>
                <input type="text" id="seri" name="seri" class="form-control">
            </div>
            <div class="mb-3">
                <label for="kalah">Kalah:</label>
                <input type="text" id="kalah" name="kalah" class="form-control">
            </div>
            <div class="mb-3">
                <label for="point">Point:</label>
                <input type="text" id="point" name="point" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
