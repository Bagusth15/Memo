<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('user_id')) {
			redirect('user');
		}

		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// validasi success
			$this->_login();
		}
		
	}

	private function _login()
	{
		$email = $this->input->post('user_email');
		$password = $this->input->post('user_password');

		$user = $this->db->get_where('tbl_user', ['user_email' => $email])->row_array();

        // jika usernya ada
		if ($user) {
            // jika usernya aktif
			if ($user['user_is_active'] == 1) {
                // cek password
				if (password_verify($password, $user['user_password'])) {
					$data = [
						'user_id' => $user['user_id'],
						'user_role_id' => $user['user_role_id']
					];
					$this->session->set_userdata($data);
					redirect('user');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'memo.in.aja@gmail.com',
            'smtp_pass' => 'Memo050798',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('memo.in.aja@gmail.com', 'Web Memo');
        $this->email->to($this->input->post('user_email'));

        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('user_email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

	public function registration()
	{
		if ($this->session->userdata('user_id')) {
			redirect('user');
		}

		$this->form_validation->set_rules('user_nik','NIK','required|trim|is_unique[tbl_user.user_nik]', [
			'is_unique' => 'This nik has already registered'
		]);
		$this->form_validation->set_rules('user_name','Name','required|trim');
		$this->form_validation->set_rules('user_no_telp','No Telp','required|trim');
		$this->form_validation->set_rules('user_email','Email', 'required|trim|valid_email|is_unique[tbl_user.user_email]', [
			'is_unique' => 'This email has already registered'
		]);
		$this->form_validation->set_rules('user_password1','Password','required|trim|min_length[3]|matches[user_password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Passsword to short'
		]);
		$this->form_validation->set_rules('user_password2','Password','required|trim|matches[user_password1]');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'user_nik' => htmlspecialchars($this->input->post('user_nik', true)),
				'user_name' => htmlspecialchars($this->input->post('user_name', true)),
				'user_no_telp' => htmlspecialchars($this->input->post('user_no_telp', true)),
				'user_email' => htmlspecialchars($this->input->post('user_email')),
				'user_password' => password_hash($this->input->post('user_password1'), PASSWORD_DEFAULT),
				'user_role' => 'Staff',
				'user_is_active' => 1,
				'user_date_created' => time()
			];
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! your account has been created. Please Login!</div>');
			$this->db->insert('tbl_user', $data);
			redirect('auth');
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You have been logged out!</div>');
		redirect('Auth');
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('user_email');
			$user = $this->db->get_where('tbl_user', ['user_email' => $email, 'user_is_active' => 1])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'ut_email' =>$email,
					'ut_token' => $token,
					'ut_date_created' => time()
				];
				$this->db->insert('tbl_user_token', $user_token);
				$this->_sendEmail($token, 'forgot');


				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
				redirect('Auth/forgotPassword');


			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
				redirect('Auth/forgotPassword');
			}
		}
	}	

	public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_user', ['user_email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tbl_user_token', ['ut_token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('user_password', $password);
            $this->db->where('user_email', $email);
            $this->db->update('tbl_user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('tbl_user_token', ['ut_email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }
}
