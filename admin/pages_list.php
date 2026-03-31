<?php
$page_title = 'Pages';
require_once 'includes/header.php';

// Fetch pages with content
$pages = $pdo->query("SELECT DISTINCT page_slug FROM site_content")->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Manage Pages</h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        <?php foreach ($pages as $slug): ?>
        <div class="card" style="margin-bottom: 0; padding: 2rem; display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid var(--border); border-radius: 12px; transition: all 0.3s ease;">
            <div class="stat-icon" style="background: #FEF2F2; color: var(--accent); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.5rem;">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <h3 style="text-transform: capitalize; margin-bottom: 0.5rem; font-weight: 700;"><?php echo $slug; ?> Page</h3>
            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 1.5rem;">Manage the general text and headings for this page.</p>
            
            <div style="display: flex; flex-direction: column; gap: 0.8rem; width: 100%;">
                <a href="page_edit.php?page=<?php echo $slug; ?>" class="btn btn-primary" style="justify-content: center; width: 100%;">Edit Static Content</a>
                
                <?php if ($slug == 'home'): ?>
                <a href="home_manage.php" class="btn btn-outline" style="justify-content: center; width: 100%; border-color: var(--accent); color: var(--accent);">Manage Sections (Slider/Stats)</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
