<?php
session_start();
include 'db.php';

$login_type = isset($_GET['type']) ? $_GET['type'] : 'user';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_type = $_POST['login_type'] ?? 'user';
    
    if ($login_type == 'user') {
        // User login
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = "Email and password are required";
        } else {
            $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header("Location: user_home.php");
                    exit();
                } else {
                    $error = "Invalid password";
                }
            } else {
                $error = "User not found";
            }
            $stmt->close();
        }
    } else {
        // Admin login
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $error = "Username and password are required";
        } else {
            $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $admin = $result->fetch_assoc();
                if (password_verify($password, $admin['password'])) {
                    $_SESSION['admin_id'] = $admin['id'];
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    $error = "Invalid password";
                }
            } else {
                $error = "Admin not found";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Catering Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand: #8B4513;
            --brand-dark: #D2691E;
            --brand-soft: #F4A460;
            --text-dark: #fff;
        }
        body {
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-auth {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 10px 35px rgba(0,0,0,.2);
            overflow: hidden;
        }
        .card-header-custom {
            background: var(--brand);
            color: #fff;
            text-align: center;
            font-weight: 700;
            letter-spacing: .05em;
            padding: 1.5rem;
        }
        .nav-tabs .nav-link {
            color: #666;
            border: none;
            border-bottom: 3px solid transparent;
            font-weight: 600;
            padding: 1rem;
        }
        .nav-tabs .nav-link.active {
            color: var(--brand);
            border-bottom: 3px solid var(--brand);
            background: none;
        }
        .nav-tabs {
            border-bottom: 1px solid #ddd;
        }
        .login-form {
            padding: 2rem;
            background: #fff;
            color: #1d2841;
        }
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ddd;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        }
        .btn-submit {
            background: var(--brand);
            border: 0;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 0.5rem;
        }
        .btn-submit:hover {
            background: var(--brand-dark);
            color: #fff;
        }
        .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--brand);
            margin-bottom: 0.5rem;
        }
        .login-bg {
            border-radius: 1rem 0 0 1rem;
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
        }
        .slider-content {
            text-align: center;
            color: white;
            padding: 2rem;
        }
        .text-muted-small {
            font-size: .9rem;
            color: #666;
        }
        .slider-content h2 {
            font-size: 2rem;
            font-weight: 700;
        }
        .slider-content p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card card-auth">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center login-bg">
                            <div class="slider-content">
                                <h2>Catering Pro</h2>
                                <p class="mt-4">Premium catering solutions for every occasion.</p>
                                <p>Log in to manage your bookings and create unforgettable menus.</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="login-form">
                                <h1 class="brand-title text-center mb-4">Welcome</h1>
                                
                                <!-- Login Type Tabs -->
                                <ul class="nav nav-tabs mb-4" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo $login_type == 'user' ? 'active' : ''; ?>" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-form" type="button" role="tab">User Login</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo $login_type == 'admin' ? 'active' : ''; ?>" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-form" type="button" role="tab">Admin Login</button>
                                    </li>
                                </ul>

                                <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                                <!-- Tab Content -->
                                <div class="tab-content">
                                    <!-- User Login Form -->
                                    <div class="tab-pane fade <?php echo $login_type == 'user' ? 'show active' : ''; ?>" id="user-form" role="tabpanel">
                                        <form method="POST" novalidate>
                                            <input type="hidden" name="login_type" value="user">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                            </div>
                                            <button type="submit" class="btn btn-submit w-100 mb-3">Login as User</button>
                                        </form>
                                        <div class="text-center text-muted-small">No account yet? <a href="register.php" class="text-decoration-none">Create one now</a></div>
                                    </div>

                                    <!-- Admin Login Form -->
                                    <div class="tab-pane fade <?php echo $login_type == 'admin' ? 'show active' : ''; ?>" id="admin-form" role="tabpanel">
                                        <form method="POST" novalidate>
                                            <input type="hidden" name="login_type" value="admin">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter admin username" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="admin-password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="admin-password" name="password" placeholder="Enter admin password" required>
                                            </div>
                                            <button type="submit" class="btn btn-submit w-100 mb-3">Login as Admin</button>
                                        </form>
                                    </div>
                                </div>

                                <hr class="my-4">
                                <div class="text-center text-muted-small">
                                    By logging in, you agree to our <a href="terms.php" class="text-decoration-none">Terms</a> and <a href="privacy.php" class="text-decoration-none">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>