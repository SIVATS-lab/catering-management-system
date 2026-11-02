<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php?type=admin");
    exit();
}
include 'db.php';
include_once __DIR__ . '/site_settings.php';
$siteSettings = get_site_settings();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_users.php");
    exit();
}

// Fetch users
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$page_title = 'Manage Users';
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
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--accent-color);
            color: white;
            font-weight: 700;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="container admin-container">
        <div class="header-graphic">
            <div class="header-content">
                <h1><i class="fas fa-users me-2"></i>Manage Users</h1>
                <p class="mb-0">View and manage all registered customer accounts</p>
            </div>
            <div class="header-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><strong>#<?php echo $user['id']; ?></strong></td>
                            <td>
                                <div class="user-info">
                                    <div class="avatar"><?php echo strtoupper(substr($user['name'], 0, 1)); ?></div>
                                    <span><?php echo htmlspecialchars($user['name']); ?></span>
                                </div>
                            </td>
                            <td><a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"><?php echo htmlspecialchars($user['email']); ?></a></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td><?php echo htmlspecialchars(substr($user['address'], 0, 40)); ?>...</td>
                            <td><span class="date-badge"><?php echo date('M j, Y', strtotime($user['created_at'])); ?></span></td>
                            <td>
                                <button class="btn btn-sm btn-view" onclick="viewUserDetails(<?php echo $user['id']; ?>)" data-bs-toggle="modal" data-bs-target="#userModal">
                                    <i class="fas fa-eye me-1"></i>Details
                                </button>
                                <a href="manage_users.php?delete=<?php echo $user['id']; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for user details -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="userDetails">
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
                        <li><a href="admin_reports.php" class="text-white text-decoration-none">Reports</a></li>
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
        function viewUserDetails(userId) {
            $.get('get_user_details.php', { id: userId }, function(data) {
                $('#userDetails').html(data);
                $('#userModal').modal('show');
            });
        }
    </script>
</body>
    <script>
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