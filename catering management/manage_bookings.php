<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php?type=admin");
    exit();
}
include 'db.php';
include_once __DIR__ . '/site_settings.php';
$siteSettings = get_site_settings();

// Handle status update
if (isset($_POST['update_status'])) {
    $booking_id = (int)$_POST['booking_id'];
    $status = trim($_POST['status']);
    
    // Validate status
    $valid_statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
    if (in_array($status, $valid_statuses)) {
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $booking_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch bookings
$sql = "SELECT b.*, u.name as user_name FROM bookings b JOIN users u ON b.user_id = u.id ORDER BY b.created_at DESC";
$result = $conn->query($sql);
$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

$page_title = 'Manage Bookings';
$isAdminPage = true;
include 'header.php';
?>
    <style>
        .admin-container {
            padding: 2rem 0;
        }
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
        }
        .page-header h1 {
            font-weight: 700;
            font-size: 2rem;
        }
        .table thead {
            background-color: var(--accent-color);
            color: white;
        }
        .badge-pending { background-color: #ffc107; }
        .badge-confirmed { background-color: #28a745; }
        .badge-completed { background-color: var(--primary-color); }
        .badge-cancelled { background-color: #dc3545; }
    </style>
</head>
<body>

    <div class="container admin-container">
        <div class="header-graphic">
            <div class="header-content">
                <h1><i class="fas fa-calendar me-2"></i>Manage Bookings</h1>
                <p class="mb-0">View and manage all customer event bookings</p>
            </div>
            <div class="header-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Event Date</th>
                        <th>Event Type</th>
                        <th>Guests</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><strong>#<?php echo $booking['id']; ?></strong></td>
                            <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                            <td><?php echo date('M j, Y', strtotime($booking['event_date'])); ?></td>
                            <td><?php echo htmlspecialchars($booking['event_type']); ?></td>
                            <td><span class="badge bg-info"><?php echo $booking['guests']; ?> guests</span></td>
                            <td><strong>$<?php echo number_format($booking['total_price'], 2); ?></strong></td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                    <select name="status" class="form-select form-select-sm d-inline w-auto badge badge-<?php echo $booking['status']; ?>" onchange="this.form.submit()">
                                        <option value="pending" <?php if ($booking['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                        <option value="confirmed" <?php if ($booking['status'] == 'confirmed') echo 'selected'; ?>>Confirmed</option>
                                        <option value="completed" <?php if ($booking['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                        <option value="cancelled" <?php if ($booking['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-view" onclick="viewDetails(<?php echo $booking['id']; ?>)" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <i class="fas fa-eye me-1"></i>Details
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for booking details -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="bookingDetails">
                    <!-- Details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Catering Pro</h5>
                    <p>Professional catering services for all your special occasions. We bring culinary excellence to your events with passion and precision.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="services.php" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="contact.php" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Admin Pages</h6>
                    <ul class="list-unstyled">
                        <li><a href="admin_dashboard.php" class="text-white text-decoration-none">Dashboard</a></li>
                        <li><a href="manage_bookings.php" class="text-white text-decoration-none">Bookings</a></li>
                        <li><a href="manage_menu.php" class="text-white text-decoration-none">Menu</a></li>
                        <li><a href="manage_users.php" class="text-white text-decoration-none">Users</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6>Contact Info</h6>
                    <p><i class="fas fa-map-marker-alt me-2"></i>123 Culinary Street, Food City, FC 12345</p>
                    <p><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope me-2"></i>info@cateringpro.com</p>
                    <p><i class="fas fa-clock me-2"></i>Mon-Sun: 6AM - 10PM</p>
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
        function viewDetails(bookingId) {
            $.get('get_booking_details.php', { id: bookingId }, function(data) {
                $('#bookingDetails').html(data);
                $('#bookingModal').modal('show');
            });
        }

        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const savedTheme = localStorage.getItem('cateringTheme') || 'light';

        function setTheme(theme) {
            const html = document.documentElement;
            if (theme === 'dark') {
                html.classList.add('dark-mode');
                if (themeToggleBtn) {
                    themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
                }
            } else {
                html.classList.remove('dark-mode');
                if (themeToggleBtn) {
                    themeToggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
                }
            }
            localStorage.setItem('cateringTheme', theme);
        }

        document.addEventListener('DOMContentLoaded', function() {
            setTheme(savedTheme);
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function() {
                    const currentTheme = document.documentElement.classList.contains('dark-mode') ? 'dark' : 'light';
                    setTheme(currentTheme === 'dark' ? 'light' : 'dark');
                });
            }
        });
    </script>
</body>
<?php
include 'footer.php';
?>
