<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Migration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function migrate() {
        // load migration library
        $this->load->library('migration');
//!$this->migration->latest();
//!$this->migration->current()
        if (!$this->migration->latest()) {
            echo 'Error' . $this->migration->error_string();
        } else {
            echo 'Migrations ran successfully!';
//            redirect(base_url());
        }
    }

    public function version($version) {
        if ($this->input->is_cli_request()) {
            $migration = $this->migration->version($version);
            if (!$migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done' . PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');
        }
    }

}
