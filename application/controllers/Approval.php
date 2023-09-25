<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Approval extends CI_Controller
{
    public function ijin()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Persetujuan Ijin Tidak Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $this->db->order_by('date_created', 'desc');
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();


        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getIjin();

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('approval/index', $data);
        $this->load->view('layout/footer_pers', $data);
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
            redirect('approval/ijin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal disetujui.</div>');
            redirect('approval/ijin');
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
            redirect('approval/ijin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal ditolak.</div>');
            redirect('approval/ijin');
        }
    }
}
