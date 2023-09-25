<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_staff();
    }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Dashboard Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $today = date('Y-m-d');
        $this->db->where('tgl_masuk', $today);
        $this->db->where('status', 'diajukan');
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getIjin();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/leader/dashboard', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function ijin()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Dashboard Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $today = date('Y-m-d');
        $this->db->where('tgl_masuk', $today);
        $this->db->where('status', 'diajukan');
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getIjin();

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/leader/ijin', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function setuju()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['name'];
        $id = $this->input->get('id');
        $this->load->model('Absen_models', 'absen');
        $ket = $this->absen->absenSetuju($id, $user);
        if ($ket == 'success') {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil disetujui.</div>');
            redirect('leader/ijin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal disetujui.</div>');
            redirect('leader/ijin');
        }
    }
    public function tolak()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user']['name'];
        $id = $this->input->get('id');
        $this->load->model('Absen_models', 'absen');
        $ket = $this->absen->absenTolak($id, $user);
        if ($ket == 'success') {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Telah ditolak.</div>');
            redirect('leader/ijin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal ditolak.</div>');
            redirect('leader/ijin');
        }
    }
}
