<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memo extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_memo');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Memo Management';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];

		$data['data_userr'] = $this->M_memo->getAllUser();
		$data['notif_userr'] = $this->M_memo->jumlahNotifUser();

		$data['memo'] = $this->M_memo->getMemoJoin();
		$data['notif'] = $this->M_memo->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_memo->isiNotifMasuk($nik);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('memo/index', $data);
		$this->load->view('templates/footer');
	}

	public function finish_processed()
	{
		$data['title'] = 'Memo Management';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];

		$data['data_userr'] = $this->M_memo->getAllUser();
		$data['notif_userr'] = $this->M_memo->jumlahNotifUser();

		$data['memo'] = $this->M_memo->getMemoJoin();
		$data['notif'] = $this->M_memo->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_memo->isiNotifMasuk($nik);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('memo/finish-processed', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Memo Management';
		$data['data_userr'] = $this->M_memo->getAllUser();
		$data['notif_userr'] = $this->M_memo->jumlahNotifUser();

		$this->form_validation->set_rules('mm_pengirim', 'Pengirim', 'required');
		$this->form_validation->set_rules('mm_tujuan', 'Tujuan', 'required');
		$this->form_validation->set_rules('mm_perihal', 'Perihal', 'required');
		$this->form_validation->set_rules('mm_isi', 'Isi', 'required');
		$this->form_validation->set_rules('mm_note', 'Note', 'required');

		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];

		$data['user_role_m'] = $this->M_memo->userRole();
		$data['user_role_d'] = $this->M_memo->userRoled();
		$data['notif'] = $this->M_memo->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_memo->isiNotifMasuk($nik);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('memo/tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->M_memo->tambahMemo();
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Memo success created!</div>');
			redirect('memo');
		}
	}

	public function hapus($id)
	{
		$this->M_memo->hapusMemo($id);
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Memo success delete!</div>');
		redirect('memo');
	}

	public function detail($id)
	{
		$data['title'] = 'Memo Management';
		$data['data_userr'] = $this->M_memo->getAllUser();
		$data['notif_userr'] = $this->M_memo->jumlahNotifUser();

		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];

		$data['memo'] = $this->M_memo->getMemoById($id);
		$data['memo_pengirim'] = $this->M_memo->getMemoPengirim($id);
		$data['memo_penerima'] = $this->M_memo->getMemoPenerima($id);
		$data['user_role_m'] = $this->M_memo->userRole();
		$data['user_role_d'] = $this->M_memo->userRoled();
		$data['memo_a'] = $this->M_memo->getMemoActivityJoin();
		$data['notif'] = $this->M_memo->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_memo->isiNotifMasuk($nik);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('memo/detail', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$data['title'] = 'Memo Management';
		$data['data_userr'] = $this->M_memo->getAllUser();
		$data['notif_userr'] = $this->M_memo->jumlahNotifUser();
		
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];
		
		$data['memo'] = $this->M_memo->getMemoById($id);
		$data['memo_penerima'] = $this->M_memo->getMemoPenerima($id);
		$data['user_role_m'] = $this->M_memo->userRole();
		$data['user_role_d'] = $this->M_memo->userRoled();
		$data['notif'] = $this->M_memo->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_memo->isiNotifMasuk($nik);

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
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Memo success update!</div>');
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