<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include 'settings.php';

    // Sanitize and validate form data
    function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to redirect to a specific URL
    function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    // Function to display error message and redirect
    function showErrorAndRedirect($errorMsg)
    {
        echo "<p>Error: $errorMsg</p>";
        echo "<p><a href='apply.php'>Go back to the application form</a></p>";
        exit();
    }

    // Sanitize and validate form inputs
    $jobRef = sanitizeInput($_POST["job"]);
    $firstName = sanitizeInput($_POST["firstName"]);
    $lastName = sanitizeInput($_POST["lastName"]);
    $dob = sanitizeInput($_POST["dob"]);
    $gender = sanitizeInput($_POST["gender"]);
    $streetAddress = sanitizeInput($_POST["streetaddress"]);
    $suburb = sanitizeInput($_POST["suburb"]);
    $state = sanitizeInput($_POST["state"]);
    $postcode = sanitizeInput($_POST["postcode"]);
    $email = sanitizeInput($_POST["email"]);
    $tel = sanitizeInput($_POST["tel"]);
    $skills = isset($_POST["skills"]) ? $_POST["skills"] : array();
    $otherSkills = sanitizeInput($_POST["other"]);

    // Perform server-side validation
    if (
        empty($jobRef) || empty($firstName) || empty($lastName) || empty($dob) || empty($gender) ||
        empty($streetAddress) || empty($suburb) || empty($state) || empty($postcode) ||
        empty($email) || empty($tel)
    ) {
        showErrorAndRedirect("All required fields must be filled.");
    }

    // Additional server-side validation for specific field formats
    // Implement your validation logic here based on the provided field format requirements

    // Connect to the database
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        showErrorAndRedirect("Database connection failed: " . mysqli_connect_error());
    }

    // Create EOI table if not exists
    $createTableSQL = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        jobReference VARCHAR(10),
        firstName VARCHAR(20),
        lastName VARCHAR(20),
        dob DATE,
        gender VARCHAR(10),
        streetAddress VARCHAR(40),
        suburb VARCHAR(40),
        state VARCHAR(5),
        postcode VARCHAR(4),
        email VARCHAR(50),
        tel VARCHAR(12),
        skills VARCHAR(255),
        otherSkills TEXT,
        status VARCHAR(10) DEFAULT 'New'
    )";
    if (!mysqli_query($conn, $createTableSQL)) {
        showErrorAndRedirect("Error creating table: " . mysqli_error($conn));
    }

    // Insert data into the database
    $insertSQL = "INSERT INTO eoi (jobReference, firstName, lastName, dob, gender, streetAddress, suburb, state, postcode, email, tel, skills, otherSkills)
        VALUES ('$jobRef', '$firstName', '$lastName', STR_TO_DATE('$dob', '%d/%m/%Y'), '$gender', '$streetAddress', '$suburb', '$state', '$postcode', '$email', '$tel', '" . implode(",", $skills) . "', '$otherSkills')";
    if (mysqli_query($conn, $insertSQL)) {
        // Get the auto-generated EOInumber
        $EOInumber = mysqli_insert_id($conn);
        // Close the database connection
        mysqli_close($conn);
        // Display confirmation message with EOInumber
        echo "<p>Your Expression of Interest (EOI) has been submitted successfully.</p>";
        echo "<p>Your EOInumber is: $EOInumber</p>";
        echo "<p><a href='apply.php'>Go back to the application form</a></p>";
    } else {
        showErrorAndRedirect("Error inserting record: " . mysqli_error($conn));
    }
} else {
    // If the script is accessed directly, redirect to the application form
    redirect("apply.php");
}
?>
