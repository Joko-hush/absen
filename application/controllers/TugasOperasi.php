<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TugasOperasi extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_staff();
    // }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR | Tugas Operasi';
        $data['judul'] = 'Riwayat Tugas Operasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'masuk tugas operasi',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['tugasoperasi'] = $this->db->get('jb_r_tugas_operasi')->result_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/tugasOperasi', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
