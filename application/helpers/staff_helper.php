<?php
function is_logged_staff()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        if ($role_id != 2) {
            redirect('auth/blocked');
        }
    }
}
