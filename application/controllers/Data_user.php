<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_data_user');
		is_logged_in();
	}
	
	public function index()
	{
		$data['title'] = 'Data User';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];

		$data['data_user'] = $this->M_data_user->getAllUser();
		$data['data_userr'] = $this->M_data_user->getAllUser();
		$data['notif_userr'] = $this->M_data_user->jumlahNotifUser();
		
		$data['notif'] = $this->M_data_user->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_data_user->isiNotifMasuk($nik);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data_user/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Data User';
		$data['data_userr'] = $this->M_data_user->getAllUser();
		$data['notif_userr'] = $this->M_data_user->jumlahNotifUser();

		$this->form_validation->set_rules('user_nik','NIK','required|trim|is_unique[tbl_user.user_nik]', [
			'is_unique' => 'This nik has already registered'
		]);
		$this->form_validation->set_rules('user_name','Name','required|trim');
		$this->form_validation->set_rules('user_no_telp','No Telp','required|trim');
		$this->form_validation->set_rules('user_email','Email', 'required|trim|valid_email|is_unique[tbl_user.user_email]', [
			'is_unique' => 'This email has already registered'
		]);
		$this->form_validation->set_rules('user_password','Password','required|trim|min_length[3]', [
			'min_length' => 'Passsword to short'
		]);

		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];
		
		$data['data_user'] = $this->M_data_user->getAllUser();
		$data['notif'] = $this->M_data_user->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_data_user->isiNotifMasuk($nik);
		
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data_user/tambah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->M_data_user->tambahUser();
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">User success created!</div>');
			redirect('data_user');
		}
		
	}

	public function edit($id)
	{
		$data['title'] = 'Data User';
		$data['notif_userr'] = $this->M_data_user->jumlahNotifUser();
		
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$nik = $data['user']['user_nik'];
		$data['data_userr'] = $this->M_data_user->getAllUser();
		$data['data_user'] = $this->M_data_user->getUserById($id);

		$data['notif'] = $this->M_data_user->jumlahNotifMasuk($nik);
		$data['isi_notif'] = $this->M_data_user->isiNotifMasuk($nik);

		$this->form_validation->set_rules('user_role', 'Bagian', 'required');
		
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data_user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->M_data_user->ubahUser();
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">User success update!</div>');
			redirect('data_user');
		}
		
	}

	public function hapus($id)
	{
		$this->db->delete('tbl_user', ['user_id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">User success delete!</div>');
		redirect('data_user');
	}

}