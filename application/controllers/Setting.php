<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_pers();
    }

    public function masterEselon()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Setting Eselon';
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


        $data['eselon'] = $this->db->get('m_eselon')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Eselon', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/eselon', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $nama = $this->input->post('nama');
            $this->db->insert('m_eselon', ['eselon' => $nama]);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Eselon baru ditambahkan.</div>');
            redirect('setting/masterEselon');
        }
    }
    public function hapusEselon()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('m_eselon');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Eselon berhasil dihapus.</div>');
        redirect('setting/masterEselon');
    }
    public function masterBidang()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Setting Bidang';
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


        $data['eselon'] = $this->db->get('m_eselon')->result_array();
        $data['bidang'] = $this->db->get('m_bidang')->result_array();

        $this->form_validation->set_rules('eselon', 'Nama Eselon', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama bidang', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/bidang', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $nama = $this->input->post('nama');
            $eselon = $this->input->post('eselon');
            $this->db->insert('m_bidang', ['eselon_id' => $eselon, 'bidang' => $nama]);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Bidang baru ditambahkan.</div>');
            redirect('setting/masterBidang');
        }
    }
    public function hapusBidang()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('m_bidang');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">bidang Kerja berhasil dihapus.</div>');
        redirect('setting/masterBidang');
    }
    public function masterBagian()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Setting Bagian';
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


        $data['eselon'] = $this->db->get('m_eselon')->result_array();
        $data['bidang'] = $this->db->get('m_bidang')->result_array();
        $data['bagian'] = $this->db->get('m_bagian')->result_array();

        $this->form_validation->set_rules('eselon', 'Nama Eselon', 'required|trim');
        $this->form_validation->set_rules('bidang', 'Nama bidang', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama bagian', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/bagian', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $nama = $this->input->post('nama');
            $bidang = $this->input->post('bidang');
            $eselon = $this->input->post('eselon');
            $data = [

                'eselon_id' => $eselon,
                'bidang_id' => $bidang,
                'bagian' => $nama
            ];
            $this->db->insert('m_bagian', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">bagian baru ditambahkan.</div>');
            redirect('setting/masterBagian');
        }
    }
    public function hapusBagian()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('m_bagian');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Bagian Kerja berhasil dihapus.</div>');
        redirect('setting/masterBagian');
    }
    public function masterSubBagian()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Setting Sub Bagian';
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



        $data['bagian'] = $this->db->get('m_bagian')->result_array();
        $data['subbagian'] = $this->db->get('m_subbagian')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Sub Bagian', 'required|trim');
        $this->form_validation->set_rules('bagian', 'Nama Bagian', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/subbagian', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {

            $nama = $this->input->post('nama');
            $ibagian = $this->input->post('bagian');
            list($bagian, $bidang, $eselon) = explode(',', $ibagian);
            $data = [
                'eselon_id' => $eselon,
                'bidang_id' => $bidang,
                'bagian_id' => $bagian,
                'subbagian' => $nama
            ];
            $this->db->insert('m_subbagian', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">bagian baru ditambahkan.</div>');
            redirect('setting/masterSubBagian');
        }
    }
    public function hapusSubBagian()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('m_subbagian');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">SubBagian Kerja berhasil dihapus.</div>');
        redirect('setting/masterSubBagian');
    }
    public function masterJabatan()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Setting Jabatan';
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



        $data['bagian'] = $this->db->get('m_bagian')->result_array();
        $this->db->order_by('isactive', 'desc');
        $data['jabatan'] = $this->db->get('m_jabatan')->result_array();
        $data['subbagian'] = $this->db->get('m_subbagian')->result_array();
        $this->form_validation->set_rules('nama', 'Nama Jabatan', 'required|trim');
        $this->form_validation->set_rules('sbagian', 'Nama Subbagian', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/jabatan', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $nama = $this->input->post('nama');
            $sbagian = $this->input->post('sbagian');
            $lead = $this->input->post('lead');
            $no_urut = $this->input->post('no_urut');
            if ($lead == '1') {
                $lead = 1;
            } else {
                $lead = 0;
            }

            $data = [
                'nama' => $nama,
                'subbagian_id' => $sbagian,
                'isactive' => 1,
                'leader' => $lead,
                'nomor' => $no_urut
            ];
            $this->db->insert('m_jabatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">Jabatan Kerja berhasil ditambahkan.</div>');
            redirect('setting/masterJabatan');
        }
    }
    public function aktivasiJabatan()
    {
        $id = $this->input->get('id');
        $aktif = $this->input->get('aktif');
        if ($aktif == 1) {
            $this->db->set('isactive', 0);
            $a = 'dinonaktifkan';
        } else {
            $this->db->set('isactive', 1);
            $a = 'diaktifkan';
        }

        $this->db->where('id', $id);
        $this->db->update('m_jabatan');
        $this->session->set_flashdata('message', "<div class='alert alert-success mt-2' role='alert'>jabatan Kerja berhasil $a.</div>");
        redirect('setting/masterJabatan');
    }
    public function jamKerja()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Setting Jam Kerja';
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


        $data['jamKerja'] = $this->db->get('jam_kerja')->result_array();

        $this->form_validation->set_rules('nama', 'nama jam kerja', 'trim|required');
        $this->form_validation->set_rules('in', 'jam masuk kerja', 'trim|required');
        $this->form_validation->set_rules('out', 'jam pulang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/jamKerja', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $nama = $this->input->post('nama');
            $in = $this->input->post('in');
            $out = $this->input->post('out');
            $ket = $this->input->post('ket');
            $this->load->model('Waktu_model', 'waktu');
            $total_jam = $this->waktu->selisihJam($in, $out);
            $data = [
                'nama' => $nama,
                'jam_masuk' => $in,
                'jam_pulang' => $out,
                'total_jam' => $total_jam,
                'ket' => $ket,
                'created_at' => time(),
                'updated_at' => time(),
                'isactive' => 1
            ];
            $this->db->insert('jam_kerja', $data);
            $this->session->set_flashdata('message', "<div class='alert alert-success mt-2' role='alert'>berhasil menambahkan jam kerja.</div>");
            redirect('setting/jamKerja');
        }
    }
    public function aktivasiJamKerja()
    {
        $id = $this->input->get('id');
        $aktif = $this->input->get('aktif');
        if ($aktif == 1) {
            $this->db->set('isactive', 0);
            $a = 'dinonaktifkan';
        } else {
            $this->db->set('isactive', 1);
            $a = 'diaktifkan';
        }

        $this->db->where('id', $id);
        $this->db->update('jam_kerja');
        $this->session->set_flashdata('message', "<div class='alert alert-success mt-2' role='alert'>Jam Kerja berhasil $a.</div>");
        redirect('setting/jamKerja');
    }
    public function hapusJamKerja()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jam_kerja');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">jam Kerja berhasil dihapus.</div>');
        redirect('setting/jamKerja');
    }
    public function editJamKerja()
    {
        $id = $this->input->get('id');
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Edit Jam Kerja';
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


        $this->db->where('id', $id);
        $data['jamKerja'] = $this->db->get('jam_kerja')->row_array();

        $this->form_validation->set_rules('nama', 'nama jam kerja', 'trim|required');
        $this->form_validation->set_rules('in', 'jam masuk kerja', 'trim|required');
        $this->form_validation->set_rules('out', 'jam pulang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/editJamKerja', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $in = $this->input->post('in');
            $out = $this->input->post('out');
            $ket = $this->input->post('ket');
            $this->load->model('Waktu_model', 'waktu');
            $total_jam = $this->waktu->selisihJam($in, $out);

            $this->db->where('id', $id);
            $this->db->set('nama', $nama);
            $this->db->set('jam_masuk', $in);
            $this->db->set('jam_pulang', $out);
            $this->db->set('total_jam', $total_jam);
            $this->db->set('ket', $ket);
            $this->db->set('updated_at', time());
            $this->db->update('jam_kerja');
            $this->session->set_flashdata('message', "<div class='alert alert-success mt-2' role='alert'>berhasil mengubah jam kerja.</div>");
            redirect('setting/jamKerja');
        }
    }
    public function ubahPassword()
    {

        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Ubah Password User';
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

        $this->db->select('U.id as id');
        $this->db->select('U.name as name');
        $this->db->select('U.email as email');
        $this->db->from('user as U');
        $this->db->join('jb_personil as P', 'P.nik = U.nik', 'right');
        $this->db->where('U.is_active', 2);
        $this->db->where('U.role_id', 2);
        $this->db->order_by('U.name', 'asc');
        $data['staff'] = $this->db->get()->result_array();

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/setting/editPassword', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function editPassword()
    {
        $id = $this->input->get('id');
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Ubah Password User';
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
        $this->db->where('id', $id);
        $data['staff'] = $this->db->get('user')->row_array();

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/setting/inputPassword', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $id = $this->input->post('id');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $this->db->set('password', $password);
            $this->db->where('id', $id);
            $this->db->update('user');
            $this->session->set_flashdata('message', "<div class='alert alert-success mt-2' role='alert'>berhasil mengubah password.</div>");
            redirect('setting/ubahPassword');
        }
    }
}
