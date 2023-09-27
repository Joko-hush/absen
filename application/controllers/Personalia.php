<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Personalia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_pers();
        error_reporting(0);
    }

    public function index()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Dashboard';
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



        // dashboard
        $data['pengguna'] = $this->db->get('jb_personil')->num_rows();
        $this->db->where_not_in('ket', 'mpp');
        $this->db->where_not_in('ket', 'Meninggal');
        $this->db->where_not_in('ket', 'mutasi');
        $this->db->where_not_in('ket', 'paku');
        $this->db->where_not_in('ket', 'pendidikan');
        $this->db->where_not_in('ket', 'stikes');
        $this->db->where('isactive', 1);
        $data['anggota'] = $this->db->get('m_personil_pers')->num_rows();
        if ($data['anggota'] < 1) {
            $data['persentase'] = 0;
        } else {
            $data['persentase'] = ceil(($data['pengguna'] / $data['anggota']) * 100);
        }
        // absen
        $this->db->where('STAT_KERJA', 1);
        $this->db->where('tgl_masuk', $today);
        $data['masuk'] = $this->db->get('abs_kehadiran')->num_rows();
        $this->db->where('STAT_KERJA', 3);
        $this->db->where('tgl_masuk', $today);
        $data['ijin'] = $this->db->get('abs_kehadiran')->num_rows();
        $this->db->where('STAT_KERJA', 4);
        $this->db->where('tgl_masuk', $today);
        $data['sakit'] = $this->db->get('abs_kehadiran')->num_rows();
        $data['unknown'] = ($data['pengguna'] - ($data['masuk'] + $data['ijin'] + $data['sakit']));

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/index', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function pangkat()
    {
        $data['title'] = 'Doel Si Petir | pangkat';
        $data['judul'] = 'Setting Pangkat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $data['approve'] = $this->db->get('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();

        $this->load->model('Pangkat_models', 'pkt');

        $data['pangkat'] = $this->pkt->getAll();

        $this->form_validation->set_rules('pkt', 'Pangkat', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/pkt', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $pkt = $this->input->post('pkt');
            $ket = $this->input->post('ket');
            $this->db->where('nama', $pkt);
            $cek = $this->db->get_where('pangkat')->num_rows();
            if ($cek > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pangkat ini sudah ada.</div>');
                redirect('personalia/pangkat');
            }
            $data = [
                'id' => '',
                'nama' => $pkt,
                'ket' => $ket
            ];
            $this->db->insert('jb_pangkat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">berhasil menambahkan pangkat</div>');
            redirect('personalia/pangkat');
        }
    }
    public function hapuspangkat()
    {
        $id = $this->input->get('id');
        $this->db->delete('pangkat', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">berhasil menghapus pangkat</div>');
        redirect('personalia/pangkat');
    }
    public function approval()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'User Approval';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();


        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/approve', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function lihat()
    {
        $id = $this->input->get('nip');

        $this->db->where('nik', $id);
        $una = $this->db->get('user')->row_array();
        $this->db->where('nip', $id);
        $banding = $this->db->get('m_personil_pers')->row_array();
        $this->db->where('is_active', 1);
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();

        $data['una'] = $una;
        $data['banding'] = $banding;


        $data['title'] = 'Sipetir | Approve';
        $data['judul'] = 'Approval';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/detiluser', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function action1()
    {
        $id = $this->input->get('id');
        $stat = $this->input->get('stat');
        $this->db->where('id', $id);
        $user = $this->db->get('user')->row_array();
        $email = $user['email'];
        $this->load->model('pers_model', 'pers', true);
        $cn = $this->pers->approve($id, $stat);

        if ($cn == 'tolak') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi Akun berhasil di tolak dan dihapus dari sistem.</div>');
            $this->_sendEmail($email, 'tolak');
            redirect('personalia/approval');
        } elseif ($cn == 'sudah ada') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak dapat ditambahkan. Akun dengan nik tersebut telah terdaftar.</div>');
            $this->_sendEmail($email, 'tolak');
            redirect('personalia/approval');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Aktivasi Akun berhasil. Data telah ditambahkan ke daftar personil.</div>');
            $this->_sendEmail($email, 'acc');
            redirect('personalia/approval');
        }
    }

    private function _sendEmail($email, $type)
    {

        $to = $email;
        $from = 'info@rsdustira.co.id';
        if ($type == 'tolak') {
            $subject = 'Ditolak';
            $body = $this->safeBase64('Mohon Maaf akun Anda tidak disetujui silahkan hubungi bagian personalia untuk informasi lebih lanjut.');
        } else if ($type == 'acc') {
            $subject = 'Akun telah disetujui';
            $body = $this->safeBase64('Akun Anda telah di setujui. Silahkan klik link dibawah ini untuk login.<br> <a href="' . base_url() . 'auth' . '">Login</a>');
        }
        // $body = base64_encode('test');
        $this->load->model('Mail_models', 'mail');
        $send = $this->mail->send($to, $from, $subject, $body);
        if ($send == 'OK') {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    private function safeBase64($str)
    {
        return strtr($this->base64($str), '+/=', '-_,');
    }

    private function deSafeBase64($str)
    {
        return $this->deBase64(strtr($str, '-_,', '+/='));
    }

    private function base64($str)
    {
        return base64_encode($str);
    }

    private function deBase64($str)
    {
        return base64_decode($str);
    }
    public function masterStaff()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Personil Dustira';
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



        $this->db->where('ISACTIVE', 1);
        $data['staff'] = $this->db->get('m_personil_pers')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nip', 'No. Nip', 'required|trim');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/master_staff', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {

            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $pangkat = $this->input->post('pangkat');
            $jabatan = $this->input->post('jabatan');
            $ket = $this->input->post('ket');
            $gender = $this->input->post('gender');
            $pendidikan = $this->input->post('pendidikan');
            $kualifikasi = $this->input->post('kualifikasi');
            $tmt = $this->input->post('tmt');
            $tgl = $this->input->post('tanggallahir');
            $aktif = $this->input->post('aktif');
            $gol = $this->input->post('gol');
            if (!$aktif) {
                $aktif = 0;
            }
            $a = $this->db->get('m_personil_pers')->num_rows();
            $sls = $a - 1442;
            $tot = 1491 + $sls;
            $id = $tot;
            $data1 = [
                'id' => $id,
                'nip' => $nip,
                'nama' => $nama,
                'pangkat' => $pangkat,
                'jabatan' => $jabatan,
                'ket' => $ket,
                'gender' => $gender,
                'pendidikan' => $pendidikan,
                'kualifikasi' => $kualifikasi,
                'tmt' => $tmt,
                'tgl_lahir' => $tgl,
                'created_at' => time(),
                'updated_at' => time(),
                'isactive' => $aktif,
                'gol' => $gol
            ];
            $this->db->insert('m_personil_pers', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan data personil.</div>');
            redirect('personalia/masterStaff');
        }
    }
    public function detailStaff()
    {
        $id = $this->input->get('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Detail Personil';
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
        $data['staff'] = $this->db->get('m_personil_pers')->row_array();
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nip', 'No. Nip', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header_pers', $data);
            $this->load->view('layout/nav_pers', $data);
            $this->load->view('layout/sidebar_pers', $data);
            $this->load->view('personalia/detail_staff', $data);
            $this->load->view('layout/footer_pers', $data);
        } else {
            $id = $this->input->post('id');
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $pangkat = $this->input->post('pangkat');
            $jabatan = $this->input->post('jabatan');
            $ket = $this->input->post('ket');
            $gender = $this->input->post('gender');
            $pendidikan = $this->input->post('pendidikan');
            $kualifikasi = $this->input->post('kualifikasi');
            $tmt = $this->input->post('tmt');
            $tgl = $this->input->post('tanggallahir');
            $aktif = $this->input->post('aktif');
            $gol = $this->input->post('gol');
            if (!$aktif) {
                $aktif = 0;
            }
            $this->db->set('nama', $nama);
            $this->db->set('nip', $nip);
            $this->db->set('tgl_lahir', $tgl);
            $this->db->set('pangkat', $pangkat);
            $this->db->set('jabatan', $jabatan);
            $this->db->set('ket', $ket);
            $this->db->set('gender', $gender);
            $this->db->set('pendidikan', $pendidikan);
            $this->db->set('kualifikasi', $kualifikasi);
            $this->db->set('tmt', $tmt);
            $this->db->set('updated_at', time());
            $this->db->set('gol', $gol);
            $this->db->where('id', $id);
            $this->db->update('m_personil_pers');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil membuat perubahan data personil.</div>');
            redirect('personalia/masterStaff');
        }
    }

    public function user()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Daftar User';
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

        $this->db->where('deleted', 'no');
        $personil = $this->db->get('jb_personil')->result_array();
        $data['personil'] = $personil;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/personil/index', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function detailUser()
    {
        $id = $this->input->get('id');
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Daftar User';
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
        $personil = $this->db->get('jb_personil')->row_array();
        $data['personil'] = $personil;
        $data['keluarga'] = $this->db->get_where('jb_keluarga', ['personil_id' => $data['personil']['id']])->result_array();
        $this->load->model('Dosier_models', 'dosier');
        $data['ktp'] = $this->dosier->getKtp($id);
        $data['bpjs'] = $this->dosier->getBpjs($id);
        $data['npwp'] = $this->dosier->getNpwp($id);
        $data['kk'] = $this->dosier->getKk($id);
        $data['karis'] = $this->dosier->getKaris($id);
        $data['dikum'] = $this->dosier->getRdikUm($id);
        $data['rPangkat'] = $this->dosier->getRpangkat($id);
        $nip = $personil['nik'];
        $data['fungsional'] = $this->dosier->getJf($nip);
        $data['struktural'] = $this->dosier->getJs($nip);
        $data['dikmila'] = $this->dosier->getDikmilA($id);
        $data['dikmilb'] = $this->dosier->getDikmilB($id);
        $data['tugasOperasi'] = $this->dosier->getTops($id);
        $data['tugasLn'] = $this->dosier->getTugasLn($id);
        $data['TandaKh'] = $this->dosier->getTkh($id);
        $data['prestasi'] = $this->dosier->getPrestasi($id);
        $data['sertifikat'] = $this->dosier->getSertifikat($id);

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/personil/detailUser', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function detailkeluarga()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Detail Keluarga';
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

        $idan = $this->input->get('id');
        $this->db->where('id', $idan);
        $data['kel'] = $this->db->get_where('jb_keluarga')->row_array();
        $data['judul'] = $data['kel']['nama'] . "<br><span class='badge badge-info'>" . $data['kel']['stat_hidup'] . "</span>";

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/personil/detailkeluarga', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function Absensi()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Absensi';
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
        $this->form_validation->set_rules('date1', 'tanggal awal', 'trim|required');
        if ($this->form_validation->run() == false) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        } else {
            $date1 = $this->input->post('date1');
            $date2 = $this->input->post('date2');
        }

        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getAbsenHarian($date1, $date2);
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/index', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function ijin()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Absensi Ijin';
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

        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if ($date2 < $date1) {
            $date2 = $date1;
        }
        if (!$date1) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        }
        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getAbsenKet($date1, $date2, 3);
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/ijin', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function masuk()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Absensi Masuk';
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

        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if ($date2 < $date1) {
            $date2 = $date1;
        }
        if (!$date1) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        }
        $this->load->model('Absen_models', 'absen');
        $this->db->order_by('TIME_IN', 'asc');
        $data['absen'] = $this->absen->getAbsenKet($date1, $date2, 1);
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/masuk', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function sakit()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Absensi Sakit';
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

        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if ($date2 < $date1) {
            $date2 = $date1;
        }
        if (!$date1) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        }
        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getAbsenKet($date1, $date2, 4);
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/sakit', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function unknown()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Absensi Tanpa Keterangan';
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

        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if ($date2 < $date1) {
            $date2 = $date1;
        }
        if (!$date1) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        }
        $this->load->model('Absen_models', 'absen');
        $data['absen'] = $this->absen->getUnknown($date1, $date2);

        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/unknown', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function absenPerorangan()
    {
        $data['title'] = 'Doel Si Petir | Dashboard';
        $data['judul'] = 'Absensi Perorangan';
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
        $this->load->model('Pers_model', 'pers');
        $data['absenPersonil'] = $this->pers->getAllPersonilPerJabatan();

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/perorangan', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function rincianAbsen()
    {
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

        $id = $this->input->post('id');
        if (!$id) {
            $id = $this->input->get('id');
        }
        $month = $this->input->post('month');
        if (!$month) {
            $month = date('Y-m');
        }
        $this->db->where('nik', $id);
        $p = $this->db->get('jb_personil')->row_array();
        $this->db->where('nama', $p['jabatan']);
        $jabStaff = $this->db->get('m_jabatan')->row_array();
        $this->db->select('A.nama');
        $this->db->select('B.subbagian');
        $this->db->from('m_jabatan as A');
        $this->db->join('m_subbagian as B', 'A.subbagian_id = B.id');
        $this->db->where('A.id', $jabStaff['id']);
        $b = $this->db->get()->row_array();
        $jbtn = $b['nama'];
        $unit = $b['subbagian'];
        $name = $p['name'];
        $data['title'] = "Data Absensi<br> Nama :  $name<br>Jabatan: $jbtn <br>Unit: $unit";
        list($tahun, $bulan) = explode('-', $month);
        $kalender = CAL_GREGORIAN;
        $jh = cal_days_in_month($kalender, $bulan, $tahun);
        for ($d = 1; $d <= $jh; $d++) {
            $date_month_year[] = '' . $tahun . '-' . $bulan . '-' . $d . '';
        }
        $data['tgl'] = $date_month_year;
        $data['month'] = $month;
        $data['id'] = $id;
        $data['judul'] = "Absensi $name";
        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/rincianAbsen', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function detailAbsen()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // die;
        if ($id == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ada data absen pada hari tersebut.</div>');
            redirect('personalia/absenPerorangan');
        }
        // token mapbox bikin sendiri di https://www.mapbox.com/
        $data['tokenmapbox'] = 'accestoken';
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
        $data['title'] = "Data Detail Absensi";

        $this->db->where('ID', $id);
        $absen = $this->db->get('abs_kehadiran')->row_array();
        $this->db->where('nik', $absen['NIP']);
        $personil = $this->db->get('jb_personil')->row_array();
        $this->db->where('nama', $personil['jabatan']);
        $jabStaff = $this->db->get('m_jabatan')->row_array();
        $data['personil'] = $personil;
        $tgl = $absen['TGL_MASUK'];
        $data['judul'] = "Detail Absensi $tgl";
        $data['absen'] = $absen;
        $this->db->select('A.nama');
        $this->db->select('B.subbagian');
        $this->db->from('m_jabatan as A');
        $this->db->join('m_subbagian as B', 'B.id = A.subbagian_id');
        $this->db->where('A.id', $jabStaff['id']);
        $j = $this->db->get()->row_array();
        $data['jbtn'] = $j['nama'];
        $data['unit'] = $j['subbagian'];
        if ($absen['LOK_OUT'] == '-') {
            $absen['LOK_OUT'] = '0,0';
        }
        list($lat_out, $long_out) = explode(',', $absen['LOK_OUT']);
        if ($absen['LOK_IN'] == '-') {
            $absen['LOK_IN'] = '0,0';
        }
        list($lat_in, $long_in) = explode(',', $absen['LOK_IN']);
        $data['lat_in'] = $lat_in;
        $data['lat_out'] = $lat_out;
        $data['long_in'] = $long_in;
        $data['long_out'] = $long_out;
        $this->db->where('id', $absen['STAT_ABSEN']);
        $status = $this->db->get('abs_stat_absen')->row_array();
        $sa = $status['STATUS'];
        $this->db->where('id', $absen['STAT_KERJA']);
        $statKerja = $this->db->get('stat_kerja')->row_array();
        $st = $statKerja['KET'];
        $data['sa'] = $sa;
        $data['st'] = $st;


        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/absensi/detailAbsen', $data);
        $this->load->view('layout/footer_pers', $data);
    }

    public function dosier()
    {
        $id = $this->input->post('id');
        if (!$id) {
            $id = $this->input->post('id');
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $this->db->order_by('date_created', 'desc');
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $this->db->where('tgl_masuk', $today);
        $this->db->where('status', 'diajukan');
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $data['title'] = "Kumpulan Dosier";
        $data['judul'] = "Dosier Personil";

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/dosierPersonil', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    public function AbsenPerBagian()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $this->db->order_by('date_created', 'desc');
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $this->db->where('tgl_masuk', $today);
        $this->db->where('status', 'diajukan');
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();
        $data['title'] = "Kumpulan Dosier";
        $data['judul'] = "Dosier Personil";

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('personalia/dosierPersonil', $data);
        $this->load->view('layout/footer_pers', $data);
    }
    private function phone($phone)
    {
        $phone = explode(' ', $phone);
        $n = count($phone);
        for ($i = 0; $i < $n; $i++) {
            $phones[] = $phone[$i];
        }
        $phone = implode($phones);
        $phones = explode('-', $phone);
        $x = count($phones);
        if ($x > 1) {
            $phone = implode($phones);
        } else {
            $phone = $phone;
        }
        $cekplus = substr($phone, 0, 1);
        if ($cekplus == '+') {
            $tlp = substr($phone, 1, 13);
        } elseif ($cekplus == '0') {
            $tlp = '62' . substr($phone, 1, 13);
        } else {
            $tlp = $phone;
        }
        return $tlp;
    }
    public function reminderAbsenMasuk()
    {
        $this->db->select('tlp');
        $this->db->where('tlp <>', '');
        $this->db->where('name', 'NUR MUHAMMAD HASYIM, S.KOM');
        $this->db->or_where('name', 'joko budiyanto');
        $u = $this->db->get('jb_personil')->result_array();
        // var_dump($u);
        // die;
        $text = 'Hallo, Sudahkah Anda absen di aplikasi Doelsipetir? Silahkan klik tautan ini https://rsdustira.co.id/doelsipetir/ ini adalah pesan otomatis. Abaikan jika sudah absen atau tidak merasa daftar di aplikasi doelsipetir. *Testing* ';
        // $file = base_url('manual_book.pdf');
        foreach ($u as $u) {
            $phone = $this->phone($u['tlp']);
            $wa = $this->Wa_models->_send($phone, $text);
        }

        redirect('/');
    }
}
