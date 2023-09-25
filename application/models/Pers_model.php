<?php

class Pers_model extends CI_model
{
    public function approve($id, $stat)
    {
        if ($stat == 'tolak') {
            $this->db->where('id', $id);
            $user = $this->db->get('user')->row_array();
            $email = $user['email'];
            $this->db->where('id', $id);
            $this->db->delete('user');
            $this->_sendEmail($stat, $email);
            return $stat;
        } else {
            $this->db->where('id', $id);
            $user = $this->db->get('user')->row_array();
            $email = $user['email'];
            $kdstaff = $user['nik'];

            $this->db->where('nip', $kdstaff);
            $staff = $this->db->get('m_personil_pers')->row_array();
            $this->db->where('nik', $kdstaff);
            $cek = $this->db->get('jb_personil')->num_rows();
            if ($cek > 0) {
                $stat = "sudah ada";
                return $stat;
            } else {

                if (!$staff['gender']) {
                    $staff['gender'] = '-';
                }

                $data = [
                    'nik' => $kdstaff,
                    'name' => $user['name'],
                    'tempat_lahir' => '',
                    'tgl_lahir' => '',
                    'sex' => $staff['gender'],
                    'agama' => '',
                    'gol_darah' => '',
                    'email' => $user['email'],
                    'tlp' => '',
                    'suku_bangsa' => '',
                    'tmt_kerja' => '',
                    'image' => 'default.jpg',
                    'pangkat' => '',
                    'jabatan' => '',
                    'tmt_jabatan' => '',
                    'bpjs' => '',
                    'npwp' => '',
                    'ktp' => '',
                    'alamat' => '',
                    'kategori' => '',
                    'sumber_pa' => '-',
                    'satuan' => 'RS. DUSTIRA',
                    'psi' => '',
                    'created_at' => time(),
                    'update_at' => time(),
                    'deleted' => 'no',
                    'deleted_at' => 0
                ];
                $this->db->insert('jb_personil', $data);
                $this->db->set('is_active', 2);
                $this->db->where('id', $id);
                $this->db->update('user');
                $this->_sendEMail($stat, $email);
                return $stat;
            }
        }
    }
    private function _sendEmail($type, $email)
    {

        $to = $email;
        $from = 'info@rsdustira.co.id';
        if ($type == 'tolak') {
            $subject = 'Aktivasi Akun';
            $body = base64_encode('Mohon Maaf akun Anda tidak di setujui silahkan hubungi bagian personalia untuk informasi lebih lanjut.');
        } else if ($type == 'setuju') {
            $subject = 'Aktivasi Akun';
            $body = base64_encode('Akun Anda telah di setujui. Silahkan klik link dibawah ini untuk login.<br> <a href="' . base_url() . 'auth' . '">Login</a>');
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://172.165.115.224/sendmail.php");


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "to=$to&from=$from&subject=$subject&text=$body"
        );
        $output = curl_exec($ch);

        curl_close($ch);
        return true;
    }
    private function safeBase64($str)
    {
        return strtr($this->base64($str), '+/=', '-_,');
    }

    private function deSafeBase64($str)
    {
        return $this->deBase64(strtr($str, '-_,', '+/='));
    }

    private function base64($str)
    {
        return base64_encode($str);
    }

    private function deBase64($str)
    {
        return base64_decode($str);
    }
    public function getAllPersonilPerJabatan()
    {
        $sql = "SELECT        
    P.nik as nik,
    P.name as nama,
    P.pangkat as pangkat,
	J.nama as jabatan,
	S.subbagian as subbagian,
	B.bagian as bagian,
	D.bidang as bidang
FROM
	jb_personil P
	INNER JOIN m_jabatan J ON J.nama = P.jabatan
	INNER JOIN m_subbagian S ON S.id = J.subbagian_id
	INNER JOIN m_bagian B ON B.id = S.bagian_id
	INNER JOIN m_bidang D ON D.id = B.bidang_id
	INNER JOIN m_eselon E ON E.id = D.eselon_id
	ORDER BY E.id, D.bidang, B.bagian, S.subbagian, J.nama ";

        return $this->db->query($sql)->result_array();
    }
}
