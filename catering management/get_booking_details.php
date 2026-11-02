<?php
include 'db.php';

if (isset($_GET['id'])) {
    $booking_id = (int)$_GET['id'];
    
    $stmt = $conn->prepare("SELECT b.*, u.name as user_name, u.email, u.phone FROM bookings b JOIN users u ON b.user_id = u.id WHERE b.id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $booking = $result->fetch_assoc();
        echo "<p><strong>User:</strong> " . htmlspecialchars($booking['user_name']) . " (" . htmlspecialchars($booking['email']) . ")</p>";
        echo "<p><strong>Phone:</strong> " . htmlspecialchars($booking['phone']) . "</p>";
        echo "<p><strong>Event Date:</strong> " . htmlspecialchars($booking['event_date']) . "</p>";
        echo "<p><strong>Event Type:</strong> " . htmlspecialchars($booking['event_type']) . "</p>";
        echo "<p><strong>Guests:</strong> " . (int)$booking['guests'] . "</p>";
        echo "<p><strong>Total Price:</strong> $" . number_format($booking['total_price'], 2) . "</p>";
        echo "<p><strong>Status:</strong> " . htmlspecialchars(ucfirst($booking['status'])) . "</p>";
        echo "<p><strong>Menu Items:</strong></p><ul>";
        $menu_ids = explode(',', $booking['menu_items']);
        foreach ($menu_ids as $id) {
            $id = (int)$id;
            $menu_stmt = $conn->prepare("SELECT name FROM menu WHERE id = ?");
            $menu_stmt->bind_param("i", $id);
            $menu_stmt->execute();
            $menu_result = $menu_stmt->get_result();
            if ($menu_result->num_rows > 0) {
                $item = $menu_result->fetch_assoc();
                echo "<li>" . htmlspecialchars($item['name']) . "</li>";
            }
            $menu_stmt->close();
        }
        echo "</ul>";
    } else {
        echo "Booking not found";
    }
    $stmt->close();
} else {
    echo "Invalid request";
}
?>