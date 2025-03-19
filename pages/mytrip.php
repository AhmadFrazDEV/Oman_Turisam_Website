<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT mt.TripId AS TripId, p.*, mt.DateOfVisit 
    FROM MyTrip mt
    JOIN Places p ON mt.PlaceId = p.Id 
    WHERE mt.UserId = ?
");

$stmt->execute([$user_id]);
$trips = $stmt->fetchAll();
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">My Travel Plan</h2>
    
    <?php if (empty($trips)): ?>
        <div class="alert alert-info">No places added to your trip yet.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($trips as $trip): ?>
            <div class="col-md-4">
                <div class="card place-card h-100">
                <img src="../<?= htmlspecialchars($trip['MainPhoto']) ?>" class="card-img-top" alt="<?= htmlspecialchars($trip['Place']) ?>">


                    <div class="card-body">
                        <h5><?= htmlspecialchars($trip['Place']) ?></h5>
                        <p class="text-muted">Visit Date: <?= htmlspecialchars($trip['DateOfVisit'] ?? 'Not set') ?></p>

                        <form method="POST" action="../actions/remove_trip.php" onsubmit="return confirm('Are you sure you want to remove this place?');">
                            <input type="hidden" name="trip_id" value="<?= $trip['TripId'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
