<?php
$page_title = 'Administrators';
require_once 'includes/header.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Check role of target admin
    $chk = $pdo->prepare("SELECT role FROM admins WHERE id = ?");
    $chk->execute([$id]);
    $target = $chk->fetch();

    if ($id == $_SESSION['admin_id']) {
        echo "<script>window.location.href='users_list.php?msg=error_self';</script>";
    } elseif ($target && $target['role'] == 'Owner') {
        echo "<script>window.location.href='users_list.php?msg=error_owner';</script>";
    } else {
        $stmt = $pdo->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->execute([$id]);
        echo "<script>window.location.href='users_list.php?msg=deleted';</script>";
    }
}

// Fetch all admins
$admins = $pdo->query("SELECT * FROM admins ORDER BY created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">System Administrators</h2>
        <a href="users_add.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add New Admin</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
        <div class="alert" style="background: rgba(25, 135, 84, 0.1); color: #198754; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid rgba(25, 135, 84, 0.2); font-size: 0.9rem;">
            Administrator removed successfully.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'error_self'): ?>
        <div class="alert" style="background: rgba(220, 53, 69, 0.1); color: #ff6b6b; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid rgba(220, 53, 69, 0.2); font-size: 0.9rem;">
            You cannot delete your own account.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'error_owner'): ?>
        <div class="alert" style="background: rgba(220, 53, 69, 0.1); color: #ff6b6b; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid rgba(220, 53, 69, 0.2); font-size: 0.9rem;">
            Owners cannot be removed from the system for security reasons.
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th width="100" style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($admins as $admin): ?>
                <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><strong><?php echo $admin['full_name']; ?></strong></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td><span class="badge" style="background: <?php echo $admin['role'] == 'Owner' ? '#FEF2F2' : '#F1F5F9'; ?>; color: <?php echo $admin['role'] == 'Owner' ? 'var(--accent)' : 'var(--text-secondary)'; ?>;"><?php echo $admin['role']; ?></span></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td><?php echo date('M d, Y', strtotime($admin['created_at'])); ?></td>
                    <td>
                        <div class="actions-cell" style="justify-content: flex-end;">
                            <?php if ($admin['role'] != 'Owner' && $admin['id'] != $_SESSION['admin_id']): ?>
                                <a href="users_list.php?delete=<?php echo $admin['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove this admin?')" title="Delete"><i class="bi bi-trash"></i></a>
                            <?php else: ?>
                                <span class="badge badge-accent"><?php echo $admin['id'] == $_SESSION['admin_id'] ? 'You' : 'Protected'; ?></span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
