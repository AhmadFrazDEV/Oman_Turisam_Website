<?php
// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Redirect logged-in users away from auth pages
function redirect_if_logged_in() {
    if (is_logged_in()) {
        header("Location: " . ($_SESSION['redirect_url'] ?? '/pages/mytrip.php'));
        exit();
    }
}

// Get current user data
function current_user() {
    if (!is_logged_in()) return null;
    
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
?>