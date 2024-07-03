<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';

$groups_result = $conn->query("SELECT DISTINCT group_name FROM groups");

$countries_result = $conn->query("SELECT id, name, group_name FROM countries");

$results = $conn->query("SELECT r.group_name, c.name as country, r.wins, r.draws, r.losses FROM results r JOIN countries c ON r.country_id = c.id");

$username = $_SESSION['username']; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            margin-top: 200px;
        }
        .dashboard-container, .results-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-bottom: 20px;
        }
        .dashboard-container h2, .results-container h2 {
            margin-bottom: 20px;
        }
        .dashboard-container select, .dashboard-container input, .dashboard-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .dashboard-container button, .results-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .dashboard-container button:hover, .results-container button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .print-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .print-header h2 {
            margin: 0;
        }
        .print-header p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Input Team Data</h2>
        <form method="post" action="input.php">
            Group: 
            <select name="group" id="groupDropdown" onchange="filterCountries()">
                <option value="">Select Group</option>
                <?php
                while ($group = $groups_result->fetch_assoc()) {
                    echo "<option value='".$group['group_name']."'>".$group['group_name']."</option>";
                }
                ?>
            </select><br>
            
            Country: 
            <select name="country" id="countryDropdown">
                <option value="">Select Country</option>
                <?php
                while ($country = $countries_result->fetch_assoc()) {
                    echo "<option value='".$country['id']."' data-group='".$country['group_name']."'>".$country['name']."</option>";
                }
                ?>
            </select><br>
            
            Wins: <input type="number" name="wins" required><br>
            Draws: <input type="number" name="draws" required><br>
            Losses: <input type="number" name="losses" required><br>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="results-container">
        <h2>Results</h2>
        <div id="printSection">
            <div class="print-header">
                <h2>Group Results</h2>
                <p id="currentDateTime"></p>
                <p>User: <?php echo $username; ?></p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Group</th>
                        <th>Country</th>
                        <th>Wins</th>
                        <th>Draws</th>
                        <th>Losses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = $results->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$result['group_name']."</td>";
                        echo "<td>".$result['country']."</td>";
                        echo "<td>".$result['wins']."</td>";
                        echo "<td>".$result['draws']."</td>";
                        echo "<td>".$result['losses']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button onclick="printToPDF()">Print to PDF</button>
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>

    <script>
        function filterCountries() {
            var groupDropdown = document.getElementById('groupDropdown');
            var countryDropdown = document.getElementById('countryDropdown');
            var selectedGroup = groupDropdown.value;

            for (var i = 0; i < countryDropdown.options.length; i++) {
                var option = countryDropdown.options[i];
                if (option.getAttribute('data-group') === selectedGroup || option.value === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            }
        }

        function printToPDF() {
            // Set current date and time
            var currentDateTime = new Date();
            document.getElementById('currentDateTime').innerText = currentDateTime.toLocaleString();

            var printContents = document.getElementById('printSection').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
</body>
</html>
