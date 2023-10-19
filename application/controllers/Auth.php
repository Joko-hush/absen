<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('cookie');
    }
    public function index()
    {
        $c = get_cookie('always');
        if (!$c) {
            $session = $this->session->userdata('email');
            $email = $session;
        } else {
            $email = $c;
        }

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $this->db->where('nik', $user['nik']);
            $staff = $this->db->get('jb_personil')->row_array();
            $data = [
                'email' => $user['email'],
                'role_id' => $user['role_id']
            ];
            $this->session->set_userdata($data);
            $this->db->set('online', 1);
            $this->db->where('id', $staff['id']);
            $this->db->update('jb_personil');
            $log = [
                'user_id' => $user['id'],
                'action' => 'login',
                'created_at' => time()
            ];
            $this->db->insert('log', $log);
            if ($user['role_id'] == 1) {
                redirect('admin');
            } elseif ($user['role_id'] == 3) {
                redirect('personalia');
            } else {
                redirect('member');
            }
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run() == false) {

                $data['title'] = 'Login Doelsipetir';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 2) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $cookie = array(
                        'name'   => 'always',
                        'value'  => $user['email'],
                        'expire' => (60 * 60 * 24 * 365),
                        'secure' => TRUE
                    );
                    set_cookie($cookie);
                    $this->session->set_userdata($data);
                    $this->db->where('nik', $user['nik']);
                    $staff = $this->db->get('jb_personil')->row_array();

                    $log = [
                        'user_id' => $user['id'],
                        'action' => 'login',
                        'created_at' => time()
                    ];
                    $this->db->insert('log', $log);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 3) {
                        redirect('personalia');
                    } else {

                        redirect('member');
                    }
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not activated!</div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK Kepegawaian', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password not match!', 'min_length' => 'password too short!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $nik = $this->input->post('nik');
            $ln = strlen($nik);
            $name = strtoupper(htmlspecialchars($this->input->post('name', true)));

            $tlp = phone($this->input->post('tlp'));
            if ($ln < 6) {
                $nik = $nik;
            } elseif ($ln <= 10) {
                $a = substr($nik, 0, 2);
                $b = substr($nik, 2, $ln);
                $nik = $a . '.' . $b;
            } elseif ($ln == 12) {
                list($a, $b) = explode('.', $nik);
                $nik = $a . '.' . trim($b);
            } else {
                $nik = $nik;
            }
            $this->db->where('nip', $nik);
            $s = $this->db->get('m_personil_pers')->row_array();



            if ($s) {
                $data = [

                    'name' => $name,
                    'email' => htmlspecialchars($email),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_active' => 0,
                    'date_created' => time(),
                    'nik' => $nik,
                    'tlp' => $tlp
                ];

                $token = rand(64, 123161);
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user', $data);
                // $this->db->insert('jb_personil', $data2);
                $this->db->insert('user_token', $user_token);

                // $this->_sendEmail($token, 'verify');

                $phone = $tlp;
                $text = "Untuk Aktivasi akun Doelsipetir Anda silahkan klik link dibawah ini\n" . base_url() . 'auth/verify?email=' . $email . '&token=' . $token . "\nSetelah proses aktivasi tinggal menunggu konfirmasi dari bagian Personalia.\nTerimakasih.";
                $phone1 = '6281324981695';
                $text1 = "Info si Doel \n
                        Ada registrasi akun baru. Dengan rincian sbb:\n
                        nama : $name\n
                        email : $email\n
                        nik : $nik\n
                        tlp : $tlp\n
                        Terima kasih.
                ";
                $this->Wa_models->_send($phone, $text);
                $this->Wa_models->_send($phone1, $text1);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat akun Anda sudah dibuat. Silahkan cek email untuk aktivasi. Jika tidak ada, silahkan cek di spam. Tunggu di Approve oleh Personalia. <a href="https://mail.google.com/">Cek Inbox</a></div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nik tidak ditemukan. Silahkan hubungi personalia.</div>');
                redirect('auth');
            }
        }
    }
    // private function _sendEmail($token, $type)
    // {

    //     $to = $this->input->post('email');
    //     $from = 'info@rsdustira.co.id';
    //     if ($type == 'verify') {
    //         $subject = 'Verify';
    //         $body = $this->safeBase64('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a> <br><br> Jika link di atas tidak bekerja, silahkan copy link di bawah ini dan paste-kan pada browser anda : <br> "' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"');
    //     } else if ($type == 'forgot') {
    //         $subject = 'Forgot Password';
    //         $body = $this->safeBase64('Click this link to reset your account : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a> <br><br> Jika link di atas tidak bekerja, silahkan copy link di bawah ini dan paste-kan pada browser anda : <br> "' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"');
    //     }
    //     // $body = base64_encode('test');
    //     $this->load->model('Mail_models', 'mail');
    //     $send = $this->mail->send($to, $from, $subject, $body);
    //     if ($send == 'OK') {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }
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

    public function verify()
    {
        $email = trim($this->input->get('email'));
        $token = trim($this->input->get('token'));

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">' . $email . ' sudah aktif. Tinggal menunggu konfirmasi dari personalia.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account Activation failed. Token Expired</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account Activation failed. Wrong Token</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account Activation failed. Wrong Email</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        delete_cookie('always');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('jb_personil', ['email' => $data['user']['email']])->row_array();
        $this->db->set('online', 0);
        $this->db->where('id', $data['staff']['id']);
        $this->db->update('jb_personil');

        $log = [
            'user_id' => $data['user']['id'],
            'action' => 'logout',
            'created_at' => time()
        ];
        $this->db->insert('log', $log);
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out.</div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }


    public function forgotPassword()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 2])->row_array();

            if ($user) {
                $token = rand(512, 1213465);
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $text = 'Click this link to reset your account :\n ' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '\nSilahkan copy link di atas dan paste-kan pada browser anda';
                $phone = phone($user['tlp']);
                $this->Wa_models->_send($phone, $text);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">We send reset password code to your whatsapp number.</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your email is not registered or activated.</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = urldecode($this->input->get('token'));

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password failed. Token Expired</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password failed. Wrong Token</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password failed. Wrong Email</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'New Password', 'required|trim|min_length[5]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[5]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');


            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed, please login.</div>');
            redirect('auth');
        }
    }
}
