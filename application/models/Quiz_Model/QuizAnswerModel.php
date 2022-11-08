<?php

class QuizAnswerModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	function insert_quiz_answer($quiz_question_id, $answer, $is_correct) {
		$sql = "INSERT INTO quiz_answer (quiz_question_id, description, is_correct) 
				VALUES (?, ?, ?, ?, ?);";
		$query = $this->db->query($sql, array($quiz_question_id, $answer, $is_correct));
		$result = $query->result();
		return $result;
	}

	function get_quiz_answers_by_quiz_id($id) {
		$sql = "SELECT quiz_answer_id, description, is_correct, quiz_question_id
				FROM quiz_answer 
				WHERE quiz_question_id IN (
					SELECT quiz_question_id FROM quiz_question WHERE quiz_id = ?
				) and archived = 0;";
		$query = $this->db->query($sql, array('quiz_id' => $id));
		return $query->result();
	}

	function validate_correct_quiz_answer($quiz_question_id, $quiz_answer_id) {
		$sql = "SELECT quiz_answer_id, description, is_correct, quiz_question_id
				FROM quiz_answer 
				WHERE quiz_question_id = ? and quiz_answer_id = ? and archived = 0;";
		$query = $this->db->query(
			$sql,
			array('quiz_question_id' => $quiz_question_id, 'quiz_answer_id' => $quiz_answer_id)
		);
		return $query->row();
	}

	function get_quiz_ans_by_quiz_questions_ids($ids) {
		$sql = "SELECT quiz_answer_id, description, is_correct, quiz_question_id
				FROM quiz_answer 
				WHERE quiz_question_id IN ? and archived = 0;";
		$query = $this->db->query($sql, array('quiz_question_id' => $ids));
		return $query->result();
	}

}
