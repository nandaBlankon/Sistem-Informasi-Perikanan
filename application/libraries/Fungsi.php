<?php

class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('model_user');
        $user_id = $this->ci->session->userdata('user_id');
        $user_data = $this->ci->model_user->get($user_id)->row();
        return $user_data;
    }
}