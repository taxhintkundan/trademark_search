<!DOCTYPE html>
<html>
<head>
    <title>Trademark Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General body styles to center content */
        body {
            display: flex;
            flex-direction: column; /* Aligns items vertically */
            justify-content: center; /* Centers vertically */
            align-items: center; /* Centers horizontally */
            height: 100vh; /* Full height of the viewport */
            margin: 0;
            background-color: #3498db; /* Background color */
        }

        /* Style for the heading */
        h1 {
            color: #fff;
            text-align: center;
        }

        /* Style for the input box */
        #search {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Style for the suggestions list */
        #suggestions {
            list-style-type: none;
            padding: 0;
            margin-top: 5px;
            width: 50%; /* Make suggestions list same width as the input */
            border: 1px solid #ccc;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
        }

        /* Style for individual suggestion items */
        .suggest-item {
            padding: 10px;
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        /* Hover effect for suggestion items */
        .suggest-item:hover {
            background-color: #e0e0e0;
        }

        /* Style for the suggestion links */
        .suggest-item a {
            text-decoration: none;
            color: #333;
            display: block;
        }

        /* Style for the 'No suggestions found' message */
        #suggestions li {
            padding: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Powered by Trademarkpro</h1>
    <h1>Trademark Search</h1>
    
    <input type="text" id="search" placeholder="Search by Name, Registration Number, or Trademark Name">
    <ul id="suggestions"></ul> <!-- Suggestions will be populated here -->
    
    <script>
        $(document).ready(function() {
            // Handle input to fetch suggestions
            $('#search').on('input', function() {
                let query = $(this).val();
                
                if (query.length > 1) {
                    $.ajax({
                        url: "<?php echo site_url('trademarks/search_suggestions'); ?>",
                        method: 'GET',
                        data: {query: query},
                        success: function(data) {
                            let suggestions = JSON.parse(data);
                            let suggestionList = '';
                            if (suggestions.length > 0) {
                                suggestions.forEach(function(item) {
                                    suggestionList += `
                                        <li class="suggest-item" data-reg="${item.registration_number}">
                                            <a href="<?php echo site_url('trademarks/details/'); ?>${item.registration_number}">
                                                ${item.trademark_name} (${item.registration_number}) - ${item.name}
                                            </a>
                                        </li>`;
                                });
                            } else {
                                suggestionList = '<li>No suggestions found</li>';
                            }
                            $('#suggestions').html(suggestionList);
                        }
                    });
                } else {
                    $('#suggestions').html(''); // Clear suggestions if input is cleared
                }
            });
        });
    </script>
</body>
</html>
