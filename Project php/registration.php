<?php include "header.inc"; ?>
<?php include "menu.inc"; ?>
<link href="styles/form.css" rel="stylesheet">

<?php
// Database connection settings
include "settings.php";
echo "<h2> Register as Manager </h2>";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle registration form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Server-side validation for uniqueness of username
        // Server-side validation for password rule (e.g., minimum length)

        // Check if the username already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // Insert data into the database without hashing the password
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);

            echo "Registration successful. You can now login.";
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<h3>Already Registered? Move to login page</h3>
<a href="login.php">Login</a>
