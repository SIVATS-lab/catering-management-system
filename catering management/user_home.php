<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$page_title = "User Home";
include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll">Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <p class="lead mb-5 animate-on-scroll">Manage your catering needs and explore our services from your personalized dashboard.</p>
        </div>
    </section>

    <!-- Dashboard Images Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <h3 class="text-center mb-4">Your Dashboard Preview</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" class="card-img-top" alt="Dashboard Image 1">
                        <div class="card-body">
                            <h5 class="card-title">Event Overview</h5>
                            <p class="card-text">Quick snapshot of your booked events and upcoming schedules.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80" class="card-img-top" alt="Dashboard Image 2">
                        <div class="card-body">
                            <h5 class="card-title">Menu Selection</h5>
                            <p class="card-text">Instant access to menu categories and popular items you chose recently.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Actions Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Quick Actions</h2>
                <p class="lead text-muted animate-on-scroll">Access your favorite features and manage your bookings</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4 class="mb-3">Menu</h4>
                        <p class="text-muted">Explore our delicious catering menu options.</p>
                        <a href="services.php" class="btn btn-primary mt-3">View Menu</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4 class="mb-3">Book Now</h4>
                        <p class="text-muted">Reserve your catering service for your next event.</p>
                        <a href="booking.php" class="btn btn-primary mt-3">Book Event</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <h4 class="mb-3">My Bookings</h4>
                        <p class="text-muted">View and manage your current and past bookings.</p>
                        <a href="view_booking.php" class="btn btn-primary mt-3">View Bookings</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <h4 class="mb-3">Services</h4>
                        <p class="text-muted">Learn more about our catering services and packages.</p>
                        <a href="services.php" class="btn btn-primary mt-3">Explore Services</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <h4 class="mb-3">Logout</h4>
                        <p class="text-muted">Securely log out of your account.</p>
                        <a href="logout.php" class="btn btn-primary mt-3">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 class="display-5 fw-bold mb-4 animate-on-scroll">Why Choose Catering Pro?</h2>
                    <div class="mb-4 animate-on-scroll">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Fresh, Local Ingredients</h5>
                                <p class="text-muted mb-0">We source the finest seasonal ingredients from local farmers and suppliers.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Experienced Culinary Team</h5>
                                <p class="text-muted mb-0">Our chefs bring decades of experience and culinary innovation to every event.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Customizable Menus</h5>
                                <p class="text-muted mb-0">Work with our team to create a menu that perfectly matches your vision and dietary needs.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Flawless Execution</h5>
                                <p class="text-muted mb-0">From planning to cleanup, we handle every detail with precision and professionalism.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Catering Service" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>