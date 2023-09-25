<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi_models extends CI_Model
{
    public function getKatPangkat()
    {
        $this->db->select('pangkat');
        $this->db->group_by('pangkat');
        $this->db->order_by('pangkat', 'desc');
        return $this->db->get('m_personil_pers')->result_array();
    }
    public function getJumlahPangkat($p)
    {
        // $query = "SELECT pangkat, jumlah = count(pangkat) from m_personil_pers where pangkat = '$p' ";
        // return $this->db->query($query);
        $this->db->where('pangkat', $p);
        $j = $this->db->get('m_personil_pers')->num_rows();
        $data = [
            'pangkat' => $p,
            'jumlah' => $j
        ];
        return $data;
    }
    public function getGol()
    {
        $this->db->select('gol');
        $this->db->group_by('gol');
        return $this->db->get('m_personil_pers')->result_array();
    }
    public function getJmlGol($g)
    {
        $this->db->where('gol', $g);
        $j = $this->db->get('m_personil_pers')->num_rows();
        $data = ['gol' => $g, 'jumlah' => $j];
        return $data;
    }
}
