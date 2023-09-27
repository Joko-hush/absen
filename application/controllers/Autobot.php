<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class Autobot extends CI_Controller
{

    public function pengingatAbsenMasuk()
    {
        $tgl = date('Y-m-d');
        $time = date('H:i');
        $hari = date('l');
        if (hari($hari) == 'Sabtu' || hari($hari) == 'Minggu') {
            $cek = $this->Autobot_models->getBelumAbsenMasukLibur($tgl, $time);
        } else {

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
