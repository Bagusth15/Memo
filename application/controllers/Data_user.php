<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller 
{
	public function index()
	{
		$data['title'] = 'Data User';
		$data['user'] = $this->db->get_where('tbl_user', ['user_id' => $this->session->userdata('user_id')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data_user/index', $data);
		$this->load->view('templates/footer');
	}

}