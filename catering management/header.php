<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/site_settings.php';
$siteSettings = get_site_settings();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?><?php echo htmlspecialchars($siteSettings['site_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #F4A460;
            --dark-color: #2C1810;
            --light-color: #FFF8DC;
            --text-color: #2C1810;
            --card-bg: #ffffff;
            --body-bg: #FFF8DC;
            --footer-bg: #2C1810;
            --footer-text: #ffffff;
        }

        .dark-mode {
            --primary-color: #1f2937;
            --secondary-color: #3f4e6b;
            --accent-color: #f59e0b;
            --dark-color: #111827;
            --light-color: #1f2937;
            --text-color: #e5e7eb;
            --card-bg: #1f2937;
            --body-bg: #0f172a;
            --footer-bg: #111827;
            --footer-text: #e5e7eb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-color);
        }

        .card, .feature-card, .testimonial-card, .chart-section, .recent-activity, .table {
            background-color: var(--card-bg);
            color: var(--text-color);
        }

        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .navbar, .navbar-admin {
            padding: 0.4rem 1rem;
            min-height: 62px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 0;
        }

        .navbar > .container, .navbar > .container-fluid, .navbar > .container-lg, .navbar > .container-md, .navbar > .container-sm, .navbar > .container-xl, .navbar > .container-xxl,
        .navbar-admin > .container, .navbar-admin > .container-fluid, .navbar-admin > .container-lg, .navbar-admin > .container-md, .navbar-admin > .container-sm, .navbar-admin > .container-xl, .navbar-admin > .container-xxl {
            display: flex;
            flex-wrap: inherit;
            align-items: center;
            justify-content: space-between;
            padding: 0;
        }

        .navbar-admin {
            background-color: var(--primary-color) !important;
        }

        .navbar-admin .navbar-brand,
        .navbar .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            padding: 0.6rem 0.95rem !important;
            border-radius: 0.25rem;
            white-space: nowrap;
            margin: 0 0.25rem !important;
            min-width: 110px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .navbar-admin .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-admin .nav-link {
            color: rgba(255,255,255,0.85) !important;
            margin-left: 0.5rem;
            padding: 0.6rem 0.95rem;
            border-radius: 0.25rem;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .navbar-admin .nav-link:hover,
        .navbar-admin .nav-link.active {
            background-color: var(--secondary-color);
            color: #fff !important;
        }

        .navbar-admin .nav-link.active {
            font-weight: 600;
            box-shadow: inset 0 -2px 0 0 rgba(0,0,0,0.15);
        }

        .navbar-nav .nav-link {
            min-width: 110px;
            text-align: center;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            opacity: 0.1;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin: 1rem;
        }

        .stats-counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0;
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

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .admin-container {
            padding: 2rem 0;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        .page-header-content {
            flex: 1;
        }

        .btn-add-item {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-add-item:hover {
            background-color: #218838;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .table {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table thead {
            background-color: var(--accent-color);
            color: white;
        }

        .table thead th {
            border: none;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-color: #f0f0f0;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: rgba(139, 69, 19, 0.05);
        }

        .category-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }

        .price-badge {
            background-color: #17a2b8;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 0.25rem;
            font-weight: 600;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #333;
        }

        .badge-confirmed {
            background-color: #28a745;
            color: white;
        }

        .badge-cancelled {
            background-color: #dc3545;
            color: white;
        }

        .btn-edit, .btn-delete {
            border: none;
            margin-right: 0.5rem;
            padding: 0.4rem 0.8rem;
            border-radius: 0.25rem;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #333;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #333;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
            color: white;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 600;
        }

        .form-control {
            background-color: var(--card-bg);
            color: var(--text-color);
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
            background-color: var(--card-bg);
            color: var(--text-color);
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .header-graphic {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }

        .header-graphic::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .header-content {
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .header-icon {
            position: relative;
            z-index: 1;
            font-size: 4rem;
            opacity: 0.2;
        }

        .header-content h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-content p {
            font-size: 1rem;
            opacity: 0.95;
        }

        .header-actions {
            position: relative;
            z-index: 1;
            margin-left: 2rem;
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
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .inquiry-card {
            background-color: var(--card-bg);
            border-left: 4px solid var(--accent-color);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .inquiry-card h5 {
            color: var(--text-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .inquiry-card p {
            color: var(--text-color);
            margin-bottom: 0.25rem;
        }

        .report-card {
            background-color: var(--card-bg);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-top: 3px solid var(--accent-color);
        }

        .report-card h5 {
            color: var(--text-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .menu-card {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .stat-card-enhanced {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-card-enhanced h5 {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .stat-card-enhanced .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .chart-section {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .chart-section h5 {
            color: var(--text-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .mini-chart {
            background-color: var(--card-bg);
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .recent-activity {
            background-color: var(--card-bg);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .custom-select {
            background-color: var(--card-bg);
            color: var(--text-color);
            border: 1px solid #ddd;
        }

        .custom-select:focus {
            background-color: var(--card-bg);
            color: var(--text-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php if (isset($isAdminPage) && isset($_SESSION['admin_id'])): ?>
    <nav class="navbar navbar-expand-lg navbar-admin navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.php">
                <i class="fas fa-utensils me-2"></i><?php echo htmlspecialchars($siteSettings['admin_brand_name'] ?: $siteSettings['site_name']); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? ' active' : ''; ?>" href="admin_dashboard.php"><i class="fas fa-chart-line me-1"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'manage_bookings.php' ? ' active' : ''; ?>" href="manage_bookings.php"><i class="fas fa-calendar me-1"></i>Bookings</a></li>
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'manage_menu.php' ? ' active' : ''; ?>" href="manage_menu.php"><i class="fas fa-utensils me-1"></i>Menu</a></li>
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'manage_users.php' ? ' active' : ''; ?>" href="manage_users.php"><i class="fas fa-users me-1"></i>Users</a></li>
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'admin_reports.php' ? ' active' : ''; ?>" href="admin_reports.php"><i class="fas fa-chart-bar me-1"></i>Reports</a></li>
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'admin_settings.php' ? ' active' : ''; ?>" href="admin_settings.php"><i class="fas fa-cog me-1"></i>Settings</a></li>
                    <li class="nav-item"><a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'admin_feedback.php' ? ' active' : ''; ?>" href="admin_feedback.php"><i class="fas fa-comments me-1"></i>Feedback</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button id="themeToggleBtn" class="btn btn-sm btn-outline-light me-2" type="button" style="min-width: 2.7rem;">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php else: ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-utensils me-2"></i><?php echo htmlspecialchars($siteSettings['site_name']); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? 'user_home.php' : 'index.php'; ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="testimonials.php">Testimonials</a></li>
                    <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button id="themeToggleBtn" class="btn btn-sm btn-outline-dark me-2" type="button" style="min-width: 2.7rem;">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-shield me-1"></i>Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin_settings.php">Settings</a></li>
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php elseif (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="view_booking.php">My Bookings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <script>
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const savedTheme = localStorage.getItem('cateringTheme') || 'light';

        function setTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark-mode');
                if (themeToggleBtn) {
                    themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
                }
            } else {
                document.documentElement.classList.remove('dark-mode');
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
                    const nextTheme = document.documentElement.classList.contains('dark-mode') ? 'light' : 'dark';
                    setTheme(nextTheme);
                });
            }
        });
    </script>