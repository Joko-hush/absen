<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Utility extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_pers();
        $this->load->model("Utility_models");
    }

    public function aktifasiEmail()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Daftar User Belum Aktif';
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


        $this->db->where('is_active', 0);
        $client = $this->db->get('user')->result_array();

        $data['client'] = $client;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/client/index', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function aktivasi()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $client = $this->db->get('user')->row_array();

        $this->db->where('nik', $client['nik']);
        $cekNik = $this->db->get('jb_personil')->num_rows();

        if ($cekNik > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mt-2" role="alert">Sudah ada akun dengan NIK yang sama.</div>');
            redirect('utility/aktifasiEmail');
        } else {
            $this->db->set('is_active', 1);
            $this->db->where('id', $id);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Berhasil diaktivasi</div>');
            redirect('utility/aktifasiEmail');
        }
    }
    public function delete()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Berhasil dihapus</div>');
        redirect('utility/aktifasiEmail');
    }
    public function unregistered()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Daftar Personil belum Daftar';
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

        $this->load->model('Utility_models', 'uti');
        $client = $this->uti->getUnregistered();
        $data['client'] = $client;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/client/calon', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function editdapokpersonil()
    {
        $id = $this->input->get('id');
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Daftar Personil belum Daftar';
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

        $data['staff'] = $this->db->get_where('jb_personil', ['id' => $id])->row_array();
        $this->db->order_by('nomor', 'asc');
        $data['jabatan'] = $this->db->get('m_jabatan')->result_array();

        $this->form_validation->set_rules('nik', 'No Kepegawaian', 'trim|required');
        $this->form_validation->set_rules('sdm', 'Kualifikasi SDM', 'trim|required');
        $this->form_validation->set_rules('gp', 'Golongan', 'trim|required');
        $this->form_validation->set_rules('tl', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tlp', 'No Tlp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/client/editdapokpersonil', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/dosier/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                }
            }
            $jabatan = $this->input->post('jabatan');
            list($idj, $namaj, $sbj) = explode('|', $jabatan);
            $this->db->set('jabatan', trim($namaj));
            $suku_bangsa = $this->input->post('suku');
            $this->db->set('suku_bangsa', $suku_bangsa);
            $status = $this->input->post('status');
            $this->db->set('status', $status);
            $sdm = strtoupper(htmlspecialchars($this->input->post('sdm')));
            $this->db->set('kualifikasi_sdm', $sdm);
            $id = $this->input->post('id');
            $nik = $this->input->post('nik');
            $this->db->set('nik', $nik);
            $name = strtoupper(htmlspecialchars($this->input->post('name', true)));
            $this->db->set('name', $name);
            $tl = strtoupper(htmlspecialchars($this->input->post('tl', true)));
            $this->db->set('tempat_lahir', $tl);
            $ttl = strtoupper(htmlspecialchars($this->input->post('ttl', true)));
            $this->db->set('tgl_lahir', $ttl);
            $gender = strtoupper(htmlspecialchars($this->input->post('gender', true)));
            $this->db->set('sex', $gender);
            $darah = strtoupper(htmlspecialchars($this->input->post('darah', true)));
            $this->db->set('gol_darah', $darah);
            $tlp = strtoupper(htmlspecialchars($this->input->post('tlp', true)));
            $this->db->set('tlp', $tlp);
            $email = htmlspecialchars($this->input->post('email', true));
            $this->db->set('email', $email);
            $gp = htmlspecialchars($this->input->post('gp', true));
            $this->db->set('gol_pkt', $gp);
            $agama = strtoupper(htmlspecialchars($this->input->post('agama', true)));
            $this->db->set('agama', $agama);
            $alamat = strtoupper(htmlspecialchars($this->input->post('alamat', true)));
            $this->db->set('alamat', $alamat);
            $jamKerja = $this->input->post('jamKerja');

            $this->db->set('jam_kerja_id', $jamKerja);
            $this->db->where('id', $id);
            $this->db->update('jb_personil');

            $this->db->set('email', $email);
            $this->db->where('nik', $nik);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data</div>');
            redirect('personalia/user');
        }
    }
    public function nonaktifkanPersonil()
    {
        $data = array(
            'deleted' => 'yes',
        );
        $result = $this->Utility_models->updatePersonil($data, array('id' => $this->input->get('id')));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data</div>');
        redirect('personalia/user');
    }
}
