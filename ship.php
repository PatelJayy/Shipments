<?php
// URL of the API
// $apiUrl = "https://api.example.com/data";
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
            <th>Integer</th>
            <th>String</th>
            <th>Enum</th>
            <th>Date</th>
            <th>Boolean</th>
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
                echo "<td>" . htmlspecialchars($item['Integer']) . "</td>";
                echo "<td>" . htmlspecialchars($item['String']) . "</td>";
                echo "<td>" . htmlspecialchars($item['Enum']) . "</td>";
                echo "<td>" . htmlspecialchars($item['Date']) . "</td>";
                echo "<td>" . htmlspecialchars($item['Boolean']) . "</td>";
                // Add other data columns as needed
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
