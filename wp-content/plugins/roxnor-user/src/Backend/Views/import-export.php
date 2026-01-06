<div class="wrap">
    <h1>Import & Export Users</h1>
    
    <div class="card">
        <h2>Export Users</h2>
        <p>Export all users to CSV format.</p>
        <form method="post" action="">
            <?php wp_nonce_field('export_users', 'export_nonce'); ?>
            <input type="hidden" name="action" value="export" />
            <?php submit_button('Export Users', 'primary', 'export_users'); ?>
        </form>
    </div>
    
    <div class="card">
        <h2>Import Users</h2>
        <p>Import users from CSV file.</p>
        <form method="post" action="" enctype="multipart/form-data">
            <?php wp_nonce_field('import_users', 'import_nonce'); ?>
            <input type="hidden" name="action" value="import" />
            <table class="form-table">
                <tr>
                    <th><label for="import_file">CSV File</label></th>
                    <td><input type="file" id="import_file" name="import_file" accept=".csv" required /></td>
                </tr>
            </table>
            <?php submit_button('Import Users', 'primary', 'import_users'); ?>
        </form>
    </div>
</div>