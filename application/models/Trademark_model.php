<?php
class Trademark_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Insert a new trademark record
    public function insert_trademark($data) {
        // Adjust the data insert method to handle new fields
        $data_to_insert = array(
            'registration_number' => $data['registration_number'],
            'name'               => isset($data['name']) ? $data['name'] : null,
            'phone_number'       => isset($data['phone_number']) ? $data['phone_number'] : null,
            'email'              => isset($data['email']) ? $data['email'] : null,
            'trademark_name'     => isset($data['trademark_name']) ? $data['trademark_name'] : null,
            'trademark_type'     => isset($data['trademark_type']) ? $data['trademark_type'] : null,
            'trademark_class'    => isset($data['trademark_class']) ? $data['trademark_class'] : null,
            'state'              => isset($data['state']) ? $data['state'] : null,
            'jurisdiction'       => isset($data['jurisdiction']) ? $data['jurisdiction'] : null,
            'publication'        => isset($data['publication']) ? $data['publication'] : null,
            'image'              => isset($data['image']) ? $data['image'] : null,
            'created_at'         => $data['created_at'],
            'updated_at'         => $data['updated_at']
        );

        return $this->db->insert('trademarks', $data_to_insert);
    }

    // Search for trademarks by query
    public function search_trademark($query) {
        // Search in relevant fields
        $this->db->like('trademark_name', $query);
        $this->db->or_like('name', $query);
        $this->db->or_like('registration_number', $query);
        $this->db->or_like('phone_number', $query); // Added new field for searching
        $this->db->or_like('email', $query);        // Added new field for searching
        $this->db->or_like('trademark_type', $query); // Added new field for searching

        $query = $this->db->get('trademarks');
        return $query->result_array();
    }

    // Fetch details of a specific trademark by registration number
    // public function get_trademark_details($registration_number) {
    //     $this->db->where('registration_number', $registration_number);
    //     return $this->db->get('trademarks')->row_array();
    // }
    public function get_trademark_details_by_registration($registration_number) {
        // Query the database to get the trademark details using the registration number
        $this->db->where('registration_number', $registration_number);
        
        // Execute the query
        $query = $this->db->get('trademarks');
        
        // Return the result (single row)
        return $query->row_array();  // Return the result as an associative array
    }

    // Search for similar trademarks based on the input
    public function search_suggestions($query) {
        $this->db->select('registration_number, trademark_name');
        $this->db->from('trademarks');
        $this->db->like('trademark_name', $query); // Search by trademark_name, adjust if necessary
        $this->db->limit(10); // Limit the number of suggestions
        $query = $this->db->get();

        return $query->result();
    }

    // API model - Get all trademarks
    public function get_all_trademarks() {
        $query = $this->db->get('trademarks');
        return $query->result_array();
    }

    public function get_trademark_details_by_id($id) {
        // Make sure the ID is properly sanitized
        $this->db->where('id', $id);
        $query = $this->db->get('trademarks'); // 'trademarks' should be the name of your database table
        
        // Return the row as an array, assuming only one row should match
        return $query->row_array();
    }
}
