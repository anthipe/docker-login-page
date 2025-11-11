<?php
// Database configuration

//$servername = $_SERVER['SERVER_ADDR'];
// $servername = $_ENV['MYSQL_ROOT_HOST']; // δεν χρειάζεται

// Database configuration (μέσα σε docker: host = 'db')
$servername = getenv('MYSQL_HOST') ?: 'db';
$dbuser     = getenv('MYSQL_USER') ?: 'username';
$dbpass     = getenv('MYSQL_PASSWORD') ?: 'password';
$dbname     = getenv('MYSQL_DATABASE') ?: 'database';

// Create connection
$conn = new mysqli($servername, $dbuser, $dbpass, $dbname, 3306);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//  log_attempt
function log_attempt(mysqli $conn, string $username, int $success, ?int $userId = null): void {
    $sql = "INSERT INTO logins (user_id, username, success) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // i = int (user_id), s = string (username), i = int (success)
    $stmt->bind_param("isi", $userId, $username, $success);
    $stmt->execute();
    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get login form data
    $susername = $_POST['loginUsername'];
    $spassword = $_POST['loginPassword'];

    // Prepare and execute SQL statement to select user data from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $susername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if ($spassword == $row['password']) {
            // Password is correct, login successful
            session_start();
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $susername;

            // Καταγραφή επιτυχημένου attempt (με user_id)
            log_attempt($conn, $susername, 1, (int)$row['id']);

            header("Location: home.php");
            exit();
        } else {
            //  Incorrect password
            log_attempt($conn, $susername, 0, (int)$row['id']); // υπάρχει user, αλλά λάθος pass
            echo "Invalid username or password";
        }
    } else {
        // User not found
        log_attempt($conn, $susername, 0, null); // δεν υπάρχει user_id
        echo "Invalid user";
    }

    $stmt->close();
}

$conn->close();
?>
