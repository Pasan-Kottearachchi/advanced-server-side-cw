<?php

class QuizAttemptModel extends CI_Model
{
	function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	function insert_quiz_attempt($quiz_id, $user_id) {
		$this->db->insert('quiz_attempt', array("quiz_id" => $quiz_id, "attempted_by" => $user_id));
		return $this->db->insert_id();
	}

}
