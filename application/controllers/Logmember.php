<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Logmember extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR | Isi Data';
        $data['judul'] = 'Riwayat Pendidikan Militer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->db->where('user_id', $data['staff']['id']);
        $this->db->order_by('created_at', 'desc');
        $data['log'] = $this->db->get('log')->result_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/log', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
