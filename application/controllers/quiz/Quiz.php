<?php

class Quiz extends CI_Controller {

	public function submitQuiz() {
		$this->load->model('Quiz_Model/QuizModel');
		$formValues = $this->input->post();
		$correctAnswers = 0;
//		access quiz_id key in form values
		$quiz_id = $formValues['quiz-id'];
		$user_id = $formValues['user-id'];
		$totalAnswers = count($formValues);

//		removing quiz_id from the array
		unset($formValues['quiz-id']);
		unset($formValues['user-id']);


		echo json_encode($formValues);
		echo "<br>";
		echo "QUIZ ID:".$quiz_id;
		echo "<br>";
		echo "USER ID:".$user_id;
		echo "<br>";

//		foreach ($formValues as $key => $value) {
//
////			Key   => quiz_question_id
////			Value => quiz_answer_id
//			$questions = $this->QuizModel->validate_correct_quiz_answer(intval($key), intval($value));
//			if (intval($questions->is_correct) === 1) {
//				$correctAnswers++;
//			}
//
//		}
//		redirect(base_url('challenge/'.$quiz_id));
//		echo "You got ".$correctAnswers." out of ".$totalAnswers." correct";

	}

}
