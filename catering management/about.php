<?php
$page_title = "About Us";
include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['about_heading']); ?></h1>
            <p class="lead mb-0 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['about_subtitle']); ?></p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 class="display-5 fw-bold mb-4 animate-on-scroll">Our Story</h2>
                    <p class="lead mb-4 animate-on-scroll">Founded in 2009, Catering Pro began as a small family business with a big dream: to create extraordinary dining experiences that bring people together.</p>
                    <p class="mb-4 animate-on-scroll">What started as intimate dinner parties has evolved into a full-service catering company serving hundreds of events annually. Our commitment to quality, creativity, and customer satisfaction has made us the premier choice for discerning clients.</p>
                    <p class="animate-on-scroll">Today, we continue to innovate while staying true to our roots - using the finest ingredients, employing skilled artisans, and treating every event as if it were our own celebration.</p>
                </div>
                <div class="col-lg-6">
                    <div class="animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Kitchen" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Our Values</h2>
                <p class="lead text-muted animate-on-scroll">The principles that guide everything we do</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4 class="mb-3">Quality</h4>
                        <p class="text-muted">We never compromise on the quality of our ingredients or our service.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="mb-3">Passion</h4>
                        <p class="text-muted">Food is our passion, and we bring that enthusiasm to every event.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-3">Community</h4>
                        <p class="text-muted">We believe in supporting local farmers and building lasting relationships.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 class="mb-3">Excellence</h4>
                        <p class="text-muted">We strive for perfection in every dish and every detail.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Meet Our Team</h2>
                <p class="lead text-muted animate-on-scroll">The culinary artists behind your perfect event</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Chef Maria" class="rounded-circle mb-3" width="200" height="200">
                        <h4>Maria Rodriguez</h4>
                        <p class="text-muted mb-2">Executive Chef</p>
                        <p>With 20+ years of experience, Maria leads our culinary team with creativity and precision.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Chef David" class="rounded-circle mb-3" width="200" height="200">
                        <h4>David Chen</h4>
                        <p class="text-muted mb-2">Pastry Chef</p>
                        <p>David's artistic desserts have won numerous awards and delighted countless guests.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="text-center animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Chef Sarah" class="rounded-circle mb-3" width="200" height="200">
                        <h4>Sarah Johnson</h4>
                        <p class="text-muted mb-2">Event Coordinator</p>
                        <p>Sarah ensures every detail is perfect, from menu planning to flawless execution.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">15+</div>
                    <p class="mb-0">Years of Excellence</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">500+</div>
                    <p class="mb-0">Events Catered</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">10K+</div>
                    <p class="mb-0">Happy Customers</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">50+</div>
                    <p class="mb-0">Team Members</p>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>