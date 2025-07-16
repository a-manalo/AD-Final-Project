<?php
// Simple singleton database connection
function db_connect() {
    static $conn;
    if (!$conn) {
        $conn = mysqli_connect(
            'db',       // Matches your docker-compose.yml service name
            'root',     // Default username
            'password', // Must match MYSQL_ROOT_PASSWORD in docker-compose
            'ecommerce_db' // Your database name
        );
        if (!$conn) die("Database connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Fetch user data from DB
function get_user($username) {
    $conn = db_connect();
    $escaped_user = mysqli_real_escape_string($conn, $username);
    $result = mysqli_query($conn, 
        "SELECT id, username, password_hash, role 
         FROM users 
         WHERE username = '$escaped_user'"
    );
    return mysqli_fetch_assoc($result); // Returns user array or NULL
}