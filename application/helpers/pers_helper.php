<?php
function is_logged_pers()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        if ($role_id != 3) {
            redirect('auth/blocked');
        }
    }
}
