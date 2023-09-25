<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Kumpul Sertifikat';
        $data['judul'] = 'Kumpulan Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->db->where('personil_id', $data['staff']['id']);
        $data['sertifikat'] = $this->db->get('jb_sertifikat')->result_array();

        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal sertifikat',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->form_validation->set_rules('nama', 'Nama Sertifikat', 'required|trim');
        $this->form_validation->set_rules('tgl', 'tgl Sertifikat', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/sertifikat', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $tgl = $this->input->post('tgl');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/dosier/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                    $file = [
                        'personil_id' => $id,
                        'sertifikat' => $nama,
                        'tgl' => $tgl,
                        'created_at' => time()
                    ];

                    $this->db->insert('jb_sertifikat', $file);
                    $log = [
                        'user_id' => $id,
                        'action' => 'upload sertifikat',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil Menyimpan sertifikat</div>');
                    redirect('sertifikat');
                } else {
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal upload sertifikat',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Maaf, upload file gagal. Silakan coba beberapa saat lagi.</div>');
                    redirect('sertifikat');
                }
            }
        }
    }
    public function hapus()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_sertifikat');
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Menghapus sertifikat',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus sertifikat</div>');
        redirect('sertifikat');
    }
    public function edit()
    {
        $id = $this->input->get('id');
        $data['title'] = 'Sertifikat';
        $data['judul'] = 'Edit Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->db->where('id', $id);
        $data['cert'] = $this->db->get('jb_sertifikat')->row_array();

        $this->form_validation->set_rules('nama', 'Nama Sertifikat', 'required|trim');
        $this->form_validation->set_rules('tgl', 'tgl Sertifikat', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/editsertifikat', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $personil_id = $this->input->post('personil_id');
            $nama = $this->input->post('nama');
            $tgl = $this->input->post('tgl');
            $this->db->set('sertifikat', $nama);
            $this->db->set('tgl', $tgl);
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/dosier/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'Error, gagal upload edit sertifikat',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Maaf, upload file gagal. Silakan coba beberapa saat lagi.</div>');
                    redirect('sertifikat');
                }
            }
            $this->db->where('id', $id);
            $this->db->update('jb_sertifikat');
            $log = [
                'user_id' => $personil_id,
                'action' => 'Edit sertifikat',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil mengedit sertifikat</div>');
            redirect('sertifikat');
        }
    }
}
