<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php?type=admin");
    exit();
}
include 'db.php';
include_once __DIR__ . '/site_settings.php';
$siteSettings = get_site_settings();

// Get reports data
$monthly_bookings_sql = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count FROM bookings GROUP BY month ORDER BY month DESC LIMIT 12";
$monthly_bookings_result = $conn->query($monthly_bookings_sql);
$monthly_bookings = [];
while ($row = $monthly_bookings_result->fetch_assoc()) {
    $monthly_bookings[] = $row;
}

$popular_menu_sql = "SELECT m.name, COUNT(*) as count FROM menu m JOIN bookings b ON FIND_IN_SET(m.id, b.menu_items) GROUP BY m.id ORDER BY count DESC LIMIT 10";
$popular_menu_result = $conn->query($popular_menu_sql);
$popular_menu = [];
while ($row = $popular_menu_result->fetch_assoc()) {
    $popular_menu[] = $row;
}

$revenue_by_type_sql = "SELECT event_type, SUM(total_price) as revenue FROM bookings WHERE status = 'completed' GROUP BY event_type";
$revenue_by_type_result = $conn->query($revenue_by_type_sql);
$revenue_by_type = [];
while ($row = $revenue_by_type_result->fetch_assoc()) {
    $revenue_by_type[] = $row;
}

$page_title = 'Reports';
$isAdminPage = true;
include 'header.php';
?>
    <style>
        .admin-container { padding: 2rem 0; }
        .report-section { background: white; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .report-section h3 { color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 3px solid var(--accent-color); }
        .report-section h3 i { margin-right: 0.5rem; }
        .table { margin-bottom: 0; }
        .count-badge { background-color: var(--secondary-color); color: white; padding: 0.4rem 0.8rem; border-radius: 0.25rem; font-weight: 600; display: inline-block; }
        .revenue-text { color: #28a745; font-weight: 700; font-size: 1.1rem; }
        .event-type-badge { background-color: var(--primary-color); color: white; padding: 0.4rem 0.8rem; border-radius: 0.25rem; }
    </style>

    <div class="container admin-container">
        <div class="header-graphic">
            <div class="header-content">
                <h1><i class="fas fa-chart-bar me-2"></i>Reports & Analytics</h1>
                <p class="mb-0">View detailed business analytics and performance metrics</p>
            </div>
            <div class="header-icon"><i class="fas fa-chart-bar"></i></div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="report-section">
                    <h3><i class="fas fa-calendar-alt"></i>Monthly Bookings</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead><tr><th>Month</th><th>Bookings</th></tr></thead>
                            <tbody>
                                <?php foreach ($monthly_bookings as $mb): ?>
                                    <tr>
                                        <td><strong><?php echo date('F Y', strtotime($mb['month'] . '-01')); ?></strong></td>
                                        <td><span class="count-badge"><?php echo $mb['count']; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="report-section">
                    <h3><i class="fas fa-utensils"></i>Popular Menu Items</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead><tr><th>Menu Item</th><th>Bookings</th></tr></thead>
                            <tbody>
                                <?php foreach ($popular_menu as $pm): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($pm['name']); ?></strong></td>
                                        <td><span class="count-badge"><?php echo $pm['count']; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="report-section">
                    <h3><i class="fas fa-money-bill-alt"></i>Revenue by Event Type</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead><tr><th>Event Type</th><th>Revenue</th></tr></thead>
                            <tbody>
                                <?php foreach ($revenue_by_type as $rt): ?>
                                    <tr>
                                        <td><span class="event-type-badge"><?php echo htmlspecialchars($rt['event_type']); ?></span></td>
                                        <td><span class="revenue-text">$<?php echo number_format($rt['revenue'], 2); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
