<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memo extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_memo');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Memo Management';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$data['memo'] = $this->M_memo->getMemoJoin();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('memo/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Memo Management';
		$this->form_validation->set_rules('mm_no', 'Memo No', 'required');
		$this->form_validation->set_rules('mm_pengirim', 'Pengirim', 'required');
		$this->form_validation->set_rules('mm_tujuan', 'Tujuan', 'required');
		$this->form_validation->set_rules('mm_perihal', 'Perihal', 'required');
		$this->form_validation->set_rules('mm_isi', 'Isi', 'required');
		$this->form_validation->set_rules('mm_note', 'Note', 'required');

		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();

		$data['user_role_m'] = $this->M_memo->userRole();

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('memo/tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->M_memo->tambahMemo();
			redirect('memo');
		}
	}

	public function hapus($id)
	{
		$this->M_memo->hapusMemo($id);
		redirect('memo');
	}

	public function detail($id)
	{
		$data['title'] = 'Memo Management';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$data['memo'] = $this->M_memo->getMemoById($id);
		$data['memo_pengirim'] = $this->M_memo->getMemoPengirim($id);
		$data['memo_penerima'] = $this->M_memo->getMemoPenerima($id);
		$data['user_role_m'] = $this->M_memo->userRole();
		$data['user_role_d'] = $this->M_memo->userRoled();
		$data['memo_a'] = $this->M_memo->getMemoActivityJoin();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('memo/detail', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$data['title'] = 'Memo Management';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$data['memo'] = $this->M_memo->getMemoById($id);
		$data['memo_penerima'] = $this->M_memo->getMemoPenerima($id);
		$data['user_role_m'] = $this->M_memo->userRole();

		$this->form_validation->set_rules('mm_no', 'Memo No', 'required');
		$this->form_validation->set_rules('mm_tujuan', 'Tujuan', 'required');
		$this->form_validation->set_rules('mm_perihal', 'Perihal', 'required');
		$this->form_validation->set_rules('mm_isi', 'Isi', 'required');
		$this->form_validation->set_rules('mm_note', 'Note', 'required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('memo/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->M_memo->ubahMemo();
			redirect('memo');
		}
		
	}

	public function pertimbangan()
	{
		$this->M_memo->pertimbanganMemo();
		redirect('memo');	
	}

	public function approved_m()
	{
		$this->M_memo->approvedMemo_M();
		redirect('memo');	
	}

	public function not_approved()
	{
		$this->M_memo->notapprovedMemo();
		redirect('memo');	
	}

}