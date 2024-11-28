<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!level('admin'))
			redirect('admin', 'refresh');

		$this->load->model('UserModel');
	}

	public function index()
	{
		$this->breadcrumbs->add('Dashboard', 'admin/dashboard');
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$data['userdata'] = $this->session->userdata('admin');
		
		$data['total_pelanggan'] = $this->UserModel->total();

		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer');
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
