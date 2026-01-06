<div class="wrap">
    <h1 class="wp-heading-inline">User Details</h1>
    <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=edit&id=' . $user->id); ?>" class="page-title-action">Edit</a>
    <hr class="wp-header-end">
    
    <div class="card">
        <h2 class="title"><?php echo esc_html($user->name); ?></h2>
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td><?php echo $user->id; ?></td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td><?php echo esc_html($user->name); ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><a href="mailto:<?php echo esc_attr($user->email); ?>"><?php echo esc_html($user->email); ?></a></td>
                </tr>
                <tr>
                    <th scope="row">Phone</th>
                    <td><?php echo esc_html($user->phone ?: 'Not provided'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Created</th>
                    <td><?php echo date('F j, Y \a\t g:i a', strtotime($user->created_at)); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <p class="submit">
        <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=edit&id=' . $user->id); ?>" class="button button-primary">Edit User</a>
        <a href="<?php echo admin_url('admin.php?page=roxnor-user&action=list'); ?>" class="button">Back to Users</a>
        <a href="<?php echo wp_nonce_url(admin_url('admin-post.php?action=delete_user&id=' . $user->id), 'delete_user_' . $user->id, 'nonce'); ?>" class="button button-link-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
    </p>
</div>