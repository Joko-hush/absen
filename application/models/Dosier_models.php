<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dosier_models extends CI_Model
{
    public function getKartu($id)
    {
        $sql = "SELECT
	A.noktp AS KTP,
	A.doc AS DOK_KTP,
	B.bpjs AS BPJS,
	B.doc AS DOK_BPJS,
	C.npwp AS NPWP,
	C.doc AS DOK_NPWP,
	X.no_kk AS KK,
	X.doc AS DOK_KK 
FROM
	jb_ktp A
	INNER JOIN jb_bpjs B ON B.personil_id = A.personil_id
	INNER JOIN jb_npwp C ON C.personil_id = A.personil_id
	INNER JOIN jb_kartu_keluarga X ON X.personil_id = A.personil_id 
WHERE
	A.personil_id = $id";

        return $this->db->query($sql)->row_array();
    }

    // kartu
    public function getKtp($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_ktp')->row_array();
        return $card;
    }
    public function getBpjs($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_bpjs')->row_array();
        return $card;
    }
    public function getKk($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_kartu_keluarga')->row_array();
        return $card;
    }
    public function getNpwp($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_npwp')->row_array();
        return $card;
    }
    public function getKaris($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_karis')->row_array();
        return $card;
    }

    // kartu
    public function getRpangkat($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('tmt', 'desc');
        $card = $this->db->get('jb_kepangkatan')->result_array();
        return $card;
    }
    public function getRdikUm($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_dik_um')->result_array();
        return $card;
    }
    public function getJf($nip)
    {
        $this->db->where('nip', $nip);
        $this->db->order_by('tmt', 'desc');
        $card = $this->db->get('jabatan_fungsional')->result_array();
        return $card;
    }
    public function getJs($nip)
    {
        $this->db->where('nip', $nip);
        $this->db->order_by('tmt', 'desc');
        $card = $this->db->get('jabatan_struktural')->result_array();
        return $card;
    }
    public function getDikmilA($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_dikmil_a')->result_array();
        return $card;
    }
    public function getDikmilB($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_dikmil_b')->result_array();
        return $card;
    }
    public function getTugasLn($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_r_tugas_luarnegri')->result_array();
        return $card;
    }
    public function getTops($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_r_tugas_operasi')->result_array();
        return $card;
    }
    public function getTkh($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_tanda_kehormatan')->result_array();
        return $card;
    }
    public function getPrestasi($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('thn', 'desc');
        $card = $this->db->get('jb_prestasi')->result_array();
        return $card;
    }
    public function getBahasaDaerah($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_b_daerah')->result_array();
        return $card;
    }
    public function getBahasaAsing($id)
    {
        $this->db->where('personil_id', $id);
        $card = $this->db->get('jb_b_asing
        ')->result_array();
        return $card;
    }
    public function getStatusKeluarga($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->where('stat_hidup', 'hidup');
        $this->db->where('hub', 'anak');
        $anak = $this->db->get('jb_keluarga')->num_rows();

        $this->db->select('status');
        $this->db->select('sex');
        $this->db->where('id', $id);
        $a = $this->db->get('jb_personil')->row_array();
        if ($a['sex'] == 'P') {
            $this->db->where('personil_id', $id);
            $this->db->where('stat_hidup', 'hidup');
            $this->db->where('hub', 'suami');
            $pasangan = $this->db->get('jb_keluarga')->row_array();
            $pasangan = $pasangan['nama'];
        } else {
            $this->db->where('personil_id', $id);
            $this->db->where('stat_hidup', 'hidup');
            $this->db->where('hub', 'istri');
            $pasangan = $this->db->get('jb_keluarga')->row_array();
        }
        $this->db->where('personil_id', $id);
        $this->db->where('stat_hidup', 'hidup');
        $this->db->where('hub', 'ayah');
        $ayah = $this->db->get('jb_keluarga')->row_array();
        $this->db->where('personil_id', $id);
        $this->db->where('stat_hidup', 'hidup');
        $this->db->where('hub', 'ibu');
        $ibu = $this->db->get('jb_keluarga')->row_array();
        $status = $a['status'];
        if ($status == 'Kawin') {
            $status = "K $anak";
        } else {
            $status = "TK";
        }
        if (!$pasangan) {
            $psg = '-';
            $pasangan['tlp'] = '-';
        } else {
            $psg = $pasangan['nama'];
        }
        if (!$ayah) {
            $ayah = '-';
        }
        if (!$ibu) {
            $ibu = '-';
            $alamat = '-';
        } else {
            $alamat = $ibu['alamat'];
        }

        $data = [
            'anak' => $anak,
            'pasangan' => $psg,
            'ayah' => $ayah,
            'ibu' => $ibu,
            'alamat' => $alamat,
            'status' => $status,
            'no_hp' => $pasangan['tlp']
        ];
        return $data;
    }

    public function getSertifikat($id)
    {
        $this->db->where('personil_id', $id);
        $this->db->order_by('tgl', 'desc');
        return $this->db->get('jb_sertifikat')->result_array();
    }
}
