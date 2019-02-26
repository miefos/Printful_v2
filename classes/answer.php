<?php


class Answer 
{
	private $db;

	public function __construct ($db) 
	{
		$this->db = $db;
	}

	public function insertNewAnswer($test_id, $user_id, $selected, $correct_answer_id, $question_id) 
	{
		if($selected == $correct_answer_id) {
			$correct = 1;
		} else {
			$correct = 0;
		}

		$this->db->query("INSERT INTO enrolled_answers (question_id, answer_id, correct_answer, correct, user_id) VALUES (?, ?, ?, ?, ?)", array($question_id, $selected, $correct_answer_id, $correct, $user_id));
	}
}

?>