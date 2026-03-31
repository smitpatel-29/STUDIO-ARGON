<?php
$page_title = 'Add New Administrator';
require_once 'includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (!empty($username) && !empty($email) && !empty($password)) {
        if ($password === $confirm_password) {
            // Check if username or email exists
            $check = $pdo->prepare("SELECT id FROM admins WHERE username = ? OR email = ?");
            $check->execute([$username, $email]);
            if ($check->rowCount() == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO admins (username, password, email, full_name) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$username, $hashed_password, $email, $full_name])) {
                    $success = "Administrator created successfully!";
                } else {
                    $error = "Error adding admin.";
                }
            } else {
                $error = "Username or Email already exists.";
            }
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">User Account Details</h2>
        <a href="users_list.php" class="btn btn-outline btn-sm"><i class="bi bi-arrow-left"></i> Back to List</a>
    </div>

    <?php if ($error): ?>
        <div class="alert" style="background: rgba(220, 53, 69, 0.1); color: #ff6b6b; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; border: 1px solid rgba(220, 53, 69, 0.2); font-size: 0.9rem;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert" style="background: rgba(25, 135, 84, 0.1); color: #198754; padding: 1rem; border-radius: 4px; margin-bottom: 2rem; border: 1px solid rgba(25, 135, 84, 0.2); font-size: 0.9rem;">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" style="display: grid; gap: 1.5rem;">
        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-secondary);">Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="e.g. Smit Patel" required style="width: 100%;  border: 1px solid var(--border); padding: 0.8rem 1.2rem;  border-radius: 3px;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-secondary);">Username*</label>
                <input type="text" name="username" class="form-control" placeholder="smit_argon" required style="width: 100%;  border: 1px solid var(--border); padding: 0.8rem 1.2rem;  border-radius: 3px;">
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-secondary);">Email Address*</label>
                <input type="email" name="email" class="form-control" placeholder="smit@studioargon.com" required style="width: 100%;  border: 1px solid var(--border); padding: 0.8rem 1.2rem;  border-radius: 3px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-secondary);">Password*</label>
                <input type="password" name="password" class="form-control" required style="width: 100%;  border: 1px solid var(--border); padding: 0.8rem 1.2rem;  border-radius: 3px;">
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-secondary);">Confirm Password*</label>
                <input type="password" name="confirm_password" class="form-control" required style="width: 100%;  border: 1px solid var(--border); padding: 0.8rem 1.2rem;  border-radius: 3px;">
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Create Account</button>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
