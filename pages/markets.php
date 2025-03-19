<?php
require_once __DIR__ . '/../includes/config.php';
include __DIR__ . '/../includes/header.php';

$malls = [
    [
        "name" => "Al Raha Mall",
        "description" => "Al Raha Mall is a modern shopping center offering a variety of retail stores, dining options, and entertainment facilities, making it a perfect destination for families and tourists.",
        "image" => "../assets/images/images/malls/alraha_mall/1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Gardens Mall",
        "description" => "Gardens Mall is known for its wide range of international and local brands, providing a premium shopping experience in a stylish and comfortable environment.",
        "image" => "../assets/images/images/malls/gardens_mall/1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Grand Mall",
        "description" => "Grand Mall is one of the largest malls in Dhofar, featuring diverse shopping outlets, entertainment centers, and a food court that caters to all tastes.",
        "image" => "../assets/images/images/malls/grand_mall/1.jpeg",
        "location" => "#"
    ],
];

?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Shopping Malls in Dhofar</h1>
    
    <div class="row g-4">
        <?php foreach ($malls as $mall): ?>
        <div class="col-md-4">
            <div class="card place-card h-100">
                <img src="<?= htmlspecialchars($mall['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($mall['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($mall['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($mall['description']) ?></p>
                    <a href="<?= $mall['location'] ?>" class="btn btn-sm btn-outline-primary" target="_blank">View Location</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>