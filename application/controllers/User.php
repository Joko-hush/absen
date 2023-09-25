<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($data['user']['role_id'] == 2) {
            redirect('member/index');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {

        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['klinik'] = $this->db->get('klinik')->result_array();
        if (!$data['user']['klinik1']) {
            $data['k1'] = [
                'id' => '',
                'nama' => ''
            ];
        } else {
            $data['k1'] = $this->db->get_where('klinik', ['id' => $data['user']['klinik1']])->row_array();
        }
        if (!$data['user']['klinik2']) {
            $data['k2'] = [
                'id' => '',
                'nama' => ''
            ];
        } else {
            $data['k2'] = $this->db->get_where('klinik', ['id' => $data['user']['klinik2']])->row_array();
        }
        if (!$data['user']['klinik3']) {
            $data['k3'] = [
                'id' => '',
                'nama' => ''
            ];
        } else {
            $data['k3'] = $this->db->get_where('klinik', ['id' => $data['user']['klinik3']])->row_array();
        }





        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('klinik1', 'Klinik 1', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');

            if ($this->input->post('klinik1') == null) {

                $k1 = $this->input->post('klinik12');
                $data = ['nama' => $k1];
                $this->db->insert('klinik', $data);
                $result = $this->db->get_where('klinik', ['nama' => $k1])->row_array();
                $klinik1 = $result['id'];
            } else {
                $klinik1 = $this->input->post('klinik1');
            }
            if ($this->input->post('klinik2') == null) {
                if ($this->input->post('klinik32') == null) {
                    $klinik2 = $this->input->post('klinik2');
                } else {
                    $k2 = $this->input->post('klinik22');
                    $data = ['nama' => $k2];
                    $this->db->insert('klinik', $data);
                    $result = $this->db->get_where('klinik', ['nama' => $k2])->row_array();
                    $klinik2 = $result['id'];
                }
            } else {
                $klinik2 = $this->input->post('klinik2');
            }
            if ($this->input->post('klinik3') == null) {
                if ($this->input->post('klinik32') == null) {
                    $klinik3 = $this->input->post('klinik3');
                } else {
                    $k3 = $this->input->post('klinik32');
                    $data = ['nama' => $k3];
                    $this->db->insert('klinik', $data);
                    $result = $this->db->get_where('klinik', ['nama' => $k3])->row_array();
                    $klinik3 = $result['id'];
                }
            } else {
                $klinik3 = $this->input->post('klinik3');
            }






            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }



                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = [
                'name' => $name,
                'phone' => $phone,
                'address' => $address
            ];


            $this->db->set('klinik1', $klinik1);
            $this->db->set('klinik2', $klinik2);
            $this->db->set('klinik3', $klinik3);
            $this->db->where('email', $email);
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your profile has been updated</div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|min_length[5]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
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

    public function address()
    {
        $data['title'] = 'Address';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/address', $data);
            $this->load->view('templates/footer');
        } else {
            $user_id = $data['user']['id'];
            $date_created = time();
            $phone = $this->input->post('phone');
            $addr = $this->input->post('address');

            $data = [
                'user_id' => $user_id,
                'phone' => $phone,
                'address' => $addr,
                'date_created' => $date_created
            ];

            $this->db->insert('address', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Address has been added</div>');
            redirect('user/address');
        }
    }
}
