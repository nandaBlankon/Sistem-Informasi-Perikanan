<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_user', 'model_kapal', 'model_nelayan', 'model_tpi', 'model_ikan', 'model_peta', 'model_survei']);
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'peta'  => $this->db->query("SELECT * FROM peta_tb ORDER BY peta_id DESC LIMIT 1")->row(),
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

    public function survei()
    {
        $data = [
            'title' => 'Survei',
            'page'  => 'survei',
            'row'   => $this->model_survei->getPertanyaan(),
            'ships' => $this->model_kapal->get(),
            'act_survei'  => 'active'
        ];

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/survei_baru', $data);
        $this->load->view('templates/frontend/footer', $data);
    }

    public function proses()
    {
        $this->form_validation->set_rules('jawaban_isi[]', 'Jawaban', 'trim|required', array('required' => 'Pilih jawaban'));
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', array('required' => 'Bagian ini wajib diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Bagian ini wajib diisi'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required', array('required' => 'Bagian ini wajib diisi'));
        $this->form_validation->set_rules('kapal_id', 'Kapal', 'trim|required', array('required' => 'Bagian ini wajib dipilih'));

        $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

        if ($this->form_validation->run() == FALSE) {
            $this->survei();
        } else {
            // $nama = $this->input->post('nama');
            // $alamat = $this->input->post('alamat');
            // $email = $this->input->post('email');
            // $kapal = $this->input->post('kapal_id');
            // $pertanyaan_id = $this->input->post('pertanyaan_id');
            // $jawaban = $this->input->post('jawaban_isi');

            // // Simpan data responden ke dalam tabel Responden
            // $responden_data = array(
            //     'kapal_id' => $kapal,
            //     'nama' => $nama,
            //     'alamat' => $alamat,
            //     'email' => $email,
            //     // 'tanggal_survey' => date('Y-m-d')
            // );
            // $this->db->insert('responden_tb', $responden_data);
            // $responden_id = $this->db->insert_id();

            // // Simpan data jawaban ke dalam tabel Jawaban
            // $data = array();
            // for ($i = 0; $i < count($pertanyaan_id); $i++) {
            //     $data[] = array(
            //         'responden_id' => $responden_id,
            //         'pertanyaan_id' => $pertanyaan_id[$i],
            //         'jawaban_isi' => $jawaban[$i]
            //     );
            // }
            // $this->db->insert_batch('jawaban_tb', $data);
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $kapal = $this->input->post('kapal_id');
            $pertanyaan_id = $this->input->post('pertanyaan_id');
            $jawaban = $this->input->post('jawaban_isi');

            // Simpan data responden ke dalam tabel Responden
            $responden_data = array(
                'kapal_id' => $kapal,
                'nama' => $nama,
                'alamat' => $alamat,
                'email' => $email,
                // 'tanggal_survey' => date('Y-m-d')
            );
            $this->db->insert('responden_tb', $responden_data);
            $responden_id = $this->db->insert_id();

            // Simpan data jawaban ke dalam tabel Jawaban
            $data = array();
            for ($i = 0; $i < count($pertanyaan_id); $i++) {
                $jawaban_isi = $jawaban[$i];
                $bobot = $this->getBobotJawaban($jawaban_isi); // Mengambil bobot berdasarkan jawaban
                $data[] = array(
                    'responden_id' => $responden_id,
                    'pertanyaan_id' => $pertanyaan_id[$i],
                    'jawaban_isi' => $jawaban_isi,
                    'bobot' => $bobot
                );
            }
            $this->db->insert_batch('jawaban_tb', $data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata("sukses", "<small>Survei berhasil dikirim. Terima kasih sudah meluangkan waktu.</small>");
            }
            redirect('survei.html');
        }
    }

    // Fungsi untuk mendapatkan bobot berdasarkan jawaban
    private function getBobotJawaban($jawaban_isi)
    {
        // Definisikan bobot berdasarkan jawaban
        $bobot_jawaban = array(
            'SS' => 5, // Sangat Setuju
            'S' => 4, // Setuju
            'RR' => 3, // Ragu-Ragu
            'TS' => 2, // Tidak Setuju
            'STS' => 1 // Sangat Tidak Setuju
        );

        // Ambil bobot berdasarkan jawaban
        if (isset($bobot_jawaban[$jawaban_isi])) {
            return $bobot_jawaban[$jawaban_isi];
        } else {
            return 0; // Jika jawaban tidak valid, beri bobot 0
        }
    }

    public function kirim_survei()
    {
        $this->validation_for = 'add';
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('jawaban_isi[]', 'Jawaban', 'trim|required', array('required' => 'Pilih jawaban'));
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', array('required' => 'Bagian ini wajib diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Bagian ini wajib diisi'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required', array('required' => 'Bagian ini wajib diisi'));
        $this->form_validation->set_rules('kapal_id', 'Kapal', 'trim|required', array('required' => 'Bagian ini wajib dipilih'));

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'nama'          => form_error('nama'),
                'alamat'        => form_error('nama'),
                'email'         => form_error('email'),
                'kapal_id'      => form_error('kapal_id'),
                'jawaban_isi[]' => form_error('jawaban_isi[]'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = array(
                'pertanyaan_id' => $this->input->post('pertanyaan_id'),
                'pertanyaan_text' => $this->input->post('pertanyaan_text'),
            );

            $insert = $this->model_survei->save($insert);

            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
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
