<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministratorModel extends CI_Model {

	function validasi($formulir)
	{
		$username		= $formulir['username'];
		$password	= sha1($formulir['password']);

		$data = $this->db->where('user_username', $username)
						->where('user_password', $password)
						->where_in('user_role', ['Superadmin', 'Operator'])
						->get('users')->row_array();

		if (empty($data))
			return 'gagal';

		unset($data['password']);

		$this->session->set_userdata('admin', $data);
		return 'sukses';
	}

	function validasiOldPassword($id, $formulir)
	{
		$password	= sha1($formulir['old_password']);

		$data = $this->db->where('user_id', $id)->where('user_password', $password)->get('users')->row_array();

		if (empty($data))
			return 'gagal';

		return 'sukses';
	}

	function update($id, $formulir)
	{
		$this->db->where('user_id', $id)->update('users', $formulir);
	}

	function updatePassword($id, $formulir)
	{
		unset($formulir['old_password']);
		unset($formulir['password_confirmation']);
		$formulir['user_password'] = sha1($formulir['new_password']);
		unset($formulir['new_password']);

		$this->db->where('user_id', $id)->update('users', $formulir);
	}

	function getDetail($id)
	{
		return $this->db->select('u.*')
				->from('users u')
				->where('u.user_id', $id)
				->get()->row_array();
	}

	function create($formulir)
	{
		unset($formulir['password_confirmation']);
		$formulir['administrator_password'] = sha1($formulir['administrator_password']);
		$this->db->insert('administrator', $formulir);
	}

}

/* End of file AdministratorModel.php */
/* Location: ./application/models/AdministratorModel.php */
