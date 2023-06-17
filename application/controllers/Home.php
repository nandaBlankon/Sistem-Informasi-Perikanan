<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_kapal', 'model_nelayan', 'model_tpi', 'model_ikan', 'model_peta']);
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'page'  => 'home',
            'act_home'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function data_kapal()
    {
        $data = [
            'title' => 'Data Kapal',
            'page'  => 'kapal',
            'kapal' => $this->model_kapal->get(),
            'act_kapal'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/kapal', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function data_nelayan()
    {
        $data = [
            'title' => 'Data Nelayan',
            'page'  => 'nelayan',
            'row'   => $this->model_nelayan->get(),
            'act_nelayan'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/nelayan', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function data_tpi()
    {
        $data = [
            'title' => 'Data Tempat Pelelangan Ikan (TPI)',
            'page'  => 'tpi',
            'row'   => $this->model_tpi->get(),
            'act_tpi'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/tpi', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function data_ikan()
    {
        $data = [
            'title' => 'Data Ikan',
            'page'  => 'ikan',
            'row'   => $this->model_ikan->get(),
            'act_ikan'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/ikan', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function data_peta()
    {
        $data = [
            'title' => 'Data Peta',
            'page'  => 'peta',
            'row'   => $this->model_peta->get(),
            'act_peta'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/peta', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function login()
    {
        $data['title'] = 'Halaman Login';
        $this->load->view('pages/login', $data);
    }

    public function login_proses()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => 'Email harus diisi', 'valid_email' => 'Email tidak valid'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi'));

        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(NULL, TRUE);
            $email = $this->security->xss_clean($post['email']);
            $password = $this->security->xss_clean($post['password']);

            $user = $this->model_user->get_user_by_email($email);
            if ($user) {
                if (password_verify($password, $user->password)) {
                    $user_data = array(
                        'user_id' => $user->user_id,
                        'level' => $user->level,
                    );
                    $this->session->set_userdata($user_data);

                    redirect('dashboard.html');
                } else {
                    $this->session->set_flashdata('error', 'Email atau password salah');
                    redirect('masuk.html');
                }
            } else {
                $this->session->set_flashdata('error', 'Email atau password salah');
                redirect('masuk.html');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('masuk.html');
        }
    }

    public function logout()
    {
        $user_id = $this->session->userdata('user_id');

        $params = array('user_id', 'level');
        $this->session->unset_userdata($params);

        // session_destroy();
        $this->session->set_flashdata('sukses', 'Sign Out Berhasil!');
        redirect('masuk.html');
    }
}
