<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Utility_models extends CI_Model
{
    public function getUnregistered()
    {
        $queri = "SELECT * From (select 
                    nip = A.NIP
                    ,nama = A.nama
                    ,pangkat = A.pangkat
                    ,jabatan = A.jabatan
                    ,gol = A.gol
                    ,Sudah_Daftar = ISNULL((SELECT TOP 1CONVERT(BIT, 1) FROM jb_personil AS AA WHERE AA.NIK = A.NIP), CONVERT(BIT, 0))

                    from m_personil_pers A
										WHERE NOT A.ket='MPP'
                                         AND NOT A.ket='meninggal' 
                                         AND NOT A.ket='mutasi' 										
                                         AND NOT A.ket='stikes' 										
                                         AND NOT A.ket='pendidikan' 										
                                         AND NOT A.ket='pensiun' 										
                                         AND NOT A.ket='paku' 										
                    ) AS ZZ
                    Where zz.Sudah_Daftar = 0";

        return $this->db->query($queri)->result_array();
    }

    public function updatePersonil($data, $where)
    {
        $this->db->update('jb_personil', $data, $where);
        return $this->db->affected_rows();
    }
}
