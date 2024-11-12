<!DOCTYPE html>
<html>
<head>
    <title>Add Trademark</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin: 15px 0 5px;
        }

        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .required::after {
            content: "*";
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <h2>Add Trademark</h2>

    <div class="error"><?php echo validation_errors(); ?></div>

    <?php echo form_open_multipart('trademarks/add'); ?>
    
        <label class="required" for="registration_number">Registration Number</label>
        <input type="text" name="registration_number" value="<?php echo set_value('registration_number'); ?>" required />

        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo set_value('name'); ?>" />

        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" value="<?php echo set_value('phone_number'); ?>" />

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo set_value('email'); ?>" />

        <label for="trademark_name">Trademark Name</label>
        <input type="text" name="trademark_name" value="<?php echo set_value('trademark_name'); ?>" />

        <label for="trademark_type">Trademark Type</label>
        <input type="text" name="trademark_type" value="<?php echo set_value('trademark_type'); ?>" />

        <label for="trademark_class">Trademark Class</label>
        <input type="text" name="trademark_class" value="<?php echo set_value('trademark_class'); ?>" />

        <label for="state">State</label>
        <input type="text" name="state" value="<?php echo set_value('state'); ?>" />

        <label for="jurisdiction">Jurisdiction</label>
        <input type="text" name="jurisdiction" value="<?php echo set_value('jurisdiction'); ?>" />

        <label for="publication">Publication</label>
        <input type="text" name="publication" value="<?php echo set_value('publication'); ?>" />

        <label for="image">Upload Trademark Image</label>
        <input type="file" name="image" />

        <input type="submit" value="Submit" />
        
    <?php echo form_close(); ?>
</body>
</html>
