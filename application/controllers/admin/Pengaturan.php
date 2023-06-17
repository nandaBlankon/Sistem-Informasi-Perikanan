<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['model_user', 'model_pengaturan']);
	}

	public function profil()
	{
		check_not_login();
		$id = $this->fungsi->user_login()->user_id;
		$data['title']      	= 'Akun';
		$data['page']			= 'edit';
		$data['profil']			= $this->model_user->get($id)->row();
		$data['act_profil']    	= 'active';
		$this->load->view('templates/backend/header', $data);
		$this->load->view('templates/backend/sidebar', $data);
		$this->load->view('admin/profil', $data);
		$this->load->view('templates/backend/footer', $data);
	}

	public function profil_update()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validateprofil();

		if ($this->form_validation->run() == FALSE) {
			$errors = array(
				'username'  		=> form_error('email'),
				'level'  			=> form_error('level'),
			);

			$data = array(
				'status'         => FALSE,
				'errors'         => $errors
			);

			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$update = array(
				'username'  		=> $this->input->post('email'),
				'level'				=> $this->input->post('level'),
			);

			$this->model_user->profil_update(array('user_id' => $this->input->post('user_id')), $update);
			$data['status'] = TRUE;
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	private function _validateprofil()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('level', 'Level hak akses', 'required', array('required' => '%s harus dipilih.'));

		$email_unique = '';
		$getData = $this->model_user->get($this->input->post('user_id'))->row();

		if ($this->fungsi->user_login()->level == 1) :
			if ($this->input->post('email') != $getData->username) {
				// jika id yang diedit tidak sama dengan id yang memiliki email yang ingin diubah,
				// maka lakukan validasi is_unique
				$email_unique = '|is_unique[tb_user.username]';
			}
		endif;

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' . $email_unique, array('required' => '%s tidak boleh kosong', 'valid_email' => '%s tidak valid', 'is_unique' => '%s sudah digunakan'));
	}
}
