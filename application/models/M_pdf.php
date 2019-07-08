<?php 

class M_pdf extends CI_model {

	public function getAllMemo()
	{
		return $this->db->get('tbl_memo')->result_array();
	}

	public function getMemoJoin() 
	{
		$this->db->select('*');
		$this->db->from('tbl_memo');
		$this->db->join('tbl_user','tbl_memo.mm_tujuan=tbl_user.user_nik');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getMemoActivityJoin() 
	{
		$this->db->select('*');
		$this->db->from('tbl_memo_activity');
		$this->db->join('tbl_memo','tbl_memo_activity.ma_mm_id=tbl_memo.mm_id');
		$this->db->join('tbl_user','tbl_memo_activity.ma_by=tbl_user.user_nik');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function userRole()
	{
		$status='Manager';
		$options=array('user_role'=>$status);
		$query =  $this->db->get_where('tbl_user',$options);
		return $query->result_array();
	}

	public function userRoled()
	{
		$status='Direktur';
		$options=array('user_role'=>$status);
		$query =  $this->db->get_where('tbl_user',$options);
		return $query->result_array();
	}

	public function tambahMemo()
	{
		$data = [
			"mm_no" => $this->input->post('mm_no', true),
			"mm_pengirim" => $this->input->post('mm_pengirim', true),
			"mm_tujuan" => $this->input->post('mm_tujuan', true),
			"mm_perihal" => $this->input->post('mm_perihal', true),
			"mm_isi" => $this->input->post('mm_isi', true),
			"mm_note" => $this->input->post('mm_note', true),
			"mm_tgl_buat" => time(),
			"mm_status" => 1
		];

		$this->db->insert('tbl_memo', $data);
	}

	public function getMemoById($id)
	{
		return $this->db->get_where('tbl_memo', ['mm_id' => $id])->row_array();
	}

	public function getMemoPengirim($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_memo');
		$this->db->join('tbl_user','tbl_memo.mm_pengirim=tbl_user.user_nik');
		$this->db->where('mm_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getMemoPenerima($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_memo');
		$this->db->join('tbl_user','tbl_memo.mm_tujuan=tbl_user.user_nik');
		$this->db->where('mm_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function ubahMemo()
	{
		$data = [
			"mm_no" => $this->input->post('mm_no', true),
			"mm_tujuan" => $this->input->post('mm_tujuan', true),
			"mm_perihal" => $this->input->post('mm_perihal', true),
			"mm_isi" => $this->input->post('mm_isi', true),
			"mm_note" => $this->input->post('mm_note', true),
		];

		$this->db->where('mm_id', $this->input->post('mm_id'));
		$this->db->update('tbl_memo', $data);
	}

	public function pertimbanganMemo()
	{
		$data = [
			"mm_tujuan" => $this->input->post('mm_tujuan', true)
		];

		$this->db->where('mm_id', $this->input->post('mm_id'));
		$this->db->update('tbl_memo', $data);
	}
	
	public function approvedMemo_M()
	{
		$data_i = [
			"ma_mm_id" => $this->input->post('mm_id', true),
			"ma_by" => $this->input->post('mm_tujuan_l', true),
			"ma_date" => time(),
			"ma_status" => 2
		];
		$this->db->insert('tbl_memo_activity', $data_i);

		$data = [
			"mm_tujuan" => $this->input->post('mm_tujuan', true)
		];
		$this->db->where('mm_id', $this->input->post('mm_id'));
		$this->db->update('tbl_memo', $data);
	}

	public function notapprovedMemo()
	{
		$data_i = [
			"ma_mm_id" => $this->input->post('mm_id', true),
			"ma_by" => $this->input->post('mm_tujuan_l', true),
			"ma_date" => time(),
			"ma_status" => 3
		];
		$this->db->insert('tbl_memo_activity', $data_i);

		$data = [
			"mm_note" => $this->input->post('mm_note', true),
			"mm_status" => 3
		];

		$this->db->where('mm_id', $this->input->post('mm_id'));
		$this->db->update('tbl_memo', $data);
	}

	public function hapusMemo($id)
	{
		$this->db->delete('tbl_memo', ['mm_id' => $id]);
		$this->db->delete('tbl_memo_activity', ['ma_mm_id' => $id]);
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

}