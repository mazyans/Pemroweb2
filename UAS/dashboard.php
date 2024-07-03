<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';

// Fetch groups for the dropdown menu
$groups_result = $conn->query("SELECT DISTINCT group_name FROM groups");

// Fetch countries for the dropdown menu
$countries_result = $conn->query("SELECT id, name, group_name FROM countries");

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
            height: 100vh;
        }
        .dashboard-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .dashboard-container h2 {
            margin-bottom: 20px;
        }
        .dashboard-container select, .dashboard-container input, .dashboard-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .dashboard-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .dashboard-container button:hover {
            background-color: #0056b3;
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
    </script>
</body>
</html>
