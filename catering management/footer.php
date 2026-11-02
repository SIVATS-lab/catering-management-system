    <!-- Footer -->
    <?php include_once __DIR__ . '/site_settings.php'; $siteSettings = get_site_settings(); ?>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3"><?php echo htmlspecialchars($siteSettings['site_name']); ?></h5>
                    <p><?php echo htmlspecialchars($siteSettings['site_tagline']); ?></p>
                    <div class="social-links">
                        <a href="<?php echo htmlspecialchars($siteSettings['social_facebook']); ?>"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo htmlspecialchars($siteSettings['social_instagram']); ?>"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo htmlspecialchars($siteSettings['social_twitter']); ?>"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo htmlspecialchars($siteSettings['social_youtube']); ?>"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="services.php" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="gallery.php" class="text-white text-decoration-none">Gallery</a></li>
                        <li><a href="testimonials.php" class="text-white text-decoration-none">Testimonials</a></li>
                        <li><a href="contact.php" class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="faq.php" class="text-white text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Services</h6>
                    <ul class="list-unstyled">
                        <li><a href="services.php#wedding" class="text-white text-decoration-none">Wedding Catering</a></li>
                        <li><a href="services.php#corporate" class="text-white text-decoration-none">Corporate Events</a></li>
                        <li><a href="services.php#private" class="text-white text-decoration-none">Private Parties</a></li>
                        <li><a href="services.php#catering" class="text-white text-decoration-none">Custom Catering</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6>Contact Info</h6>
                    <p><i class="fas fa-map-marker-alt me-2"></i><?php echo htmlspecialchars($siteSettings['contact_address']); ?></p>
                    <p><i class="fas fa-phone me-2"></i><?php echo htmlspecialchars($siteSettings['contact_phone']); ?></p>
                    <p><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($siteSettings['contact_email']); ?></p>
                    <p><i class="fas fa-clock me-2"></i><?php echo htmlspecialchars($siteSettings['contact_hours']); ?></p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 Catering Pro. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="privacy.php" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="terms.php" class="text-white text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Animate on scroll
        $(window).on('scroll', function() {
            $('.animate-on-scroll').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animate');
                }
            });
        });

        // Initialize animations on page load
        $(document).ready(function() {
            $('.animate-on-scroll').each(function() {
                var elementTop = $(this).offset().top;
                var viewportBottom = $(window).scrollTop() + $(window).height();

                if (elementTop < viewportBottom) {
                    $(this).addClass('animate');
                }
            });
        });
    </script>
</body>
</html>