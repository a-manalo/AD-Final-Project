<?php
session_start();
include 'db_connection.php'; // Include your database connection

// Check if the request method is POST for login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check user credentials
    $query = "SELECT role FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['role'] = $row['role'];

        // Redirect based on user role
        switch ($_SESSION['role']) {
            case 'admin':
                header("Location: /admin/dashboard.php");
                break;
            case 'user':
                header("Location: /user/home.php");
                break;
            default:
                header("Location: /index.php");
                break;
        }
    } else {
        echo "Invalid username or password.";
    }
}

// Check if the request method is GET for logout
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy(); // Destroy the session
    header("Location: /pages/login/index.php"); // Redirect to login page
    exit();
}
?>