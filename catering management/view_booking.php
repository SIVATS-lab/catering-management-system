<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $booking_id = (int)$_GET['id'];
    $sql = "SELECT * FROM bookings WHERE id = $booking_id AND user_id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $booking = $result->fetch_assoc();
    } else {
        die("Booking not found");
    }
} else {
    // List all bookings
    $sql = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}
?>

<?php
$page_title = "Your Bookings";
include 'header.php';
?>

<style>
    .booking-card { border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 2px 16px rgba(0,0,0,0.08); }
    .booking-card .card-header { background-color: #f8f9fa; font-weight: 700; }
    .badge-status-pending { background-color: #fd7e14; }
    .badge-status-confirmed { background-color: #198754; }
</style>

<div class="container py-5">
        <h2 class="text-center mb-4">Your Bookings</h2>
        <a href="booking.php" class="btn btn-primary mb-3">New Booking</a>
        <a href="logout.php" class="btn btn-secondary mb-3">Logout</a>

        <?php if (isset($booking)): ?>
            <div class="card">
                <div class="card-header">
                    <h5>Booking Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Event Date:</strong> <?php echo $booking['event_date']; ?></p>
                    <p><strong>Event Type:</strong> <?php echo $booking['event_type']; ?></p>
                    <p><strong>Guests:</strong> <?php echo $booking['guests']; ?></p>
                    <p><strong>Total Price:</strong> $<?php echo $booking['total_price']; ?></p>
                    <p><strong>Status:</strong> <span class="badge bg-<?php echo $booking['status'] == 'confirmed' ? 'success' : 'warning'; ?>"><?php echo ucfirst($booking['status']); ?></span></p>
                    <p><strong>Menu Items:</strong></p>
                    <ul>
                        <?php
                        $menu_ids = explode(',', $booking['menu_items']);
                        foreach ($menu_ids as $id) {
                            $menu_sql = "SELECT name FROM menu WHERE id = $id";
                            $menu_result = $conn->query($menu_sql);
                            if ($menu_result->num_rows > 0) {
                                $item = $menu_result->fetch_assoc();
                                echo "<li>" . $item['name'] . "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($bookings as $b): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $b['event_type']; ?></h5>
                                <p class="card-text">Date: <?php echo $b['event_date']; ?></p>
                                <p class="card-text">Guests: <?php echo $b['guests']; ?></p>
                                <p class="card-text">Status: <span class="badge bg-<?php echo $b['status'] == 'confirmed' ? 'success' : 'warning'; ?>"><?php echo ucfirst($b['status']); ?></span></p>
                                <a href="view_booking.php?id=<?php echo $b['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

<?php include 'footer.php'; ?>