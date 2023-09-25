<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input extends CI_Controller
{

    public function dikmil()
    {
        $data['title'] = 'SIPERS | Isi Data';
        $data['judul'] = 'Pendidikan Militer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/jb_dikmil', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
