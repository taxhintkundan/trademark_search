<!DOCTYPE html>
<html>
<head>
    <title>Search Trademarks</title>
</head>
<body>
    <h2>Search for Trademarks</h2>

    <?php echo form_open('trademark/search', ['method' => 'get']); ?>
        <input type="text" name="query" placeholder="Enter search term" required />
        <input type="submit" value="Search" />
    <?php echo form_close(); ?>
</body>
</html>
