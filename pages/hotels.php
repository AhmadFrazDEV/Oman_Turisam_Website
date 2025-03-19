<?php
require_once __DIR__ . '/../includes/config.php';
include __DIR__ . '/../includes/header.php';

$hotels = [
    [
        "name" => "Alila",
        "description" => "Alila is a luxurious resort offering stunning views, world-class amenities, and a relaxing retreat in Dhofar.",
        "image" => "../assets/images/images/hotels/Alila/Alila_hotel_1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Crown Plaza",
        "description" => "Crown Plaza provides a blend of comfort and elegance, featuring modern rooms and exceptional service.",
        "image" => "../assets/images/images/hotels/crown_plaza/crown_plaza_1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Hawana",
        "description" => "Hawana Resort is a perfect getaway with beachfront access, water activities, and luxury accommodations.",
        "image" => "../assets/images/images/hotels/hawana/hawana_hotel_1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Millennium",
        "description" => "Millennium Hotel is known for its contemporary design, high-end amenities, and excellent hospitality.",
        "image" => "../assets/images/images/hotels/millennium/millennium_hotel_1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "The Plaza",
        "description" => "The Plaza Hotel offers a mix of elegance and comfort, with top-notch services and a central location.",
        "image" => "../assets/images/images/hotels/theplaza/theplaza_hotel_1.jpeg",
        "location" => "#"
    ],
];

?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Best Hotels in Dhofar</h1>
    
    <div class="row g-4">
        <?php foreach ($hotels as $hotel): ?>
        <div class="col-md-4">
            <div class="card place-card h-100">
                <img src="<?= htmlspecialchars($hotel['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($hotel['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($hotel['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($hotel['description']) ?></p>
                    <a href="<?= $hotel['location'] ?>" class="btn btn-sm btn-outline-primary" target="_blank">View Location</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
