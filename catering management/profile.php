<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$page_title = "My Profile";
include 'db.php';
include 'header.php';

// Get user information
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: login.php');
    exit;
}

// Handle profile update
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate required fields
    if (empty($name) || empty($email)) {
        $message = 'Please fill in all required fields.';
        $message_type = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $message_type = 'error';
    } else {
        // Check if email is already taken by another user
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->bind_param("si", $email, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $message = 'Email address is already in use.';
            $message_type = 'error';
        } else {
            // Update profile
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);
            $stmt->execute();
            $stmt->close();

            // Update password if provided
            if (!empty($current_password) && !empty($new_password)) {
                if (!password_verify($current_password, $user['password'])) {
                    $message = 'Current password is incorrect.';
                    $message_type = 'error';
                } elseif (strlen($new_password) < 6) {
                    $message = 'New password must be at least 6 characters long.';
                    $message_type = 'error';
                } elseif ($new_password !== $confirm_password) {
                    $message = 'New passwords do not match.';
                    $message_type = 'error';
                } else {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $stmt->bind_param("si", $hashed_password, $user_id);
                    $stmt->execute();
                    $stmt->close();
                    $message = 'Profile updated successfully!';
                    $message_type = 'success';
                }
            } else {
                $message = 'Profile updated successfully!';
                $message_type = 'success';
            }

            // Refresh user data
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
        }
    }
}

// Get user's bookings
$stmt = $conn->prepare("
    SELECT b.* 
    FROM bookings b
    WHERE b.user_id = ?
    ORDER BY b.created_at DESC
    LIMIT 5
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$recent_bookings = [];
while ($row = $result->fetch_assoc()) {
    $recent_bookings[] = $row;
}
$stmt->close();
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll">My Profile</h1>
            <p class="lead mb-0 animate-on-scroll">Manage your account and view your bookings</p>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Profile Form -->
                <div class="col-lg-8">
                    <div class="profile-card animate-on-scroll">
                        <h3 class="mb-4">Account Information</h3>

                        <?php if ($message): ?>
                            <div class="alert alert-<?php echo $message_type === 'success' ? 'success' : 'danger'; ?> mb-4">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                           value="<?php echo htmlspecialchars($user['name']); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                           value="<?php echo htmlspecialchars($user['email']); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                           value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <hr class="my-4">
                                    <h5>Change Password (Optional)</h5>
                                </div>
                                <div class="col-md-4">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                </div>
                                <div class="col-md-4">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <div class="col-md-4">
                                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Account Stats -->
                    <div class="profile-card animate-on-scroll mb-4">
                        <h5 class="mb-3">Account Overview</h5>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number"><?php echo count($recent_bookings); ?></div>
                                <div class="stat-label">Total Bookings</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">
                                    <?php
                                    $status = 'confirmed';
                                    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM bookings WHERE user_id = ? AND status = ?");
                                    $stmt->bind_param("is", $user_id, $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    echo $row['count'];
                                    $stmt->close();
                                    ?>
                                </div>
                                <div class="stat-label">Confirmed</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">
                                    <?php
                                    $status = 'pending';
                                    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM bookings WHERE user_id = ? AND status = ?");
                                    $stmt->bind_param("is", $user_id, $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    echo $row['count'];
                                    $stmt->close();
                                    ?>
                                </div>
                                <div class="stat-label">Pending</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="profile-card animate-on-scroll">
                        <h5 class="mb-3">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="booking.php" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>New Booking
                            </a>
                            <a href="view_booking.php" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>View All Bookings
                            </a>
                            <a href="contact.php" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-2"></i>Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="profile-card animate-on-scroll">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3>Recent Bookings</h3>
                            <a href="view_booking.php" class="btn btn-outline-primary">View All</a>
                        </div>

                        <?php if (empty($recent_bookings)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h5>No bookings yet</h5>
                                <p class="text-muted">Your recent bookings will appear here.</p>
                                <a href="booking.php" class="btn btn-primary">Make Your First Booking</a>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Event Type</th>
                                            <th>Date</th>
                                            <th>Guests</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recent_bookings as $booking): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($booking['event_type']); ?></td>
                                                <td><?php echo date('M j, Y', strtotime($booking['event_date'])); ?></td>
                                                <td><?php echo htmlspecialchars($booking['guests']); ?></td>
                                                <td>$<?php echo number_format($booking['total_price'], 2); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php
                                                        echo $booking['status'] === 'confirmed' ? 'success' :
                                                             ($booking['status'] === 'pending' ? 'warning' : 'secondary');
                                                    ?>">
                                                        <?php echo ucfirst(htmlspecialchars($booking['status'])); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="view_booking.php?id=<?php echo $booking['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>