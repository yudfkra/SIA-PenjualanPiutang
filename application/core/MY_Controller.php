<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // load helper
        $this->load->helper(array('my_helper', 'form_helper'));

        // load library untuk validasi input.
        $this->load->library('form_validation');
    }
}