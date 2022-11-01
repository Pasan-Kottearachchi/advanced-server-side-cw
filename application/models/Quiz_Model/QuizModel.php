<?php

class QuizModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

//	function insert_quiz_meta_data($data) {
//		$this->db->insert('student_course', array("student_name" => $data['name'], "course" => $data['course']));
//	}

	function get_all_quizzes() {
		$this->db->select('quiz_id, title, created_by, user.name');
		$this->db->from('quiz');
		$this->db->join('user', 'user.user_id = quiz.created_by', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function get_by_id($id) {
		$query = $this->db->get_where('quiz', array('quiz_id' => $id));
		return $query->row();
	}

	function get_quiz_questions_by_quiz_id($id) {
		$query = $this->db->get_where('quiz_question', array('quiz_id' => $id));
		return $query->result();
	}

	function get_quiz_ans_by_quiz_questions_ids($ids) {
		$sql = "SELECT quiz_answer_id, description, is_correct, quiz_question_id
				FROM quiz_answer 
				WHERE quiz_question_id IN ? and archived = 0;";
		$query = $this->db->query($sql, array('quiz_question_id' => $ids));
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
}
