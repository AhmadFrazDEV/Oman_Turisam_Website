<?php
// Include database connection
require_once __DIR__ . '/../includes/config.php';
include __DIR__ . '/../includes/header.php';

// Fetch all places with their feedback
$sql = "SELECT p.Id, p.Place, p.Description, p.MainPhoto, p.Location, p.Category,
               f.Comment, f.Rating, u.Name AS UserName
        FROM places p
        LEFT JOIN feedback f ON p.Id = f.PlaceID
        LEFT JOIN users u ON f.UserID
        ORDER BY p.Id, f.CreatedAt DESC";

$stmt = $pdo->query($sql);

// Organizing places and feedback
$places = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $placeId = $row['Id'];

    if (!isset($places[$placeId])) {
        $places[$placeId] = [
            'Place' => $row['Place'],
            'Description' => $row['Description'],
            'MainPhoto' => $row['MainPhoto'],
            'Location' => $row['Location'],
            'Category' => $row['Category'],
            'Feedbacks' => []
        ];
    }

    if (!empty($row['Comment'])) {
        $places[$placeId]['Feedbacks'][] = [
            'UserName' => $row['UserName'],
            'Comment' => $row['Comment'],
            'Rating' => $row['Rating']
        ];
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Places & Feedback - Dhofar Tourism</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .feedback-section {
            max-height: 150px;
            overflow-y: auto;
        }
        .rating {
            color: #f39c12;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Explore Places & Feedback</h2>
    
    <div class="row">
        <?php foreach ($places as $place):?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    
                <img src="../<?= htmlspecialchars($place['MainPhoto']) ?>" class="card-img-top" alt="<?= htmlspecialchars($place['Place']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($place['Place']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($place['Description']) ?></p>
                        <p><strong>Location:</strong> <?= htmlspecialchars($place['Location']) ?></p>
                        <p><strong>Category:</strong> <?= htmlspecialchars($place['Category']) ?></p>
                        
                        <?php if (!empty($place['Feedbacks'])): ?>
                            <h6>Feedback</h6>
                            <div class="feedback-section">
                                <?php foreach ($place['Feedbacks'] as $feedback): ?>
                                    <p><strong><?= htmlspecialchars($feedback['UserName']) ?>:</strong> <?= htmlspecialchars($feedback['Comment']) ?></p>
                                    <p class="rating">⭐ <?= str_repeat('★', $feedback['Rating']) ?><?= str_repeat('☆', 5 - $feedback['Rating']) ?></p>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No feedback available</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include __DIR__ . '/../includes/footer.php'; ?>