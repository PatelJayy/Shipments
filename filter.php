<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shipments Data</title>
</head>
<body>
    <h1>Shipments Data</h1>
    <form method="POST" action="">
        <!-- <h3>Search</h3>
        <input type="text" name="search" id="search"> -->
        <h1>Integer Filters</h1>
        <h3>for age</h3>
        <label for="age">Age:</label>
        <select name="ageOperator">
            <option value="=">=</option>
            <option value="<"><</option>
            <option value="<="><=</option>
            <option value=">">></option>
            <option value=">=">>=</option>
            <option value="!=">!=</option>
        </select>
        <input type="number" name="age" id="age">

        <h3>for salary</h3>
        <label for="salary">salary:</label>
        <select name="salaryOperator">
            <option value="=">=</option>
            <option value="<"><</option>
            <option value="<="><=</option>
            <option value=">">></option>
            <option value=">=">>=</option>
            <option value="!=">!=</option>
        </select>
        <input type="number" name="salary" id="salary">   

        <h3>for projects</h3>
        <label for="projects">projects:</label>
        <select name="projectsCompleted">
            <option value="=">=</option>
            <option value="<"><</option>
            <option value="<="><=</option>
            <option value=">">></option>
            <option value=">=">>=</option>
            <option value="!=">!=</option>
        </select>
        <input type="number" name="projects" id="projects">

        <h1>String Filters</h1>
        <h3>for name</h3>
        <label for="name">Name:</label>
        <select name="nameOperator">
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
        
        <h3>for role</h3>
        <label for="role">Role:</label>
        <select name="roleOperator">
            <option value="contains">Contains</option>
            <option value="not_contains">Not Contains</option>
            <option value="=">=</option>
            <option value="!=">!=</option>
            <option value="starts_with">Starts With</option>
            <option value="ends_with">Ends With</option>
            <option value="is_null">Is Null</option>
            <option value="is_not_null">Is Not Null</option>
        </select>
        <input type="text" name="role" id="role">
        
        <h3>for department</h3>
        <label for="department">department:</label>
        <select name="departmentOperator">
            <option value="contains">Contains</option>
            <option value="not_contains">Not Contains</option>
            <option value="=">=</option>
            <option value="!=">!=</option>
            <option value="starts_with">Starts With</option>
            <option value="ends_with">Ends With</option>
            <option value="is_null">Is Null</option>
            <option value="is_not_null">Is Not Null</option>
        </select>
        <input type="text" name="department" id="department">

        <h3>Date Filters</h3>
        <label for="hireDate">Hire Date:</label>
        <select name="hireDateOperator">
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
               
        <h3>Boolean Filters</h3>
        <label for="isActive">Active:</label>
        <select name="isActiveOperator">
            <option value="=">Equals</option>
        </select> 
        <select name="isActive">
            <option value="1">Yes</option>
            <option value="empty">No</option>
        </select>
        
        <button type="submit">Filter</button>
    </form>
    <hr>

<?php

// connecting to mySql database for executing querries

$hostname = "localhost:3307";
  $username = "root";
  $password = "";
  $dbname = "ship";


