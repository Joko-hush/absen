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
            $text = "Pengajuan akun anda ditolak. Silahkan hubungi bagian pers";
            $wa = $this->Wa_models->_send(phone($user['tlp']), $text);
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
                $text = "Akun dengan no induk karyawan tersebut telah terdaftar dengan email " . $cek['email'] . '\nSilahkan login dengan email diatas untuk masuk ke akun lama Anda. Jika lupa password silahkan lakukan reset password.';
                $wa = $this->Wa_models->_send(phone($user['tlp']), $text);
                $this->db->where('id', $id);
                $this->db->delete('user');
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
                $text = "Akun dengan no induk karyawan tersebut telah terdaftar dengan email " . $cek['email'] . '\nSilahkan login dengan email diatas untuk masuk ke akun Anda.';
                $wa = $this->Wa_models->_send(phone($user['tlp']), $text);
                return $stat;
            }
        }
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
