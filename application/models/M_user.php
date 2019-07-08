<?php 

class M_user extends CI_model {

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
	
	public function jumlahUser()
	{   
		$query = $this->db->get('tbl_user');
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

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
}