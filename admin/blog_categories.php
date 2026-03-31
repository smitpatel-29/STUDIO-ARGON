<?php
$page_title = "Blog Categories";
require_once 'includes/header.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $name = $_POST['name'];
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        
        $stmt = $pdo->prepare("INSERT INTO blog_categories (name, slug) VALUES (?, ?)");
        try {
            $stmt->execute([$name, $slug]);
            $message = "Category added.";
        } catch (PDOException $e) {
            $message = "Error: Category or Slug already exists.";
        }
    }
    
    if (isset($_POST['delete_category'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM blog_categories WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Category removed.";
    }
}

$categories = $pdo->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
?>

<?php if ($message): ?>
    <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid #059669;">
        <i class="bi bi-info-circle-fill"></i> <?php echo $message; ?>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Add Category -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add New Category</h2>
        </div>
        <form method="POST">
            <input type="hidden" name="add_category" value="1">
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 700; font-size: 0.8rem;">Category Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Architectural Design" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>

    <!-- Category List -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Existing Categories</h2>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th width="50">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr><td colspan="3" align="center">No categories found.</td></tr>
                    <?php else: ?>
                        <?php foreach($categories as $cat): ?>
                        <tr>
                            <td><strong><?php echo $cat['name']; ?></strong></td>
                            <td><code style="font-size: 0.75rem;"><?php echo $cat['slug']; ?></code></td>
                            <td>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this category?')">
                                    <input type="hidden" name="delete_category" value="1">
                                    <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
