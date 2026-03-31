<?php
$page_title = "Media Library";
require_once 'includes/header.php';

$upload_dir = '../assets/uploads/';
$errors = [];
$successes = [];

// Handle Multiple Uploads
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['files']['name'][0])) {
    $files = $_FILES['files'];
    $allowed = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
    
    foreach ($files['name'] as $key => $name) {
        $error = '';
        if ($files['error'][$key] !== UPLOAD_ERR_OK) {
            $error = "Error uploading $name.";
        } else {
            $filename = basename($name);
            $target_file = $upload_dir . $filename;
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (!in_array($file_type, $allowed)) {
                $error = "File type .$file_type not allowed for $name.";
            } elseif ($files['size'][$key] > 200000000) { // 200MB limit
                $error = "$name is too large (max 200MB).";
            } else {
                // Rename if exists
                if (file_exists($target_file)) {
                    $filename = time() . '_' . $filename;
                    $target_file = $upload_dir . $filename;
                }

                if (move_uploaded_file($files['tmp_name'][$key], $target_file)) {
                    $stmt = $pdo->prepare("INSERT INTO media (filename, filepath, filetype, filesize) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$filename, 'assets/uploads/' . $filename, $file_type, $files['size'][$key]]);
                    $successes[] = "$name uploaded successfully.";
                } else {
                    $error = "Failed to save $name to server.";
                }
            }
        }
        if ($error) $errors[] = $error;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("SELECT * FROM media WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    
    if ($item) {
        $full_path = '../' . $item['filepath'];
        if (file_exists($full_path)) {
            unlink($full_path);
        }
        $pdo->prepare("DELETE FROM media WHERE id = ?")->execute([$id]);
        $successes[] = "Asset removed.";
    }
}

$media_items = $pdo->query("SELECT * FROM media ORDER BY created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Assets Management</h2>
        <button class="btn btn-primary" onclick="document.getElementById('upload-area').style.display = 'block';"><i class="bi bi-cloud-upload"></i> Upload Assets</button>
    </div>

    <!-- Upload Area -->
    <div id="upload-area" style="display: <?php echo !empty($errors) ? 'block' : 'none'; ?>; background: #fdf2f2; border: 1px dashed var(--accent); padding: 2rem; border-radius: 12px; margin-bottom: 2rem; text-align: center;">
        <h3 style="margin-bottom: 1rem;">Upload Media</h3>
        <form method="POST" enctype="multipart/form-data" style="max-width: 400px; margin: 0 auto;">
            <input type="file" name="files[]" id="file-input" class="form-control" style="margin-bottom: 1rem;" accept=".jpg,.jpeg,.png,.webp,.svg" multiple required>
            <div id="file-names" style="margin-bottom: 1rem; font-size: 0.8rem; color: var(--text-secondary);"></div>
            <div style="display: flex; gap: 0.5rem; justify-content: center;">
                <button type="submit" class="btn btn-primary">Start Upload</button>
                <button type="button" class="btn btn-outline" onclick="document.getElementById('upload-area').style.display = 'none';">Cancel</button>
            </div>
            <p style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 1rem;">JPG, PNG, WEBP, SVG (Max 200MB/file)</p>
        </form>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert" style="background: rgba(220, 53, 69, 0.1); color: #ff6b6b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            <?php foreach($errors as $e) echo $e . '<br>'; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($successes)): ?>
        <div class="alert" style="background: rgba(25, 135, 84, 0.1); color: #198754; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            <?php foreach($successes as $s) echo $s . '<br>'; ?>
        </div>
    <?php endif; ?>

    <!-- Media Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem;">
        <?php foreach($media_items as $item): ?>
        <div class="card" style="margin-bottom: 0; padding: 0.75rem; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; position: relative;">
            <div style="height: 140px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 0.75rem;">
                <?php if (in_array($item['filetype'], ['jpg', 'jpeg', 'png', 'svg', 'webp', 'gif'])): ?>
                    <img src="../<?php echo $item['filepath']; ?>" style="width: 100%; height: 100%; object-fit: contain;">
                <?php else: ?>
                    <i class="bi bi-file-earmark" style="font-size: 3rem; color: var(--text-secondary);"></i>
                <?php endif; ?>
            </div>
            
            <div style="padding: 0 0.25rem;">
                <h4 style="font-size: 0.85rem; margin-bottom: 0.4rem; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item['filename']; ?></h4>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.7rem; color: var(--text-secondary); text-transform: uppercase;">.<?php echo $item['filetype']; ?></span>
                    <div style="display: flex; gap: 0.3rem;">
                        <button onclick="copyToClipboard('<?php echo 'assets/uploads/' . $item['filename']; ?>')" class="btn btn-sm" style="padding: 0.3rem 0.5rem; background: #f1f5f9; border: none; font-size: 0.8rem;" title="Copy Link"><i class="bi bi-link-45deg"></i></button>
                        <a href="media_manage.php?delete=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" style="padding: 0.3rem 0.5rem; font-size: 0.8rem;" onclick="return confirm('Delete this file permanently?')" title="Delete"><i class="bi bi-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.getElementById('file-input').addEventListener('change', function() {
        const fileCount = this.files.length;
        document.getElementById('file-names').innerText = fileCount + ' files selected';
    });

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.innerText = 'Path copied: ' + text;
                toast.classList.add('show');
                setTimeout(() => { toast.classList.remove('show'); }, 3000);
            } else {
                alert('File path copied to clipboard!');
            }
        });
    }
</script>

<?php require_once 'includes/footer.php'; ?>
