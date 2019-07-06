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
		$data['title'] = 'User Management';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'User Management';
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

}