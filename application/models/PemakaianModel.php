<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianModel extends CI_Model {
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('pemakaian');
		$this->db->join('users', 'users.user_id = pemakaian.user_id');

		return $this->db->get()->result_array();
	}

	
	public function getById($id)
	{
		return $this->db
			->join('users', 'users.user_id = pemakaian.user_id')
			->where('pemakaian.id', $id)
			->get('pemakaian')
			->row_array();

	}

	public function total()
	{
		$this->db->select('COUNT(*) as data_pelanggan');
		$this->db->from('pemakaian');
		$this->db->where('user_role','pelanggan');
		
		$query = $this->db->get();
		return $query->row_array();
	}

	function create($formulir)
	{
		// unset($formulir['password_confirmation']);
		// $formulir['user_password'] = sha1($formulir['user_password']);
		
		$this->db->insert('pemakaian', $formulir);
	}

    public function update($id, $formulir)
    {
        $this->db->where('id', $id)->update('pemakaian', $formulir);
    }

    function delete($id)
    {
        $this->db->where('user_id', $id)->delete('pemakaian');
        return 'success';
    }
}

/* End of file satuanArtikelModel.php */
/* Location: ./application/models/satuanArtikelModel.php */
