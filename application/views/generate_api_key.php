<!DOCTYPE html>
<html>
<head>
    <title>Generate API Key</title>
</head>
<body>
    <h1>Generate API Key</h1>
    
    <?php if ($this->session->flashdata('success')): ?>
        <p><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <?php echo validation_errors(); ?>

    <form action="<?php echo site_url('api_keys/generate'); ?>" method="POST">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" id="user_name" required><br><br>

        <label for="actions">Select Actions:</label><br>
        <input type="checkbox" name="actions[]" value="GET"> GET <br>
        <input type="checkbox" name="actions[]" value="POST"> POST <br>
        <input type="checkbox" name="actions[]" value="PUT"> PUT <br>
        <input type="checkbox" name="actions[]" value="UPDATE"> UPDATE <br>
        <input type="checkbox" name="actions[]" value="DELETE"> DELETE <br><br>

        <button type="submit">Generate API Key</button>
    </form>

    <a href="<?php echo site_url('api_keys/list'); ?>">View API Keys</a>
</body>
</html>
