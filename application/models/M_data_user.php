<?php 

class M_data_user extends CI_model {
	public function jumlahNotifMasuk($nik)
	{   
		$query = $this->db->get_where('tbl_memo', ['mm_status' => 1, 'mm_tujuan'=> $nik]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function isiNotifMasuk($nik)
	{
		$this->db->select('*');
		$this->db->from('tbl_memo');
		$this->db->join('tbl_user','tbl_memo.mm_pengirim=tbl_user.user_nik');
		$this->db->where('mm_tujuan', $nik);
		$this->db->where('mm_status', 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAllUser()
	{
		return $this->db->get('tbl_user')->result_array();
	}

	public function jumlahNotifUser()
	{
		$query = $this->db->get_where('tbl_user', ['user_is_active' => 0, 'user_role' => 0]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function tambahUser()
	{
		$data = [
			'user_nik' => htmlspecialchars($this->input->post('user_nik', true)),
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_no_telp' => htmlspecialchars($this->input->post('user_no_telp', true)),
			'user_email' => htmlspecialchars($this->input->post('user_email')),
			'user_password' => password_hash($this->input->post('user_password'), PASSWORD_DEFAULT),
			'user_role' => htmlspecialchars($this->input->post('user_role')),
			'user_bagian' => htmlspecialchars($this->input->post('user_bagian')),
			'user_is_active' => htmlspecialchars($this->input->post('user_is_active')),
			'user_date_created' => time()
		];

		$this->db->insert('tbl_user', $data);
	}

	public function getUserById($id)
	{
		return $this->db->get_where('tbl_user', ['user_id' => $id])->row_array();
	}

	public function ubahUser()
	{
		$data = [
			"user_role" => $this->input->post('user_role', true),
			"user_bagian" => $this->input->post('user_bagian', true),
			"user_is_active" => $this->input->post('user_is_active', true),
		];

		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->update('tbl_user', $data);
		
	}
}