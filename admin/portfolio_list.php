<?php
$page_title = 'Portfolio Projects';
require_once 'includes/header.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM portfolio WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>window.location.href='portfolio_list.php?msg=deleted';</script>";
}

// Fetch all projects
$projects = $pdo->query("SELECT * FROM portfolio ORDER BY created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Manage Projects</h2>
        <a href="portfolio_add.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add New Project</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success" style="background: rgba(25, 135, 84, 0.1); color: #198754; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid rgba(25, 135, 84, 0.2); font-size: 0.9rem;">
            Project deleted successfully.
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="80">Image</th>
                    <th>Project Details</th>
                    <th>Category</th>
                    <th>Year</th>
                    <th width="150" style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($projects)): ?>
                    <tr><td colspan="5" align="center" style="padding: 3rem;">No projects found. Add your first project!</td></tr>
                <?php else: ?>
                    <?php foreach($projects as $project): ?>
                    <tr>
                        <td>
                            <img src="../<?php echo $project['image']; ?>" class="table-img" alt="" onerror="this.src='https://placehold.co/200x150?text=No+Image'">
                        </td>
                        <td>
                            <div style="font-weight: 600; margin-bottom: 4px;"><?php echo $project['title']; ?></div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary); max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $project['description']; ?></div>
                        </td>
                        <td><span class="badge badge-accent"><?php echo $project['category']; ?></span></td>
                        <td><?php echo $project['year']; ?></td>
                        <td>
                            <div class="actions-cell" style="justify-content: flex-end;">
                                <a href="portfolio_edit.php?id=<?php echo $project['id']; ?>" class="btn btn-outline btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="portfolio_list.php?delete=<?php echo $project['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')" title="Delete"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
