<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Utility_models extends CI_Model
{
    public function getUnregistered()
    {
        $this->db->select('A.NIP AS nip, A.nama AS nama, A.pangkat, A.jabatan, A.gol, ISNULL((SELECT TOP 1 CONVERT(BIT, 1) FROM jb_personil AS AA WHERE AA.NIK = A.NIP), CONVERT(BIT, 0)) AS Sudah_Daftar', false);
        $this->db->from('m_personil_pers A');
        $this->db->where('A.ket !=', 'MPP');
        $this->db->where('A.ket !=', 'meninggal');
        $this->db->where('A.ket !=', 'mutasi');
        $this->db->where('A.ket !=', 'stikes');
        $this->db->where('A.ket !=', 'pendidikan');
        $this->db->where('A.ket !=', 'pensiun');
        $this->db->where('A.ket !=', 'paku');
        $this->db->having('Sudah_Daftar', 0);

        $query = $this->db->get()->result_array();

        return $query;
    }

    public function updatePersonil($data, $where)
    {
        $this->db->update('jb_personil', $data, $where);
        return $this->db->affected_rows();
    }
}
