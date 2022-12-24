<?php

class UserModel extends CI_Model {
	public function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	public function getUserDetailsByUserId($userId) {
		$sql = "SELECT user_id, username, name
				FROM user 
				WHERE user_id = ? and archived = 0;";
		$query = $this->db->query($sql, array('user_id' => $userId));
		return $query->row();
	}

	public function updateUserName($userId, $name) {
		$sql = " UPDATE user
				 SET name = ?
				 WHERE user_id = ?; ";
		$this->db->query($sql, array('name' => $name, 'user_id' => $userId));
	}

}
