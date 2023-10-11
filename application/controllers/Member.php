<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_staff();
    }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->set('online', 1);
        $this->db->where('id', $data['staff']['id']);
        $this->db->update('jb_personil');
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'masuk ke homepage',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('nama', $data['staff']['jabatan']);
        $jabStaff = $this->db->get('m_jabatan')->row_array();
        if ($jabStaff) {
            $id = $jabStaff['id'];
            $this->db->where('id', $id);
            $jbtn = $this->db->get('m_jabatan')->row_array();
            if ($jbtn) {
                if ($jbtn['leader'] == 1) {
                    redirect('member/leader');
                }
            }
        }
        $today = date('Y-m-d');
        $this->db->where('nip', $data['staff']['nik']);
        $this->db->where('tgl_masuk >=', $today);
        $ijin = $this->db->get('abs_ijin')->result_array();
        $data['ijin'] = count($ijin);

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/index', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function leader()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'PJ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $today = date('Y-m-d');
        $this->db->where('pejabat_id', $data['staff']['id']);
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $ijin = $this->db->get('abs_ijin')->result_array();
        $data['ijin'] = count($ijin);



        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/index2', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function personal_info()
    {
        $data['title'] = 'DOEL SI PETIR | DATA POKOK';
        $data['judul'] = 'Data Pokok';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal data pokok',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/info', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function rh()
    {
        $data['title'] = 'DOEL SI PETIR | RH';
        $data['judul'] = 'Riwayat Hidup';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal riwayat hidup',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->db->order_by('tmt', 'asc');
        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->limit(1);
        $pkt = $this->db->get_where('jb_kepangkatan')->result_array();
        if ($pkt) {
            $pkt = $pkt[0];
        }
        if (!$pkt) {
            $pkt = [
                'pangkat' => '',
                'tmt' => '',
                'no_skep' => '',
                'doc' => ''
            ];
        } else {

            $data['pangkat'] = $pkt;
            if ($pkt['pangkat'] = 'PNS') {
                $tmt = $pkt['tmt'];
                $data['tmtpns'] = $tmt;
            }
        }

        $this->db->order_by('thn', 'desc');
        $data['dikum'] = $this->db->get_where('jb_dik_um', ['personil_id' => $data['staff']['id']])->result_array();
        $id = $data['staff']['id'];
        $nip  = $data['staff']['nik'];
        $this->db->where('hub', 'anak');
        $this->db->where('stat_hidup', 'hidup');
        $this->db->where('personil_id', $id);
        $data['anak'] = $this->db->get_where('jb_keluarga')->result_array();
        $this->load->model('Dosier_models', 'dosier');

        $data['dikum'] = $this->dosier->getRdikUm($id);
        $data['rPangkat'] = $this->dosier->getRpangkat($id);
        if ($data['rPangkat']) {
            $tmtkhl = $data['rPangkat'][0]['tmt'];
            $data['tmtkhl'] = $tmtkhl;
        } else {
            $data['tmtkhl'] = '';
        }
        $data['fungsional'] = $this->dosier->getJf($nip);
        // var_dump($data['fungsional']);
        // die;
        if (!$data['fungsional']) {
            $data['jf'] = '-';
            $data['jft'] = '-';
        } else {
            $data['jf'] = $data['fungsional'][0]['nama'];
            $data['jft'] = $data['fungsional'][0]['tmt'];
        }
        $data['struktural'] = $this->dosier->getJs($nip);
        if (!$data['struktural']) {
            $data['js'] = '-';
            $data['jst'] = '-';
        } else {
            $data['js'] = $data['struktural'][0]['nama'];
            $data['jst'] = $data['struktural'][0]['tmt'];
        }
        $data['dikmila'] = $this->dosier->getDikmilA($id);
        $data['dikmilb'] = $this->dosier->getDikmilB($id);
        $data['tugasOperasi'] = $this->dosier->getTops($id);
        $data['tugasLn'] = $this->dosier->getTugasLn($id);
        $data['tandaKh'] = $this->dosier->getTkh($id);
        $data['prestasi'] = $this->dosier->getPrestasi($id);
        $data['bhsDaerah'] = $this->dosier->getBahasaDaerah($id);
        $data['bhsAsing'] = $this->dosier->getBahasaAsing($id);
        $data['kel'] = $this->dosier->getStatusKeluarga($id);

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/rh', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function inputdata()
    {
        $data['title'] = 'DOEL SI PETIR | Isi Data';
        $data['judul'] = 'Pengisian Data Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $db150 = $this->load->database('staff', true);
        // $data['bagian'] = $db150->get('M_STAFF_BAGIAN')->result_array();

        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal input data',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->order_by('nomor', 'asc');
        $data['jabatan'] = $this->db->get('m_jabatan')->result_array();

        $this->db->where('personil_id', $data['staff']['id']);
        $data['kk'] = $this->db->get('jb_kartu_keluarga')->row_array();
        if (!$data['kk']) {
            $data['kk'] = ['no_kk' => '', 'doc' => ''];
        }
        $this->db->where('personil_id', $data['staff']['id']);
        $data['npwp'] = $this->db->get('jb_npwp')->row_array();
        if (!$data['npwp']) {
            $data['npwp'] = ['npwp' => '', 'doc' => ''];
        }
        $data['jamKerja'] = $this->db->get('jam_kerja')->result_array();
        $this->db->where('personil_id', $data['staff']['id']);
        $data['kartuBpjs'] = $this->db->get_where('jb_bpjs')->row_array();
        if (!$data['kartuBpjs']) {
            $data['kartuBpjs'] = ['bpjs' => '', 'fktp' => '', 'doc' => ''];
        }
        $this->db->where('personil_id', $data['staff']['id']);
        $data['kartuKtp'] = $this->db->get_where('jb_ktp')->row_array();
        if (!$data['kartuKtp']) {
            $data['kartuKtp'] = ['noktp' => '', 'doc' => ''];
        }
        $this->db->where('personil_id', $data['staff']['id']);
        $data['kartuKaris'] = $this->db->get_where('jb_karis')->row_array();
        if (!$data['kartuKaris']) {
            $data['kartuKaris'] = ['no' => '', 'doc' => ''];
        }

        $this->form_validation->set_rules('nik', 'No Kepegawaian', 'trim|required');
        $this->form_validation->set_rules('sdm', 'Kualifikasi SDM', 'trim|required');
        $this->form_validation->set_rules('gp', 'Golongan', 'trim|required');
        $this->form_validation->set_rules('tl', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tlp', 'No Tlp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/jb_input', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '20000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/dosier/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');

                    $this->db->set('image', $new_image);
                } else {
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'Error, gagal update data pokok',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data gagal diupdate</div>');
                    redirect('member/inputdata');
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
            $this->db->where('id', $data['user']['id']);
            $this->db->update('user');

            $log = [
                'user_id' => $data['staff']['id'],
                'action' => 'update data pokok',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data</div>');
            redirect('member/inputdata');
        }
    }

    public function ktp()
    {
        $this->form_validation->set_rules('no', 'No Ktp', 'trim|required|min_length[16]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('member/inputdata');
        } else {
            //cek ktp
            $id = $this->input->post('id');
            $no = htmlspecialchars($this->input->post('no', true));
            $this->db->where('personil_id', $this->input->post('id'));
            $ktp = $this->db->get('jb_ktp')->num_rows();
            if ($ktp > 0) {
                $upload_image = $_FILES['image']['name'];
                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);
                        $this->db->where('personil_id', $id);
                        $this->db->set('noktp', $no);
                        $this->db->update('jb_ktp');
                        $log = [
                            'user_id' => $id,
                            'action' => 'berhasil update ktp',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Update KTP</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal update ktp',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data gagal diupdate</div>');
                        redirect('card');
                    }
                }
            } else {

                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);

                        $id = $this->input->post('id');
                        $no = htmlspecialchars($this->input->post('no', true));
                        $data = [
                            'personil_id' => $id,
                            'noktp' => $no,
                            'ket' => 'M',
                            'created_at' => time(),
                            'update_at' => time(),
                            'deleted_at' => time(),
                            'deleted' => 'no'
                        ];
                        $this->db->insert('jb_ktp', $data);
                        $this->db->set('ktp', $no);
                        $this->db->where('id', $id);
                        $this->db->update('jb_personil');
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert ktp',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data KTP</div>');
                        redirect('card');
                    } else {
                        $id = $this->input->post('id');
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error gagal insert ktp',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update data KTP gagal silahkan coba lagi. Pastikan dokumen yang dikirim tidak lebih dari 5Mb</div>');
                        redirect('card');
                    }
                }
            }
        }
    }

    public function kk()
    {
        $this->form_validation->set_rules('no', 'No KK', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('card');
        } else {
            //cek kk 
            $id = $this->input->post('id');
            $this->db->where('personil_id', $id);
            $kk = $this->db->get('jb_kartu_keluarga')->row_array();
            if ($kk) {
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);

                        $id = $this->input->post('id');
                        $this->db->where('personil_id', $id);
                        $no = htmlspecialchars($this->input->post('no', true));
                        $this->db->set('no_kk', $no);

                        $this->db->update('jb_kartu_keluarga');
                        $log = [
                            'user_id' => $id,
                            'action' => 'update kartu keluarga',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Kartu Keluarga</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal update kartu keluarga',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update kartu keluarga gagal</div>');
                        redirect('card');
                    }
                }
            } else {

                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');

                        $id = $this->input->post('id');
                        $no = htmlspecialchars($this->input->post('no', true));
                        $data = [

                            'personil_id' => $id,
                            'no_kk' => $no,
                            'doc' => $new_image,
                            'created_at' => time(),
                            'updated_at' => time(),
                            'deleted_at' => 0,
                            'deleted' => 'no'
                        ];
                        $this->db->insert('jb_kartu_keluarga', $data);
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert kartu keluarga',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Kartu Keluarga</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal insert kartu keluarga',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update kartu keluarga gagal. Silahkan coba lagi nanti.</div>');
                        redirect('card');
                    }
                }
            }
        }
    }

    public function karis()
    {
        $this->form_validation->set_rules('no', 'No karis/karsu', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('card');
        } else {

            $id = $this->input->post('id');
            $no = htmlspecialchars($this->input->post('no', true));
            $this->db->where('personil_id', $id);
            $karis = $this->db->get('jb_karis')->row_array();
            if ($karis) {
                $id = $karis['id'];
                $this->db->set('no', $no);
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);
                        $this->db->where('id', $id);
                        $this->db->update('jb_karis');
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert karis',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Kartu Istri/suami</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal insert karis',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal upload karis</div>');
                        redirect('card');
                    }
                }
            } else {

                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);

                        $data = [
                            'personil_id' => $id,
                            'no' => $no
                        ];
                        $this->db->insert('jb_karis', $data);
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert karis',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Kartu Istri/suami</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal insert karis',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal upload karis</div>');
                        redirect('card');
                    }
                }
            }
        }
    }

    public function bpjs()
    {
        $this->form_validation->set_rules('no', 'No bpjs', 'trim|required');
        $id = $this->input->post('id');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('card');
        } else {
            $id = $this->input->post('id');
            $no = htmlspecialchars($this->input->post('no', true));
            $fktp = strtoupper(htmlspecialchars($this->input->post('fktp', true)));
            $this->db->where('personil_id', $id);
            $bpjs = $this->db->get('jb_bpjs')->row_array();
            if ($bpjs) {
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);
                        $this->db->set('bpjs', $no);
                        $this->db->set('fktp', $fktp);
                        $this->db->where('id', $bpjs['id']);
                        $this->db->update('jb_bpjs');
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert kartu bpjs',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->db->set('bpjs', $no);
                        $this->db->where('id', $id);
                        $this->db->update('jb_personil');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data BPJS</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal insert bpjs',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Upload gagal</div>');
                        redirect('card');
                    }
                }
            } else {
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                    $config['max_size']         = '5000';
                    $config['upload_path']      = './assets/img/dosier/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('doc', $new_image);

                        $data = [
                            'personil_id' => $id,
                            'bpjs' => $no,
                            'fktp' => $fktp,
                            'created_at' => time(),
                            'updated_at' => time(),
                            'deleted_at' => 0,
                            'deleted' => 'no'
                        ];
                        $this->db->insert('jb_bpjs', $data);
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert kartu bpjs',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);

                        $this->db->set('bpjs', $no);
                        $this->db->where('id', $id);
                        $this->db->update('jb_personil');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data BPJS</div>');
                        redirect('card');
                    } else {
                        $log = [
                            'user_id' => $id,
                            'action' => 'Error, gagal insert bpjs',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Upload gagal</div>');
                        redirect('card');
                    }
                }
            }
        }
    }

    public function npwp()
    {
        $this->form_validation->set_rules('no', 'No NPWP', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('card');
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);

                    $id = $this->input->post('id');
                    $no = htmlspecialchars($this->input->post('no', true));
                    $data = [

                        'personil_id' => $id,
                        'npwp' => $no,
                        'created_at' => time(),
                        'updated_at' => time(),
                        'deleted_at' => 0,
                        'deleted' => 'no'
                    ];
                    $this->db->where('personil_id', $id);
                    $cek = $this->db->get('jb_npwp')->num_rows();
                    if (
                        $cek > 0
                    ) {
                        $this->db->set('npwp', $no);
                        $this->db->where('personil_id', $id);
                        $this->db->update('jb_npwp');
                        $this->db->where('id', $id);
                        $this->db->set('npwp', $no);
                        $this->db->update('jb_personil');
                        $log = [
                            'user_id' => $id,
                            'action' => 'insert npwp',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data NPWP</div>');
                        redirect('card');
                    } else {
                        $this->db->insert('jb_npwp', $data);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data NPWP</div>');
                        $this->db->where('id', $id);
                        $this->db->set('npwp', $no);
                        $this->db->update('jb_personil');
                        $log = [
                            'user_id' => $id,
                            'action' => 'update npwp',
                            'created_at' => time()
                        ];
                        $this->db->insert('log', $log);
                        redirect('card');
                    }
                } else {
                    $id = $this->input->post('id');
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal input npwp',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NPWP gagal diinput</div>');
                    redirect('card');
                }
            }
        }
    }

    public function pangkat()
    {
        $data['title'] = 'DOEL SI PETIR | Isi Data';
        $data['judul'] = 'Pengisian Data Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $db150 = $this->load->database('staff', true);
        $data['bagian'] = $db150->get('M_STAFF_BAGIAN')->result_array();

        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'riwayat pangkat',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('tmt', 'desc');
        $data['kepangkatan'] = $this->db->get_where('jb_kepangkatan')->result_array();
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
        $this->form_validation->set_rules('tmt', 'TMT Pangkat', 'trim|required');
        $this->form_validation->set_rules('skep', 'Skep Pangkat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/riwayat_pangkat', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);

                    $id = $this->input->post('id');
                    $pangkat = strtoupper(htmlspecialchars($this->input->post('pangkat'), true));
                    $skep = strtoupper(htmlspecialchars($this->input->post('skep'), true));
                    $tmt = $this->input->post('tmt');
                    $data = [
                        'personil_id' => $id,
                        'pangkat' => $pangkat,
                        'tmt' => $tmt,
                        'no_skep' => $skep,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_kepangkatan', $data);

                    $log = [
                        'user_id' => $id,
                        'action' => 'tambah pangkat',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);

                    $idp = $data['staff']['id'];
                    $this->db->select('pangkat');
                    $this->db->order_by('tmt', 'desc');
                    $this->db->where('personil_id', $idp);
                    $p = $this->db->get('jb_kepangkatan', 1)->row_array();

                    $pangkatskrg = $p['pangkat'];
                    $this->db->set('pangkat', $pangkatskrg);
                    $this->db->where('id', $idp);
                    $this->db->update('jb_personil');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pangkat</div>');
                    redirect('member/pangkat');
                } else {
                    $id = $this->input->post('id');
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal input npwp',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">gagal update pangkat</div>');
                    redirect('member/pangkat');
                }
            }
        }
    }

    public function hapuskepangkatan()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_kepangkatan');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'menghapus pangkat',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->select('pangkat');
        $this->db->order_by('tmt', 'desc');
        $this->db->where('personil_id', $data['staff']['id']);
        $p = $this->db->get('jb_kepangkatan', 1)->row_array();
        $pangkat = $p['pangkat'];
        if (!$pangkat) {
            $this->db->set('pangkat', '');
        } else {
            $this->db->set('pangkat', $pangkat);
        }
        $this->db->where('id', $id);
        $this->db->update('jb_personil');


        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda berhasil melakukan hapus data Pangkat</div>');
        redirect('member/pangkat');
    }
    public function editkepangkatan()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $this->db->where('id', $id);
        $pkt = $this->db->get('jb_kepangkatan')->row_array();
        $data['pkt'] = $pkt;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $db150 = $this->load->database('staff', true);
        $data['pangkat'] = $db150->get('M_STAFF_PANGKAT')->result_array();

        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Edit Riwayat Pangkat';

        $this->form_validation->set_rules('pangkat', 'Pangkat', 'required|trim');
        $this->form_validation->set_rules('tmt', 'TMT', 'required|trim');
        $this->form_validation->set_rules('skep', 'No Skep', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/editpangkat', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $tmt = $this->input->post('tmt');
            $skep = $this->input->post('skep');
            $pkt = strtoupper(htmlspecialchars($this->input->post('pangkat')));
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'Error, gagal mengedit pendidikan umum',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-gagal" role="alert">
                    Gagal menambahkan data. Silahkan cek kembali apakah dokumen yang diupload sudah sesuai. Jika sudah silahkan ulangi kembali.
                    </div>');
                }
            }
            $this->db->set('pangkat', $pkt);
            $this->db->set('tmt', $tmt);
            $this->db->set('no_skep', $skep);
            $this->db->set('update_at', time());
            $this->db->where('id', $id);
            $this->db->update('jb_kepangkatan');
            $log = [
                'user_id' => $data['staff']['id'],
                'action' => 'update pangkat',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $p = substr($pkt, 0, 3);

            if ($p == 'KHL') {
                $this->db->where('id', $id);
                $personal = $this->db->get('jb_kepangkatan')->row_array();
                $idp = $personal['personil_id'];
                $this->db->set('pangkat', $p);
                $this->db->set('pangkat', $pkt);
                $this->db->where('id', $idp);
                $this->db->update('jb_personil');
            } else {
                $this->db->where('id', $id);
                $personal = $this->db->get('jb_kepangkatan')->row_array();
                $idp = $personal['personil_id'];

                $this->db->select('pangkat');
                $this->db->order_by('tmt', 'desc');
                $this->db->where('personil_id', $idp);
                $p = $this->db->get('jb_kepangkatan', 1)->row_array();
                $pangkat = $p['pangkat'];
                $this->db->set('pangkat', $pangkat);
                $this->db->where('id', $idp);
                $this->db->update('jb_personil');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pangkat</div>');
            redirect('member/pangkat');
        }
    }
    public function pendidikan()
    {
        $data['title'] = 'DOEL SI PETIR | Isi Data';
        $data['judul'] = 'Riwayat Pendidikan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $db150 = $this->load->database('staff', true);
        $data['bagian'] = $db150->get('M_STAFF_BAGIAN')->result_array();

        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'riwayat pangkat',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['dikum'] = $this->db->get('jb_dik_um')->result_array();

        $this->form_validation->set_rules('jenis', 'Jenis Pendidikan', 'trim|required');
        $this->form_validation->set_rules('thn', 'Tahun Lulus', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama Sekolah', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/pendidikan', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg|webp';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);

                    $personil_id = $this->input->post('id');
                    $jenis_didik = strtoupper(htmlspecialchars($this->input->post('jenis')));
                    $thn = strtoupper(htmlspecialchars($this->input->post('thn')));
                    $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
                    $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));

                    $data = [
                        'personil_id' => $personil_id,
                        'jenis_didik' => $jenis_didik,
                        'thn' => $thn,
                        'nama' => $nama,
                        'prestasi' => $prestasi,
                        'created_at' => time(),
                        'updated_at' => time()
                    ];
                    $this->db->insert('jb_dik_um', $data);
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'update pendidikan Umum',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pendidikan Umum</div>');
                    redirect('member/pendidikan');
                } else {
                    $personil_id = $this->input->post('id');
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'Error, gagal update pendidikan umum',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">gagal update pendidikan umum</div>');
                    redirect('member/pendidikan');
                }
            }
        }
    }
    public function hpsdikum()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_dik_um');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'menghapus pendidikan umum',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda berhasil melakukan hapus data Pendidikan Umum</div>');
        redirect('member/pendidikan');
    }
    public function editdikum()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $dikum = $this->db->get('jb_dik_um')->row_array();
        $data['dikum'] = $dikum;

        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Edit Pendidikan Umum';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->form_validation->set_rules('jenis', 'Jenis Pendidikan', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun lulus', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Sekolah', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/edit_dikum', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $jenis = $this->input->post('jenis');
            $thn = $this->input->post('thn');
            $nama = $this->input->post('nama');
            $prestasi = $this->input->post('prestasi');
            $update = time();
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {

                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal mengedit pendidikan umum',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-gagal" role="alert">
                    Gagal menambahkan data. Silahkan cek kembali apakah dokumen yang diupload sudah sesuai. Jika sudah silahkan ulangi kembali.
                    </div>');
                }
            }
            $this->db->set('jenis_didik', $jenis);
            $this->db->set('thn', $thn);
            $this->db->set('nama', $nama);
            $this->db->set('prestasi', $prestasi);
            $this->db->set('updated_at', $update);
            $this->db->where('id', $id);
            $this->db->update('jb_dik_um');
            $log = [
                'user_id' => $id,
                'action' => 'mengedit pendidikan umum',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pendidikan umum</div>');
            redirect('member/pendidikan');
        }
    }
    public function dik_a()
    {
        $this->form_validation->set_rules('jenis', 'Jenis Pendidikan', 'trim|required');
        $this->form_validation->set_rules('thn', 'Tahun Lulus', 'trim|required');
        $this->form_validation->set_rules('kep', 'No Kep', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('member/inputdata');
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);

                    $personil_id = $this->input->post('id');
                    $jenis_didik = strtoupper(htmlspecialchars($this->input->post('jenis')));
                    $thn = strtoupper(htmlspecialchars($this->input->post('thn')));
                    $kep = strtoupper(htmlspecialchars($this->input->post('kep')));
                    $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));

                    $data = [
                        'personil_id' => $personil_id,
                        'nama' => $jenis_didik,
                        'thn' => $thn,
                        'prestasi' => $prestasi,
                        'kep' => $kep,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_dikmil_a', $data);
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'menambah pendidikan militer a',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pendidikan Militer</div>');
                    redirect('member/inputdata');
                } else {
                    $personil_id = $this->input->post('id');
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'error, gagal menambah pendidikan militer a',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda gagal melakukan update data Pendidikan Militer. Mohon ulangi beberapa saat lagi</div>');
                }
            }
        }
    }
    public function hpsdikmila()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_dikmil_a');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'menghapus pendidikan militer a',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan hapus data Pendidikan Militer</div>');
        redirect('member/inputdata');
    }
    public function editdikmila()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $this->db->where('id', $id);
        $dikmil = $this->db->get('jb_dikmil_a')->row_array();
        $data['dikmil'] = $dikmil;

        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Edit Pendidikan Militer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->form_validation->set_rules('jenis', 'Nama / Jenis Pendidikan', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun pendidikan', 'required|trim');
        $this->form_validation->set_rules('kep', 'No Kep', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/editdikmil', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('jenis')));
            $this->db->set('nama', $nama);
            $thn = $this->input->post('thn');
            $this->db->set('thn', $thn);
            $kep = strtoupper(htmlspecialchars($this->input->post('kep')));
            $this->db->set('kep', $kep);
            $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));
            $this->db->set('prestasi', $prestasi);

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('update_at', time());
            $this->db->where('id', $id);
            $this->db->update('jb_dikmil_a');
            $log = [
                'user_id' => $id,
                'action' => 'mengedit pendidikan militer a',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pendidikan Militer</div>');
            redirect('member/inputdata');
        }
    }
    public function editdikmilB()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $this->db->where('id', $id);
        $dikmil = $this->db->get('jb_dikmil_b')->row_array();
        $data['dikmil'] = $dikmil;

        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Edit Pendidikan Militer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->form_validation->set_rules('jenis', 'Nama / Jenis Pendidikan', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun pendidikan', 'required|trim');
        $this->form_validation->set_rules('kep', 'No Kep', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/editdikmilb', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('jenis')));
            $this->db->set('nama', $nama);
            $thn = $this->input->post('thn');
            $this->db->set('thn', $thn);
            $kep = strtoupper(htmlspecialchars($this->input->post('kep')));
            $this->db->set('kep', $kep);
            $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));
            $this->db->set('prestasi', $prestasi);

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('update_at', time());
            $this->db->where('id', $id);
            $this->db->update('jb_dikmil_b');
            $log = [
                'user_id' => $id,
                'action' => 'mengedit pendidikan militer b',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pendidikan Militer</div>');
            redirect('member/inputdata');
        }
    }
    public function hpsdikmilb()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_dikmil_b');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'menghapus pendidikan militer b',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan hapus data Pendidikan Militer</div>');
        redirect('member/inputdata');
    }


    public function dik_b()
    {
        $this->form_validation->set_rules('jenis', 'Jenis Pendidikan', 'trim|required');
        $this->form_validation->set_rules('thn', 'Tahun Lulus', 'trim|required');
        $this->form_validation->set_rules('nama', 'No Kep', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">tidak ada data yang dikirim</div>');
            redirect('member/inputdata');
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);

                    $personil_id = $this->input->post('id');
                    $jenis_didik = strtoupper(htmlspecialchars($this->input->post('jenis')));
                    $thn = strtoupper(htmlspecialchars($this->input->post('thn')));
                    $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
                    $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));

                    $data = [
                        'personil_id' => $personil_id,
                        'nama' => $jenis_didik,
                        'thn' => $thn,
                        'prestasi' => $prestasi,
                        'kep' => $nama,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_dikmil_b', $data);
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'menambahkan pendidikan militer b',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Pendidikan Militer</div>');
                    redirect('member/inputdata');
                } else {
                    $personil_id = $this->input->post('id');
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'error, gagal menambahkan pendidikan militer b',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak berhasil dikirim. Silahkan diulangi setelah beberapa saat.</div>');
                    redirect('member/inputdata');
                }
            }
        }
    }
    public function bhs_d()
    {
        $personil_id = $this->input->post('id');
        $bahasa = strtoupper(htmlspecialchars($this->input->post('bahasa')));
        $isactive = strtoupper(htmlspecialchars($this->input->post('isactive')));

        $data = [
            'personil_id' => $personil_id,
            'nama' => $bahasa,
            'isactive' => $isactive,
            'created_at' => time(),
            'update_at' => time()
        ];
        $this->db->insert('jb_b_daerah', $data);
        $log = [
            'user_id' => $personil_id,
            'action' => 'menambahkan bahasa daerah',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Bahasa Daerah</div>');
        redirect('member/inputdata');
    }
    public function bhs_asing()
    {
        $personil_id = $this->input->post('id');
        $bahasa = strtoupper(htmlspecialchars($this->input->post('bahasa')));
        $isactive = strtoupper(htmlspecialchars($this->input->post('isactive')));

        $data = [
            'personil_id' => $personil_id,
            'nama' => $bahasa,
            'isactive' => $isactive,
            'created_at' => time(),
            'update_at' => time()
        ];
        $this->db->insert('jb_b_asing', $data);
        $log = [
            'user_id' => $personil_id,
            'action' => 'menambahkan bahasa asing',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Bahasa asing</div>');
        redirect('member/inputdata');
    }
    public function hapus_bahasa_asing()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $personil = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_b_asing');
        $log = [
            'user_id' => $personil['id'],
            'action' => 'menanghapus bahasa asing',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Bahasa asing</div>');
        redirect('member/inputdata');
    }
    public function hapus_bahasa_daerah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $personil = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_b_daerah');
        $log = [
            'user_id' => $personil['id'],
            'action' => 'menanghapus bahasa daerah',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Bahasa daerah</div>');
        redirect('member/inputdata');
    }
    public function tln()
    {
        $personil_id = $this->input->post('id');
        $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
        $thn = strtoupper(htmlspecialchars($this->input->post('thn')));
        $negara = strtoupper(htmlspecialchars($this->input->post('negara')));
        $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));

        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
            $config['max_size']         = '5000';
            $config['upload_path']      = './assets/img/dosier/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('doc', $new_image);

                $data = [
                    'personil_id' => $personil_id,
                    'nama' => $nama,
                    'thn' => $thn,
                    'negara' => $negara,
                    'prestasi' => $prestasi,
                    'created_at' => time(),
                    'updated_at' => time()
                ];
                $this->db->insert('jb_r_tugas_luarnegri', $data);
                $log = [
                    'user_id' => $personil_id,
                    'action' => 'menanbahkan tugas luar negeri',
                    'created_at' => time()
                ];
                $this->db->insert('log', $log);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil melakukan update data Tugas luar negeri</div>');
                redirect('member/inputdata');
            } else {
                $personil_id = $this->input->post('id');
                $log = [
                    'user_id' => $personil_id,
                    'action' => 'Error, gagal menambahkan tugas luar negeri',
                    'created_at' => time()
                ];
                $this->db->insert('log', $log);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda gagal melakukan update data Tugas luar negeri. Silahkan ulangi setelah beberapa saat.</div>');
                redirect('member/inputdata');
            }
        }
    }
    public function tkh()
    {
        $this->form_validation->set_rules('nama', 'Nama Tanda Kehormatan', 'required|trim');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun Tanda Kehormatan', 'required|trim|max_length[4]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sepertinya Anda salah menginput sehingga tidak ada data yang di kirim.</div>');
            redirect('member/inputdata');
        } else {
            $personil_id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
            $thn = strtoupper(htmlspecialchars($this->input->post('thn')));
            $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);

                    $data = [
                        'personil_id' => $personil_id,
                        'nama' => $nama,
                        'thn' => $thn,
                        'prestasi' => $prestasi,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_tanda_kehormatan', $data);
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'menambahkan tanda kehormatan',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil menambahkan data Tanda kehormatan</div>');
                    redirect('member/inputdata');
                } else {
                    $log = [
                        'user_id' => $personil_id,
                        'action' => 'error, gagal menambahkan tanda kehormatan',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda gagal menambahkan data Tanda kehormatan. Silahkan coba kembali setelah beberapa saat</div>');
                    redirect('member/inputdata');
                }
            }
        }
    }
    public function hpstkh()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $personil = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_tanda_kehormatan');
        $log = [
            'user_id' => $personil['id'],
            'action' => 'menanghapus tanda kehormatan',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil melakukan Hapus data Tanda Kehormatan.</div>');
        redirect('member/inputdata');
    }
    public function edittkh()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Dashboard Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $this->db->where('id', $id);
        $data['tkh'] = $this->db->get('jb_tanda_kehormatan')->row_array();
        $this->form_validation->set_rules('nama', 'Nama Tanda Kehormatan', 'required|trim');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun Tanda Kehormatan', 'required|trim|max_length[4]');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/edittkh', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
            $thn = strtoupper(htmlspecialchars($this->input->post('thn')));
            $prestasi = strtoupper(htmlspecialchars($this->input->post('prestasi')));
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal mengedit tanda kehormatan',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda gagal mengubah data Tanda kehormatan. Silahkan cek kembali dokumen yang diupload</div>');
                }
            }
            $this->db->set('update_at', time());
            $this->db->set('nama', $nama);
            $this->db->set('thn', $thn);
            $this->db->set('prestasi', $prestasi);
            $this->db->where('id', $id);
            $this->db->update('jb_tanda_kehormatan');
            $log = [
                'user_id' => $id,
                'action' => 'Mengedit tanda kehormatan',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil mengubah data Tanda kehormatan</div>');
            redirect('member/inputdata');
        }
    }
    public function prestasi()
    {
        $data['title'] = 'DOEL SI PETIR | Riwayat Prestasi';
        $data['judul'] = 'Riwayat Prestasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $db150 = $this->load->database('staff', true);
        $data['bagian'] = $db150->get('M_STAFF_BAGIAN')->result_array();

        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->where('personil_id', $data['staff']['id']);
        $this->db->order_by('thn', 'desc');
        $data['prestasi'] = $this->db->get('jb_prestasi')->result_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'buka halaman prestasi',
            'created_at' => time()
        ];

        $this->form_validation->set_rules('nama', 'Kegiatan', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun', 'required|trim|max_length[4]');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/prestasi', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
            $thn = $this->input->post('thn');
            $tempat = strtoupper(htmlspecialchars($this->input->post('tempat')));
            $deskripsi = strtoupper(htmlspecialchars($this->input->post('deskripsi')));
            $kep = $this->input->post('kep');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                    $data = [
                        'personil_id' => $id,
                        'kegiatan' => $nama,
                        'thn' => $thn,
                        'tempat' => $tempat,
                        'deskripsi' => $deskripsi,
                        'kep' => $kep,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_prestasi', $data);
                    $log = [
                        'user_id' => $id,
                        'action' => 'menambahkan prestasi',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan data prestasi.</div>');
                    redirect('member/inputdata');
                } else {
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal menambahkan prestasi',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan data prestasi. Silahkan ulangi setelah beberapa saat</div>');
                    redirect('member/inputdata');
                }
            }
        }
    }
    public function kinerja()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Kinerja Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $idstaff = $data['staff']['nik'];
        $db2 = $this->load->database('staff', true);
        $db2->where('NOMOR_NIP', $idstaff);
        $u = $db2->get('M_STAFF')->row_array();
        $kdstaff = $u['KDSTAFF'];
        $db2->where('M_ITEM_PENCAPAIAN_STAFF.KDSTAFF', $kdstaff);
        $db2->from('M_ITEM_PENCAPAIAN_STAFF');
        $db2->join('M_ITEMPENCAPAIAN', 'M_ITEMPENCAPAIAN.KDITEMPENCAPAIN = M_ITEM_PENCAPAIAN_STAFF.KDITEMPENCAPAIN');
        $item = $db2->get()->result_array();
        $data['item'] = $item;
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('first day of this month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d', strtotime('last day of this month'));
        }
        // $date1 = date('Y-m-d', strtotime('first day of this month'));
        // $date2 = date('Y-m-d', strtotime('last day of this month'));

        $db2->where('KDSTAFF', $kdstaff);
        $db2->where('DATE >=', $date1);
        $db2->where('DATE <=', $date2);
        $data['kinerja'] = $db2->get('F_KINERJAPENCAPAIN_H')->result_array();
        $db2->where('KDSTAFF', $kdstaff);
        $db2->where('DATE >=', $date1);
        $db2->where('DATE <=', $date2);
        $db2->select('sum(VOLUME)');
        $sum = $db2->get('F_KINERJAPENCAPAIN_H')->row_array();

        if ($sum == 'NULL') {
            $sum = 0;
        }
        $data['sum'] = $sum;



        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/kinerja', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function tambahKinerja()
    {
        $db2 = $this->load->database('staff', true);

        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Kinerja Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $idstaff = $data['staff']['nik'];
        $db2 = $this->load->database('staff', true);
        $db2->where('NOMOR_NIP', $idstaff);
        $u = $db2->get('M_STAFF')->row_array();
        $kdstaff = $u['KDSTAFF'];
        $db2->where('M_ITEM_PENCAPAIAN_STAFF.KDSTAFF', $kdstaff);
        $db2->from('M_ITEM_PENCAPAIAN_STAFF');
        $db2->join('M_ITEMPENCAPAIAN', 'M_ITEMPENCAPAIAN.KDITEMPENCAPAIN = M_ITEM_PENCAPAIAN_STAFF.KDITEMPENCAPAIN');
        $db2->where('M_ITEMPENCAPAIAN.ISACTIVE', 1);
        $item = $db2->get()->result_array();
        $data['item'] = $item;
        $date1 = date('Y-m-d', strtotime('first day of this month'));
        $date2 = date('Y-m-d', strtotime('last day of this month'));
        // var_dump($kdstaff);
        // die;

        $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required|trim');
        $this->form_validation->set_rules('output', 'Output', 'required|trim');
        $this->form_validation->set_rules('volume', 'Volume', 'required|trim');
        if ($this->form_validation->run() == false) {
            $db2->where('KDSTAFF', $kdstaff);
            $db2->where('DATE >=', $date1);
            $db2->where('DATE <=', $date2);
            $data['kinerja'] = $db2->get('F_KINERJAPENCAPAIN_H')->result_array();


            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/kinerja', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = '*';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $db2->set('UPLOADDOKUMEN', $new_image);
                    $data = [
                        'KDSTAFF' => $this->input->post('id'),
                        'DATECREATED' => date('Y-m-d h:i:s'),
                        'DATEUPDATED' => date('Y-m-d h:i:s'),
                        'DATE' => $this->input->post('date'),
                        'KDITEMPENCAPAIN' => $this->input->post('kegiatan'),
                        'OUTPUT' => $this->input->post('output'),
                        'VOLUME' => $this->input->post('volume'),
                        'SATUAN' => $this->input->post('satuan'),
                        'KETERANGAN' => $this->input->post('ket'),
                        'KDUSER' => $data['user']['id']
                    ];
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $data = [
                    'KDSTAFF' => $this->input->post('id'),
                    'DATECREATED' => date('Y-m-d h:i:s'),
                    'DATEUPDATED' => date('Y-m-d h:i:s'),
                    'DATE' => $this->input->post('date'),
                    'KDITEMPENCAPAIN' => $this->input->post('kegiatan'),
                    'OUTPUT' => $this->input->post('output'),
                    'VOLUME' => $this->input->post('volume'),
                    'SATUAN' => $this->input->post('satuan'),
                    'KETERANGAN' => $this->input->post('ket'),
                    'KDUSER' => $data['user']['id']
                ];
            }

            $db2->insert('F_KINERJAPENCAPAIN_H', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan data Kinerja.</div>');
            redirect('member/kinerja');
        }
    }
    public function hapuskinerja()
    {
        $id = $this->input->get('id');
        $db2 = $this->load->database('staff', true);
        $db2->where('KDKINERJAPENCAPAIN', $id);
        $db2->delete('F_KINERJAPENCAPAIN_H');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data Kinerja.</div>');
        redirect('member/kinerja');
    }
    public function editkinerja()
    {

        $id = $this->input->get('id');
        $db2 = $this->load->database('staff', true);
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Kinerja Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $idstaff = $data['staff']['nik'];
        $db2->where('NOMOR_NIP', $idstaff);
        $u = $db2->get('M_STAFF')->row_array();
        $kdstaff = $u['KDSTAFF'];
        $db2->where('KDKINERJAPENCAPAIN', $id);
        $data['kinerja'] = $db2->get('F_KINERJAPENCAPAIN_H')->row_array();

        $db2->where('M_ITEM_PENCAPAIAN_STAFF.KDSTAFF', $kdstaff);
        $db2->from('M_ITEM_PENCAPAIAN_STAFF');
        $db2->join('M_ITEMPENCAPAIAN', 'M_ITEMPENCAPAIAN.KDITEMPENCAPAIN = M_ITEM_PENCAPAIAN_STAFF.KDITEMPENCAPAIN');
        $db2->where('M_ITEMPENCAPAIAN.ISACTIVE', 1);
        $item = $db2->get()->result_array();
        $data['item'] = $item;

        $db2->where('KDITEMPENCAPAIN', $data['kinerja']['KDITEMPENCAPAIN']);
        $i = $db2->get('M_ITEMPENCAPAIAN')->row_array();
        $data['k'] = $i['KEGIATAN'];


        $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required|trim');
        $this->form_validation->set_rules('output', 'Output', 'required|trim');
        $this->form_validation->set_rules('volume', 'Volume', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/editkinerja', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = '*';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $db2->set('UPLOADDOKUMEN', $new_image);
                    $data = [


                        'KDUSER' => $data['user']['id']
                    ];
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $kds = $this->input->post('id');
            $idi = $this->input->post('idi');
            $db2->set('KDSTAFF', $kds);
            $db2->set('DATEUPDATED', date('Y-m-d h:i:s'));
            $date = $this->input->post('date');
            $db2->set('DATE', $date);
            $itemp = $this->input->post('kegiatan');
            $db2->set('KDITEMPENCAPAIN', $itemp);
            $out = $this->input->post('output');
            $db2->set('OUTPUT', $out);
            $volume = $this->input->post('volume');
            $db2->set('VOLUME', $volume);
            $sat = $this->input->post('satuan');
            $db2->set('SATUAN', $sat);
            $ket = $this->input->post('ket');
            $db2->set('KETERANGAN', $ket);
            $db2->set('KDUSER', $data['user']['id']);
            $db2->where('KDKINERJAPENCAPAIN', $idi);

            $db2->update('F_KINERJAPENCAPAIN_H');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Edit data Kinerja.</div>');
            redirect('member/kinerja');
        }
    }
    public function editprestasi()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Kinerja Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        // $kdstaff = $data['staff']['nik'];

        $this->db->where('id', $id);
        $data['prestasi'] = $this->db->get('jb_prestasi')->row_array();

        $this->form_validation->set_rules('nama', 'Kegiatan', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun Kegiatan', 'required|trim|max_length[4]');
        $this->form_validation->set_rules('tempat', 'Tempat Kegiatan', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'required|trim');
        $this->form_validation->set_rules('kep', 'Kep/Piagam Kegiatan', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/editprestasi', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = strtoupper(htmlspecialchars($this->input->post('nama')));
            $this->db->set('kegiatan', $nama);
            $thn = $this->input->post('thn');
            $this->db->set('thn', $thn);
            $tempat = strtoupper(htmlspecialchars($this->input->post('tempat')));
            $this->db->set('tempat', $tempat);
            $deskripsi = strtoupper(htmlspecialchars($this->input->post('deskripsi')));
            $this->db->set('deskripsi', $deskripsi);
            $kep = $this->input->post('kep');
            $this->db->set('kep', $kep);

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal update doc prestasi',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Upload dokumen</div>');
                }
            }
            $this->db->set('update_at', time());
            $this->db->where('id', $id);
            $this->db->update('jb_prestasi');
            $log = [
                'user_id' => $id,
                'action' => 'mengedit prestasi',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil melakukan edit data prestasi.</div>');
            redirect('member/inputdata');
        }
    }
    public function hpsstar()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_prestasi');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'menghapus prestasi',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil melakukan Hapus data prestasi.</div>');
        redirect('member/inputdata');
    }
    public function tugasOperasi()
    {
        $this->form_validation->set_rules('nama', 'Nama Tugas Operasi', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun Tugas Operasi', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data yang dikirim tidak lengkap</div>');
            redirect('member/inputdata');
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $thn = $this->input->post('thn');
            $prestasi = $this->input->post('prestasi');
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                    $data1 = [
                        'personil_id' => $id,
                        'nama' => $nama,
                        'thn' => $thn,
                        'prestasi' => $prestasi,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_r_tugas_operasi', $data1);
                    $log = [
                        'user_id' => $id,
                        'action' => 'mengedit prestasi',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat tugas operasi berhasil ditambahkan</div>');
                    redirect('member/inputdata');
                } else {
                    $id = $this->input->post('id');
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, Gagal insert tugas operasi',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data riwayat tugas operasi gagal ditambahkan. Silahkan periksa dokumen upload. Apakah sudah sesuai dengan petunjuk</div>');
                    redirect('member/inputdata');
                }
            }
        }
    }
    public function editto()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $this->db->where('id', $id);
        $to = $this->db->get('jb_r_tugas_operasi')->row_array();
        $data['to'] = $to;

        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Kinerja Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Tugas Operasi', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun Tugas Operasi', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/editto', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $nama = $this->input->post('nama');
            $thn = $this->input->post('thn');
            $prestasi = $this->input->post('prestasi');
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    $log = [
                        'user_id' => $id,
                        'action' => 'error, gagal edit tugas operasi',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data riwayat tugas operasi gagal ditambahkan. Upload file dokumen gagal</div>');
                }
            }

            $this->db->set('nama', $nama);
            $this->db->set('thn', $thn);
            $this->db->set('prestasi', $prestasi);
            $this->db->set('update_at', time());
            $this->db->where('id', $id);
            $this->db->update('jb_r_tugas_operasi');
            $log = [
                'user_id' => $id,
                'action' => 'edit tugas operasi',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat tugas operasi berhasil ditambahkan</div>');
            redirect('member/inputdata');
        }
    }
    public function hpsto()
    {
        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $this->db->delete('jb_r_tugas_operasi');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'menghapus tugas operasi',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat tugas operasi berhasil hapus</div>');
        redirect('member/inputdata');
    }
    public function tugasLuarNegeri()
    {
        $this->form_validation->set_rules('nama', 'Nama Tugas', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun', 'required|trim');
        $this->form_validation->set_rules('negara', 'Negara', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data yang dikirim tidak lengkap</div>');
            redirect('member/inputdata');
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $thn = $this->input->post('thn');
            $negara = $this->input->post('negara');
            $prestasi = $this->input->post('prestasi');
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                    $data1 = [
                        'personil_id' => $id,
                        'nama' => $nama,
                        'thn' => $thn,
                        'negara' => $negara,
                        'prestasi' => $prestasi,
                        'created_at' => time(),
                        'update_at' => time()
                    ];
                    $this->db->insert('jb_r_tugas_luarnegri', $data1);
                    $log = [
                        'user_id' => $id,
                        'action' => 'Menambahkan tugas luar negeri',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat tugas luar negeri berhasil di tambahkan.</div>');
                    redirect('member/inputdata');
                } else {
                    $log = [
                        'user_id' => $id,
                        'action' => 'Error, gagal menambahkan tugas luar negeri',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan. Cek kembali file yang diupload. Jika sudah sesuai silahkan ulangi kembali.</div>');
                    redirect('member/inputdata');
                }
            }
        }
    }
    public function hpstln()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('jb_r_tugas_luarnegri');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Menghapus tugas luar negeri',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat tugas luar negeri berhasil di hapus.</div>');
        redirect('member/inputdata');
    }
    public function edittln()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $this->db->where('id', $id);
        $to = $this->db->get('jb_r_tugas_luarnegri')->row_array();
        $data['to'] = $to;

        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Kinerja Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Tugas Operasi', 'required|trim');
        $this->form_validation->set_rules('thn', 'Tahun Tugas Operasi', 'required|trim');
        $this->form_validation->set_rules('negara', 'Negara', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/edittln', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $thn = $this->input->post('thn');
            $negara = $this->input->post('negara');
            $prestasi = $this->input->post('prestasi');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('thn', $thn);
            $this->db->set('negara', $negara);
            $this->db->set('prestasi', $prestasi);
            $this->db->set('update_at', time());
            $this->db->where('id', $id);
            $this->db->update('jb_r_tugas_luarnegri');
            $log = [
                'user_id' => $data['staff']['id'],
                'action' => 'Edit tugas luar negeri',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat tugas operasi berhasil ditambahkan</div>');
            redirect('member/inputdata');
        }
    }
    public function jabatan()
    {

        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Jabatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        // if ($data['staff']['pangkat'] == ' KHL') {
        //     redirect('member/fungsional');
        // }

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/jabatan', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function fungsional()
    {
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Riwayat Jabatan Fungsional';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->where('isactive', 1);
        $data['jabatan'] = $this->db->get('m_jabatan')->result_array();
        $this->db->where('nip', $data['staff']['nik']);
        $data['jabatan_f'] = $this->db->get('jabatan_fungsional')->result_array();


        $this->form_validation->set_rules('nama', 'Nama Jabatan', 'trim|required');
        $this->form_validation->set_rules('skep', 'skep/sprint Jabatan', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/fungsional', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $jabatan = $this->input->post('nama');
            $skep = $this->input->post('skep');
            $tmt = $this->input->post('tmt');
            $this->db->where('nip', $id);
            $this->db->order_by('tmt', 'desc');
            $j = $this->db->get('jabatan_fungsional')->row_array();
            $upload_image = $_FILES['image']['name'];


            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                    $data = [
                        'nama' => $jabatan,
                        'skep' => $skep,
                        'tmt' => $tmt,
                        'isactive' => 1,
                        'nip' => $id,
                        'created_at' => time(),
                        'updated_at' => time()
                    ];
                    $this->db->insert('jabatan_fungsional', $data);

                    $this->db->where('nip', $j['nip']);
                    $this->db->order_by('tmt', 'desc');
                    $this->db->limit(1);
                    $jf = $this->db->get('jabatan_fungsional')->row_array();


                    $this->db->set('jabatan', $jf['nama']);
                    $this->db->set('tmt_jabatan', $jf['tmt']);
                    $this->db->where('nik', $jf['nip']);
                    $this->db->update('jb_personil');
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'menambahkan jabatan fungsional',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat jabatan fungsional berhasil ditambahkan</div>');
                    redirect('member/fungsional');
                } else {
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'Error, gagal menambahkan jabatan fungsional',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-gagal" role="alert">
                    Gagal menambahkan data. Silahkan cek kembali apakah dokumen yang diupload sudah sesuai. Jika sudah silahkan ulangi kembali.
                    </div>');
                    redirect('member/fungsional');
                }
            }
        }
    }
    public function hapusFungsional()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $j = $this->db->get('jabatan_fungsional')->row_array();
        $this->db->delete('jabatan_fungsional', ['id' => $id]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Menghapus riwayat jabatan fungsional',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('nip', $j['nip']);
        $this->db->order_by('tmt', 'desc');
        $this->db->limit(1);
        $jf = $this->db->get('jabatan_fungsional')->row_array();
        if (!$jf) {
            $jf['nama'] = '';
            $jf['tmt'] = '';
        }

        $this->db->set('jabatan', $jf['nama']);
        $this->db->set('tmt_jabatan', $jf['tmt']);
        $this->db->where('nik', $j['nip']);
        $this->db->update('jb_personil');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat jabatan fungsional berhasil dihapus</div>');
        redirect('member/fungsional');
    }
    public function editFungsional()
    {
        $id = $this->input->get('id');
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Riwayat Jabatan Fungsional';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->where('id', $id);
        $data['jabatan_f'] = $this->db->get('jabatan_fungsional')->row_array();
        $this->db->where('isactive', 1);
        $data['jabatan'] = $this->db->get('m_jabatan')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Jabatan', 'trim|required');
        $this->form_validation->set_rules('skep', 'Skep Jabatan', 'trim|required');
        $this->form_validation->set_rules('tmt', 'TMT Jabatan', 'trim|required');
        if ($this->form_validation->run() == false) {

            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/editFungsional', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $this->input->post('id');
            $jabatan = $this->input->post('nama');
            list($j_id, $name) = explode(',', $jabatan);
            $skep = $this->input->post('skep');
            $tmt = $this->input->post('tmt');
            $upload_image = $_FILES['image']['name'];
            $this->db->where('id', $id);
            $j = $this->db->get('jabatan_fungsional')->row_array();
            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');

                    $this->db->set('doc', $new_image);
                } else {
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'Error, gagal mengedit jabatan fungsional',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-gagal" role="alert">
                    Gagal menambahkan data. Silahkan cek kembali apakah dokumen yang diupload sudah sesuai. Jika sudah silahkan ulangi kembali.
                    </div>');
                }
            }
            $this->db->set('updated_at', time());
            $this->db->set('skep', $skep);
            $this->db->set('tmt', $tmt);
            $this->db->set('jabatan_id', $j_id);
            $this->db->set('nama', $name);
            $this->db->where('nip', $id);
            $this->db->update('jabatan_fungsional');

            $this->db->where('nip', $j['nip']);
            $this->db->order_by('tmt', 'desc');
            $this->db->limit(1);
            $jf = $this->db->get('jabatan_fungsional')->row_array();


            $this->db->set('jabatan', $jf['nama']);
            $this->db->set('tmt_jabatan', $jf['tmt']);
            $this->db->where('nik', $jf['nip']);
            $this->db->update('jb_personil');
            $log = [
                'user_id' => $data['staff']['id'],
                'action' => 'mengedit jabatan fungsional',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat jabatan fungsional berhasil diubah</div>');
            redirect('member/fungsional');
        }
    }
    public function struktural()
    {
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Riwayat Jabatan Struktural';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->where('nip', $data['staff']['nik']);
        $data['jabatan'] = $this->db->get('jabatan_struktural')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Jabatan', 'trim|required');
        $this->form_validation->set_rules('skep', 'skep/sprint Jabatan', 'trim|required');
        $this->form_validation->set_rules('tmt', 'TMT Jabatan', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/input/jabstruk', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];
            $nama = $this->input->post('nama');
            $skep = $this->input->post('skep');
            $tmt = $this->input->post('tmt');
            $tmt = $this->input->post('tmt');
            $id = $this->input->post('id');

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/dosier/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                    $data = [
                        'nama' => $nama,
                        'tmt' => $tmt,
                        'skep' => $skep,
                        'isactive' => 1,
                        'nip' => $id,
                        'created_at' => time(),
                        'updated_at' => time()
                    ];
                    $this->db->insert('jabatan_struktural', $data);
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'mengedit jabatan struktural',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat jabatan struktural berhasil disimpan</div>');
                    redirect('member/struktural');
                } else {
                    $log = [
                        'user_id' => $data['staff']['id'],
                        'action' => 'Error, gagal menambah jabatan struktural',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);
                    $this->session->set_flashdata('message', '<div class="alert alert-gagal" role="alert">
                    Gagal menambahkan data. Silahkan cek kembali apakah dokumen yang diupload sudah sesuai. Jika sudah silahkan ulangi kembali.
                    </div>');
                    redirect('member/struktural');
                }
            }
        }
    }
    public function hapusStruktural()
    {
        $id = $this->input->get('id');
        $this->db->delete('jabatan_struktural', ['id' => $id]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Menghapus riwayat jabatan struktural',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data riwayat jabatan struktural berhasil dihapus</div>');
        redirect('member/struktural');
    }
    public function editStruktural()
    {
        $id = $this->input->get('id');
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Edit Riwayat Jabatan Struktural';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->where('id', $id);
        $data['jabatan_f'] = $this->db->get('jabatan_struktural')->row_array();
        $this->db->where('isactive', 1);
        $data['jabatan'] = $this->db->get('m_jabatan')->result_array();
    }
    public function dosier()
    {
        $data['title'] = 'DOELSIPETIR';
        $data['judul'] = 'Kumpulan Dosier';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $data['staff']['id'];
        $nip = $data['staff']['nik'];

        $log = [
            'user_id' => $id,
            'action' => 'Melihat dosier',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->load->model('Dosier_models', 'dosier');
        $data['ktp'] = $this->dosier->getKtp($id);
        $data['bpjs'] = $this->dosier->getBpjs($id);
        $data['npwp'] = $this->dosier->getNpwp($id);
        $data['kk'] = $this->dosier->getKk($id);
        $data['karis'] = $this->dosier->getKaris($id);
        $data['dikum'] = $this->dosier->getRdikUm($id);
        $data['rPangkat'] = $this->dosier->getRpangkat($id);
        $data['fungsional'] = $this->dosier->getJf($nip);
        $data['struktural'] = $this->dosier->getJs($nip);
        $data['dikmila'] = $this->dosier->getDikmilA($id);
        $data['dikmilb'] = $this->dosier->getDikmilB($id);
        $data['tugasOperasi'] = $this->dosier->getTops($id);
        $data['tugasLn'] = $this->dosier->getTugasLn($id);
        $data['TandaKh'] = $this->dosier->getTkh($id);
        $data['prestasi'] = $this->dosier->getPrestasi($id);
        $data['sertifikat'] = $this->dosier->getSertifikat($id);



        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/dosier', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
