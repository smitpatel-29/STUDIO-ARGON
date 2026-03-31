<?php
$page_title = 'Blog Posts';
require_once 'includes/header.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>window.location.href='blog_list.php?msg=deleted';</script>";
}

// Fetch all posts
$posts = $pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Manage Blog</h2>
        <a href="blog_add.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Post</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success" style="background: rgba(25, 135, 84, 1.1); color: #198754; padding: 1rem; border-radius: 4px; margin-bottom: 
        1.5rem; border: 1px solid rgba(25, 135, 84, 0.2); font-size: 0.9rem;">
            Post deleted successfully.
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="80">Image</th>
                    <th>Post Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th width="150" style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($posts)): ?>
                    <tr><td colspan="6" align="center" style="padding: 3rem;">No posts found. Write your first blog!</td></tr>
                <?php else: ?>
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td>
                            <img src="../<?php echo $post['image']; ?>" class="table-img" alt="" onerror="this.src='https://placehold.co/200x150?text=No+Image'">
                        </td>
                        <td>
                            <div style="font-weight: 600; margin-bottom: 4px;"><?php echo $post['title']; ?></div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary);"><?php echo $post['tag']; ?></div>
                        </td>
                        <td><span class="badge badge-accent"><?php echo $post['category']; ?></span></td>
                        <td><?php echo $post['author']; ?></td>
                        <td><?php echo $post['date']; ?></td>
                        <td>
                            <div class="actions-cell" style="justify-content: flex-end;">
                                <a href="../blogs/<?php echo $post['slug']; ?>" class="btn btn-outline btn-sm" title="View Public" target="_blank"><i class="bi bi-eye"></i></a>
                                <a href="blog_edit.php?id=<?php echo $post['id']; ?>" class="btn btn-outline btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="blog_list.php?delete=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')" title="Delete"><i class="bi bi-trash"></i></a>
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
