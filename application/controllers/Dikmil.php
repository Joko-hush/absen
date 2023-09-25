<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dikmil extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_staff();
    // }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR | Isi Data';
        $data['judul'] = 'Riwayat Pendidikan Militer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal Pendidikan militer',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);


        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['dik_a'] = $this->db->get('jb_dikmil_a')->result_array();
        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['dik_b'] = $this->db->get('jb_dikmil_b')->result_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/dikmil', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