$conn = new mysqli($hostname, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dynamic sql querry for all

$sql = "SELECT id, name, age, role, hireDate, isActive, salary, department, projectsCompleted, lastLogin, accessLevel FROM employees WHERE 1=1";

//Filter for Salary

if (!empty($_POST['salary']) && !empty($_POST['salaryOperator'])) {
    $salary = intval($_POST['salary']);
    $salaryOperator = $_POST['salaryOperator'];
    $sql .= " AND salary $salaryOperator $salary";
}

//Filter for projects

if (!empty($_POST['project']) && !empty($_POST['projectsCompleted'])) {
    $project = intval($_POST['project']);
    $projectsCompleted = $_POST['projectsCompleted'];
    $sql .= " AND project $projectsCompleted $project";
}

// salary filter

if (!empty($_POST['age']) && !empty($_POST['ageOperator'])) {
    $age = intval($_POST['age']);
    $ageOperator = $_POST['ageOperator'];
    $sql .= " AND age $ageOperator $age";
}

// Name filter

if (!empty($_POST['name']) && !empty($_POST['nameOperator'])) {
    $nameOperator = $_POST['nameOperator'];
    $name = $_POST['name'];
    if ($nameOperator == 'contains') {
        $sql .= " AND name LIKE '%$name%'";
    } elseif ($nameOperator == 'not_contains') {
        $sql .= " AND name NOT LIKE '%$name%'";
    } elseif ($nameOperator == 'starts_with') {
        $sql .= " AND name LIKE '$name%'";
    } elseif ($nameOperator == 'ends_with') {
        $sql .= " AND name LIKE '%$name'";
    } elseif ($nameOperator == 'is_null') {
        $sql .= " AND name IS NULL";
    } elseif ($nameOperator == 'is_not_null') {
        $sql .= " AND name IS NOT NULL";
    } else {
        $sql .= " AND name $nameOperator '$name'";
    }
}


// Name filter

if (!empty($_POST['projects']) && !empty($_POST['projectsCompleted'])) {
    $projectsCompleted = $_POST['projectsCompleted'];
    $projects = $_POST['projects'];
    if ($projectsCompleted == 'contains') {
        $sql .= " AND projects LIKE '%$projects%'";
    } elseif ($projectsCompleted == 'not_contains') {
        $sql .= " AND projects NOT LIKE '%$projects%'";
    } elseif ($projectsCompleted == 'starts_with') {
        $sql .= " AND projects LIKE '$projects%'";
    } elseif ($projectsCompleted == 'ends_with') {
        $sql .= " AND projects LIKE '%$projects'";
    } elseif ($projectsCompleted == 'is_null') {
        $sql .= " AND projects IS NULL";
    } elseif ($projectsCompleted == 'is_not_null') {
        $sql .= " AND projects IS NOT NULL";
    } else {
        $sql .= " AND projects $projectsCompleted '$projects'";
    }
}

// role filter

if (!empty($_POST['role']) && !empty($_POST['roleOperator'])) {
    $roleOperator = $_POST['roleOperator'];
    $role = $_POST['role'];
    if ($roleOperator == 'contains') {
        $sql .= " AND role LIKE '%$role%'";
    } elseif ($roleOperator == 'not_contains') {
        $sql .= " AND role NOT LIKE '%$role%'";
    } elseif ($roleOperator == 'starts_with') {
        $sql .= " AND role LIKE '$role%'";
    } elseif ($roleOperator == 'ends_with') {
        $sql .= " AND role LIKE '%$role'";
    } elseif ($roleOperator == 'is_null') {
        $sql .= " AND role IS NULL";
    } elseif ($roleOperator == 'is_not_null') {
        $sql .= " AND role IS NOT NULL";
    } else {
        $sql .= " AND role $roleOperator '$role'";
    }
}

// date filter

if (!empty($_POST['hireDateOperator'])) {
    $hireDateOperator = $_POST['hireDateOperator'];
    $hireDate = $_POST['hireDate'];
    if ($hireDateOperator == 'range') {
        $hireDate_end = $_POST['hireDate_end'];
        if (!empty($hireDate) && !empty($hireDate_end)) {
            $sql .= " AND hireDate BETWEEN '$hireDate' AND '$hireDate_end'";
        }
    } elseif ($hireDateOperator == 'is_null') {
        $sql .= " AND hireDate IS NULL";
    } elseif ($hireDateOperator == 'is_not_null') {
        $sql .= " AND hireDate IS NOT NULL";
    } elseif (!empty($hireDate)) {
        $sql .= " AND hireDate $hireDateOperator '$hireDate'";
    }
}

// department filters

if (!empty($_POST['department']) && !empty($_POST['departmentOperator'])) {
    $departmentOperator = $_POST['departmentOperator'];
    $department = $_POST['department'];
    if ($departmentOperator == 'contains') {
        $sql .= " AND department LIKE '%$department%'";
    } elseif ($departmentOperator == 'not_contains') {
        $sql .= " AND department NOT LIKE '%$department%'";
    } elseif ($departmentOperator == 'starts_with') {
        $sql .= " AND department LIKE '$department%'";
    } elseif ($departmentOperator == 'ends_with') {
        $sql .= " AND department LIKE '%$department'";
    } elseif ($departmentOperator == 'is_null') {
        $sql .= " AND department IS NULL";
    } elseif ($departmentOperator == 'is_not_null') {
        $sql .= " AND department IS NOT NULL";
    } else {
        $sql .= " AND department $departmentOperator '$department'";
    }
}

// filter for boolean yes/no

if (!empty($_POST['isActiveOperator'])) {
    $isActiveOperator = $_POST['isActiveOperator'];
    if (!empty($_POST['isActive'])) {
            $isActive = intval($_POST['isActive']);
            $sql .= " AND isActive = $isActive";
    }
}

$result = $conn->query($sql);

// checking for result

if ($result->num_rows > 0) {
    
    // format of table

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
