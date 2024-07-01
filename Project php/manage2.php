<?php include 'header.inc' ?>;
<?php include 'menu.inc' ?>;
<?php
// Include database connection settings
include 'settings.php';

try {
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

            // Modify SQL query based on sorting criteria and sorting order
            $sort_by = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'EOInumber'; // Default to EOInumber if not specified
            $sort_order = isset($_POST['sort_order']) && in_array($_POST['sort_order'], array('asc', 'desc')) ? $_POST['sort_order'] : 'asc'; // Default to ascending order if not specified
            $sql = '';

            switch ($query_type) {
                case 'all':
                    $sql = "SELECT * FROM eoi ORDER BY $sort_by $sort_order";
                    break;
                case 'position':
                    // Modify SQL query for position query
                    $job_ref = isset($_POST['job_ref']) ? mysqli_real_escape_string($conn, $_POST['job_ref']) : '';
                    $sql = "SELECT * FROM eoi WHERE jobReference = '$job_ref' ORDER BY $sort_by $sort_order";
                    break;
                case 'applicant':
                    // Modify SQL query for applicant query
                    $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : '';
                    $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn, $_POST['last_name']) : '';
                    $sql = "SELECT * FROM eoi WHERE firstName = '$first_name' OR lastName = '$last_name' ORDER BY $sort_by $sort_order";
                    break;
                // Add other cases for different queries
            }

            // Execute the modified SQL query
            $result = mysqli_query($conn, $sql);

            // Display the results
            if ($result) {
                echo "<h2>Results:</h2>";
                echo "<table border='1'>";
                echo "<tr><th>EOInumber</th><th>Job Reference</th><th>First Name</th><th>Last Name</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['EOInumber']}</td><td>{$row['jobReference']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td><td>{$row['status']}</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Query execution failed.";
            }

            // Close database connection
            mysqli_close($conn);
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<a href="sort.php" class="hover-link primary-button">Go back</a>