<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TugasLuarNegeri extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_staff();
    // }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR | Tugas Luar Negeri';
        $data['judul'] = 'Riwayat Tugas Luar Negeri';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'masuk riwayat tugas luar negeri',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);


        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['luarnegeri'] = $this->db->get('jb_r_tugas_luarnegri')->result_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/tugasLuarNegeri', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
