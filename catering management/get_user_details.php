<?php
include 'db.php';

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        echo "<p><strong>Name:</strong> " . htmlspecialchars($user['name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
        echo "<p><strong>Phone:</strong> " . htmlspecialchars($user['phone']) . "</p>";
        echo "<p><strong>Address:</strong> " . htmlspecialchars($user['address']) . "</p>";
        echo "<p><strong>Registered:</strong> " . htmlspecialchars($user['created_at']) . "</p>";

        // Show bookings count
        $booking_stmt = $conn->prepare("SELECT COUNT(*) as count FROM bookings WHERE user_id = ?");
        $booking_stmt->bind_param("i", $user_id);
        $booking_stmt->execute();
        $booking_result = $booking_stmt->get_result();
        $booking_count = $booking_result->fetch_assoc()['count'];
        echo "<p><strong>Total Bookings:</strong> " . (int)$booking_count . "</p>";
        $booking_stmt->close();
    } else {
        echo "User not found";
    }
    $stmt->close();
} else {
    echo "Invalid request";
}
?>