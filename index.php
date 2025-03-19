<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<link rel="stylesheet" href="/assets/css/styles.css">



<body>
    
<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';
include __DIR__ . '/includes/header.php';
?>

<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Welcome to Dhofar</h1>
        <p class="lead">Discover Oman's Hidden Paradise</p>
        <a href="./pages/landscapes.php" class="btn btn-primary btn-lg mt-3">Explore Now</a>
    </div>
</div>

<main class="container my-5">
    <section class="featured-destinations">
        <h2 class="text-center mb-5">Featured Attractions</h2>

        <div class="row g-4">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM places ORDER BY RAND() LIMIT 3");
                while ($place = $stmt->fetch()):
            ?>
                    <div class="col-md-4">
                        <div class="card place-card h-100">
                            <img src="<?= htmlspecialchars($place['MainPhoto']) ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($place['Place']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($place['Place']) ?></h5>
                                <p class="card-text">
                                    <?= htmlspecialchars(substr($place['Description'], 0, 100)) ?>...
                                </p>

                                <!-- Feedback Section -->
                                <div class="feedback-section mt-3">
                                    <h6 class="mb-2">Visitor Feedback:</h6>

                                    <?php
                                    // Get feedback for this place
                                    $feedback_stmt = $pdo->prepare("SELECT Feedback.*, Users.Name 
                                           FROM Feedback 
                                           JOIN Users ON Feedback.UserID = Users.Id 
                                           WHERE PlaceID = ? 
                                           ORDER BY CreatedAt DESC 
                                           LIMIT 3");
                                    $feedback_stmt->execute([$place['Id']]);
                                    $feedbacks = $feedback_stmt->fetchAll();

                                    if (!empty($feedbacks)):
                                        foreach ($feedbacks as $feedback):
                                    ?>
                                            <div class="feedback-item mb-2 p-2 border rounded">
                                                <div class="d-flex justify-content-between">
                                                    <strong><?= htmlspecialchars($feedback['Name']) ?></strong>
                                                    <div class="rating">
                                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                                            <i class="fas fa-star <?= $i < $feedback['Rating'] ? 'text-warning' : 'text-secondary' ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                                <p class="mb-0"><?= htmlspecialchars($feedback['Comment']) ?></p>
                                                <small class="text-muted"><?= date('M j, Y', strtotime($feedback['CreatedAt'])) ?></small>
                                            </div>
                                        <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <div class="alert alert-info py-1">No feedback yet. Be the first to review!</div>
                                    <?php endif; ?>

                                    <?php if (is_logged_in()): ?>
                                        <form method="POST" action="./actions/submit_feedback.php" class="mt-2">
                                            <input type="hidden" name="place_id" value="<?= $place['Id'] ?>">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                                            <div class="mb-2">
                                                <label class="form-label">Your Rating:</label>
                                                <div class="rating-input">
                                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                                        <input type="radio" id="rating-<?= $place['Id'] ?>-<?= $i ?>"
                                                            name="rating" value="<?= $i ?>" required>
                                                        <label for="rating-<?= $place['Id'] ?>-<?= $i ?>"><i class="fas fa-star"></i></label>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <textarea name="comment"
                                                    class="form-control form-control-sm"
                                                    placeholder="Write your feedback..."
                                                    rows="2"
                                                    required></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                                Submit Feedback
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <div class="alert alert-warning py-1 mt-2">
                                            <a href="login.php" class="text-decoration-none">Login</a> to leave feedback
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Add to My Trip Button -->
                                <?php if (is_logged_in()): ?>
                                    <form method="POST" action="./actions/add_trip.php" class="mt-2">
                                        <input type="hidden" name="place_id" value="<?= $place['Id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-success w-100">
                                            <i class="fas fa-plus-circle"></i> Add to My Trip
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
        </div>

        <div class="text-center mt-5">
            <a href="./pages/all_places.php" class="btn btn-primary px-5">View All Destinations</a>
        </div>

    <?php
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger text-center">Error loading featured destinations. Please try again later.</div>';
            }
    ?>
    </section>




    <section class="about-section my-5 py-5">
    <div class="row align-items-center">
        <!-- Map Section -->
        <div class="col-md-6">
            <div id="map" style="height: 400px; border-radius: 10px;"></div>
            <p class="mt-3"><strong>Crowd Status: </strong><span id="crowd-status">Loading...</span></p>
        </div>

        <!-- About Dhofar Content -->
        <div class="col-md-6">
            <h2>About Dhofar</h2>
            <p class="lead">
                Discover the unique blend of natural beauty and cultural heritage in Oman's southernmost region.
            </p>
            <p>
                From lush green mountains during the Khareef season to pristine beaches and ancient historical sites,
                Dhofar offers a diverse range of experiences for every traveler.
            </p>
            <a href="/pages/about.php" class="btn btn-outline-primary">Learn More</a>
        </div>
    </div>
</section>

<!-- Google Maps API & JavaScript -->
<script>
    function initMap() {
        var dhofar = { lat: 17.0174, lng: 54.0829 }; // Coordinates for Dhofar
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: dhofar
        });

        var marker = new google.maps.Marker({
            position: dhofar,
            map: map,
            title: "Dhofar, Oman"
        });

        getCrowdStatus();
    }

    function getCrowdStatus() {
        var crowdStatusElement = document.getElementById('crowd-status');

        if (!crowdStatusElement) {
            console.error("Element #crowd-status not found!");
            return;
        }

        // Simulated API call (Google Popular Times API requires scraping workaround)
        setTimeout(() => {
            let status = ["Not Crowded", "Moderate", "Very Crowded"];
            let randomStatus = status[Math.floor(Math.random() * status.length)];
            crowdStatusElement.innerText = randomStatus;
        }, 2000);
    }
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap">
</script>

</main>

<?php include __DIR__ . './includes/footer.php'; ?>
</body>
</html>