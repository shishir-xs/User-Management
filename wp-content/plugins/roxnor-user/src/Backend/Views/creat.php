<div class="wrap roxnor-user-management">
    <div class="roxnor-page-header">
        <h1 class="roxnor-page-title">
            <span class="dashicons dashicons-plus-alt2" style="margin-right: 12px; color: #3b82f6;"></span>
            Add New User
        </h1>
        <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>" class="roxnor-btn roxnor-btn-secondary">
            <span class="dashicons dashicons-arrow-left-alt2"></span>
            Back to Users
        </a>
    </div>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="roxnor-notification roxnor-notification-error">
            <span class="dashicons dashicons-warning"></span>
            Error creating user. Please try again.
        </div>
    <?php endif; ?>
    
    <div class="roxnor-form-container">
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" novalidate="novalidate">
            <input type="hidden" name="action" value="create_user">
            <?php wp_nonce_field('create_user', 'user_nonce'); ?>
            
            <div class="roxnor-form-group">
                <label for="user_name" class="roxnor-form-label">
                    Full Name <span style="color: #ef4444;">*</span>
                </label>
                <input name="user_name" type="text" id="user_name" value="" class="roxnor-form-input" required />
                <div class="roxnor-form-help">Enter the user's full name</div>
            </div>
            
            <div class="roxnor-form-group">
                <label for="user_email" class="roxnor-form-label">
                    Email Address <span style="color: #ef4444;">*</span>
                </label>
                <input name="user_email" type="email" id="user_email" value="" class="roxnor-form-input" required />
                <div class="roxnor-form-help">Enter a valid email address</div>
            </div>
            
            <div class="roxnor-form-group">
                <label for="user_phone" class="roxnor-form-label">
                    Phone Number
                </label>
                <input name="user_phone" type="text" id="user_phone" value="" class="roxnor-form-input" />
                <div class="roxnor-form-help">Enter phone number (optional)</div>
            </div>
            
            <div style="display: flex; gap: 12px; margin-top: 32px;">
                <button type="submit" class="roxnor-btn roxnor-btn-primary">
                    <span class="dashicons dashicons-plus-alt2"></span>
                    Create User
                </button>
                <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>" class="roxnor-btn roxnor-btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>