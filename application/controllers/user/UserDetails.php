<?php

class UserDetails extends CI_Controller {
	public function index($id) {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->getUserDetailsByUserId($id);
	}

	public function getUserDetailsByUserId($userId){
		$this->load->model('User_Model/UserModel');
		$this->load->model('Quiz_Model/QuizModel');
		$userDetails = $this->UserModel->getUserDetailsByUserId($userId);
		$createdQuizCount = $this->QuizModel->getUserCreatedQuizCount($userId);
		$participatedQuizCount = $this->QuizModel->getUserParticipatedTotalQuizCount($userId);
		$attemptedQuizCount = $this->QuizModel->getUserAttemptedQuizCount($userId);

		$response = array();
		$response['userDetails'] = $userDetails;
		$response['userStats'] = array(
			"createdQuizCount"=>$createdQuizCount->count,
			"participatedQuizCount"=>$participatedQuizCount->count,
			"attemptedQuizCount"=>$attemptedQuizCount->count
		);
		$this->load->view('navigation/navbar');
		$this->load->view('profile/user_profile', array("data"=>$response));
	}

	public function update($userId){
		$this->load->model('User_Model/UserModel');
		$formValues = $this->input->post('userData');
		$name = $formValues['name'];
		$this->UserModel->updateUserName(intval($userId), $name);
		$this->session->set_userdata('name', $name);
//		redirect(base_url('profile/'.$userId));
		$data = array(
			'status' => 'success',
		);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));


	}

}
