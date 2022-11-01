<?php

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index() {
		$this->load->view('login/login_form');
	}

	public function signup_redirect() {
		$this->load->view('login/signup_form');
	}

	public function login_redirect() {
		$this->load->view('login/login_form');
	}

	public function signin() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username', 'Username', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->load->model('Login/AuthModel');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login/login_form');
		} else {
			$userDetails = $this->AuthModel->getUserByEmail($username);
			if ($userDetails != null) {
				if (password_verify($password, $userDetails->password)) {
					$this->session->set_userdata('user_id', $userDetails->user_id);
					$this->session->set_userdata('username', $userDetails->username);
					$this->session->set_userdata('logged_in', true);
//					redirect to home with base url
					$this->session->set_flashdata('success', 'Logged in successfully');
					redirect(base_url().'/home');
				} else {
					$this->session->set_flashdata('error', 'Invalid password');
					$this->load->view('login/login_form');
				}
			} else {
				$this->session->set_flashdata('error', 'Invalid username');
				$this->load->view('login/login_form');
			}
//			if ($login) {
//				$session_data = array(
//					'username' => $username,
//					'logged_in' => TRUE,
//				);
//				$this->session->set_userdata($session_data);
//				redirect('welcome');
//			} else {
//				$this->session->set_flashdata('error', 'Invalid Username or Password');
//				redirect('login');
//			}
		}

	}

	public function signup() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$name = $this->input->post('name');

		$this->form_validation->set_rules('username', 'Username', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');

		$this->load->model('Login/AuthModel');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login/signup_form');
		} else {
			$userDetails = $this->AuthModel->getUserByEmail($username);
			if ($userDetails != null) {
				$this->session->set_flashdata('error', 'User already exists');
				$this->load->view('login/signup_form');
			} else {
				$this->AuthModel->saveUser(array("email" => $username, "password" => $password, "name" => $name));
				$this->session->set_flashdata('success', 'User created successfully');
				$this->load->view('login/login_form');
			}
		}
	}

}
