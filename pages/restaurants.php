<?php
require_once __DIR__ . '/../includes/config.php';
include __DIR__ . '/../includes/header.php';

$historical_places = [
    [
        "name" => "Khor Rori (Sumhuram)",
        "description" => "Khor Rori (Sumhuram) is an important archaeological site that was once a major port for exporting frankincense, and includes the remains of the historic city of Sumhuram, which dates back more than two thousand years. The site allows visitors to explore ancient ruins and enjoy the breathtaking views of the Gulf and the surrounding mountains.",
        "image" => "../assets/images/images/resturants/1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Al Baleed",
        "description" => "The ancient city of Al Baleed is one of the most important historical sites in Dhofar, as it was a thriving commercial center since the 12th century. The city is home to the Frankincense Land Museum, which narrates the history of the frankincense trade and the role of Dhofar in global trade.",
        "image" => "../assets/images/images/resturants/2.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Taqah Castle",
        "description" => "Taqah Castle is one of the important historical castles in Dhofar, dating back to the 19th century. It is characterized by its traditional Omani design and includes many ancient artifacts that reflect the lifestyle of the past.",
        "image" => "../assets/images/images/resturants/1.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Prophet Ayoub’s Tomb",
        "description" => "Located on a high mountain peak, it offers wonderful views of the Dhofar plains, and is considered one of the important religious and historical sites.",
        "image" => "../assets/images/images/resturants/2.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Prophet Hud’s Tomb",
        "description" => "An ancient religious site surrounded by beautiful natural scenery, and is visited by visitors for exploration and religious visits.",
        "image" => "../assets/images/images/resturants/3.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Mirbat Castle",
        "description" => "An ancient fort dating back to the 19th century, it witnessed important historical battles, and is characterized by its Omani architectural style.",
        "image" => "../assets/images/images/resturants/4.jpeg",
        "location" => "#"
    ],
    [
        "name" => "Sadah Fort",
        "description" => "An ancient fort in Sadah city, reflecting the historical heritage of the region and its role in ancient maritime trade.",
        "image" => "../assets/images/images/resturants/5.jpeg",
        "location" => "#"
    ]
];
?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Historical Places of Dhofar</h1>
    
    <div class="row g-4">
        <?php foreach ($historical_places as $place): ?>
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
