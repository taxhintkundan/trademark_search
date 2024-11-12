<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trademarks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Trademark_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'session')); // Load the session library here
    }
    //load the dashboard
    public function dashboard() {
        $this->load->view('dashboard');
    }
    
    // Load the form and process submission
    public function add() {
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'required|is_unique[trademarks.registration_number]');
            
            // No file upload validation, as the image is not required anymore
            if ($this->form_validation->run() == TRUE) {
                $image_path = null;

                // Handle file upload if an image is uploaded
                if (!empty($_FILES['image']['name'])) {
                    $config['upload_path'] = './uploads/trademarks/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 2048; // 2MB
                    $config['encrypt_name'] = TRUE; // Encrypt file name to avoid conflicts

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('image')) {
                        // If file upload fails, show the error
                        $data['upload_error'] = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $data['upload_error']);
                        $this->load->view('trademark_form', $data);
                        return; // Stop execution on file upload error
                    } else {
                        // File upload success
                        $upload_data = $this->upload->data();
                        $image_path = 'uploads/trademarks/' . $upload_data['file_name'];
                    }
                }

                // Prepare data for insertion
                $data = array(
                    'registration_number' => $this->input->post('registration_number'),
                    'name' => $this->input->post('name'),
                    'phone_number' => $this->input->post('phone_number'),
                    'email' => $this->input->post('email'),
                    'trademark_name' => $this->input->post('trademark_name'),
                    'trademark_type' => $this->input->post('trademark_type'),
                    'trademark_class' => $this->input->post('trademark_class'),
                    'state' => $this->input->post('state'),
                    'jurisdiction' => $this->input->post('jurisdiction'),
                    'publication' => $this->input->post('publication'),
                    'image' => $image_path, // Store image path or null if no image
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                // Insert the trademark data into the database
                $insert = $this->db->insert('trademarks', $data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Trademark added successfully');
                    redirect('trademarks/success');
                } else {
                    $this->session->set_flashdata('error', 'An error occurred while saving the data.');
                    $this->load->view('trademark_form');
                }
            } else {
                // Validation failed
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('trademark_form');
            }
        } else {
            // Load the form view initially
            $this->load->view('trademark_form');
        }
    }




    

    // Success page after insertion
    public function success() {
        $this->load->view('form_success');
    }

    // Fetch details of a specific trademark
    // public function details($registration_number) {
    //     // Fetch the trademark details from the database using the registration number
    //     $data['trademark'] = $this->Trademark_model->get_trademark_details($registration_number);

    //     // Load the view with the trademark data
    //     $this->load->view('trademark_details', $data);
    // }


    public function details($registration_number) {
        // Load your Trademark model
        $this->load->model('Trademark_model');
        
        // Fetch the trademark details using only the registration number
        $trademark = $this->Trademark_model->get_trademark_details_by_registration($registration_number);
        
        // Check if the trademark exists
        if ($trademark) {
            // Load the view and pass the trademark details
            $this->load->view('trademark_details', ['trademark' => $trademark]);
        } else {
            // If no trademark is found, show a 404 error page
            show_404();
        }
    }

   
    

    // check the files
    public function file_check($str){
        if (empty($_FILES['image']['name'])) {
            return TRUE; // No file is uploaded, this is optional, so return TRUE
        } else {
            // Check for valid file upload
            $allowed_mime_type_arr = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
            $mime = get_mime_by_extension($_FILES['image']['name']);
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_check', 'Please upload an image.');
                return FALSE;
            }
        }
    }


    // Search for trademarks
    public function search() {
        $query = $this->input->post('query'); // Get the search input

        if ($query) {
            $data['results'] = $this->Trademark_model->search_trademark($query);
        } else {
            $data['results'] = null; // No data to display initially
        }

        $this->load->view('trademark_search', $data);
    }

    // Search suggestions
    // public function search_suggestions() {
    //     $query = $this->input->get('query'); // Get the search term from the AJAX request

    //     if ($query) {
    //         // Search for similar trademarks based on registration number, name, or trademark name
    //         $this->db->select('registration_number, name, trademark_name');
    //         $this->db->from('trademarks');
    //         $this->db->like('registration_number', $query);
    //         $this->db->or_like('name', $query);
    //         $this->db->or_like('trademark_name', $query);
    //         $this->db->limit(10); // Limit to 10 suggestions
    //         $result = $this->db->get();

    //         // Return suggestions as JSON
    //         echo json_encode($result->result());
    //     }
    // }

    public function search_suggestions() {
        $query = $this->input->get('query'); // Get the search term from the AJAX request
    
        if ($query) {
            // Search for similar trademarks based on registration number, name, or trademark name
            $this->db->select('registration_number, name, trademark_name, trademark_class, state, jurisdiction');
            $this->db->from('trademarks');
            $this->db->like('registration_number', $query);
            $this->db->or_like('name', $query);
            $this->db->or_like('trademark_name', $query);
            $this->db->limit(10); // Limit to 10 suggestions
            $result = $this->db->get();
    
            // Return suggestions as JSON
            echo json_encode($result->result());
        }
    }
    
    // download image
    public function download_image($id) {
        // Load the trademark details based on the ID
        $trademark = $this->Trademark_model->get_trademark_details_by_id($id); // Make sure the model returns the correct data
    
        if ($trademark && file_exists($trademark['image'])) {
            // Get the file path and name
            $file_path = $trademark['image'];
            $file_name = basename($file_path);
    
            // Set headers for file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . filesize($file_path));
    
            // Read the file and send it to the output buffer
            readfile($file_path);
            exit;
        } else {
            show_404(); // Show 404 error if file not found
        }
    }
    
}
