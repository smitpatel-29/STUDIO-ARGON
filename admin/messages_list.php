<?php
$page_title = 'Contact Inquiries';
require_once 'includes/header.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>window.location.href='messages_list.php?msg=deleted';</script>";
}

// Fetch all messages
$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Manage Form Submissions</h2>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success" style="background: rgba(46, 213, 115, 0.1); color: #2ed573; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid rgba(46, 213, 115, 0.2); font-size: 0.9rem; font-weight: 600;">
            <i class="bi bi-check-circle-fill"></i> Inquiry deleted.
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Sender Info</th>
                    <th>Service Needed</th>
                    <th width="40%">Message Details</th>
                    <th>Date Received</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr><td colspan="5" align="center" style="padding: 3rem;">No inquiries found.</td></tr>
                <?php else: ?>
                    <?php foreach($messages as $msg): ?>
                    <tr>
                        <td style="vertical-align: top;">
                            <div style="font-weight: 700; color: var(--text-primary);"><?php echo htmlspecialchars($msg['name']); ?></div>
                            <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 4px;"><i class="bi bi-envelope"></i> <?php echo htmlspecialchars($msg['email']); ?></div>
                            <div style="font-size: 0.8rem; color: var(--text-secondary);"><i class="bi bi-phone"></i> <?php echo htmlspecialchars($msg['phone']); ?></div>
                        </td>
                        <td style="vertical-align: top;"><span class="badge badge-accent"><?php echo htmlspecialchars($msg['service']); ?></span></td>
                        <td style="vertical-align: top;">
                            <div style="background: #F8FAFC; border: 1px solid var(--border); border-radius: 8px; padding: 1rem; font-size: 0.85rem; line-height: 1.5;">
                                <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                            </div>
                        </td>
                        <td style="vertical-align: top; color: var(--text-secondary); font-size: 0.8rem;">
                            <?php echo date('M d, Y', strtotime($msg['created_at'])); ?><br>
                            <?php echo date('h:i A', strtotime($msg['created_at'])); ?>
                        </td>
                        <td style="vertical-align: top;">
                            <a href="messages_list.php?delete=<?php echo $msg['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')" title="Delete"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
