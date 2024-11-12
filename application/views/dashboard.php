<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trademark Management Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .button {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trademark Management Dashboard</h1>
        <a href="<?php echo site_url('trademarks/add'); ?>" class="button">Add Trademark</a>
        <a href="<?php echo site_url('trademarks/search'); ?>" class="button">Search Trademark</a>
        <a href="<?php echo site_url('api_keys/list'); ?>" class="button">API Management</a>
    </div>
</body>
</html>
