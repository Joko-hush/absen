<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class SendInformasiAbsensi extends CI_Controller
{
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
        $day = date('l');
        // $day = date('l', strtotime('+ 3 day'));
        $now = date('H:i');
        // $skrg = date('H:i', strtotime('+ 15 minutes'));


        if ($day === 'Saturday' or $day === 'Sunday') {
            // echo "OK";
            // die;
            $response = array(
                'code' => 200
            );
            echo json_encode($response);
        } else {
            if ($day === 'Friday') {
                if ($now == '15:30') {
                    $skrg = date('H:i', strtotime('- 30 minutes'));
                } else {
                    if ($now == '06:00') {
                        $skrg = date('H:i', strtotime('+ 60 minutes'));
                    }
                    if ($now == '06:30') {
                        $skrg = date('H:i', strtotime('+ 90 minutes'));
                    }
                }
            } else {
                // echo "Mantap";
                // die;
                if ($now == '06:00') {
                    $skrg = date('H:i', strtotime('+ 60 minutes'));
                }
                if ($now == '06:30') {
                    $skrg = date('H:i', strtotime('+ 90 minutes'));
                }
            }


            $sql = "SELECT * FROM (SELECT
                    p = P.tlp
                    ,jm = J.jam_masuk
                    ,jp = J.jam_pulang 
                FROM
                    SIPERS.dbo.jb_personil P
                    INNER JOIN SIPERS.dbo.jam_kerja J ON J.id = P.jam_kerja_id 
                WHERE
                    P.tlp <> ''
                    AND P.deleted = 'no') xx
                    WHERE jm = '$skrg' or
                    jp = '$now'
                    ";
            $u = $this->db->query($sql)->result_array();
            $b = count($u);
            $c = $b / 2;
            $d = $c * 2;
            $i = 1;
            $text = "Halo, Sudahkah Anda absen di aplikasi Doelsipetir? \n Silahkan masuk ke aplikasi Doelsipetir atau klik tautan ini https://rsdustira.co.id/doelsipetir/ ini adalah pesan otomatis. \n Abaikan jika sudah absen, sedang libur atau tidak merasa daftar di aplikasi doelsipetir.";

            $cekUser = count($u);
            if ($cekUser > 0) {
                foreach ($u as $u) {
                    // $i++;
                    // if ($i > $c) {
                    //     $phone = $this->phone($u['p']);
                    //     $wa = $this->Wa_models->_send2($phone, $text);
                    // } else {
                    //     $phone = $this->phone($u['p']);
                    //     $wa = $this->Wa_models->_send($phone, $text);
                    // }
                    $phone = $this->phone($u['p']);
                    $wa = $this->Wa_models->_send2($phone, $text);
                }
                $response = array(
                    'code' => 200
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'code' => 200
                );
                echo json_encode($response);
            }
        }
    }


    public function testwa()
    {
        $sql = "INSERT INTO [WA].[dbo].[BATCH] ([NOMORWA], [LAYOUTTEXT], [STATUS]) VALUES ('62881024913954', 'doelsipeetir', 0)";
        $this->db->query($sql);
        $response = array(
            'code' => 200
        );
        echo json_encode($response);
    }
}
