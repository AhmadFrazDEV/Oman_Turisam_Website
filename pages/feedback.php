<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal<?= $place['Id'] ?>" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Give Feedback for <?= htmlspecialchars($place['Place']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="./actions/submit_feedback.php">
                            <div class="modal-body">
                                <input type="hidden" name="place_id" value="<?= $place['Id'] ?>">
                                <div class="mb-3">
                                    <label for="stars" class="form-label">Rating (1-5 Stars)</label>
                                    <select class="form-select" name="stars" required>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="feedback" class="form-label">Your Feedback</label>
                                    <textarea class="form-control" name="feedback" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>