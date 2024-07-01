
    <title>Job Postings</title>
    
<?php include "header.inc" ?>
<?php include "menu.inc" ?>

<link href="styles/display.css" rel="stylesheet" type="text/css">

<body>
    <h2>Job Postings</h2>

    <?php
    include "settings.php";
    
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if(mysqli_connect_errno()){
        die("Connection error: " . mysqli_connect_error());
    }
    
    // Fetch job postings from the database
    $sql = "SELECT * FROM jobs";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='job-posting'>";
            echo "<h3 class='job-title'>" . $row["title"] . "</h3>";
            echo "<p class='job-description'><strong>Description:</strong> " . $row["description"] . "</p>";
            echo "<p class='job-details'><strong>Reference:</strong> " . $row["reference"] . "</p>";
            echo "<p class='job-details'><strong>Salary Range:</strong> " . $row["salary_range"] . "</p>";
            echo "<p class='job-details'><strong>Key Responsibilities:</strong> " . $row["key_responsibilities"] . "</p>";
            echo "</div>";
            echo "<p class='job-details'> Dynamically Generated from Database</p>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

</body>
</html>
