<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->helper('url'); // Load the URL helper to use base_url()
        $this->load->helper('file'); // Load file helper for file operations


    }

    // Function to validate the API key and action
    private function validate_api_key($api_key, $action) {
        log_message('debug', "Validating API key: $api_key for action: $action");

        $query = $this->db->get_where('api_keys', array('api_key' => $api_key));
        $api_key_data = $query->row();

        if ($api_key_data) {
            log_message('debug', "API key found: " . $api_key_data->api_key);

            // Check if the action is allowed
            $allowed_actions = explode(',', $api_key_data->actions);
            log_message('debug', "Allowed actions: " . implode(', ', $allowed_actions));

            if (in_array($action, $allowed_actions)) {
                log_message('debug', "Action allowed: " . $action);
                return true;
            } else {
                log_message('debug', "Action not allowed: " . $action);
            }
        } else {
            log_message('debug', "API key not found.");
        }

        return false;
    }


    public function get_data() {
        // Get API key from headers
        $api_key = $this->input->get_request_header('X-API-KEY');

        // Validate the API key for GET action
        if ($this->validate_api_key($api_key, 'GET')) {

            // Fetch data from the trademarks table
            $query = $this->db->get('trademarks');
            $data = $query->result();

            // Prepare an array to store the modified data with download links
            $response_data = array();

            foreach ($data as $row) {
                // Generate download URL for the image
                if (!empty($row->image)) {
                    $download_link = base_url('api/download_image/' . $row->id);
                } else {
                    $download_link = null; // If no image is available
                }

                // Append the download link to the row
                $row->download_link = $download_link;

                // Add the modified row to the response data
                $response_data[] = $row;
            }

            // Return data as JSON, including download links
            echo json_encode(array('status' => 'success', 'data' => $response_data));
        } else {
            // Return error if the key is invalid
            echo json_encode(array('status' => 'error', 'message' => 'Invalid API key or action not allowed'));
        }
    }
    

    
    public function post_data() {
        // Get API key from headers
        $api_key = $this->input->get_request_header('X-API-KEY');
    
        // Validate the API key for POST action
        if ($this->validate_api_key($api_key, 'POST')) {
    
            // Get raw POST input (for JSON requests)
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
    
            // Check if the compulsory field 'registration_number' is received
            if (isset($input_data['registration_number'])) {
    
                // Prepare the data array (optional fields are checked and set if available)
                $data = array(
                    'registration_number' => $input_data['registration_number'],
                    'name' => isset($input_data['name']) ? $input_data['name'] : null,
                    'phone_number' => isset($input_data['phone_number']) ? $input_data['phone_number'] : null,
                    'email' => isset($input_data['email']) ? $input_data['email'] : null,
                    'trademark_name' => isset($input_data['trademark_name']) ? $input_data['trademark_name'] : null,
                    'trademark_type' => isset($input_data['trademark_type']) ? $input_data['trademark_type'] : null,
                    'trademark_class' => isset($input_data['trademark_class']) ? $input_data['trademark_class'] : null,
                    'state' => isset($input_data['state']) ? $input_data['state'] : null,
                    'jurisdiction' => isset($input_data['jurisdiction']) ? $input_data['jurisdiction'] : null,
                    'publication' => isset($input_data['publication']) ? $input_data['publication'] : null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
    
                // Check if image is provided as base64
                if (isset($input_data['image']) && !empty($input_data['image'])) {
                    $image_data = $input_data['image']; // Base64 encoded image data
                    $image_name = uniqid() . '.jpg'; // Generate unique name for the image
                    $image_path = './uploads/trademarks/' . $image_name;
    
                    // Decode the base64 data and save the image
                    $decoded_image = base64_decode($image_data);
                    if (file_put_contents($image_path, $decoded_image)) {
                        $data['image'] = 'uploads/trademarks/' . $image_name;
                    } else {
                        // If image saving fails, return an error response
                        echo json_encode(array('status' => 'error', 'message' => 'Failed to save image'));
                        return;
                    }
                }
    
                // Insert the data into the trademarks table
                if ($this->db->insert('trademarks', $data)) {
                    // Success response
                    $response = array(
                        'status' => 'success',
                        'message' => 'Trademark data posted successfully'
                    );
                } else {
                    // Failure response
                    $response = array(
                        'status' => 'error',
                        'message' => 'Error inserting data into trademarks table'
                    );
                }
            } else {
                // Missing compulsory field (registration_number) response
                $response = array(
                    'status' => 'error',
                    'message' => 'Missing compulsory field: registration_number'
                );
            }
        } else {
            // Invalid API key or action not allowed response
            $response = array(
                'status' => 'error',
                'message' => 'Invalid API key or action not allowed'
            );
        }
    
        // Output the response
        echo json_encode($response);
    }
    

    // PUT: Update data in the `trademarks` table
    public function put_data($id) {
        // Get API key from headers
        $api_key = $this->input->get_request_header('X-API-KEY');

        // Validate the API key for PUT action
        if ($this->validate_api_key($api_key, 'PUT')) {
            // Get raw input data
            $input_data = json_decode(trim(file_get_contents('php://input')), true);

            if (!empty($input_data)) {
                // Prepare data for update (only allowed fields)
                $allowed_fields = array('registration_number', 'name', 'phone_number', 'email', 'trademark_name', 'trademark_type', 'trademark_class', 'state', 'jurisdiction', 'publication', 'image');
                $data = array();

                foreach ($allowed_fields as $field) {
                    if (isset($input_data[$field])) {
                        $data[$field] = $input_data[$field];
                    }
                }

                // Update the 'updated_at' field
                $data['updated_at'] = date('Y-m-d H:i:s');

                if (!empty($data)) {
                    $this->db->where('id', $id);
                    if ($this->db->update('trademarks', $data)) {
                        echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
                    } else {
                        echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
                    }
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'No valid data provided for update'));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid API key or action not allowed'));
        }
    }

    // DELETE: Delete data from the `trademarks` table by ID
    public function delete_data($id) {
        // Get API key from headers
        $api_key = $this->input->get_request_header('X-API-KEY');

        // Validate the API key for DELETE action
        if ($this->validate_api_key($api_key, 'DELETE')) {
            // Delete data from the `trademarks` table by ID
            $this->db->where('id', $id);
            if ($this->db->delete('trademarks')) {
                echo json_encode(array('status' => 'success', 'message' => 'Data deleted successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to delete data'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid API key or action not allowed'));
        }
    }

    // Function to handle image download by ID
    public function download_image($id) {
        // Fetch the trademark details based on ID
        $trademark = $this->Trademark_model->get_trademark_details($id);
        
        if ($trademark && !empty($trademark['image'])) {
            // Full path to the image
            $image_path = FCPATH . $trademark['image'];
    
            // Check if file exists
            if (file_exists($image_path)) {
                // Set headers to download the file
                header('Content-Type: ' . mime_content_type($image_path));
                header('Content-Disposition: attachment; filename="' . basename($image_path) . '"');
                header('Content-Length: ' . filesize($image_path));
                readfile($image_path); // Output the file
                exit;
            } else {
                show_404(); // Show 404 if the file doesn't exist
            }
        } else {
            show_404(); // Show 404 if no trademark or image found
        }
    }
    
    
}
