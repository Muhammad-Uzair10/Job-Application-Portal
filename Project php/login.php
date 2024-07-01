<?php include "header.inc"; ?>
<?php include "menu.inc"; ?>
<link href="styles/form.css" rel="stylesheet">

<?php
session_start();

// Check if user is already logged in, redirect to manage.php if logged in
if (isset($_SESSION['username'])) {
    header("Location: manage.php");
    exit();
}

// Initialize login attempts count and last attempt timestamp
$login_attempts = 0;
$last_attempt_time = 0;
// Check if login attempts count and last attempt timestamp session variables are set
if (isset($_SESSION['login_attempts']) && isset($_SESSION['last_attempt_time'])) {
    $login_attempts = $_SESSION['login_attempts'];
    $last_attempt_time = $_SESSION['last_attempt_time'];
}

// Lockout duration in seconds (e.g., 5 minutes)
$lockout_duration = 300;

// Check if the user is still in lockout period
if ($login_attempts >= 3 && time() - $last_attempt_time < $lockout_duration) {
    echo "Too many login attempts. Locked for 5 mins. (Reload after 5 mins)";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    include "settings.php";

    // Connect to the database
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Verify password
        if ($password === $row['password']) { // Direct comparison of passwords
            // Login successful
            $_SESSION['username'] = $username;
            // Reset login attempts count and last attempt timestamp
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = 0;
            // Redirect to manage.php
            header("Location: manage.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid password";
            // Increment login attempts count
            $login_attempts++;
            // Update last attempt timestamp
            $_SESSION['last_attempt_time'] = time();
            $_SESSION['login_attempts'] = $login_attempts;
            // Check if login attempts exceed limit
            if ($login_attempts >= 3) {
                echo "Too many login attempts. Please try again after 5 mins (reload page).";
                exit();
            }
        }
    } else {
        // Username not found
        echo "Username not found";
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<div class="login-form">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
