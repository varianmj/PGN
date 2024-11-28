<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!level('admin'))
			redirect('admin', 'refresh');

		$this->load->model('UserModel');
	}

	public function index()
	{
		$this->breadcrumbs->add('Master', 'admin/konten');
		$this->breadcrumbs->add('user', 'admin/konten/user');
		$header['breadcrumbs'] = $this->breadcrumbs->show();

		$data['user'] = $this->UserModel->getAll();

		$this->load->view('admin/header', $header);
		$this->load->view('admin/user', $data);
		$this->load->view('admin/footer');
	}

	public function tambah()
	{
		$formulir	= $this->input->post();
		$this->form_validation->set_rules('user_username', 'username user', 'required|is_unique[users.user_username]');
        $this->form_validation->set_rules('user_role', 'role user', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required|min_length[6]');

		if($formulir['user_role'] == "Admin"){
			$this->form_validation->set_rules('user_instansi_id', 'instansi user', 'required');
		}

        if ($this->form_validation->run()) {
            $this->UserModel->create($this->input->post());

            $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
            $pesan = ['status' => 'success'];
        } else {
            $pesan = ['status' => 'error', 'validation' => $this->form_validation->error_array()];
        }

        echo json_encode($pesan);
	}

	public function ubah()
	{
		$formulir	= $this->input->post();
		$data		= $this->UserModel->getById($formulir['user_id']);

		$namaUnique = $formulir['user_username'] == $data['user_username'] ? '' : '|is_unique[users.user_username]';

		$this->form_validation->set_rules('user_username', 'Nama user', 'required'.$namaUnique);
		$this->form_validation->set_rules('user_role', 'role user', 'required');
		
		if(isset($formulir['user_password'])){
			$this->form_validation->set_rules('user_password', 'Password user', 'min_length[6]');
			$this->form_validation->set_rules('password_confirmation', 'Password Konfirmasi', 'required|min_length[6]|matches[user_password]');
		}

		if ($this->form_validation->run()) {
			$data = [
				'user_id' => $this->input->post('user_id'),
				'user_name' => $this->input->post('user_name'),
				'user_deskripsi' => $this->input->post('user_deskripsi')
			];
			
			$this->UserModel->update($formulir['user_id'], $data);

			$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
			$pesan = ['status' => 'success'];
		} else {
			$pesan = ['status' => 'error', 'validation' => $this->form_validation->error_array()];
		}

		echo json_encode($pesan);
	}

	public function detail()
	{
		echo json_encode($this->UserModel->getById($this->input->post('user_id')));
	}

	public function hapus($id)
	{
		$status = $this->UserModel->delete($id);
		if ($status == 'success') {
			$this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
		} else {
			$this->session->set_flashdata('pesan', 'Data gagal dihapus. Berkaitan dengan data lainnya!');
		}

		redirect('admin/master/user', 'refresh');
	}

}

/* End of file Artikel.php */
/* Location: ./application/controllers/admin/Artikel.php */