<?php 

class M_dashboard extends CI_model {

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

	public function jumlahUserManager()
	{   
		$status='Manager';
		$options=array('user_role'=>$status);
		$query =  $this->db->get_where('tbl_user',$options);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahUserDirektur()
	{   
		$status='Direktur';
		$options=array('user_role'=>$status);
		$query =  $this->db->get_where('tbl_user',$options);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}
	public function jumlahUserStaff()
	{   
		$status='Staff';
		$options=array('user_role'=>$status);
		$query =  $this->db->get_where('tbl_user',$options);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemo()
	{   
		$query = $this->db->get('tbl_memo');
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemoP($nik)
	{   
		$query = $this->db->get_where('tbl_memo', ['mm_pengirim'=> $nik]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemoApproved($nik)
	{   
		
		$query = $this->db->get_where('tbl_memo', ['mm_status' => 2, 'mm_tujuan'=> $nik]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemoNotApproved($nik)
	{   
		
		$query = $this->db->get_where('tbl_memo', ['mm_status' => 3, 'mm_tujuan'=> $nik]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemoProcessed($nik)
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

	public function jumlahMemoApprovedP($nik)
	{   
		
		$query = $this->db->get_where('tbl_memo', ['mm_status' => 2, 'mm_pengirim'=> $nik]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemoNotApprovedP($nik)
	{   
		
		$query = $this->db->get_where('tbl_memo', ['mm_status' => 3, 'mm_pengirim'=> $nik]);
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function jumlahMemoProcessedP($nik)
	{   
		$query = $this->db->get_where('tbl_memo', ['mm_status' => 1, 'mm_pengirim'=> $nik]);
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