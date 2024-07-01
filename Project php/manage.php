<?php

// Include header and menu
include "header.inc";
echo "<title>EOI Management</title>";
include "menu.inc";

?>

<body>
    <h1>EOI Management</h1>

    <form action="manage.php" method="POST">
        <label for="query">Select Query:</label>
        <select name="query" id="query">
            <option value="all">List All EOIs</option>
            <option value="position">List EOIs by Position</option>
            <option value="applicant">List EOIs by Applicant</option>
            <option value="delete">Delete EOIs by Position</option>
            <option value="change_status">Change Status of EOI</option>
        </select>
        <input type="submit" value="Submit">

        <!-- Input field for job reference -->
        <label for="job_ref">Reference Number:</label>
        <input type="text" name="job_ref" id="job_ref">

        <!-- Input fields for first name and last name -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name">

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name">
        <br>

        <!-- Additional input fields for change_status query -->
        <label for="eoi_number">EOInumber:</label>
        <input type="text" name="eoi_number" id="eoi_number">

        <label for="new_status">New Status:</label>
        <input type="text" name="new_status" id="new_status">
    </form>

    <?php
    try {
        // Include database connection settings
        include 'settings.php';

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if query parameter is set
            if (isset($_POST['query'])) {
                $query_type = $_POST['query'];

                // Connect to the database
                $conn = mysqli_connect($host, $username, $password, $dbname);

                if (!$conn) {
                    throw new Exception("Connection with database failed: " . mysqli_connect_error());
                }

                // Execute selected query
                switch ($query_type) {
                    case 'all':
                        $sql = "SELECT * FROM eoi";
                        break;
                    case 'position':
                        // Check if job reference number is provided
                        if (!isset($_POST['job_ref'])) {
                            throw new Exception("Job reference number is required.");
                        }
                        $job_ref = mysqli_real_escape_string($conn, $_POST['job_ref']);
                        $sql = "SELECT * FROM eoi WHERE jobReference = '$job_ref'";
                        break;
                    case 'applicant':
                        // Check if first name and last name are provided
                        if (!isset($_POST['first_name']) || !isset($_POST['last_name'])) {
                            throw new Exception("Both first name and last name are required.");
                        }
                        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                        $sql = "SELECT * FROM eoi WHERE firstName = '$first_name' OR lastName = '$last_name'";
                        break;
                    case 'delete':
                        // Check if job reference number is provided
                        if (!isset($_POST['job_ref'])) {
                            throw new Exception("Job reference number is required.");
                        }
                        $job_ref = mysqli_real_escape_string($conn, $_POST['job_ref']);
                        $sql = "DELETE FROM eoi WHERE jobReference = '$job_ref'";
                        break;
                    case 'change_status':
                        // Check if EOInumber and new status are provided
                        if (!isset($_POST['eoi_number']) || !isset($_POST['new_status'])) {
                            throw new Exception("EOInumber and new status are required.");
                        }
                        $eoi_number = mysqli_real_escape_string($conn, $_POST['eoi_number']);
                        $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
                        $sql = "UPDATE eoi SET status = '$new_status' WHERE EOInumber = '$eoi_number'";
                        break;
                    default:
                        throw new Exception("Invalid query type.");
                }

                // Execute the query
                $result = mysqli_query($conn, $sql);

                if ($result === false) {
                    throw new Exception("Query execution failed.");
                }

                // Display the results
                if (mysqli_num_rows($result) > 0) {
                    echo "<h2>Results:</h2>";
                    echo "<table border='1'>";
                    echo "<tr><th>EOInumber</th><th>Job Reference</th><th>First Name</th><th>Last Name</th><th>Status</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>{$row['EOInumber']}</td><td>{$row['jobReference']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['status']}</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No results found.";
                }
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close database connection
        if (isset($conn)) {
            mysqli_close($conn);
        }
    }
    ?>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>

</html>
