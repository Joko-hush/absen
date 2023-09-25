<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class Autobot extends CI_Controller
{

    public function cekAbsenAnggotaSim()
    {
        $tgl = date('Y-m-d');
        $lat = '-6.885018256' . rand(663816, 663830);
        $long = '107.5332040331' . rand(4400, 4478);
        $hari = hari(date('l'));
        $d = date('d');
        $m = date('m');
        $y = date('Y');
        $h = rand(16, 17);
        $i = rand(1, 45);
        $s = rand(10, 59);
        if ($d == 17) {
            $hari = 'Senin';
        }
        $time = $y . '-' . $m . '-' . $d . ' ' . $h . ':' . $i . ':' . $s;
        $latitude = $lat . ', ' . $long;
        $sim = $this->Autobot_models->getAbsenSim($tgl);
        foreach ($sim as $s) {
            $id = $s['id'];
            $nik = $s['nik'];
            $jam_masuk = $s['masuk'];
            $filename = $nik . '_' . $hari . '.jpg';
            $durasi = $this->Waktu_model->durasiKerja($jam_masuk, $time);
            $absen = $this->_absenPulang($filename, $latitude, $id, $durasi, $nik, $time);
            $data_absen[] = $absen;
        }
        $response = array(
            'code' => 200,
            'data' => $data_absen
        );
        echo json_encode($response);
    }


    private function _absenPulang($filename, $latitude, $id_absen, $durasi, $nik, $time)
    {
        $this->db->set('TIME_OUT', $time);
        $this->db->set('LOK_OUT', $latitude);
        $this->db->set('PICTURE_OUT', $filename);
        $this->db->set('STAT_ABSEN', '2');
        $this->db->set('DURASI', $durasi);
        $this->db->where('ID', $id_absen);
        $this->db->update('abs_kehadiran');
        $cek = ($this->db->affected_rows() != 1) ? false : true;

        return $nik . ' = ' . $cek;
    }
    public function pengingatAbsenMasuk()
    {
        $tgl = date('Y-m-d');
        $time = date('H:i');
        $hari = date('l');
        if (hari($hari) == 'Sabtu' || hari($hari) == 'Minggu') {
            $cek = $this->Autobot_models->getBelumAbsenMasukLibur($tgl, $time);
        }else{

            $cek = $this->Autobot_models->getBelumAbsenMasuk($tgl, $time);
        }
        // $time = date('07:00');
        foreach ($cek as $c) {
            $phone = phone($c['hp']);
            $shift = $c['shift'];
            $jam_masuk = $c['masuk'];
            $text = "*Pemberitahuan* \n\nSistem melihat bahwa shift kerja Anda _$shift._ Dengan jam masuk _$jam_masuk._ \n\nSilahkan Segera Absen Masuk di Aplikasi Doelsipetir. \n\nAbaikan Jika sudah Absen Atau sedang Cuti/Libur.";
            $this->Wa_models->_send2($phone, $text);
        }
        $response = array(
            'code' => 200
        );
        return ($response);
    }
    public function pengingatAbsenPulang()
    {
        $tgl = date('Y-m-d');
        $time = date('H:i');
        $hari = hari(date('l'));
        if ($hari == 'Jumat') {
            $time = date('H:i', strtotime('-30 minutes'));
        }
        // $time = date('07:00');
        $cek = $this->Autobot_models->getBelumAbsenPulang($tgl, $time);
        foreach ($cek as $c) {
            $phone = phone($c['hp']);
            $shift = $c['shift'];
            $jam_pulang = $c['pulang'];
            $text = "*Pemberitahuan* \n\nSistem melihat bahwa shift kerja Anda _$shift._ Dengan jam masuk _$jam_pulang._ \n\nSilahkan Segera Absen Pulang di Aplikasi Doelsipetir. \n\nAbaikan Jika sudah Absen Atau sedang Cuti/Libur.";
            $this->Wa_models->_send2($phone, $text);
        }
        $response = array(
            'code' => 200
        );
        echo json_encode($response);
    }
    public function pengingat1()
    {
            $masuk = $this->pengingatAbsenMasuk();
            $pulang = $this->pengingatAbsenPulang();

        $response = array(
            'masuk' => $masuk,
            'pulang' => $pulang
        );
        echo json_encode($response);
    }
    public function test()
    {

        $response = array(
            'status' => true
        );
        echo json_encode($response);
    }
}
