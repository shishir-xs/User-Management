<div class="wrap">
    <h1 class="wp-heading-inline">Edit User</h1>
    <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>" class="page-title-action">← Back to Users</a>
    <hr class="wp-header-end">
    
    <?php echo $error; ?>
    
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" novalidate="novalidate">
        <input type="hidden" name="action" value="update_user">
        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
        <?php wp_nonce_field('edit_user', 'user_nonce'); ?>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="user_name">Name <span class="description">(required)</span></label>
                    </th>
                    <td>
                        <input name="user_name" type="text" id="user_name" value="<?php echo esc_attr($user->name); ?>" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60" class="regular-text" required />
                        <p class="description">Enter the user's full name.</p>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="user_email">Email <span class="description">(required)</span></label>
                    </th>
                    <td>
                        <input name="user_email" type="email" id="user_email" value="<?php echo esc_attr($user->email); ?>" class="regular-text ltr" required />
                        <p class="description">Enter a valid email address.</p>
                    </td>
                </tr>
                <tr class="form-field">
                    <th scope="row">
                        <label for="user_phone">Phone</label>
                    </th>
                    <td>
                        <input name="user_phone" type="text" id="user_phone" value="<?php echo esc_attr($user->phone); ?>" class="regular-text" />
                        <p class="description">Enter phone number (optional).</p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="submit">
            <?php submit_button('Update User', 'primary', 'submit', false); ?>
            <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=show&id=' . $user->id); ?>" class="button">View User</a>
            <a href="<?php echo wp_nonce_url(admin_url('admin-post.php?action=delete_user&id=' . $user->id), 'delete_user_' . $user->id, 'nonce'); ?>" class="button button-link-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
        </p>
    </form>
</div>