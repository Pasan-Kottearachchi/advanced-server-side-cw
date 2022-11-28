<?php

class AuthModel extends CI_Model {

	public function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	public function getUserByEmail($email) {
		$sql = "SELECT user_id, username, password, name
				FROM user 
				WHERE username = ? and archived = 0;";
		$query = $this->db->query($sql, array('email' => $email));
		return $query->row();
	}

	public function saveUser($data) {
		$hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);
		$this->db->insert(
			'user',
			array("username" => $data['email'], "password" => $hashed_password, "name" => $data['name'])
		);
	}

	public function authenticateUser($username, $password) {
		$userDetails = $this->getUserByEmail($username);
		if ($userDetails != null) {
			if (password_verify($password, $userDetails->password)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

}
