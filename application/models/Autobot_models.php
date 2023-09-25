<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Autobot_models extends CI_Model
{
    public function getAbsenSim($tgl)
    {
        $sql = "SELECT
                    id = A.ID,
                    nik = A.NIP,
                    masuk = A.TIME_IN 
                FROM
                    [dbo].[abs_kehadiran] A
                    LEFT JOIN [dbo].[jb_personil] B ON B.nik = A.NIP
                    LEFT JOIN [dbo].[m_jabatan] C ON C.nama = B.jabatan
                WHERE
                    A.TGL_MASUK = '$tgl'
                    AND C.subbagian_id = 2
                    AND A.STAT_ABSEN = 1";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    public function getBelumAbsenMasuk($tgl, $time)
    {
        $sql = "SELECT
                *
                FROM
                (SELECT
                    nik = A.nik,
                    hp = A.tlp,
                    hadir = (SELECT COUNT(ID) FROM abs_kehadiran WHERE NIP = A.nik AND TGL_MASUK = '$tgl'),
                    shift = B.nama,
	                masuk = SUBSTRING(CONVERT(VARCHAR(10),B.jam_masuk),0,9)
                FROM
                    [dbo].[jb_personil] A
                    INNER JOIN dbo.jam_kerja B ON B.id = A.jam_kerja_id
                    WHERE B.jam_masuk LIKE '$time%'
                    AND A.deleted = 'no')xx
                    WHERE xx.hadir = 0	
	            ";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    public function getBelumAbsenMasukLibur($tgl, $time)
    {
        $sql = "SELECT
                *
                FROM
                (SELECT
                    nik = A.nik,
                    hp = A.tlp,
                    hadir = (SELECT COUNT(ID) FROM abs_kehadiran WHERE NIP = A.nik AND TGL_MASUK = '$tgl'),
                    shift = B.nama,
	                masuk = SUBSTRING(CONVERT(VARCHAR(10),B.jam_masuk),0,9)
                FROM
                    [dbo].[jb_personil] A
                    INNER JOIN dbo.jam_kerja B ON B.id = A.jam_kerja_id
                    WHERE B.jam_masuk LIKE '$time%'
                    AND A.deleted = 'no'
                    AND NOT B.nama = 'Non Shift / STAFF')xx
                    WHERE xx.hadir = 0	
	            ";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    public function getBelumAbsenPulang($tgl, $time)
    {
        $sql = "SELECT
                    nik = A.nik,
                    hp = A.tlp,
                    shift = B.nama,
	                pulang = SUBSTRING(CONVERT(VARCHAR(10),B.jam_pulang),0,9)
                FROM
                    [dbo].[jb_personil] A
                    INNER JOIN dbo.jam_kerja B ON B.id = A.jam_kerja_id
                    INNER JOIN dbo.abs_kehadiran C ON C.NIP = A.nik
                    WHERE B.jam_pulang LIKE '$time%'
                    AND STAT_ABSEN = 1
                    AND TGL_MASUK = '$tgl'
	            ";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
}
