<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('migration'); // Load the migration library
    }

    // Run migrations to the latest version
    public function index() {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrations ran successfully!";
        }
    }

    // Rollback migrations
    public function rollback() {
        if ($this->migration->version(0) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrations rolled back successfully!";
        }
    }
}
