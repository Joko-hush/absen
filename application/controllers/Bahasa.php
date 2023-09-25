<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahasa extends CI_Controller
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
            'action' => 'Buka hal bahasa',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('personil_id', $data['staff']['id']);
        $data['bahasa'] = $this->db->get('jb_b_daerah')->result_array();
        $this->db->where('personil_id', $data['staff']['id']);
        $data['bhsasing'] = $this->db->get('jb_b_asing')->result_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/bahasa', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
