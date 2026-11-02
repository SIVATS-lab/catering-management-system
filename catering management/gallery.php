<?php
$page_title = "Gallery";
include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll">Our Gallery</h1>
            <p class="lead mb-0 animate-on-scroll">A feast for the eyes - showcasing our culinary artistry</p>
        </div>
    </section>

    <!-- Gallery Filter -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Culinary Creations</h2>
                <p class="lead text-muted animate-on-scroll">Explore our diverse menu offerings and presentation styles</p>
            </div>

            <!-- Filter Buttons -->
            <div class="d-flex justify-content-center mb-4 animate-on-scroll">
                <button class="btn btn-outline-primary me-2 active" onclick="filterGallery('all')">All</button>
                <button class="btn btn-outline-primary me-2" onclick="filterGallery('appetizers')">Appetizers</button>
                <button class="btn btn-outline-primary me-2" onclick="filterGallery('mains')">Main Courses</button>
                <button class="btn btn-outline-primary me-2" onclick="filterGallery('desserts')">Desserts</button>
                <button class="btn btn-outline-primary" onclick="filterGallery('events')">Events</button>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4" id="galleryGrid">
                <!-- Appetizers -->
                <div class="col-lg-4 col-md-6 gallery-item appetizers">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Bruschetta" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Artisan Bruschetta</h5>
                            <p>Toasted bread with fresh tomatoes, basil, and balsamic glaze</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item appetizers">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Stuffed Mushrooms" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Stuffed Mushrooms</h5>
                            <p>Button mushrooms filled with herbs, cheese, and breadcrumbs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item appetizers">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1551782450-17144efb5723?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Shrimp Cocktail" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Chilled Shrimp Cocktail</h5>
                            <p>Fresh shrimp with cocktail sauce and lemon wedges</p>
                        </div>
                    </div>
                </div>

                <!-- Main Courses -->
                <div class="col-lg-4 col-md-6 gallery-item mains">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1546833999-b9f581a1996d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Grilled Salmon" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Herb-Crusted Salmon</h5>
                            <p>Atlantic salmon with lemon herb crust and seasonal vegetables</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item mains">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1558030006-450675393462?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Beef Wellington" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Classic Beef Wellington</h5>
                            <p>Tender beef wrapped in puff pastry with mushroom duxelles</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item mains">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1565299507177-b0ac66763828?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Chicken Marsala" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Chicken Marsala</h5>
                            <p>Pan-seared chicken breast in Marsala wine sauce with mushrooms</p>
                        </div>
                    </div>
                </div>

                <!-- Desserts -->
                <div class="col-lg-4 col-md-6 gallery-item desserts">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Tiramisu" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Classic Tiramisu</h5>
                            <p>Layers of coffee-soaked ladyfingers and mascarpone cream</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item desserts">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Chocolate Cake" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Decadent Chocolate Cake</h5>
                            <p>Rich chocolate layers with ganache and fresh berries</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item desserts">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Fruit Tart" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Fresh Fruit Tart</h5>
                            <p>Buttery pastry crust with custard and seasonal fruits</p>
                        </div>
                    </div>
                </div>

                <!-- Events -->
                <div class="col-lg-4 col-md-6 gallery-item events">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Wedding Reception" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Wedding Reception</h5>
                            <p>Elegant setup for a memorable celebration</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item events">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Corporate Event" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Corporate Dinner</h5>
                            <p>Professional catering for business gatherings</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item events">
                    <div class="gallery-card animate-on-scroll">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Birthday Party" class="img-fluid rounded">
                        <div class="gallery-overlay">
                            <h5>Birthday Celebration</h5>
                            <p>Joyful atmosphere with delicious catering</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4 animate-on-scroll">Inspired by Our Creations?</h2>
            <p class="lead mb-4 animate-on-scroll">Let us bring this level of culinary artistry to your next event.</p>
            <div class="animate-on-scroll">
                <a href="booking.php" class="btn btn-light btn-lg me-3 px-4 py-3">
                    <i class="fas fa-calendar-check me-2"></i>Book Your Event
                </a>
                <a href="contact.php" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="fas fa-phone me-2"></i>Contact Us
                </a>
            </div>
        </div>
    </section>

    <style>
        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .gallery-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .gallery-card:hover .gallery-overlay {
            transform: translateY(0);
        }

        .gallery-item {
            display: none;
        }

        .gallery-item.show {
            display: block;
        }
    </style>

    <script>
        function filterGallery(category) {
            // Update active button
            document.querySelectorAll('.btn-outline-primary').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Filter items
            const items = document.querySelectorAll('.gallery-item');
            items.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.classList.add('show');
                } else {
                    item.classList.remove('show');
                }
            });
        }

        // Show all items initially
        document.addEventListener('DOMContentLoaded', function() {
            filterGallery('all');
        });
    </script>

<?php include 'footer.php'; ?>