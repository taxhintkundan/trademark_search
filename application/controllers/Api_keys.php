<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_keys extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->database(); // Load the database
    }

    // Generate API key page
    public function generate() {
        if ($this->input->post()) {
            // Set validation rules
            $this->form_validation->set_rules('user_name', 'User Name', 'required');
            $this->form_validation->set_rules('actions[]', 'Actions', 'required');

            if ($this->form_validation->run() == TRUE) {
                // Generate API key
                $api_key = hash('sha256', uniqid() . time());

                // Prepare data for insertion
                $data = array(
                    'user_name' => $this->input->post('user_name'),
                    'api_key' => $api_key,
                    'actions' => implode(',', $this->input->post('actions')), // Convert selected actions to comma-separated string
                    'created_at' => date('Y-m-d H:i:s'),
                );

                // Insert into the database
                if ($this->db->insert('api_keys', $data)) {
                    // Set a success message
                    $this->session->set_flashdata('success', 'API key generated successfully for ' . $data['user_name']);

                    // Redirect to the list page
                    redirect('api_keys/list');
                } else {
                    // Set an error message if insertion fails
                    $this->session->set_flashdata('error', 'Failed to generate API key.');
                    $this->load->view('generate_api_key');
                }
            } else {
                // Validation failed
                $this->load->view('generate_api_key');
            }
        } else {
            // Load the API key generation form
            $this->load->view('generate_api_key');
        }
    }

    // Display the list of API keys
    public function list() {
        // Fetch all API keys from the database
        $data['api_keys'] = $this->db->get('api_keys')->result();

        // Load the list view
        $this->load->view('api_key_list', $data);
    }

    // Delete an API key
    public function delete($id) {
        // Delete the API key by its ID
        if ($this->db->delete('api_keys', array('id' => $id))) {
            // Set a success message
            $this->session->set_flashdata('success', 'API key deleted successfully.');
        } else {
            // Set an error message if deletion fails
            $this->session->set_flashdata('error', 'Failed to delete API key.');
        }

        // Redirect to the list page
        redirect('api_keys/list');
    }
}
