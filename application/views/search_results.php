<!DOCTYPE html>
<html>
<head>
    <title>Search Trademarks</title>
</head>
<body>
    <h2>Search Results</h2>

    <?php if (!empty($results)): ?>
        <table border="1">
            <tr>
                <th>Registration Number</th>
                <th>Name</th>
                <th>Trademark Name</th>
                <th>Trademark Class</th>
                <th>State</th>
                <th>Details</th>
            </tr>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['registration_number']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['trademark_name']; ?></td>
                    <td><?php echo $row['trademark_class']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><a href="<?php echo site_url('trademark/details/'.$row['registration_number']); ?>">View Details</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>
</html>
