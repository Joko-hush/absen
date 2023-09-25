<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function personil()
    {
        $data['title'] = 'Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $db150 = $this->load->database('staff', true);
        $db150->where('is_active', 1);
        $data['staff'] = $db150->get('M_STAFF')->result_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/personil', $data);
        $this->load->view('templates/footer');
    }
    public function sample()
    {
        $db150 = $this->load->database('local', true);
        $db150->where('is_active', 1);
        $data['staff'] = $db150->get('M_STAFF')->result_array();
        var_dump($data['staff']);
    }
}
