<?php
require_once __DIR__ . '/../includes/config.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /");
    exit();
}

// Validate CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Invalid CSRF token";
    header("Location: ../index.php");
    exit();
}

// Validate inputs
$place_id = filter_input(INPUT_POST, 'place_id', FILTER_VALIDATE_INT);
$rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 5]
]);
$comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS));

if (!$place_id || !$rating || empty($comment)) {
    $_SESSION['error'] = "Invalid feedback data";
    header("Location: ../index.php");
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO Feedback (PlaceID, UserID, Rating, Comment) 
                          VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $place_id,
        $_SESSION['user_id'],
        $rating,
        $comment
    ]);
    
    $_SESSION['success'] = "Feedback submitted successfully!";
} catch (PDOException $e) {
    error_log("Feedback Error: " . $e->getMessage());
    $_SESSION['error'] = "Failed to submit feedback";
}

header("Location: ../index.php");
exit();
?>