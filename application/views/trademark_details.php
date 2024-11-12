<!DOCTYPE html>
<html>
<head>
    <title>Trademark Details</title>
    <style>
        /* General body styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #3498db;
        }

        /* Header styles */
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Container for the trademark details */
        .trademark-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            display: flex; /* Flexbox layout */
            justify-content: space-between; /* Space between the text and image */
            align-items: flex-start; /* Align content to the top */
        }

        /* Container for the text details */
        .details {
            flex: 1;
            margin-right: 20px; /* Space between text and image */
        }

        /* Paragraph and label styles */
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }

        p strong {
            color: #333;
        }

        /* Image container to control its size */
        .image-container {
            width: 250px;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9; /* Background for the container */
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        /* Image styling */
        .image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Ensure image fits without distortion */
            border-radius: 8px;
        }

        /* Link button styling */
        a {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }

        /* No details styling */
        .no-details {
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
        }

        /* Centering the button */
        .button-container {
            text-align: center;
            margin-top: 20px; /* Space above the button */
        }
    </style>
</head>
<body>
    <h1>Trademark Details</h1>

    <div class="trademark-details">
        <div class="details">
            <?php if (isset($trademark)): ?>
                <p><strong>Registration Number:</strong> <?php echo $trademark['registration_number']; ?></p>
                <p><strong>Name:</strong> <?php echo $trademark['name'] ? $trademark['name'] : 'N/A'; ?></p>
                <p><strong>Trademark Name:</strong> <?php echo $trademark['trademark_name'] ? $trademark['trademark_name'] : 'N/A'; ?></p>
                <p><strong>Trademark Class:</strong> <?php echo $trademark['trademark_class'] ? $trademark['trademark_class'] : 'N/A'; ?></p>
                <p><strong>State:</strong> <?php echo $trademark['state'] ? $trademark['state'] : 'N/A'; ?></p>
                <p><strong>Jurisdiction:</strong> <?php echo $trademark['jurisdiction'] ? $trademark['jurisdiction'] : 'N/A'; ?></p>
            <?php else: ?>
                <p class="no-details">No details available for this trademark.</p>
            <?php endif; ?>
        </div>

        <!-- Image container -->
        <div class="image-container">
            <?php if (!empty($trademark['image'])): ?>
                <img src="<?php echo base_url($trademark['image']); ?>" alt="Trademark Image">
            <?php else: ?>
                <p><strong>Trademark Image:</strong> Not available</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="button-container">
        <a href="<?php echo site_url('trademarks/search'); ?>">Search Another Trademark</a>
    </div>
</body>
</html>
