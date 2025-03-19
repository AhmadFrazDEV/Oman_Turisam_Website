<?php
require_once __DIR__ . '/../includes/config.php';
include __DIR__ . '/../includes/header.php';

$landscapes = [
    [
        "name" => "Ittin Plain",
        "description" => "Ittin Plain is a beautiful natural area that transforms into a lush green oasis during the autumn season. It features water springs like Jarziz Spring, making it a perfect destination for hiking and enjoying the scenery.",
        "image" => "../assets/images/3.jpg",
        "location" => "https://maps.app.goo.gl/nKnUrNDKGy5KrgHP9"
    ],
    [
        "name" => "Al Mughsail Beach",
        "description" => "Al Mughsail Beach is famous for its soft white sand and turquoise waters. The beach is home to the 'Al Mughsail Fountains', a natural phenomenon where waves force water through rock openings, creating a stunning scene.",
        "image" => "../assets/images/7.jpg",
        "location" => "https://maps.app.goo.gl/kLExzz2v88sPgLmZ9"
    ],
    [
        "name" => "Wadi Darbat",
        "description" => "Wadi Darbat features seasonal waterfalls and permanent lakes, making it a paradise for nature lovers. Visitors can hike, boat through the waters, and explore its diverse wildlife.",
        "image" => "../assets/images/1.jpg",
        "location" => "#"
    ],
    [
        "name" => "Jabal Samhan",
        "description" => "Jabal Samhan is a towering mountain famous for being home to the rare Arabian leopard. It offers breathtaking panoramic views, especially during the misty autumn season.",
        "image" => "../assets/images/2.jpg",
        "location" => "#"
    ],
    [
        "name" => "Wadi Nahiz",
        "description" => "Wadi Nahiz is known for its unique rock formations and natural caves, attracting adventurers and explorers. This hidden gem provides a thrilling experience away from tourist crowds.",
        "image" => "../assets/images/1.jpg",
        "location" => "#"
    ],
    [
        "name" => "Mirbat Beach",
        "description" => "Located in the historic city of Mirbat, this peaceful beach offers golden sands and clear waters. Visitors can enjoy swimming, dolphin watching, and exploring marine life.",
        "image" => "../assets/images/3.jpg",
        "location" => "#"
    ],
    [
        "name" => "Ayoons",
        "description" => "Ayoons is a picturesque area known for its stunning landscapes and natural beauty, making it a must-visit for nature enthusiasts.",
        "image" => "../assets/images/5.jpg",
        "location" => "#"
    ],
];

?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Landscapes & Beaches of Dhofar</h1>
    
    <div class="row g-4">
        <?php foreach ($landscapes as $place): ?>
        <div class="col-md-4">
            <div class="card place-card h-100">
                <img src="<?= htmlspecialchars($place['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($place['name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($place['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($place['description']) ?></p>
                    <a href="<?= $place['location'] ?>" class="btn btn-sm btn-outline-primary" target="_blank">View Location</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
