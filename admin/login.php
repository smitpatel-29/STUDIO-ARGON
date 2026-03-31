<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../includes/db.php';
require_once '../includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['full_name'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_role'] = $user['role'];
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Please fill in all fields';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Studio Argon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #F8FAFC;
            --admin-card: #FFFFFF;
            --accent: #E11D48; /* Premium Red */
            --text-primary: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            cursor: auto !important;
        }

        body {
            background-color: var(--admin-bg);
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            cursor: default !important;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-card {
            background: var(--admin-card);
            border: 1px solid var(--border);
            padding: 3.5rem 3rem;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.6rem;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            background: #F8FAFC;
            border: 1px solid var(--border);
            padding: 0.9rem 1.2rem;
            color: var(--text-primary);
            font-family: inherit;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(225, 29, 72, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--accent);
            
            border: none;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.2);
        }

        .btn-login:hover {
            background: #BE123D;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(225, 29, 72, 0.3);
        }

        .error-msg {
            background: #FEF2F2;
            color: #E11D48;
            padding: 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            text-align: center;
            border: 1px solid #FECDD3;
            font-weight: 600;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .back-to-site {
            text-align: center;
            margin-top: 2rem;
        }

        .back-to-site a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-to-site a:hover {
            color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="brand-logo">
                <img src="../assets/uploads/logo%20black.png" alt="Studio Argon">
            </div>
            
            <?php if ($error): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="admin" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-login">Enter Dashboard</button>
            </form>
        </div>
        <div class="back-to-site">
            <a href="../index.php">← Back to website</a>
        </div>
    </div>
</body>
</html>
