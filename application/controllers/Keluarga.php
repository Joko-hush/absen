<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_staff();
    }

    public function index()
    {
        $data['title'] = 'SIPERS | Dashboard';
        $data['judul'] = 'Data Keluarga';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $data['keluarga'] = $this->db->get_where('jb_keluarga', ['personil_id' => $data['staff']['id']])->result_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal keluarga',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/keluarga', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('tl', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('ttl', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('hub', 'Hubungan Keluarga', 'trim|required');
        $this->form_validation->set_rules('bpjs', 'No BPJS', 'trim|required');


        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data yang diinput masih kurang, Proses di batalkan</div>');
            redirect('keluarga');
        } else {


            $id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
            $tl = strtoupper(htmlspecialchars($this->input->post('tl')));
            $ttl = strtoupper(htmlspecialchars($this->input->post('ttl')));
            $ktp = strtoupper(htmlspecialchars($this->input->post('ktp')));
            $gol = strtoupper(htmlspecialchars($this->input->post('gol')));
            $bpjs = $this->input->post('bpjs');
            $hub = strtoupper(htmlspecialchars($this->input->post('hub')));
            $alamat = strtoupper(htmlspecialchars($this->input->post('alamat')));
            $fktp = strtoupper(htmlspecialchars($this->input->post('fktp')));
            $email = $this->input->post('email');
            $tlp = $this->input->post('tlp');
            $agama = strtoupper(htmlspecialchars($this->input->post('agama')));
            $status = $this->input->post('status');
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg|webp|tiff';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $upload_image1 = $_FILES['image1']['name'];

            if ($upload_image1) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg|webp|tiff';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image1')) {
                    $new_image1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $upload_image2 = $_FILES['image2']['name'];

            if ($upload_image2) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg|webp|tiff';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    $new_image2 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = [
                'personil_id' => $id,
                'nama' => $nama,
                'tempat_lahir' => $tl,
                'tanggal_lahir' => $ttl,
                'hub' => $hub,
                'gol_darah' => $gol,
                'stat_hidup' => $status,
                'ktp' => $ktp,
                'bpjs' => $bpjs,
                'email' => $email,
                'tlp' => $tlp,
                'agama' => $agama,
                'fktp' => $fktp,
                'alamat' => $alamat,
                'doc_aktalahir' => $new_image,
                'doc_ktp' => $new_image1,
                'doc_bpjs' => $new_image2,
                'created_at' => time(),
                'updated_at' => time(),
                'deleted_at' => time(),
                'deleted' => 'no'
            ];
            $this->db->insert('jb_keluarga', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan anggota keluarga</div>');
            redirect('keluarga');
        }
    }
    public function detail()
    {
        $data['title'] = 'SIPERS | Keluarga';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $idan = $this->input->get('id');
        $this->db->where('id', $idan);
        $data['kel'] = $this->db->get_where('jb_keluarga')->row_array();
        $data['judul'] = $data['kel']['nama'] . "<br><span class='badge badge-info'>" . $data['kel']['stat_hidup'] . "</span>";

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/detail', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function Edit()
    {
        $id = $this->input->get('id');
        $data['title'] = 'SIPERS | Keluarga';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->db->where('id', $id);
        $data['fam'] = $this->db->get_where('jb_keluarga')->row_array();
        $data['judul'] = 'edit data';

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('hub', 'Hubungan Keluarga', 'required|trim');
        // $this->form_validation->set_rules('tlp', 'No tlp', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/editfam', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $this->db->set('personil_id', $id);
            $famid = $this->input->post('famid');
            $this->db->where('id', $famid);
            $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
            $this->db->set('nama', $nama);
            $tl = strtoupper(htmlspecialchars($this->input->post('tl')));
            $this->db->set('tempat_lahir', $tl);
            $ttl = strtoupper(htmlspecialchars($this->input->post('ttl')));
            $this->db->set('tanggal_lahir', $ttl);
            $ktp = strtoupper(htmlspecialchars($this->input->post('ktp')));
            $this->db->set('ktp', $ktp);
            $bpjs = $this->input->post('bpjs');
            $this->db->set('bpjs', $bpjs);
            $hub = strtoupper(htmlspecialchars($this->input->post('hub')));
            $this->db->set('hub', $hub);
            $alamat = strtoupper(htmlspecialchars($this->input->post('alamat')));
            $this->db->set('alamat', $alamat);
            $fktp = strtoupper(htmlspecialchars($this->input->post('fktp')));
            $this->db->set('fktp', $fktp);
            $email = $this->input->post('email');
            $this->db->set('email', $email);
            $phone = $this->input->post('phone');
            $this->db->set('tlp', $phone);
            $agama = strtoupper(htmlspecialchars($this->input->post('agama')));
            $this->db->set('agama', $agama);
            $status = $this->input->post('status');
            $this->db->set('stat_hidup', $status);
            $gol = $this->input->post('gol');
            $this->db->set('gol_darah', $gol);

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc_aktalahir', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $upload_image1 = $_FILES['image1']['name'];

            if ($upload_image1) {
                $config['allowed_types']    = 'gif|jpg|png|pdf';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image1')) {
                    $new_image1 = $this->upload->data('file_name');
                    $this->db->set('doc_ktp', $new_image1);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $upload_image2 = $_FILES['image2']['name'];

            if ($upload_image2) {
                $config['allowed_types']    = 'gif|jpg|png|pdf';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image2')) {
                    $new_image2 = $this->upload->data('file_name');
                    $this->db->set('doc_bpjs', $new_image2);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $up = time();
            $this->db->set('updated_at', $up);
            $this->db->update('jb_keluarga');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di ubah</div>');
            redirect('keluarga');
        }
    }
}
