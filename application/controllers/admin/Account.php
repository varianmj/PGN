<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdministratorModel');
	}

	public function index()
	{
		if (level('admin'))
			redirect('admin/dashboard', 'refresh');
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','Password','required');
		
		if ($this->form_validation->run()) {
			$formulir = $this->input->post();
			
			$validasi = $this->AdministratorModel->validasi($formulir);
			if ($validasi == 'gagal') {
				$this->session->set_flashdata('pesan', 'username atau password tidak valid,mohon periksa kembali!');
				redirect('admin', 'refresh');
			}

			redirect('admin/dashboard', 'refresh');
		}

		$this->load->view('admin/login');
	}

	public function profil()
	{
		if (!level('admin'))
			redirect('admin', 'refresh');
		
		$data['userdata'] = $this->session->userdata('admin');
		$id = $data['userdata']['user_id'];
		$data['profile'] = $this->AdministratorModel->getDetail($id);

		$this->load->view('admin/header');
		$this->load->view('admin/profil', $data);
		$this->load->view('admin/footer');
	}

	public function ubah()
	{
		$data['userdata'] = $this->session->userdata('admin');
		$id = $data['userdata']['user_id'];

		$this->form_validation->set_rules('user_username', 'user_username', 'required');
		
		if ($this->form_validation->run()) {
				$config['upload_path']      = FCPATH.'assets/admin/img/';
				$config['allowed_types']    = 'jpeg|jpg|png';
				$config['detect_mime']      = true;
	
				$this->upload->initialize($config);

				if ($this->upload->do_upload('file')){
					$name = $this->upload->data('file_name');
					$data = array(
						"user_username" => $this->input->post('user_username'),
						"user_email" => $this->input->post('email'),
						"user_fullname" => $this->input->post('nama_lengkap'),
						"user_image_url" => $name,
					);
				} else {
					$data = array(
						"user_username" => $this->input->post('user_username'),
						"user_email" => $this->input->post('email'),
						"user_fullname" => $this->input->post('nama_lengkap'),
					);
				}

				$this->AdministratorModel->update($id, $data);
				$this->session->set_flashdata('pesan', 'Profil berhasil diubah!');
				$this->session->set_userdata('admin', $this->AdministratorModel->getDetail($id));
	
            $pesan = ['status' => 'success'];
		} else {
			$pesan = ['status' => 'error', 'validation' => $this->form_validation->error_array()];
		}

		echo json_encode($pesan);
	}

	public function ubahPassword()
	{
			$data['userdata'] = $this->session->userdata('admin');
			$id = $data['userdata']['user_id'];
			
			$this->form_validation->set_rules('old_password', 'password lama', 'required');
			$this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
			$this->form_validation->set_rules('password_confirmation', 'password Konfimasi', 'matches[new_password]');

			if ($this->form_validation->run()) {

				$validasiOldPassword = $this->AdministratorModel->validasiOldPassword($id,$this->input->post());

				if ($validasiOldPassword == 'gagal') {
					$msg = array(
						"old_password" =>  "Password lama salah",
					);
					$pesan = ['status' => 'error', 'validation' => $msg];
				} else {
					$this->AdministratorModel->updatePassword($id, $this->input->post());
					$this->session->set_flashdata('pesan', 'password berhasil diubah!');
					$pesan = ['status' => 'success'];
				}

	
		} else {
			$pesan = ['status' => 'error', 'validation' => $this->form_validation->error_array()];
		}

		echo json_encode($pesan);
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin', 'refresh');
	}

}

/* End of file Account.php */
/* Location: ./application/controllers/admin/Account.php */
