<?php

class QuizQuestionModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	function insert_quiz_question($quiz_id, $question, $question_order) {
		$sql = "INSERT INTO quiz_question (quiz_id, description, question_order) 
				VALUES (?, ?, ?);";
		$query = $this->db->query($sql, array($quiz_id, $question, $question_order));
		$result =  $this->db->insert_id();;
		return $result;
	}

	function insert_quiz_question_answer( $question_id, $answer, $correct) {
		$answer_correct = $correct ? 1 : 0;
		$sql = "INSERT INTO quiz_answer (quiz_question_id, description, is_correct) 
				VALUES (?, ?, ?);";
		$this->db->query($sql, array($question_id, $answer, $answer_correct));
		$result =  $this->db->insert_id();;
		return $result;
	}

	function get_quiz_questions_by_quiz_id($id) {
		$sql = "SELECT * FROM quiz_question WHERE quiz_id = ? and archived = 0;";
		$query = $this->db->query($sql, array('quiz_id' => $id));
		return $query->result();
	}

	function get_quiz_question_order_by_quiz_id($id) {
		$sql = "SELECT question_order
				FROM `quiz_question` 
				WHERE archived=0 AND quiz_id=? 
				ORDER BY question_order DESC LIMIT 1;";
		$query = $this->db->query($sql, array('quiz_id' => $id));
		return $query->result();
	}

	function get_quiz_question_count_by_quiz_id($id) {
		$sql = "SELECT COUNT(quiz_question_id) AS count
				FROM `quiz_question` 
				WHERE archived=0 AND quiz_id=?;";
		$query = $this->db->query($sql, array('quiz_id' => $id));
		return $query->row();
	}

}
