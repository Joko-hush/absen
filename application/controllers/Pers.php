<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_pers();
    }

    public function changepassword()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Ubah Password';
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


        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|min_length[5]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/changepassword', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as current password! </div>');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Changed</div>');
                    redirect('auth');
                }
            }
        }
    }
    public function profil()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $this->db->order_by('date_created', 'desc');
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk', $today);
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();


        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/profil', $data);
        $this->load->view('layout/footer_pers', $data);
    }
}
