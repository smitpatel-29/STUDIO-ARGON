<?php
$page_title = 'Edit Project';
require_once 'includes/header.php';

$error = '';
$success = '';

if (!isset($_GET['id'])) {
    header('Location: portfolio_list.php');
    exit();
}

$id = $_GET['id'];

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $tools = $_POST['tools'];
    $year = $_POST['year'];
    $description = $_POST['description'];

    if (!empty($title) && !empty($category) && !empty($image)) {
        $stmt = $pdo->prepare("UPDATE portfolio SET title = ?, category = ?, image = ?, tools = ?, year = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$title, $category, $image, $tools, $year, $description, $id])) {
            $success = "Project details updated successfully!";
        } else {
            $error = "Update failed.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}

// Fetch existing data
$project = $pdo->prepare("SELECT * FROM portfolio WHERE id = ?");
$project->execute([$id]);
$data = $project->fetch();

if (!$data) {
    header('Location: portfolio_list.php');
    exit();
}
?>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Edit Project: <?php echo htmlspecialchars($data['title'] ?? 'N/A'); ?></h2>
        <a href="portfolio_list.php" class="btn btn-outline btn-sm"><i class="bi bi-arrow-left"></i> Back to List</a>
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

    <form method="POST" action="" style="display: grid; gap: 2rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Project Title*</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($data['title'] ?? ''); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Category*</label>
                <select name="category" class="form-control" required>
                    <option value="exterior" <?php echo ($data['category'] ?? '') == 'exterior' ? 'selected' : ''; ?>>Exterior Rendering</option>
                    <option value="interior" <?php echo ($data['category'] ?? '') == 'interior' ? 'selected' : ''; ?>>Interior Rendering</option>
                    <option value="animation" <?php echo ($data['category'] ?? '') == 'animation' ? 'selected' : ''; ?>>3D Animation</option>
                    <option value="walkthrough" <?php echo ($data['category'] ?? '') == 'walkthrough' ? 'selected' : ''; ?>>360 Walkthrough</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Year</label>
                <input type="text" name="year" value="<?php echo htmlspecialchars($data['year'] ?? ''); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Tools Used</label>
                <input type="text" name="tools" value="<?php echo htmlspecialchars($data['tools'] ?? ''); ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Project Image*</label>
            <div style="display: flex; gap: 0.5rem;">
                <input type="text" name="image" id="project-path" value="<?php echo htmlspecialchars($data['image'] ?? ''); ?>" class="form-control" required>
                <button type="button" class="btn btn-primary" onclick="openMediaModal('project-path')" style="white-space: nowrap; font-size: 0.8rem;">Select Asset</button>
            </div>
        </div>

        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Description</label>
            <textarea name="description" class="form-control" rows="5"><?php echo htmlspecialchars($data['description'] ?? ''); ?></textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Update Project</button>
        </div>
    </form>
</div>

<?php 
require_once 'includes/media_modal.php';
require_once 'includes/footer.php'; 
?>
