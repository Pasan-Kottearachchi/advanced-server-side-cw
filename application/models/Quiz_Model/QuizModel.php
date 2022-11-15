<?php

class QuizModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$db = $this->load->database();
	}

//	Insert quiz meta data into database and return all data
	public function insert_quiz_metadata($quiz_name, $quiz_category, $user_id)
	{
		$sql = "INSERT INTO quiz (title, quiz_category_id, created_by, archived) VALUES (?, ?, ?, ?)";
		$this->db->query($sql, array($quiz_name, intval($quiz_category), intval($user_id), 0));
		return $this->db->insert_id();


	}

	function get_all_quizzes()
	{
		$this->db->select('quiz_id, title, created_by, user.name');
		$this->db->from('quiz');
		$this->db->join('user', 'user.user_id = quiz.created_by', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function get_by_id($id)
	{
		$sql = "SELECT *
				FROM quiz
				WHERE quiz_id = ? and archived = 0";
		$query = $this->db->query($sql, array('quiz_id' => $id));
		return $query->row();
	}

	function search_quiz($search)
	{
		$sql = "SELECT quiz_id, title, created_by, user.name
				FROM quiz
				JOIN user ON user.user_id = quiz.created_by
				WHERE title LIKE ? OR name LIKE ?;";
		$query = $this->db->query($sql, array('%' . $search . '%', '%' . $search . '%'));
		return $query->result();
	}

	function update_quiz_status($id, $status)
	{
		$sql = "UPDATE quiz SET archived = ? WHERE quiz_id = ?;";
		$query = $this->db->query($sql, array($status, $id));
		return $query;
	}

	function get_quizes_by_user_id($user_id)
	{
		$sql = "SELECT 
					quiz.quiz_id, 
					title, 
					quiz_category.category_name, 
					user.name,
					COUNT(quiz_attempt.quiz_attempt_id) as attempts
				FROM quiz
				LEFT JOIN quiz_category ON quiz.quiz_category_id = quiz_category.quiz_category_id
				LEFT JOIN quiz_attempt ON quiz_attempt.quiz_id = quiz.quiz_id
				LEFT JOIN user ON user.user_id = quiz.created_by
				WHERE created_by = ? and quiz.archived = 0
				GROUP BY quiz.quiz_id;";
		$query = $this->db->query($sql, array($user_id));
		return $query->result();
	}
}
