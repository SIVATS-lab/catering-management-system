<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Name, email, and password are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Use prepared statement
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $name, $email, $hashed_password, $phone, $address);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['user_name'] = $name;
            header("Location: booking.php");
            exit();
        } else {
            $error = "Error registering user: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Catering Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand: #da7f17;
            --brand-dark: #a6570f;
            --text-dark: #fff;
            --surface: #fff;
        }
        body {
            background:
                linear-gradient(rgba(8, 7, 6, 0.50), rgba(8, 7, 6, 0.50)),
                url('https://images.unsplash.com/photo-1478145046317-39f10e56b5e9?auto=format&fit=crop&w=1600&q=80') no-repeat center/cover;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-auth {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 10px 35px rgba(0,0,0,.12);
            overflow: hidden;
        }
        .card-auth .card-header {
            background: var(--brand);
            color: #fff;
            text-align: center;
            font-weight: 700;
            border-bottom: 0;
            padding: 1.25rem;
        }
        .card-auth .btn-submit {
            background: var(--brand);
            border: 0;
            font-weight: 600;
        }
        .card-auth .btn-submit:hover {
            background: var(--brand-dark);
        }
        .login-form, .register-form {
            color: #1d2841;
        }
        .register-form {
            padding: 2rem;
            background: var(--surface);
        }
        .brand-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            letter-spacing: .05em;
            margin-bottom: 1rem;
        }
        .text-muted-small { font-size: .9rem; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card card-auth">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center slider-panel">
                            <div class="slider-content">
                                <h2 class="text-white mb-3">Create your account</h2>
                                <p class="text-light">Join Catering Pro for easy event bookings, flexible menu management, and premium service.</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body register-form">
                                <h1 class="brand-title">Catering Pro</h1>
                                <h3 class="mb-4">Create an account</h3>
                                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                                <form method="POST" novalidate>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="At least 8 characters" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="+1 555 123 4567">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Street, City, Postal code"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-submit w-100 mb-3">Register Now</button>
                                </form>
                                <div class="text-center text-muted-small">Already have an account? <a href="login.php">Login</a></div>
                                <hr>
                                <div class="text-center text-muted-small">By registering you agree to <a href="terms.php">Terms</a> & <a href="privacy.php">Privacy Policy</a>.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const registerSlides = [
            'https://images.unsplash.com/photo-1541548445299-2d8aadfab13f?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1571091718767-18dd3b98fb5e?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1542444459-dbde5360a1a1?auto=format&fit=crop&w=1200&q=80'
        ];
        let registerIndex = 0;
        const registerPanel = document.querySelector('.slider-panel');

        function updateRegisterBackground() {
            registerPanel.style.backgroundImage = `linear-gradient(rgba(26, 24, 20, 0.55), rgba(26, 24, 20, 0.55)), url('${registerSlides[registerIndex]}')`;
            registerIndex = (registerIndex + 1) % registerSlides.length;
        }
        if (registerPanel) {
            updateRegisterBackground();
            setInterval(updateRegisterBackground, 5000);
        }
    </script>
</body>
</html>