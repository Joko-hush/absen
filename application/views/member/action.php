<?php
date_default_timezone_set('Asia/Jakarta');

$hari_ini = date('Y-m-d');
$time = date('H:i:s');


switch (@$_GET['action']) {


    case 'absendd':
        $latitude = $_GET['latitude'];
        list($lat, $long) = explode(',', $latitude);
        $lat2 = trim($lat);
        $lon2 = trim($long);
        $lat1 = (-6.885504520804366);
        $lon1 = (107.53379160097744);
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($miles <= 0.08) {


            $files = $_FILES["webcam"]["name"];
            $ukuranFile = $_FILES['webcam']['size'];
            $error = $_FILES['webcam']['error'];
            $tmpName = $_FILES['webcam']['tmp_name'];


            $ukuran_file = $_FILES['webcam']['size'];


            // Cek User yang sudah login -----------------------------------------------
            $hadir = $this->db->get_where('abs_kehadiran', ['NIP' => $user['nik'], 'TGL_MASUK' => $hari_ini])->num_rows();
            $jam_kerja_id = $this->db->get_where('jam_kerja', ['id' => $user['jam_kerja_id']])->row_array();
            $jk_id = $jam_kerja_id['id'];
            $jamMasuk = $jam_kerja_id['jam_masuk'];
            $jamPulang = $jam_kerja_id['jam_pulang'];

            if ($hadir == 0) {
                $filename = '' . $user['name'] . '-in-' . $hari_ini . '-' . $user['nik'] . '.jpg';
                if ($time > $jamMasuk) {
                    $info = 'Terlambat';
                } else {
                    $info = '';
                }
                $dataabsen = [
                    'NIP' => $user['nik'],
                    'TGL_MASUK' => $hari_ini,
                    'TIME_IN' => $time,
                    'TIME_OUT' => '00:00:00',
                    'PICTURE_IN' => $filename,
                    'PICTURE_OUT' => '-',
                    'STAT_KERJA' => 1,
                    'STAT_ABSEN' => 1,
                    'LOK_IN' => $latitude,
                    'LOK_OUT' => '-',
                    'INFO' =>   $info,
                    'DISETUJUI_OLEH' => '-',
                    'IJIN_ID' => '',
                    'JAM_KERJA_ID' => $jk_id
                ];
                $this->db->insert('abs_kehadiran', $dataabsen);
                move_uploaded_file($tmpName, './assets/img/absen/' . $filename);
                echo 'success/Selamat Anda berhasil Absen Masuk pada Tanggal ' . $hari_ini . ' dan Jam : ' . $time . ', Selamat bekerja "' . $user['name'] . '" !';
            } else {

                $this->db->where('TGL_MASUK', $hari_ini);
                $this->db->where('NIP', $user['nik']);
                $this->db->where('TIME_OUT', '00:00:00');
                $pulang = $this->db->get_where('abs_kehadiran')->num_rows();

                if ($pulang > 0) {
                    $filename = '' . $user['name'] . '-out-' . $hari_ini . '-' . $user['nik'] . '.jpg';
                    $directory = "../assets/img/absen/" . $filename;

                    $this->db->where('TGL_MASUK', $hari_ini);
                    $this->db->where('NIP', $user['nik']);
                    $this->db->where('TIME_OUT', '00:00:00');
                    $userpulang = $this->db->get_where('abs_kehadiran')->row_array();
                    $id = $userpulang['ID'];
                    if ($time <= $jamPulang) {

                        echo 'Maaf belum waktunya Anda pulang. Jika anda ada keperluan silahkan pilih ijin.';
                    } else {

                        $this->db->set('TIME_OUT', $time);
                        $this->db->set('LOK_OUT', $latitude);
                        $this->db->set('PICTURE_OUT', $filename);
                        $this->db->set('STAT_ABSEN', '2');
                        $this->db->where('ID', $id);
                        $this->db->update('abs_kehadiran');


                        $this->db->where('ID', $userpulang['ID']);
                        $this->db->where('TIME_OUT', $time);
                        $statpulang = $this->db->get_where('abs_kehadiran')->num_rows();

                        if ($statpulang > 0) {

                            move_uploaded_file($tmpName, './assets/img/absen/' . $filename);
                            echo 'success/Selamat "' . $user['name'] . '" berhasil Absen Pulang pada Tanggal ' . $hari_ini . ' dan Jam : ' . $time . ', Hati-hati dijalan saat pulang "' . $user['name'] . '"!';
                        }
                    }
                } else {
                    echo 'Anda belum absen masuk hari ini';
                }
            }
        } else {
            echo 'Anda belum ada masuk ke wilayah absensi Rumah Sakit dustira. Wilayah absen 100m dari kantor kantor karumkit';
        }

        break;

    case 'absendl':
        $no = $this->db->get('abs_kehadiran')->num_rows();
        $noid = $no + 1;
        $latitude = $_GET['latitude'];
        $files = $_FILES["webcam"]["name"];
        $ukuranFile = $_FILES['webcam']['size'];
        $error = $_FILES['webcam']['error'];
        $tmpName = $_FILES['webcam']['tmp_name'];
        $ukuran_file = $_FILES['webcam']['size'];
        // Cek User yang sudah login -----------------------------------------------
        $hadir = $this->db->get_where('abs_kehadiran', ['nip' => $user['nik'], 'TGL_MASUK' => $hari_ini])->num_rows();

        if ($hadir == 0) {
            $filename = '' . $user['name'] . '-in-' . $hari_ini . '-' . $user['nik'] . '.jpg';
            $dataabsen = [
                'NIP' => $user['nik'],
                'TGL_MASUK' => $hari_ini,
                'TIME_IN' => $time,
                'TIME_OUT' => '00:00:00',
                'PICTURE_IN' => $filename,
                'PICTURE_OUT' => '-',
                'STAT_KERJA' => 2,
                'STAT_ABSEN' => 1,
                'LOK_IN' => $latitude,
                'LOK_OUT' => '-',
                'INFO' => '-'
            ];
            $this->db->insert('abs_kehadiran', $dataabsen);
            move_uploaded_file($tmpName, './assets/img/absen/' . $filename);
            echo 'success/Selamat Anda berhasil Absen Masuk pada Tanggal ' . $hari_ini . ' dan Jam : ' . $time . ', Selamat bekerja "' . $user['name'] . '" !';
        }
        break;
}
