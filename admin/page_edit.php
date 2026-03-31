<?php
if (!isset($_GET['page'])) {
    header('Location: pages_list.php');
    exit();
}

$page_slug = $_GET['page'];
$page_title = 'Edit ' . ucfirst($page_slug) . ' Page';
require_once 'includes/header.php';

$error = '';
$success = '';

// Handle save
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['section'] as $section_id => $data) {
        $stmt = $pdo->prepare("UPDATE site_content SET heading = ?, content = ?, image_url = ? WHERE page_slug = ? AND section_slug = ?");
        $stmt->execute([
            $data['heading'],
            $data['content'],
            $data['image_url'],
            $page_slug,
            $section_id
        ]);
    }
    $success = ucfirst($page_slug) . " page updated successfully.";
}

// Fetch sections for this page
$stmt = $pdo->prepare("SELECT * FROM site_content WHERE page_slug = ?");
$stmt->execute([$page_slug]);
$sections = $stmt->fetchAll();
?>

<div class="card" style="max-width: 900px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Manage <?php echo ucfirst($page_slug); ?> Content</h2>
        <a href="pages_list.php" class="btn btn-outline btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success" style="background: rgba(46, 213, 115, 0.1); color: #2ed573; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid rgba(46, 213, 115, 0.2); font-size: 0.9rem; font-weight: 600;">
            <i class="bi bi-check-circle-fill"></i> <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <?php foreach ($sections as $index => $section): ?>
        <div style="background: #F8FAFC; border: 1px solid var(--border); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--accent);">
                <i class="bi bi-layers"></i>
                <h3 style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1em; font-weight: 800;"><?php echo $section['section_slug']; ?> Section</h3>
            </div>
            
            <div style="display: grid; gap: 1.5rem;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.6rem; font-size: 0.85rem; font-weight: 700;">Section Heading</label>
                    <input type="text" name="section[<?php echo $section['section_slug']; ?>][heading]" value="<?php echo htmlspecialchars($section['heading']); ?>" class="form-control">
                </div>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.6rem; font-size: 0.85rem; font-weight: 700;">Section Text Content</label>
                    <textarea name="section[<?php echo $section['section_slug']; ?>][content]" class="form-control" rows="4"><?php echo htmlspecialchars($section['content']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.6rem; font-size: 0.85rem; font-weight: 700;">Image / Background</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="section[<?php echo $section['section_slug']; ?>][image_url]" id="img-path-<?php echo $index; ?>" value="<?php echo htmlspecialchars($section['image_url']); ?>" class="form-control" placeholder="Select from media library...">
                        <button type="button" class="btn btn-primary" onclick="openMediaModal('img-path-<?php echo $index; ?>')" style="white-space: nowrap; font-size: 0.8rem;">Select Asset</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="padding: 1rem 2.5rem;">Save All Changes</button>
        </div>
    </form>
</div>

<?php 
require_once 'includes/media_modal.php';
require_once 'includes/footer.php'; 
?>
