<?php
$page_title = 'Add New Project';
require_once 'includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $tools = $_POST['tools'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    
    if (!empty($title) && !empty($category) && !empty($image)) {
        $stmt = $pdo->prepare("INSERT INTO portfolio (title, category, image, tools, year, description) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $category, $image, $tools, $year, $description])) {
            $success = "Project added successfully!";
        } else {
            $error = "Error adding project.";
        }
    } else {
        $error = "Please fill in all required fields (Title, Category, Image).";
    }
}
?>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Project Details</h2>
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
                <input type="text" name="title" class="form-control" placeholder="e.g. The Glass Pavilion" required>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Category*</label>
                <select name="category" class="form-control" required>
                    <option value="exterior">Exterior Rendering</option>
                    <option value="interior">Interior Rendering</option>
                    <option value="animation">3D Animation</option>
                    <option value="walkthrough">360 Walkthrough</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Year</label>
                <input type="text" name="year" class="form-control" placeholder="e.g. 2025">
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Tools Used</label>
                <input type="text" name="tools" class="form-control" placeholder="e.g. 3ds Max, V-Ray">
            </div>
        </div>

        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Project Image*</label>
            <div style="display: flex; gap: 0.5rem;">
                <input type="text" name="image" id="project-path" class="form-control" placeholder="Select from media library..." required>
                <button type="button" class="btn btn-primary" onclick="openMediaModal('project-path')" style="white-space: nowrap; font-size: 0.8rem;">Select from Media</button>
            </div>
        </div>

        <div class="form-group">
            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.8rem; text-transform: uppercase;">Description</label>
            <textarea name="description" class="form-control" rows="5" placeholder="Project description..."></textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">Save Project</button>
        </div>
    </form>
</div>

<?php 
require_once 'includes/media_modal.php';
require_once 'includes/footer.php'; 
?>
