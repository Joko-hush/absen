<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Card extends CI_Controller
{


    public function index()
    {
        $data['title'] = 'DOEL SI PETIR | Isi Data';
        $data['judul'] = 'Riwayat Pendidikan Militer';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $log = [
            'user_id' => $data['staff']['id'],
            'action' => 'Buka hal bahasa',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);

        $this->db->where('personil_id', $data['staff']['id']);
        $data['kk'] = $this->db->get('jb_kartu_keluarga')->row_array();
        if (!$data['kk']) {
            $data['kk'] = ['no_kk' => '', 'doc' => ''];
        }
        $this->db->where('personil_id', $data['staff']['id']);
        $data['npwp'] = $this->db->get('jb_npwp')->row_array();
        if (!$data['npwp']) {
            $data['npwp'] = ['npwp' => '', 'doc' => ''];
        }
        $data['jamKerja'] = $this->db->get('jam_kerja')->result_array();
        $this->db->where('personil_id', $data['staff']['id']);
        $data['kartuBpjs'] = $this->db->get_where('jb_bpjs')->row_array();
        if (!$data['kartuBpjs']) {
            $data['kartuBpjs'] = ['bpjs' => '', 'fktp' => '', 'doc' => ''];
        }
        $this->db->where('personil_id', $data['staff']['id']);
        $data['kartuKtp'] = $this->db->get_where('jb_ktp')->row_array();
        if (!$data['kartuKtp']) {
            $data['kartuKtp'] = ['noktp' => '', 'doc' => ''];
        }
        $this->db->where('personil_id', $data['staff']['id']);
        $data['kartuKaris'] = $this->db->get_where('jb_karis')->row_array();
        if (!$data['kartuKaris']) {
            $data['kartuKaris'] = ['no' => '', 'doc' => ''];
        }
        $this->load->view('member/layout/jb_header', $data);
        $this->load->view('member/layout/jb_nav', $data);
        $this->load->view('member/input/card', $data);
        $this->load->view('member/layout/jb_footer', $data);
    }
}
