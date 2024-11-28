<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_role !=', 'Superadmin'); // Gunakan format ini

		return $this->db->get()->result_array();
	}
	public function getPelanggan()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_role', 'Pelanggan');

		return $this->db->get()->result_array();
	}

	
	public function getById($id)
	{
		return $this->db->where('user_id', $id)->get('users')->row_array();
	}

	public function total()
	{
		$this->db->select('COUNT(*) as data_pelanggan');
		$this->db->from('users');
		$this->db->where('user_role','pelanggan');
		
		$query = $this->db->get();
		return $query->row_array();
	}

	function create($formulir)
	{
		unset($formulir['password_confirmation']);
		$formulir['user_password'] = sha1($formulir['user_password']);
		
		$this->db->insert('users', $formulir);
	}

    public function update($id, $formulir)
    {
        $this->db->where('user_id', $id)->update('users', $formulir);
    }

    function delete($id)
    {
        $this->db->where('user_id', $id)->delete('users');
        return 'success';
    }
}

/* End of file satuanArtikelModel.php */
/* Location: ./application/models/satuanArtikelModel.php */
