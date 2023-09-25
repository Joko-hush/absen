<?php

class Pangkat_models extends CI_model
{
    public function getAll()
    {
        return $this->db->get('jb_pangkat')->result_array();
    }
}
