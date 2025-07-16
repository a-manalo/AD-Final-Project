<?php
// auth.util.php

// Initialize session
function auth_init() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Login function
function auth_login($user_id, $user_data = []) {
    auth_init();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_data'] = $user_data;
}

// Get current user data
function auth_user() {
    auth_init();
    return $_SESSION['user_data'] ?? null;
}

// Check if user is logged in
function auth_check() {
    auth_init();
    return isset($_SESSION['user_id']);
}

// Logout function
function auth_logout() {
    auth_init();
    session_unset();
    session_destroy();
}