<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'My Profil';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profil';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		$this->form_validation->set_rules('user_name', 'Full Name', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$user_id = $this->input->post('user_id');
			$user_nik = $this->input->post('user_nik');
			$user_name = $this->input->post('user_name');
			$user_no_telp = $this->input->post('user_no_telp');
			$user_email = $this->input->post('user_email');

			$dataa = array(
				'user_nik' => $user_nik,
				'user_name' => $user_name,
				'user_no_telp' => $user_no_telp,
				'user_email' => $user_email
			);
            // $this->db->set('name', $name);
			$this->db->where('user_id', $user_id);
			$this->db->update('tbl_user', $dataa);	
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
			redirect('user');
		}
		
	}

	public function changepassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');

			if (!password_verify($current_password, $data['user']['user_password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
				redirect('user/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect('user/changepassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$this->db->set('user_password', $password_hash);
					$this->db->where('user_id', $this->session->userdata('user_id'));
					$this->db->update('tbl_user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
					redirect('user/changepassword');
				}
			}
		}
		
	}

}