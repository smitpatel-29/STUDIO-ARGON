<!-- Media Library Modal -->
<div id="mediaModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 10001; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
    <div class="modal-content" style="background: white; width: 90%; max-width: 1000px; height: 80vh; border-radius: 16px; display: flex; flex-direction: column; overflow: hidden; animation: modalSlideUp 0.3s ease-out;">
        <div class="modal-header" style="padding: 1.5rem 2rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #fff;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 800; color: #1E293B;">Select Media Asset</h3>
            <button onclick="closeMediaModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748B;">&times;</button>
        </div>
        
        <div class="modal-body" style="padding: 2rem; overflow-y: auto; flex: 1; background: #F8FAFC;">
            <div id="mediaGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
                <!-- Media items will be loaded here via PHP or AJAX -->
                <?php
                // Fetch all media items
                $all_media = $pdo->query("SELECT * FROM media ORDER BY created_at DESC")->fetchAll();
                foreach($all_media as $m):
                ?>
                <div class="media-pick-item" onclick="selectThisMedia('<?php echo $m['filepath']; ?>')" style="background: white; border: 1px solid #E2E8F0; border-radius: 12px; padding: 0.5rem; cursor: pointer; transition: all 0.2s;">
                    <div style="height: 100px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 8px; background: #f1f5f9; margin-bottom: 0.5rem;">
                        <?php if (in_array($m['filetype'], ['jpg', 'jpeg', 'png', 'svg', 'webp', 'gif'])): ?>
                            <img src="../<?php echo $m['filepath']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <i class="bi bi-file-earmark" style="font-size: 2rem; color: #64748B;"></i>
                        <?php endif; ?>
                    </div>
                    <p style="font-size: 0.7rem; color: #1E293B; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 600;"><?php echo $m['filename']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="modal-footer" style="padding: 1.5rem 2rem; border-top: 1px solid #f1f5f9; text-align: right; background: #fff;">
            <button onclick="closeMediaModal()" class="btn btn-outline">Cancel</button>
        </div>
    </div>
</div>

<style>
    @keyframes modalSlideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .media-pick-item:hover {
        border-color: #E11D48;
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(225, 29, 72, 0.1);
    }
</style>

<script>
    let targetInputId = '';

    function openMediaModal(inputId) {
        targetInputId = inputId;
        document.getElementById('mediaModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeMediaModal() {
        document.getElementById('mediaModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function selectThisMedia(path) {
        if (targetInputId) {
            document.getElementById(targetInputId).value = path;
            
            // If there is a preview image, update it
            const previewId = targetInputId + '-preview';
            const previewEl = document.getElementById(previewId);
            if (previewEl) {
                previewEl.src = '../' + path;
                previewEl.style.display = 'block';
            }
        }
        closeMediaModal();
    }
</script>
