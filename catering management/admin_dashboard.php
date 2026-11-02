<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
include 'db.php';
include_once __DIR__ . '/site_settings.php';
$siteSettings = get_site_settings();

// Get stats
$bookings_sql = "SELECT COUNT(*) as total FROM bookings";
$bookings_result = $conn->query($bookings_sql);
$total_bookings = $bookings_result->fetch_assoc()['total'];

$pending_sql = "SELECT COUNT(*) as total FROM bookings WHERE status = 'pending'";
$pending_result = $conn->query($pending_sql);
$pending_bookings = $pending_result->fetch_assoc()['total'];

$users_sql = "SELECT COUNT(*) as total FROM users";
$users_result = $conn->query($users_sql);
$total_users = $users_result->fetch_assoc()['total'];

$inquiries_sql = "SELECT COUNT(*) as total FROM inquiries";
$inquiries_result = $conn->query($inquiries_sql);
$total_inquiries = $inquiries_result->fetch_assoc()['total'];

$revenue_sql = "SELECT SUM(total_price) as total FROM bookings WHERE status = 'completed'";
$revenue_result = $conn->query($revenue_sql);
$total_revenue = $revenue_result->fetch_assoc()['total'] ?? 0;

// Get recent bookings
$recent_sql = "SELECT b.id, b.event_type, b.created_at, u.name FROM bookings b JOIN users u ON b.user_id = u.id ORDER BY b.created_at DESC LIMIT 5";
$recent_result = $conn->query($recent_sql);
$recent_bookings = [];
while ($row = $recent_result->fetch_assoc()) {
    $recent_bookings[] = $row;
}

// Get monthly stats for chart
$monthly_sql = "SELECT DATE_FORMAT(created_at, '%b') as month, COUNT(*) as count FROM bookings WHERE YEAR(created_at) = YEAR(NOW()) GROUP BY MONTH(created_at) LIMIT 6";
$monthly_result = $conn->query($monthly_sql);
$monthly_data = [];
while ($row = $monthly_result->fetch_assoc()) {
    $monthly_data[] = $row;
}

