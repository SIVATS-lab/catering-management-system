<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch menu items
$menu_sql = "SELECT * FROM menu ORDER BY category, name";
$menu_result = $conn->query($menu_sql);
$menu_items = [];
while ($row = $menu_result->fetch_assoc()) {
    $menu_items[$row['category']][] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_date = trim($_POST['event_date']);
    $event_type = trim($_POST['event_type']);
    $guests = (int)$_POST['guests'];
    $selected_items = isset($_POST['menu_items']) ? $_POST['menu_items'] : [];

    // Validate inputs
    if (empty($event_date) || empty($event_type) || $guests <= 0) {
        $error = "Please fill all required fields correctly";
    } elseif (empty($selected_items)) {
        $error = "Please select at least one menu item";
    } else {
        // Validate and cast menu item IDs
        $validated_items = [];
        foreach ($selected_items as $item_id) {
            $item_id = (int)$item_id;
            if ($item_id > 0) {
                $validated_items[] = $item_id;
            }
        }

        if (empty($validated_items)) {
            $error = "Invalid menu items selected";
        } else {
            $menu_items_str = implode(',', $validated_items);
            $total_price = 0;

            // Calculate total price using prepared statement
            foreach ($validated_items as $item_id) {
                $stmt = $conn->prepare("SELECT price FROM menu WHERE id = ?");
                $stmt->bind_param("i", $item_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $item = $result->fetch_assoc();
                    $total_price += $item['price'];
                }
                $stmt->close();
            }
            $total_price *= $guests;

            // Insert booking using prepared statement
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, event_date, event_type, guests, menu_items, total_price) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issisd", $user_id, $event_date, $event_type, $guests, $menu_items_str, $total_price);
            
            if ($stmt->execute()) {
                $booking_id = $stmt->insert_id;
                header("Location: view_booking.php?id=$booking_id");
                exit();
            } else {
                $error = "Error creating booking: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>

<?php
$page_title = "Book Catering";
include 'header.php';
?>

<style>
    .step { display: none; }
    .step.active { display: block; }
    .progress-bar { width: 0%; }
    .booking-card { border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    .booking-card .card-header { background-color: #f8f9fa; font-weight: 600; }
    .booking-card .card-body { padding: 1.5rem; }
    .booking-card .form-control, .booking-card .form-select { min-height: 48px; }
    .container.booking-page { max-width: 980px; }
    .page-hero { margin-bottom: 2rem; padding: 2.5rem 0 1rem; }
</style>

<div class="container booking-page my-5 pb-5">
        <section class="page-hero text-center">
            <h2 class="display-4 fw-bold mb-3">Book Your Catering</h2>
            <p class="text-secondary mb-0">Choose your event details and menu with confidence.</p>
        </section>
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
        <form id="bookingForm" method="POST">
            <!-- Step 1: Event Details -->
            <div class="step active" id="step1">
                <div class="card">
                    <div class="card-header">Step 1: Event Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_type" class="form-label">Event Type</label>
                            <select class="form-control" id="event_type" name="event_type" required>
                                <option value="">Select Event Type</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Corporate">Corporate</option>
                                <option value="Birthday">Birthday</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Number of Guests</label>
                            <input type="number" class="form-control" id="guests" name="guests" min="1" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep(1)">Next</button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Menu Selection -->
            <div class="step" id="step2">
                <div class="card">
                    <div class="card-header">Step 2: Select Menu Items</div>
                    <div class="card-body">
                        <?php foreach ($menu_items as $category => $items): ?>
                            <h5><?php echo $category; ?></h5>
                            <?php foreach ($items as $item): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="menu_items[]" value="<?php echo $item['id']; ?>" id="item<?php echo $item['id']; ?>">
                                    <label class="form-check-label" for="item<?php echo $item['id']; ?>">
                                        <?php echo $item['name']; ?> - $<?php echo $item['price']; ?>
                                        <small class="text-muted"><?php echo $item['description']; ?></small>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <button type="button" class="btn btn-secondary mt-3" onclick="prevStep(2)">Previous</button>
                        <button type="submit" class="btn btn-primary mt-3">Book Now</button>
                    </div>
                </div>
            </div>
        </form>
        <?php if (isset($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 2;

        function nextStep(step) {
            if (validateStep(step)) {
                document.getElementById('step' + step).classList.remove('active');
                currentStep++;
                document.getElementById('step' + currentStep).classList.add('active');
                updateProgress();
            }
        }

        function prevStep(step) {
            document.getElementById('step' + step).classList.remove('active');
            currentStep--;
            document.getElementById('step' + currentStep).classList.add('active');
            updateProgress();
        }

        function validateStep(step) {
            if (step === 1) {
                const eventDate = document.getElementById('event_date').value;
                const eventType = document.getElementById('event_type').value;
                const guests = document.getElementById('guests').value;
                if (!eventDate || !eventType || !guests) {
                    alert('Please fill all fields');
                    return false;
                }
            }
            return true;
        }

        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.querySelector('.progress-bar').style.width = progress + '%';
        }
    </script>

<?php include 'footer.php'; ?>