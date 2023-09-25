<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Evaluasi_models', 'evaluasi');
    }

    public function index()
    {
        $data['title'] = 'DOEL SI PETIR';
        $data['judul'] = 'Kategori Personil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('is_active', 1);
        $this->db->order_by('date_created', 'desc');
        $data['approve'] = $this->db->get_where('user')->result_array();
        $data['ja'] = count($data['approve']);
        $today = date('Y-m-d');
        $this->db->where('tgl_masuk >=', $today);
        $this->db->where('status', 'diajukan');
        $this->db->where('approved_at', 0);
        $data['ket_absen'] = $this->db->get('abs_ijin')->num_rows();

        // $gol = $this->evaluasi->getGol();
        // foreach ($gol as $g) {
        //     $gol = $this->evaluasi->getJmlGol($g['gol']);
        //     list($g, $j) = explode('-', $gol);
        //     $gol[] = ['gol' => $g, 'jumlah' => $j];
        // }
        // $data['gol'] = $gol;
        // var_dump($data['gol']);
        // die;

        $this->db->where('gol', 'tni');
        $tni = $this->db->get('m_personil_pers')->num_rows();
        $this->db->where('gol', 'pns');
        $pns = $this->db->get('m_personil_pers')->num_rows();
        $this->db->where('gol', 'khl');
        $khl = $this->db->get('m_personil_pers')->num_rows();
        $data['gol'] = [
            'tni' => $tni,
            'pns' => $pns,
            'khl' => $tni
        ];



        $pangkat = $this->evaluasi->getKatPangkat();
        foreach ($pangkat as $p) {
            $jml_pangkat[] = $this->evaluasi->getJumlahPangkat($p['pangkat']);
        }
        $data['jmlPangkat'] = $jml_pangkat;

        $this->load->view('layout/header_pers', $data);
        $this->load->view('layout/nav_pers', $data);
        $this->load->view('layout/sidebar_pers', $data);
        $this->load->view('evaluasi/kategori', $data);
        $this->load->view('layout/footer_pers', $data);
    }
}
