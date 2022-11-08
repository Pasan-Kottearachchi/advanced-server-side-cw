<?php

class QuizCategoryModel extends CI_Model{
	function __construct() {
		parent::__construct();
		$db = $this->load->database();
	}

	function get_quiz_categories() {
		$sql = "SELECT * FROM quiz_category WHERE archived = 0;";
		$query = $this->db->query($sql);
		return $query->result();
	}


}
