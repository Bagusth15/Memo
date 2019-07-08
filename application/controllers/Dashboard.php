<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dashboard');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];

		$data['data_userr'] = $this->M_dashboard->getAllUser();
		$data['notif_userr'] = $this->M_dashboard->jumlahNotifUser();

		$data['total_user'] = $this->M_dashboard->jumlahUser();
		$data['total_user_manager'] = $this->M_dashboard->jumlahUserManager();
		$data['total_user_direktur'] = $this->M_dashboard->jumlahUserDirektur();
		$data['total_user_staff'] = $this->M_dashboard->jumlahUserStaff();

		$data['total_memo'] = $this->M_dashboard->jumlahMemo();
		$data['total_memo_approved'] = $this->M_dashboard->jumlahMemoApproved($nik);
		$data['total_memo_not_approved'] = $this->M_dashboard->jumlahMemoNotApproved($nik);
		$data['total_memo_processed'] = $this->M_dashboard->jumlahMemoProcessed($nik);

		$data['total_memo_p'] = $this->M_dashboard->jumlahMemoP($nik);
		$data['total_memo_approved_p'] = $this->M_dashboard->jumlahMemoApprovedP($nik);
		$data['total_memo_not_approved_p'] = $this->M_dashboard->jumlahMemoNotApprovedP($nik);
		$data['total_memo_processed_p'] = $this->M_dashboard->jumlahMemoProcessedP($nik);

		$data['notif'] = $this->M_dashboard->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_dashboard->isiNotifMasuk($nik);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');
	}

}