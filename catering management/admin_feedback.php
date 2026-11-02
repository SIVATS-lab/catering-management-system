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
    $stmt = $conn->prepare("DELETE FROM inquiries WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_feedback.php");
    exit();
}

// Fetch inquiries
$sql = "SELECT * FROM inquiries ORDER BY created_at DESC";
$result = $conn->query($sql);
$inquiries = [];
while ($row = $result->fetch_assoc()) {
    $inquiries[] = $row;
}

$page_title = 'Feedback & Inquiries';
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
        .inquiry-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
    </style>

    <div class="container admin-container">
        <div class="header-graphic">
            <div class="header-content">
                <h1><i class="fas fa-comments me-2"></i>Feedback & Inquiries</h1>
                <p class="mb-0">Manage and respond to customer messages and inquiries</p>
            </div>
            <div class="header-icon">
                <i class="fas fa-comments"></i>
            </div>
        </div>


        <?php if (empty($inquiries)): ?>
            <div style="text-align: center; padding: 3rem; background: white; border-radius: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <i class="fas fa-inbox" style="font-size: 4rem; margin-bottom: 1rem; display: block; opacity: 0.2;"></i>
                <h3 style="color: #999;">No Inquiries Yet</h3>
                <p style="color: #ccc;">All customer messages will appear here</p>
            </div>
        <?php else: ?>
            <div style="display: grid; gap: 1.5rem;">
                <?php foreach ($inquiries as $inquiry): ?>
                    <div class="inquiry-card-enhanced">
                        <div class="inquiry-header">
                            <div>
                                <div class="inquiry-name"><?php echo htmlspecialchars($inquiry['name']); ?></div>
                                <div class="inquiry-meta">
                                    <div class="inquiry-meta-item"><i class="fas fa-envelope me-1"></i><a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>"><?php echo htmlspecialchars($inquiry['email']); ?></a></div>
                                    <div class="inquiry-meta-item"><i class="fas fa-calendar me-1"></i><?php echo date('M j, Y g:i A', strtotime($inquiry['created_at'])); ?></div>
                                </div>
                            </div>
                            <div class="inquiry-id">#<?php echo $inquiry['id']; ?></div>
                        </div>
                        <div class="inquiry-message"><?php echo htmlspecialchars($inquiry['message']); ?></div>
                        <div class="inquiry-actions">
                            <button class="btn btn-sm btn-view" onclick="viewInquiry(<?php echo $inquiry['id']; ?>)" data-bs-toggle="modal" data-bs-target="#inquiryModal">
                                <i class="fas fa-eye me-1"></i>Full Details
                            </button>
                            <a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>" class="btn btn-sm" style="background-color: #28a745; color: white; border: none;">
                                <i class="fas fa-reply me-1"></i>Reply
                            </a>
                            <a href="admin_feedback.php?delete=<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Inquiry Modal -->
    <div class="modal fade" id="inquiryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inquiry Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="inquiryDetails">
                    <!-- Details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="replyEmailBtn" href="#" class="btn btn-primary" target="_blank">
                        <i class="fas fa-mail-bulk me-1"></i>Reply via Email
                    </a>
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
    <script>
        const inquiriesData = <?php echo json_encode($inquiries); ?>;

        function viewInquiry(id) {
            const inquiry = inquiriesData.find(i => i.id == id);
            if (inquiry) {
                const html = `
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Name</h6>
                        <p class="mb-3"><strong>${inquiry.name}</strong></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Email</h6>
                        <p class="mb-3"><strong>${inquiry.email}</strong></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Date</h6>
                        <p class="mb-3"><strong>${new Date(inquiry.created_at).toLocaleString()}</strong></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Message</h6>
                        <p>${inquiry.message}</p>
                    </div>
                `;
                document.getElementById('inquiryDetails').innerHTML = html;
                document.getElementById('replyEmailBtn').href = `mailto:${inquiry.email}`;
            }
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
