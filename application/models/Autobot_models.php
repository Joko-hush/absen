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
                    abs_kehadiran A
                    LEFT JOIN jb_personil B ON B.nik = A.NIP
                    LEFT JOIN m_jabatan C ON C.nama = B.jabatan
                WHERE
                    A.TGL_MASUK = '$tgl'
                    AND C.subbagian_id = 2
                    AND A.STAT_ABSEN = 1";
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
    public function getBelumAbsenMasuk($tgl, $time)
    {
        $this->db->select('A.nik AS nik, A.tlp AS hp, (SELECT COUNT(ID) FROM abs_kehadiran WHERE NIP = A.nik AND TGL_MASUK = ' . $tgl . ') AS hadir, B.nama AS shift, SUBSTRING(CONVERT(B.jam_masuk, CHAR(10)), 1, 9) AS masuk', false);
        $this->db->from('jb_personil A');
        $this->db->join(
            'jam_kerja B',
            'B.id = A.jam_kerja_id'
        );
        $this->db->like('B.jam_masuk', $time);
        $this->db->where('A.deleted', 'no');
        $this->db->having('hadir', 0);

        $query = $this->db->get()->result_array();
        return $query;
    }
    public function getBelumAbsenMasukLibur($tgl, $time)
    {
        $this->db->select('A.nik AS nik, A.tlp AS hp, (SELECT COUNT(ID) FROM abs_kehadiran WHERE NIP = A.nik AND TGL_MASUK = ' . $tgl . ') AS hadir, B.nama AS shift, SUBSTRING(CONVERT(B.jam_masuk, TIME), 1, 9) AS masuk', false);
        $this->db->from('jb_personil A');
        $this->db->join('jam_kerja B', 'B.id = A.jam_kerja_id');
        $this->db->like('B.jam_masuk', $time);
        $this->db->where('A.deleted', 'no');
        $this->db->where('B.nama !=', 'Non Shift / STAFF');
        $this->db->having('hadir', 0);

        $query = $this->db->get()->result_array();
        return $$query;
    }
    public function getBelumAbsenPulang($tgl, $time)
    {
        $this->db->select('A.nik AS nik, A.tlp AS hp, B.nama AS shift, SUBSTRING(CONVERT(B.jam_pulang, TIME), 1, 9) AS pulang', false);
        $this->db->from('jb_personil A');
        $this->db->join('jam_kerja B', 'B.id = A.jam_kerja_id');
        $this->db->join('abs_kehadiran C', 'C.NIP = A.nik');
        $this->db->like('B.jam_pulang', $time);
        $this->db->where('C.STAT_ABSEN', 1);
        $this->db->where('C.TGL_MASUK', $tgl);

        $query = $this->db->get()->result_array();
        return $query;
    }
}
