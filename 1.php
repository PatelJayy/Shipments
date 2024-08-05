<?php
// URL of the API
$apiUrl = "https://run.mocky.io/v3/69f60a58-3a36-48c5-a9cf-b100b015950c";

// Fetch data from the API
$response = file_get_contents($apiUrl);

// Check if the response is not false
if ($response === FALSE) {
    die('Error occurred');
}

// Decode JSON data into PHP array
$data = json_decode($response, true);

// Check if json_decode succeeded
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Data Table</h2>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>age</th>
            <th>role</th>
            <th>hireDate</th>
            <th>isActive</th>
            <th>salary</th>
            <th>department</th>
            <th>projectsCompleted</th>
            <th>lastLogin</th>
            <th>accessLevel</th>
            <!-- Add other headers as needed -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if data is an array
        if (is_array($data)) {
            // Iterate over the data and create table rows
            foreach ($data as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                echo "<td>" . htmlspecialchars($item['name']) . "</td>";
                echo "<td>" . htmlspecialchars($item['age']) . "</td>";
                echo "<td>" . htmlspecialchars($item['role']) . "</td>";
                echo "<td>" . htmlspecialchars($item['hireDate']) . "</td>";
                echo "<td>" . htmlspecialchars($item['isActive']) . "</td>";
                echo "<td>" . htmlspecialchars($item['salary']) . "</td>";
                echo "<td>" . htmlspecialchars($item['department']) . "</td>";
                echo "<td>" . htmlspecialchars($item['projectsCompleted']) . "</td>";
                echo "<td>" . htmlspecialchars($item['lastLogin']) . "</td>";
                echo "<td>" . htmlspecialchars($item['accessLevel']) . "</td>";
                // Add other data columns as needed
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
