<!DOCTYPE html>
<html>
<head>
    <title>API Key List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .section {
            margin-top: 20px;
        }
        .section h2 {
            margin-top: 0;
        }
        .iframe-code, .endpoint {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
            font-family: monospace;
            font-size: 14px;
        }
        .endpoint p {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>API Key List</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <p><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>API Key</th>
            <th>Actions</th>
            <th>Created At</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($api_keys as $key): ?>
        <tr>
            <td><?php echo $key->id; ?></td>
            <td><?php echo $key->user_name; ?></td>
            <td><?php echo $key->api_key; ?></td>
            <td><?php echo $key->actions; ?></td>
            <td><?php echo $key->created_at; ?></td>
            <td><a href="<?php echo site_url('api_keys/delete/' . $key->id); ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="<?php echo site_url('api_keys/generate'); ?>" style="display: inline-block; background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; text-align: center; transition: background-color 0.3s ease;">
    Generate New API Key
</a>

    <!-- API Endpoints Section -->
    <div class="section">
        <h2>API Endpoints</h2>
        <p>Below are the available API endpoints to perform different actions:</p>

        <div class="endpoint">
            <p><strong>GET Data:</strong></p>
            <p>URL: <code><?php echo base_url('api/get_data'); ?></code></p>
            <p>Description: Retrieve data from the API.</p>
        </div>

        <div class="endpoint">
            <p><strong>POST Data:</strong></p>
            <p>URL: <code><?php echo base_url('api/post_data'); ?></code></p>
            <p>Description: Submit new data to the API.</p>
        </div>

        <div class="endpoint">
            <p><strong>PUT Data:</strong></p>
            <p>URL: <code><?php echo base_url('api/put_data/{id}'); ?></code></p>
            <p>Description: Update data by specifying the ID of the record.</p>
        </div>

        <div class="endpoint">
            <p><strong>DELETE Data:</strong></p>
            <p>URL: <code><?php echo base_url('api/delete_data/{id}'); ?></code></p>
            <p>Description: Delete data by specifying the ID of the record.</p>
        </div>
    </div>

    <!-- Trademark Search Integration Iframe Section -->
    <div class="section">
        <h2>Trademark Search Page Integration</h2>
        <p>Embed the following iframe code to integrate the Trademark Search page on your website:</p>
        <div class="iframe-code">
            &lt;iframe src="<?php echo base_url('trademarks/search'); ?>" width="100%" height="600" frameborder="0"&gt;&lt;/iframe&gt;
        </div>
    </div>

    <!-- Add Trademark Form Integration Iframe Section -->
    <div class="section">
        <h2>Add Trademark Form Integration</h2>
        <p>Embed the following iframe code to integrate the Add Trademark form page on your website:</p>
        <div class="iframe-code">
            &lt;iframe src="<?php echo base_url('trademarks/add'); ?>" width="100%" height="600" frameborder="0"&gt;&lt;/iframe&gt;
        </div>
    </div>
</body>
</html>
