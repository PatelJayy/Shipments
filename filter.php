<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Data</title>
</head>
<body>
    <h1>Employee Data</h1>
    <form method="POST" action="">
        <h3>Integer Filters</h3>
        <label for="age">Age:</label>
        <select name="age_operator">
            <option value="=">=</option>
            <option value="<"><</option>
            <option value="<="><=</option>
            <option value=">">></option>
            <option value=">=">>=</option>
            <option value="!=">!=</option>
        </select>
        <input type="number" name="age" id="age">
        
        <h3>String Filters</h3>
        <label for="name">Name:</label>
        <select name="name_operator">
            <option value="contains">Contains</option>
            <option value="not_contains">Not Contains</option>
            <option value="=">=</option>
            <option value="!=">!=</option>
            <option value="starts_with">Starts With</option>
            <option value="ends_with">Ends With</option>
            <option value="is_null">Is Null</option>
            <option value="is_not_null">Is Not Null</option>
        </select>
        <input type="text" name="name" id="name">
        
        <h3>Date Filters</h3>
        <label for="hireDate">Hire Date:</label>
        <select name="hireDate_operator">
            <option value="=">=</option>
            <option value="<"><</option>
            <option value="<="><=</option>
            <option value=">">></option>
            <option value=">=">>=</option>
            <option value="!=">!=</option>
            <option value="is_null">Is Null</option>
            <option value="is_not_null">Is Not Null</option>
            <option value="range">Range</option>
        </select>
        <input type="date" name="hireDate" id="hireDate">
        <label for="hireDate_end">to</label>
        <input type="date" name="hireDate_end" id="hireDate_end">
        
        <h3>Enum Filters</h3>
        <label for="department">Department:</label>
        <select name="department_operator">
            <option value="=">=</option>
            <option value="!=">!=</option>
            <option value="in">In</option>
            <option value="not_in">Not In</option>
            <option value="is_null">Is Null</option>
            <option value="is_not_null">Is Not Null</option>
        </select>
        <input type="text" name="department" id="department">
        
        <h3>Boolean Filters</h3>
        <label for="isActive">Active:</label>
        <select name="isActive_operator">
            <option value="=">Equals</option>
            <option value="is_null">Is Null</option>
            <option value="is_not_null">Is Not Null</option>
        </select>
        <select name="isActive">
            <option value="1">True</option>
            <option value="0">False</option>
        </select>
        
        <button type="submit">Filter</button>
    </form>
    <hr>

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

// Initialize SQL query
$sql = "SELECT id, name, age, role, hireDate, isActive, salary, department, projectsCompleted, lastLogin, accessLevel FROM employees WHERE 1=1";

// Integer Filter for Age
if (!empty($_POST['age']) && !empty($_POST['age_operator'])) {
    $age = intval($_POST['age']);
    $age_operator = $_POST['age_operator'];
    $sql .= " AND age $age_operator $age";
}

// String Filter for Name
if (!empty($_POST['name_operator'])) {
    $name_operator = $_POST['name_operator'];
    $name = $_POST['name'];
    if ($name_operator == 'contains') {
        $sql .= " AND name LIKE '%$name%'";
    } elseif ($name_operator == 'not_contains') {
        $sql .= " AND name NOT LIKE '%$name%'";
    } elseif ($name_operator == 'starts_with') {
        $sql .= " AND name LIKE '$name%'";
    } elseif ($name_operator == 'ends_with') {
        $sql .= " AND name LIKE '%$name'";
    } elseif ($name_operator == 'is_null') {
        $sql .= " AND name IS NULL";
    } elseif ($name_operator == 'is_not_null') {
        $sql .= " AND name IS NOT NULL";
    } else {
        $sql .= " AND name $name_operator '$name'";
    }
}

// Date Filter for Hire Date
if (!empty($_POST['hireDate_operator'])) {
    $hireDate_operator = $_POST['hireDate_operator'];
    $hireDate = $_POST['hireDate'];
    if ($hireDate_operator == 'range') {
        $hireDate_end = $_POST['hireDate_end'];
        $sql .= " AND hireDate BETWEEN '$hireDate' AND '$hireDate_end'";
    } elseif ($hireDate_operator == 'is_null') {
        $sql .= " AND hireDate IS NULL";
    } elseif ($hireDate_operator == 'is_not_null') {
        $sql .= " AND hireDate IS NOT NULL";
    } else {
        $sql .= " AND hireDate $hireDate_operator '$hireDate'";
    }
}

// Enum Filter for Department
if (!empty($_POST['department_operator'])) {
    $department_operator = $_POST['department_operator'];
    $department = $_POST['department'];
    if ($department_operator == 'in' || $department_operator == 'not_in') {
        $departments = explode(',', $department);
        $departments = array_map('trim', $departments);
        $departments = "'" . implode("','", $departments) . "'";
        if ($department_operator == 'in') {
            $sql .= " AND department IN ($departments)";
        } else {
            $sql .= " AND department NOT IN ($departments)";
        }
    } elseif ($department_operator == 'is_null') {
        $sql .= " AND department IS NULL";
    } elseif ($department_operator == 'is_not_null') {
        $sql .= " AND department IS NOT NULL";
    } else {
        $sql .= " AND department $department_operator '$department'";
    }
}

// Boolean Filter for Active
if (!empty($_POST['isActive_operator'])) {
    $isActive_operator = $_POST['isActive_operator'];
    if ($isActive_operator == 'is_null') {
        $sql .= " AND isActive IS NULL";
    } elseif ($isActive_operator == 'is_not_null') {
        $sql .= " AND isActive IS NOT NULL";
    } else {
        $isActive = intval($_POST['isActive']);
        $sql .= " AND isActive = $isActive";
    }
}

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

$conn->close();
?>

</body>
</html>
