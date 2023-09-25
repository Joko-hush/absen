<?php

class User_model extends CI_model
{
    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }
    public function getUser($limit, $start, $keyword = null)
    {
        if($keyword) {
            $this->db->like('name', $keyword);
            $this->db->or_like('klinik1', $keyword);
        }
        
        
        return $this->db->get('user', $limit, $start)->result_array();    
    }
    public function countAllUser()
    {
        return $this->db->get('user')->num_rows();    
    }
    
    
    
}