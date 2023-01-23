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
		$this->db->query($sql, array($quiz_name, intval($quiz_category), intval($user_id), 1));
		return $this->db->insert_id();


	}

	function get_all_quizzes($current_user_id)
	{
		$sql = "SELECT 
					quiz_id, 
					title,
					created_by, 
					user.name 
				FROM `quiz` 
				left join user 
				on user.user_id = quiz.created_by 
				WHERE quiz.created_by != ?";
		$query = $this->db->query($sql, array($current_user_id));
		return $query->result();
	}

	function get_by_id($id)
	{
		$sql = "SELECT *
				FROM quiz
				WHERE quiz_id = ?";
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
					COUNT(quiz_attempt.quiz_attempt_id) as attempts,
					quiz_stats.correct_answers,
					quiz_stats.total_answers
				FROM quiz
				LEFT JOIN quiz_category ON quiz.quiz_category_id = quiz_category.quiz_category_id
				LEFT JOIN quiz_attempt ON quiz_attempt.quiz_id = quiz.quiz_id
				LEFT JOIN user ON user.user_id = quiz.created_by
				LEFT JOIN quiz_stats ON quiz_stats.quiz_id = quiz.quiz_id
				WHERE quiz.created_by = ? and quiz.archived = 0
				GROUP BY quiz.quiz_id;";
		$query = $this->db->query($sql, array('created_by'=>$user_id));
		return $query->result();
	}

	function getUserCreatedQuizCount($userId){
		$sql = "SELECT COUNT(quiz_id) as count
			FROM quiz
				WHERE created_by = ? and archived = 0;";
		$query = $this->db->query($sql, array('created_by'=>$userId));
		return $query->row();
	}

	function getUserParticipatedTotalQuizCount($userId){
		$sql = "SELECT COUNT(DISTINCT quiz_id) as count
				FROM quiz_attempt
				WHERE attempted_by = ? and archived = 0;";
		$query = $this->db->query($sql, array('attempted_by'=>$userId));
		return $query->row();
	}

	function getUserAttemptedQuizCount($userId){
		$sql = "SELECT COUNT(quiz_id) as count
				FROM quiz_attempt
				WHERE attempted_by = ? and archived = 0;";
		$query = $this->db->query($sql, array('attempted_by'=>$userId));
		return $query->row();
	}
}
