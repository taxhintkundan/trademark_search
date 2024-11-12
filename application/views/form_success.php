<!DOCTYPE html>
<html>
<head>
    <title>Form Success</title>
</head>
<body>
    <h2>
        <?php if($this->session->flashdata('success')): ?>
            <?php echo $this->session->flashdata('success'); ?>
        <?php endif; ?>
    </h2>
    <a href="<?php echo site_url('trademarks/dashboard'); ?>" style="display: inline-block; background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; text-align: center; transition: background-color 0.3s ease;">Back to Dashboard</a>
</body>
</html>