$page_title = 'Admin Dashboard';
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
        .stat-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .stat-card.bookings {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stat-card.users {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stat-card.inquiries {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stat-card.revenue {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .stat-card .card-body {
            color: white;
            padding: 1.5rem;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .stat-icon {
            font-size: 3rem;
            opacity: 0.2;
            margin-bottom: 0.5rem;
        }
        /* ENHANCED STYLING */
        .dashboard-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 3rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .dashboard-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -5%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .dashboard-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .hero-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .hero-text p {
            font-size: 1.1rem;
            opacity: 0.95;
        }
        .hero-icon {
            font-size: 5rem;
            opacity: 0.2;
        }
        .stat-card-enhanced {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            text-align: center;
            border-top: 4px solid var(--accent-color);
            position: relative;
            overflow: hidden;
        }
        .stat-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            right: -50px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
            opacity: 0.05;
            border-radius: 50%;
        }
        .stat-card-enhanced:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        .stat-card-enhanced.bookings {
            border-top-color: #667eea;
        }
        .stat-card-enhanced.users {
            border-top-color: #f093fb;
        }
        .stat-card-enhanced.inquiries {
            border-top-color: #4facfe;
        }
        .stat-card-enhanced.revenue {
            border-top-color: #43e97b;
        }
        .stat-card-enhanced .icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
        }
        .stat-card-enhanced .bookings .icon {
            color: #667eea;
        }
        .stat-card-enhanced .users .icon {
            color: #f093fb;
        }
        .stat-card-enhanced .inquiries .icon {
            color: #4facfe;
        }
        .stat-card-enhanced .revenue .icon {
            color: #43e97b;
        }
        .stat-card-enhanced .value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0.5rem 0;
        }
        .stat-card-enhanced .label {
            color: #999;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }
        .chart-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-top: 2rem;
        }
        .chart-section h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .mini-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            gap: 0.5rem;
            height: 180px;
            margin-top: 1.5rem;
        }
        .chart-bar {
            flex: 1;
            background: linear-gradient(180deg, var(--accent-color) 0%, var(--secondary-color) 100%);
            border-radius: 0.5rem 0.5rem 0 0;
            min-height: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        .chart-bar:hover {
            transform: scaleY(1.15);
            box-shadow: 0 -8px 20px rgba(0,0,0,0.15);
            filter: brightness(1.1);
        }
        .chart-bar-label {
            margin-top: 0.5rem;
            color: #666;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .recent-activity {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-top: 2rem;
        }
        .recent-activity h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-item:hover {
            background: rgba(139, 69, 19, 0.03);
            padding-left: 1rem;
        }
        .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .activity-content {
            flex: 1;
        }
        .activity-title {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        .activity-time {
            color: #999;
            font-size: 0.85rem;
        }
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0;
            margin-top: 3rem;
        }
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        .social-links a:hover {
            color: var(--accent-color);
        }
    </style>
</head>
<body>

    <div class="container admin-container">
        <!-- Welcome Hero Section -->
        <div class="dashboard-hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Welcome back, Admin!</h2>
                    <p>Here's what's happening at your catering service today</p>
                </div>
                <div class="hero-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats Section -->
        <div class="quick-stats">
            <div class="stat-card-enhanced bookings">
                <div class="icon"><i class="fas fa-calendar-check"></i></div>
                <div class="value"><?php echo $total_bookings; ?></div>
                <div class="label">Total Bookings</div>
            </div>
            <div class="stat-card-enhanced users">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="value"><?php echo $total_users; ?></div>
                <div class="label">Registered Users</div>
            </div>
            <div class="stat-card-enhanced inquiries">
                <div class="icon"><i class="fas fa-envelope"></i></div>
                <div class="value"><?php echo $total_inquiries; ?></div>
                <div class="label">Inquiries</div>
            </div>
            <div class="stat-card-enhanced revenue">
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                <div class="value">$<?php echo number_format($total_revenue, 0); ?></div>
                <div class="label">Total Revenue</div>
            </div>
        </div>

        <!-- Stats Row with Chart -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="chart-section">
                    <h3><i class="fas fa-bar-chart"></i>Monthly Bookings</h3>
                    <div class="mini-chart">
                        <?php 
                        if (!empty($monthly_data)) {
                            $max_count = max(array_column($monthly_data, 'count'));
                            foreach ($monthly_data as $data): 
                                $height = ($data['count'] / $max_count) * 100;
                        ?>
                            <div class="chart-bar" style="height: <?php echo $height; ?>%;" title="<?php echo $data['month']; ?>: <?php echo $data['count']; ?> bookings">
                                <span><?php echo $data['count']; ?></span>
                            </div>
                        <?php endforeach; } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="chart-section">
                    <h3><i class="fas fa-info-circle"></i>Key Metrics</h3>
                    <div style="padding: 1rem 0;">
                        <div style="margin: 1rem 0; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-weight: 600; color: var(--dark-color);">Pending Bookings</span>
                                <span style="background: #ffc107; color: white; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-weight: 700;"><?php echo $pending_bookings; ?></span>
                            </div>
                            <div style="background: #e9ecef; height: 6px; border-radius: 3px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)); height: 100%; width: <?php echo ($pending_bookings / max(1, $total_bookings)) * 100; ?>%;"></div>
                            </div>
                        </div>
                        <div style="margin: 1rem 0; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <span style="font-weight: 600; color: var(--dark-color);">Completion Rate</span>
                                <span style="background: #28a745; color: white; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-weight: 700;">85%</span>
                            </div>
                            <div style="background: #e9ecef; height: 6px; border-radius: 3px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #43e97b, #38f9d7); height: 100%; width: 85%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="recent-activity">
            <h3><i class="fas fa-history"></i>Recent Bookings</h3>
            <?php if (!empty($recent_bookings)): ?>
                <?php foreach ($recent_bookings as $booking): ?>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-cake-candles"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title"><?php echo htmlspecialchars($booking['name']); ?> • <?php echo htmlspecialchars($booking['event_type']); ?></div>
                            <div class="activity-time"><?php echo date('M j, Y g:i A', strtotime($booking['created_at'])); ?></div>
                        </div>
                        <div style="color: var(--primary-color); font-weight: 700;">#<?php echo $booking['id']; ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 2rem; color: #999;">
                    <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block; opacity: 0.3;"></i>
                    No recent bookings
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php
include 'footer.php';
?>