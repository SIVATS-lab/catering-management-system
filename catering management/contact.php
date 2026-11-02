<?php
$page_title = "Contact Us";
include 'header.php';

// Handle form submission
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message_content = trim($_POST['message'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($message_content)) {
        $message = 'Please fill in all required fields.';
        $message_type = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $message_type = 'error';
    } else {
        // In a real application, you would send an email here
        // For now, we'll just show a success message
        $message = 'Thank you for your message! We\'ll get back to you within 24 hours.';
        $message_type = 'success';
    }
}
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['contact_heading']); ?></h1>
            <p class="lead mb-0 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['contact_subtitle']); ?></p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-6">
                    <div class="animate-on-scroll">
                        <h2 class="h1 mb-4">Let's Talk</h2>
                        <p class="lead mb-5">Ready to make your event unforgettable? Contact us today for a free consultation and quote.</p>

                        <div class="contact-info">
                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Phone</h5>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($siteSettings['contact_phone']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Email</h5>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($siteSettings['contact_email']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Address</h5>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($siteSettings['contact_address']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Business Hours</h5>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($siteSettings['contact_hours']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="mt-5">
                            <h5 class="mb-3">Follow Us</h5>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact-form-card animate-on-scroll">
                        <h3 class="mb-4">Send us a Message</h3>

                        <?php if ($message): ?>
                            <div class="alert alert-<?php echo $message_type === 'success' ? 'success' : 'danger'; ?> mb-4">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                           value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subject</label>
                                    <select class="form-select" id="subject" name="subject">
                                        <option value="">Select Subject</option>
                                        <option value="wedding" <?php echo ($_POST['subject'] ?? '') === 'wedding' ? 'selected' : ''; ?>>Wedding Catering</option>
                                        <option value="corporate" <?php echo ($_POST['subject'] ?? '') === 'corporate' ? 'selected' : ''; ?>>Corporate Event</option>
                                        <option value="private" <?php echo ($_POST['subject'] ?? '') === 'private' ? 'selected' : ''; ?>>Private Party</option>
                                        <option value="consultation" <?php echo ($_POST['subject'] ?? '') === 'consultation' ? 'selected' : ''; ?>>General Consultation</option>
                                        <option value="other" <?php echo ($_POST['subject'] ?? '') === 'other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="6" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="animate-on-scroll">
                        <h2 class="h1 text-center mb-5">Find Us</h2>
                        <div class="map-container">
                            <!-- In a real application, you would embed a Google Map here -->
                            <div class="map-placeholder">
                                <div class="text-center py-5">
                                    <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
                                    <h4>Interactive Map</h4>
                                    <p class="text-muted">123 Culinary Street, Food District, NY 10001</p>
                                    <a href="https://maps.google.com" target="_blank" class="btn btn-primary">
                                        <i class="fas fa-external-link-alt me-2"></i>View on Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center mb-5 animate-on-scroll">
                        <h2 class="h1 mb-4">Frequently Asked Questions</h2>
                        <p class="lead">Quick answers to common questions</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="faq-item animate-on-scroll">
                        <h5>How far in advance should I book?</h5>
                        <p>We recommend booking at least 2-3 weeks in advance for small events and 4-6 weeks for larger events to ensure availability.</p>
                    </div>
                    <div class="faq-item animate-on-scroll">
                        <h5>Do you cater to dietary restrictions?</h5>
                        <p>Absolutely! We accommodate all dietary needs including vegetarian, vegan, gluten-free, and allergies. Please let us know in advance.</p>
                    </div>
                    <div class="faq-item animate-on-scroll">
                        <h5>What is your service area?</h5>
                        <p>We serve the greater metropolitan area and surrounding regions. Additional travel fees may apply for locations outside our primary service area.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-item animate-on-scroll">
                        <h5>Do you provide setup and cleanup?</h5>
                        <p>Yes, our service includes full setup, service during your event, and complete cleanup afterward.</p>
                    </div>
                    <div class="faq-item animate-on-scroll">
                        <h5>Can I taste the food before booking?</h5>
                        <p>We offer complimentary tastings for events over $2,000. For smaller events, we can arrange virtual tastings or provide detailed menu descriptions.</p>
                    </div>
                    <div class="faq-item animate-on-scroll">
                        <h5>What is your cancellation policy?</h5>
                        <p>We require 48 hours notice for cancellations. Cancellations within 24 hours may incur a service fee. Please see our full terms for details.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>