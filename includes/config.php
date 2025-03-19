<?php
session_start();
require_once __DIR__ . '/db.php';

// Authentication functions
require_once __DIR__ . '/auth.php';

// Redirect to login if not authenticated
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("Location: ../login.php");
        exit();
    }
}

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>