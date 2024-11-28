<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemakaian extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!level('admin'))
			redirect('admin', 'refresh');

		$this->load->model('PemakaianModel');
		$this->load->model('UserModel');
	}

	public function index()
	{
		$this->breadcrumbs->add('Master', 'admin/konten');
		$this->breadcrumbs->add('user', 'admin/konten/user');
		$header['breadcrumbs'] = $this->breadcrumbs->show();

		$data['user'] = $this->PemakaianModel->getAll();

		$this->load->view('admin/header', $header);
		$this->load->view('admin/pemakaian', $data);
		$this->load->view('admin/footer');
	}

	public function tambah()
	{
		$formulir	= $this->input->post();
		$this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('volume', 'volume', 'required');

        if ($this->form_validation->run()) {
            $this->PemakaianModel->create($this->input->post());

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
		$data		= $this->PemakaianModel->getById($formulir['user_id']);

		$this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('volume', 'volume', 'required');
		
		if ($this->form_validation->run()) {
			$data = [
				'id' => $this->input->post('id'),
				'user_id' => $this->input->post('user_id'),
				'volume' => $this->input->post('volume'),
			];
			
			$this->PemakaianModel->update($formulir['id'], $data);

			$this->session->set_flashdata('pesan', 'Data berhasil diubah!');
			$pesan = ['status' => 'success'];
		} else {
			$pesan = ['status' => 'error', 'validation' => $this->form_validation->error_array()];
		}

		echo json_encode($pesan);
	}

	public function detail()
	{
		echo json_encode($this->PemakaianModel->getById($this->input->post('user_id')));
	}

	public function hapus($id)
	{
		$status = $this->PemakaianModel->delete($id);
		if ($status == 'success') {
			$this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
		} else {
			$this->session->set_flashdata('pesan', 'Data gagal dihapus. Berkaitan dengan data lainnya!');
		}

		redirect('admin/master/user', 'refresh');
	}

	function getPelanggan()
	{
		$data = $this->UserModel->getPelanggan();

		$result = array(
			"code" => "200",
			"message" => "Ambil Data berhasil",
			"results"  => $data,
		);

		echo $this->respon->createRespon($result['code'], $result['message'], $result['results']);
	}

}

/* End of file Artikel.php */
/* Location: ./application/controllers/admin/Artikel.php */
