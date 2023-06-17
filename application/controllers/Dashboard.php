<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(['model_user', 'model_kapal', 'model_nelayan', 'model_tpi', 'model_ikan', 'model_peta']);
		check_not_login();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['kapal']	= $this->model_kapal->get();
		$data['nelayan']	= $this->model_nelayan->get();
		$data['tpi']	= $this->model_tpi->get();
		$data['ikan']	= $this->model_ikan->get();
		$data['peta']	= $this->model_peta->get();
		$data['act_dashboard'] = 'active';

		$this->load->view('templates/backend/header', $data);
		$this->load->view('templates/backend/sidebar', $data);
		$this->load->view('pages/dashboard', $data);
		$this->load->view('templates/backend/footer', $data);
	}
}
