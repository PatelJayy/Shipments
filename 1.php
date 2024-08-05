<?php
// Database connection settings
$hostname = "localhost:3307";
  $username = "root";
  $password = "";
  $dbname = "ship";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT id, name, age, role, hireDate, isActive, salary, department, projectsCompleted, lastLogin, accessLevel FROM employees";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Role</th>
            <th>Hire Date</th>
            <th>Active</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Projects Completed</th>
            <th>Last Login</th>
            <th>Access Level</th>
          </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["age"] . "</td>
                <td>" . $row["role"] . "</td>
                <td>" . $row["hireDate"] . "</td>
                <td>" . ($row["isActive"] ? 'Yes' : 'No') . "</td>
                <td>" . $row["salary"] . "</td>
                <td>" . $row["department"] . "</td>
                <td>" . $row["projectsCompleted"] . "</td>
                <td>" . $row["lastLogin"] . "</td>
                <td>" . $row["accessLevel"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
