<?php

class QuizStatModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	function insert_attempt_question($data) {
		$this->db->insert('attempt_question', $data);
	}

	function get_quiz_attempt_by_id($id) {
		$query = $this->db->get_where('quiz_attempt', array('quiz_attempt_id' => $id));
		return $query->row();
	}

//	can be shown in Manage Quiz Screen
	function get_quiz_attempts_by_quiz_id($id) {
		$query = $this->db->get_where('quiz_attempt', array('quiz_id' => $id));
		return $query->result();
	}

//	can be shown in User Profile Screen
	function get_quiz_attempts_by_user_id($id) {
		$query = $this->db->get_where('quiz_attempt', array('user_id' => $id));
		return $query->result();
	}

//	Get correctly answered percentage for a given quiz
	function get_quiz_correctly_answered_percentage($quiz_id) {
		$sql = "SELECT 
				  quiz_attempt.quiz_id, 
				  quiz_attempt.quiz_attempt_id, 
				  quiz_attempt.attempted_by, 
				  quiz_attempt.completed_time, 
				  (
					SELECT 
					  Count(*) 
					FROM 
					  attempt_question 
					WHERE 
					  quiz_attempt_id = quiz_attempt.quiz_attempt_id
				  ) AS total_questions, 
				  (
					SELECT 
					  Count(*) 
					FROM 
					  attempt_question 
					  LEFT JOIN quiz_answer ON attempt_question.quiz_answer_id = quiz_answer.quiz_answer_id 
					  AND quiz_answer.is_correct = 1 
					WHERE 
					  quiz_attempt_id = quiz_attempt.quiz_attempt_id 
					  AND quiz_answer.is_correct = 1
				  ) AS correctly_answered 
				FROM quiz_attempt 
				WHERE quiz_id = ?;";
		$query = $this->db->query($sql, array('quiz_id' => $quiz_id));
		return $query->result();
	}

	// Insert or update on conflict with quiz id quiz stats to database
	function insert_quiz_stats($quiz_id, $correct_ans_count, $total_ans_count){
		$sql = "INSERT INTO quiz_stats 
    			(quiz_id, correct_answers, total_answers) 
				VALUES (?, ?, ?) 
				ON DUPLICATE KEY UPDATE correct_answers = ?, total_answers = ?;";
		$this->db->query(
			$sql,
			array($quiz_id, $correct_ans_count, $total_ans_count, $correct_ans_count, $total_ans_count)
		);
	}

}
