<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_staff();
        $this->load->model('Absen_models', 'absen');
        error_reporting(0);
    }

    public function index()
    {
        $data['title'] = 'Absensi';
        $data['judul'] = 'Dashboard Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $data['staff']['nik'];
        $data['hadir'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d')])->num_rows();
        $data['pulang'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d'), 'STAT_ABSEN' => 2])->num_rows();
        $this->form_validation->set_rules('date1', 'Tanggal awal', 'trim|required');
        $this->form_validation->set_rules('date2', 'Tanggal awal', 'trim|required');
        if ($this->form_validation->run() == false) {
            $date1 = strtotime('first day of this month');
            $date2 = strtotime('last day of this month');
            $date1 = date('Y-m-d', $date1);
            $date2 = date('Y-m-d', $date2);
        } else {
            $date1 = $this->input->post('date1');
            $date2 = $this->input->post('date2');
        }
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        $data['shift'] = $this->db->get('jam_kerja')->result_array();

        $this->db->where('TGL_MASUK >=', $date1);
        $this->db->where('TGL_MASUK <=', $date2);
        // $this->db->limit(7);
        $this->db->order_by('TGL_MASUK', 'desc');
        $data['absen'] = $this->db->get_where('abs_kehadiran', ['NIP' => $id])->result_array();
        if (!$data['staff']['jam_kerja_id']) {
            $this->session->set_flashdata('message', '<div class="alert alert-info mt-2" role="alert">Saat ini Anda belum bisa melakukan Absensi karena belum memilih jam kerja.
             Silahkan lengkapi terlebih dahulu.</div>');
            redirect('member/inputdata');
        }

        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/absensi/index', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function gantiShift()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $shift = $this->input->post('shift');
        $id = $data['staff']['id'];
        $this->db->set('jam_kerja_id', $shift);
        $this->db->where('id', $id);
        $this->db->update('jb_personil');
        $this->session->set_flashdata('message', '<div class="alert alert-info mt-2" role="alert">Berhasil merubah jam kerja</div>');
        redirect('absensi');
    }
    public function masuk()
    {
        $data['title'] = 'Absen';
        $data['judul'] = 'Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $data['staff']['nik'];
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $data['hadir'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d')])->num_rows();
        $data['pulang'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d'), 'STAT_ABSEN' => 2])->num_rows();

        $date1 = strtotime('first day of this week');
        $date2 = strtotime('last day of this week');
        $this->db->limit(5);
        $data['absen'] = $this->db->get_where('abs_kehadiran', ['nip' => $id])->result_array();


        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/absensi/masuk', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function pulang()
    {
        $data['title'] = 'Absen';
        $data['judul'] = 'Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $data['staff']['nik'];
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $data['hadir'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d')])->num_rows();
        $data['pulang'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d'), 'STAT_ABSEN' => 2])->num_rows();

        $date1 = strtotime('first day of this week');
        $date2 = strtotime('last day of this week');
        $this->db->limit(5);
        $data['absen'] = $this->db->get_where('abs_kehadiran', ['nip' => $id])->result_array();


        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/absensi/pulang', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
    public function absenPulang()
    {
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $hari_ini = date('Y-m-d');
        $time = date('Y-m-d H:i:s');
        $yesterday = strtotime('yesterday');
        $kemarin = date('Y-m-d', $yesterday);
        $tmpName = $_FILES['webcam']['tmp_name'];

        $latitude = $_GET['latitude'];
        if ($latitude == '') {
            $latitude = '-6.885580393025488, 107.53512723391297';
        } else {
            $latitude = explode('<font style="vertical-align: inherit;">', $latitude);
            $latitude = implode($latitude);
            $latitude = explode('</font>', $latitude);
            $latitude = implode($latitude);
            $latitude = trim($latitude);
        }

        $filename = '' . $data['user']['name'] . '-out-' . $hari_ini . '-' . $data['user']['nik'] . '.jpg';
        $this->db->where('id', $data['user']['jam_kerja_id']);
        $jk = $this->db->get('jam_kerja')->row_array();
        $jam_pulang = $jk['jam_pulang'];
        $periode = $jk['periode'];
        $kehadiran = $this->db->get_where('abs_kehadiran', ['NIP' => $data['user']['nik'], 'TGL_MASUK' => $hari_ini])->row_array();
        if (!$kehadiran) {
            $kehadiran = $this->db->get_where('abs_kehadiran', ['NIP' => $data['user']['nik'], 'TGL_MASUK' => $kemarin])->row_array();
        }
        if (!$kehadiran) {
            echo "Maaf, Anda belum Absen Masuk baik hari ini maupun kemarin.";
        } else {

            $jp = date('Y-m-d') . ' ' . $jam_pulang;
            $jam_masuk = $kehadiran['TIME_IN'];
            $durasi = $this->Waktu_model->durasiKerja($jam_masuk, $time);

            if ($kehadiran['STAT_ABSEN'] == 2) {
                echo "Maaf, Anda sudah absen pulang.";
            } else {
                if ($time > $jp) {
                    $absenPulang = $this->_absenPulang($filename, $latitude, $tmpName, $kehadiran['ID'], $durasi);
                    echo $absenPulang;
                } else {
                    echo "Maaf, Belum waktunya pulang";
                }
            }
        }
    }

    public function absenMasuk()
    {
        // $lat1 = (-6.885251172722737);
        // $lon1 = (107.53311745343375);
        $lat1 = (-7.225259893979511);
        $lon1 = (107.9117726005365);
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $hari_ini = date('Y-m-d');
        $time = date('H:i:s');
        $yesterday = strtotime('yesterday');
        $kemarin = date('Y-m-d', $yesterday);
        $tmpName = $_FILES['webcam']['tmp_name'];

        $latitude = $_GET['latitude'];
        if ($latitude == '' or !$latitude) {
            $latitude = '-7.225259893979511, 107.9117726005365';
        } else {
            $latitude = explode('<font style="vertical-align: inherit;">', $latitude);
            $latitude = implode($latitude);
            $latitude = explode('</font>', $latitude);
            $latitude = implode($latitude);
            $latitude = trim($latitude);
        }

        $filename = '' . $data['user']['name'] . '-in-' . $hari_ini . '-' . $data['user']['nik'] . '.jpg';

        $jam_kerja_id = $this->db->get_where('jam_kerja', ['id' => $data['user']['jam_kerja_id']])->row_array();
        $jk_id = $jam_kerja_id['id'];
        $jamMasuk = $jam_kerja_id['jam_masuk'];
        $jm = strtotime($jamMasuk);
        $now = time();
        $time = date('Y-m-d H:i:s');

        if ($now > $jm) {
            $info = 'Terlambat';
        }
        if ($latitude == '') {
            echo "Maaf, Lokasi Anda tidak terdeteksi. Silahkan cek pengaturan dan ijin lokasi untuk alamat situs ini.";
        } else {
            list($lat2, $lon2) = explode(',', $latitude);
            $lat2 = trim($lat2);
            $lon2 = trim($lon2);
            $cek_lokasi = $this->Absen_models->radius($lat1, $lon1, $lat2, $lon2);
            if ($cek_lokasi == 'true') {
                $kehadiran = $this->db->get_where('abs_kehadiran', ['NIP' => $data['user']['nik'], 'TGL_MASUK' => $hari_ini])->row_array();
                if (!$kehadiran) {
                    $absenMasuk = $this->_absenMasuk($filename, $latitude, $tmpName, $jk_id, $info, $time);
                    echo $absenMasuk;
                } else {
                    echo "Maaf, Anda sudah Absen Masuk hari ini. Silahkan absen lagi besok.";
                }
            } else {
                echo "Maaf, Absen hanya dilakukan di wilayah rumah sakit. Silahkan periksa akurasi GPS Anda jika anda memang sudah di RS.";
            }
        }
    }
    public function dinasLuar()
    {
        $data['title'] = 'Absen';
        $data['judul'] = 'Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $id = $data['staff']['nik'];
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $data['hadir'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d')])->num_rows();
        $data['pulang'] = $this->db->get_where('abs_kehadiran', ['nip' => $id, 'TGL_MASUK' => date('Y-m-d'), 'STAT_ABSEN' => 2])->num_rows();

        $date1 = strtotime('first day of this week');
        $date2 = strtotime('last day of this week');
        $this->db->limit(5);
        $data['absen'] = $this->db->get_where('abs_kehadiran', ['nip' => $id])->result_array();


        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/absensi/masuk', $data);
        $this->load->view('member/layout/jb_footer2', $data);
    }

    public function ijin()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Ijin Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->limit(20);
        $this->db->order_by('tgl_masuk', 'desc');
        $data['ijin'] = $this->db->get_where('abs_ijin', ['nip' => $data['staff']['nik']])->result_array();

        $this->form_validation->set_rules('category', 'Kategori keterangan', 'required');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('member/layout/jb_header', $data);
            $this->load->view('member/layout/jb_nav', $data);
            $this->load->view('member/absensi/ijin', $data);
            $this->load->view('member/layout/jb_footer', $data);
        } else {
            $id = $data['staff']['nik'];
            $cat = $this->input->post('category');
            $tgl = $this->input->post('tgl');
            $tgl2 = $this->input->post('tgl2');
            $alasan = $this->input->post('alasan');
            $status = 'diajukan';
            $this->db->where('nama', $data['staff']['jabatan']);
            $a = $this->db->get('m_jabatan')->row_array();
            $this->db->where('subbagian_id', $a['subbagian_id']);
            $this->db->where('leader', 1);
            $idpejabat = $this->db->get('m_jabatan')->row_array();
            $this->db->where('jabatan', $idpejabat['nama']);
            $jab = $this->db->get('jb_personil')->row_array();
            $ke = $jab['name'];
            $pid = $jab['id'];
            $tlp = $jab['tlp'];

            $data = [
                'nip' => $id,
                'tgl_masuk' => $tgl,
                'kategori' => $cat,
                'alasan' => $alasan,
                'ditujukan' => $ke,
                'status' => $status,
                'created_at' => time(),
                'approved_at' => '',
                'pejabat_id' => $pid,
                'tgl_masuk2' => $tgl2
            ];
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|png|pdf|jpeg';
                $config['max_size']         = '5000';
                $config['upload_path']      = './assets/img/absen/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('doc', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->insert('abs_ijin', $data);


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ijin yang Anda buat sudah di kirim. Harap menunggu Acc dari Pimpinan.</div>');
            redirect('member');
        }
    }

    public function prosesdl()
    {
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $hari_ini = date('Y-m-d');
        $time = date('H:i:s');
        $today = date('l', time());
        $this->db->select('subbagian_id');
        $this->db->where('nama', $data['user']['jabatan']);
        $bg = $this->db->get('m_jabatan')->row_array();
        $files = $_FILES["webcam"]["name"];
        $ukuranFile = $_FILES['webcam']['size'];
        $error = $_FILES['webcam']['error'];
        $tmpName = $_FILES['webcam']['tmp_name'];
        $ukuran_file = $_FILES['webcam']['size'];
        $jam_kerja_id = $this->db->get_where('jam_kerja', ['id' => $data['user']['jam_kerja_id']])->row_array();
        $jk_id = $jam_kerja_id['id'];
        $jamMasuk = $jam_kerja_id['jam_masuk'];
        $jm = strtotime($jamMasuk);
        $jamPulang = $jam_kerja_id['jam_pulang'];
        $latitude = trim($_GET['latitude']);
        $this->db->where('NIP', $data['user']['nik']);
        $this->db->where('TGL_MASUK', $hari_ini);
        $this->db->where('STAT_ABSEN', 2);
        $ck = $this->db->get('abs_kehadiran')->num_rows();
        if ($ck > 0) {
            echo "Anda Sudah absen pulang hari ini.";
        } else {
            $this->db->where('NIP', $data['user']['nik']);
            $this->db->where('STAT_KERJA', 2);
            $this->db->where('STAT_ABSEN', 1);
            $this->db->order_by('TGL_MASUK', 'desc');
            $this->db->limit(1);
            $cek_hadir = $this->db->get('abs_kehadiran')->row_array();
            if ($cek_hadir) {
                $filename = '' . $data['user']['name'] . '-out-' . $hari_ini . '-' . $data['user']['nik'] . '.jpg';
                $directory = "../assets/img/absen/" . $filename;
                $jam_masuk = $cek_hadir['TIME_IN'];
                $durasi = $this->Waktu_model->durasiKerja($jam_masuk, $time);
                $absenPulang = $this->_absenPulang($filename, $latitude, $tmpName, $cek_hadir['ID'], $durasi);
                echo $absenPulang;
            } else {
                $filename = '' . $data['user']['name'] . '-out-' . $hari_ini . '-' . $data['user']['nik'] . '.jpg';
                $directory = "../assets/img/absen/" . $filename;
                $info = 'Dinas Luar';
                $absenMasuk = $this->_absenMasuk($filename, $latitude, $tmpName, $jk_id, $info);
                echo $absenMasuk;
            }
        }
    }

    private function _absenMasuk($filename, $latitude, $tmpName, $jk_id, $info, $time)
    {

        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('subbagian_id');
        $this->db->where('nama', $data['user']['jabatan']);
        $bg = $this->db->get('m_jabatan')->row_array();

        $hari_ini = date('Y-m-d');
        $stat = '1';

        $ket = 'success/Selamat Anda berhasil Absen Masuk';
        if ($info == 'Terlambat') {
            $ket = 'success/Anda Terlambat hari ini. Untuk besok, Sebaiknya absen masuk sebelum mulai jam kerja.';
        }
        if ($info == 'Dinas Luar') {
            $stat = '2';
            $dataabsen = [
                'NIP' => $data['user']['nik'],
                'TGL_MASUK' => $hari_ini,
                'TIME_IN' => $time,
                'TIME_OUT' => '00:00:00',
                'PICTURE_IN' => $filename,
                'PICTURE_OUT' => '-',
                'STAT_KERJA' => $stat,
                'STAT_ABSEN' => 1,
                'LOK_IN' => $latitude,
                'LOK_OUT' => '-',
                'INFO' =>   $info,
                'DISETUJUI_OLEH' => '-',
                'IJIN_ID' => '',
                'JAM_KERJA_ID' => $jk_id
            ];

            $this->db->insert('abs_kehadiran', $dataabsen);
            $cek = ($this->db->affected_rows() != 1) ? false : true;
            move_uploaded_file($tmpName, './assets/img/absen/' . $filename);

            if ($cek === 'false') {
                return 'Absen Gagal. Silahkan hubungi administrator';
            } else {
                return $ket;
            }
        } else {

            $dataabsen = [
                'NIP' => $data['user']['nik'],
                'TGL_MASUK' => $hari_ini,
                'TIME_IN' => $time,
                'TIME_OUT' => '00:00:00',
                'PICTURE_IN' => $filename,
                'PICTURE_OUT' => '-',
                'STAT_KERJA' => $stat,
                'STAT_ABSEN' => 1,
                'LOK_IN' => $latitude,
                'LOK_OUT' => '-',
                'INFO' =>   $info,
                'DISETUJUI_OLEH' => '-',
                'IJIN_ID' => '',
                'JAM_KERJA_ID' => $jk_id
            ];
            $sql = $this->db->insert('abs_kehadiran', $dataabsen);
            $cek = ($this->db->affected_rows() != 1) ? false : true;
            move_uploaded_file($tmpName, './assets/img/absen/' . $filename);

            if ($cek === 'false') {
                return 'Gagal absen';
            } else {
                return $ket;
            }
        }
    }

    private function _absenPulang($filename, $latitude, $tmpName, $id_absen, $durasi)
    {
        $data['user'] = $this->db->get_where('jb_personil', ['email' => $this->session->userdata('email')])->row_array();
        $hari_ini = date('Y-m-d');
        $time = date('Y-m-d H:i:s');

        $this->db->set('TIME_OUT', $time);
        $this->db->set('LOK_OUT', $latitude);
        $this->db->set('PICTURE_OUT', $filename);
        $this->db->set('STAT_ABSEN', '2');
        $this->db->set('DURASI', $durasi);
        $this->db->where('ID', $id_absen);
        $this->db->update('abs_kehadiran');
        $cek = ($this->db->affected_rows() != 1) ? false : true;
        move_uploaded_file($tmpName, './assets/img/absen/' . $filename);

        if ($cek === 'false') {
            return 'Gagal absen';
        } else {
            return 'success/Selamat "' . $data['user']['name'] . '" berhasil Absen Pulang';
        }
    }
}
