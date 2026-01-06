<div class="wrap">
    <h1 class="wp-heading-inline">Add New User</h1>
    <hr class="wp-header-end">
    
    <?php echo $error; ?>
    
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" novalidate="novalidate">
        <input type="hidden" name="action" value="create_user">
        <?php wp_nonce_field('create_user', 'user_nonce'); ?>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="user_name">Name <span class="description">(required)</span></label>
                    </th>
                    <td>
                        <input name="user_name" type="text" id="user_name" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60" class="regular-text" required />
                        <p class="description">Enter the user's full name.</p>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="user_email">Email <span class="description">(required)</span></label>
                    </th>
                    <td>
                        <input name="user_email" type="email" id="user_email" value="" class="regular-text ltr" required />
                        <p class="description">Enter a valid email address.</p>
                    </td>
                </tr>
                <tr class="form-field">
                    <th scope="row">
                        <label for="user_phone">Phone</label>
                    </th>
                    <td>
                        <input name="user_phone" type="text" id="user_phone" value="" class="regular-text" />
                        <p class="description">Enter phone number (optional).</p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php submit_button('Add New User'); ?>
    </form>
</div>