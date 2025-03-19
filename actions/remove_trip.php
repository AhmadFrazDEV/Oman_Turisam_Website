<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_login();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/mytrip.php?error=unauthorized");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trip_id'])) {
    $trip_id = filter_var($_POST['trip_id'], FILTER_VALIDATE_INT);

    if (!$trip_id) {
        header("Location: ../pages/mytrip.php?error=invalid_trip_id");
        exit();
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM mytrip WHERE TripId = ? AND UserId = ?");
        $stmt->execute([$trip_id, $user_id]);

        if ($stmt->rowCount() > 0) {
            header("Location: ../pages/mytrip.php?status=trip_removed");
        } else {
            header("Location: ../pages/mytrip.php?error=trip_not_found");
        }
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: ../pages/mytrip.php?error=database_error");
    }
    exit();
} else {
    header("Location: ../pages/mytrip.php?error=invalid_request_method");
    exit();
}
