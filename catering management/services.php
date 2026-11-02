<?php
$page_title = "Services";
include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['services_heading']); ?></h1>
            <p class="lead mb-0 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['services_subtitle']); ?></p>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">What We Offer</h2>
                <p class="lead text-muted animate-on-scroll">From intimate gatherings to grand celebrations, we have you covered</p>
            </div>

            <!-- Wedding Catering -->
            <div id="wedding" class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4">
                    <div class="animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Wedding Catering" class="img-fluid rounded shadow">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="animate-on-scroll">
                        <h3 class="display-6 fw-bold mb-3">Wedding Catering</h3>
                        <p class="lead mb-3">Make your special day truly magical with our bespoke wedding catering services.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom menu design based on your preferences</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Professional service staff and coordination</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Elegant presentation and setup</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dietary accommodation and tasting sessions</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Complete event management support</li>
                        </ul>
                        <a href="booking.php" class="btn btn-primary btn-lg">Plan Your Wedding</a>
                    </div>
                </div>
            </div>

            <!-- Corporate Events -->
            <div id="corporate" class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-4">
                    <div class="animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Corporate Events" class="img-fluid rounded shadow">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="animate-on-scroll">
                        <h3 class="display-6 fw-bold mb-3">Corporate Events</h3>
                        <p class="lead mb-3">Elevate your business gatherings with sophisticated catering that impresses.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Professional presentation and service</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Flexible menu options for any budget</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>On-site coordination and setup</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dietary restrictions accommodated</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Quick service for time-sensitive events</li>
                        </ul>
                        <a href="booking.php" class="btn btn-primary btn-lg">Book Corporate Event</a>
                    </div>
                </div>
            </div>

            <!-- Private Parties -->
            <div id="private" class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4">
                    <div class="animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Private Parties" class="img-fluid rounded shadow">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="animate-on-scroll">
                        <h3 class="display-6 fw-bold mb-3">Private Parties</h3>
                        <p class="lead mb-3">Celebrate life's special moments with personalized catering that reflects your style.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Customized menus for any theme</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Flexible party sizes and budgets</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Creative presentation and theming</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Complete setup and cleanup service</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Experienced event coordination</li>
                        </ul>
                        <a href="booking.php" class="btn btn-primary btn-lg">Plan Your Party</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Services -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Additional Services</h2>
                <p class="lead text-muted animate-on-scroll">Everything you need for a complete catering experience</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4 class="mb-3">Menu Planning</h4>
                        <p class="text-muted">Collaborative menu design with our culinary experts to create the perfect dining experience.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h4 class="mb-3">Staff & Service</h4>
                        <p class="text-muted">Professional servers, bartenders, and event coordinators for seamless execution.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h4 class="mb-3">Equipment & Rentals</h4>
                        <p class="text-muted">Complete setup including tables, chairs, linens, china, glassware, and serving equipment.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <h4 class="mb-3">Dessert & Cake Service</h4>
                        <p class="text-muted">Beautiful custom cakes and an array of dessert options for every palate.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-glass-cheers"></i>
                        </div>
                        <h4 class="mb-3">Beverage Service</h4>
                        <p class="text-muted">Full bar service, wine selection, and non-alcoholic beverage options.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-broom"></i>
                        </div>
                        <h4 class="mb-3">Cleanup & Breakdown</h4>
                        <p class="text-muted">Complete post-event cleanup and breakdown service for your peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Pricing Packages</h2>
                <p class="lead text-muted animate-on-scroll">Flexible pricing options to fit your budget and needs</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="mb-3">
                            <h3 class="display-4 fw-bold text-primary">$75</h3>
                            <p class="text-muted">per person</p>
                        </div>
                        <h4 class="mb-3">Basic Package</h4>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Appetizers & Main Course</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Non-alcoholic beverages</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Basic service staff</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Standard setup</li>
                        </ul>
                        <a href="booking.php" class="btn btn-primary">Select Package</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll border-primary border-2">
                        <div class="mb-3">
                            <span class="badge bg-primary mb-2">Most Popular</span>
                            <h3 class="display-4 fw-bold text-primary">$125</h3>
                            <p class="text-muted">per person</p>
                        </div>
                        <h4 class="mb-3">Premium Package</h4>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Everything in Basic</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dessert & coffee service</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Full bar service</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Premium service staff</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Elegant presentation</li>
                        </ul>
                        <a href="booking.php" class="btn btn-primary">Select Package</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="mb-3">
                            <h3 class="display-4 fw-bold text-primary">$200+</h3>
                            <p class="text-muted">per person</p>
                        </div>
                        <h4 class="mb-3">Luxury Package</h4>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Everything in Premium</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom menu design</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Premium wine selection</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dedicated event coordinator</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Luxury presentation</li>
                        </ul>
                        <a href="booking.php" class="btn btn-primary">Select Package</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>