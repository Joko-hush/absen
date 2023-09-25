<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehormatan extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_staff();
    // }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR | Kehormatan';
        $data['judul'] = 'Riwayat Kehormatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'masuk riwayat kehormatan',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['tandakehormatan'] = $this->db->get('jb_tanda_kehormatan')->result_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/kehormatan', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
