<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manual extends CI_Controller
{
    public function index()
    {
        $this->load->view('manual');
    }
}
