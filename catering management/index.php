<?php
session_start();
$page_title = "Home";
include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['hero_title']); ?></h1>
            <p class="lead mb-5 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['hero_subtitle']); ?></p>
            <div class="animate-on-scroll">
                <a href="booking.php" class="btn btn-light btn-lg me-3 px-4 py-3">
                    <i class="fas fa-calendar-check me-2"></i>Book Your Event
                </a>
                <a href="services.php" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="fas fa-utensils me-2"></i>Explore Services
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">500+</div>
                    <p class="text-muted mb-0">Events Catered</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">10K+</div>
                    <p class="text-muted mb-0">Happy Customers</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">50+</div>
                    <p class="text-muted mb-0">Expert Chefs</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-counter animate-on-scroll">15+</div>
                    <p class="text-muted mb-0">Years Experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Our Signature Services</h2>
                <p class="lead text-muted animate-on-scroll">Tailored catering solutions for every occasion</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="mb-3">Wedding Catering</h4>
                        <p class="text-muted">Make your special day unforgettable with our exquisite wedding catering services, featuring custom menus and impeccable service.</p>
                        <a href="services.php#wedding" class="btn btn-primary mt-3">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4 class="mb-3">Corporate Events</h4>
                        <p class="text-muted">Impress clients and colleagues with professional catering that combines culinary excellence with business sophistication.</p>
                        <a href="services.php#corporate" class="btn btn-primary mt-3">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card h-100 text-center p-4 animate-on-scroll">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-3">Private Parties</h4>
                        <p class="text-muted">Celebrate life's special moments with intimate, personalized catering that reflects your unique style and preferences.</p>
                        <a href="services.php#private" class="btn btn-primary mt-3">Learn More</a>
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

    <!-- Testimonials -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">What Our Clients Say</h2>
                <p class="lead text-muted animate-on-scroll">Don't just take our word for it</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card animate-on-scroll">
                        <div class="d-flex mb-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Client" class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Wedding Client</small>
                            </div>
                        </div>
                        <p class="mb-0">"Catering Pro made our wedding day absolutely perfect. The food was incredible, the service was impeccable, and our guests are still talking about it!"</p>
                        <div class="mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card animate-on-scroll">
                        <div class="d-flex mb-3">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Client" class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">Corporate Client</small>
                            </div>
                        </div>
                        <p class="mb-0">"For our company retreat, Catering Pro delivered exceptional quality and professionalism. The team was flexible and accommodated all our dietary requirements."</p>
                        <div class="mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card animate-on-scroll">
                        <div class="d-flex mb-3">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Client" class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h6 class="mb-0">Emily Rodriguez</h6>
                                <small class="text-muted">Private Party</small>
                            </div>
                        </div>
                        <p class="mb-0">"Our family reunion was a huge success thanks to Catering Pro. The food was delicious, the presentation was beautiful, and the cleanup was handled perfectly."</p>
                        <div class="mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--secondary-color), var(--accent-color)); color: white;">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4 animate-on-scroll">Ready to Create Something Amazing?</h2>
            <p class="lead mb-4 animate-on-scroll">Let us handle the catering so you can focus on what matters most - creating memories.</p>
            <div class="animate-on-scroll">
                <a href="booking.php" class="btn btn-light btn-lg me-3 px-4 py-3">
                    <i class="fas fa-calendar-check me-2"></i>Start Planning
                </a>
                <a href="contact.php" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="fas fa-phone me-2"></i>Get in Touch
                </a>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>