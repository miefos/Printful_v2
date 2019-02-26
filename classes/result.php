<?php

class Result 
{
	private $db;

	public function __construct($db) 
	{
		$this->db = $db;
	}

	public function getGreeting($user_id) 
	{
		// Username Attempt TestName Result (answers.correct/questions.total)
		$userData = $this->db->query("SELECT e.id, e.user, e.attempt, SUM(ea.correct) corrects, t.test_name FROM enrolled as e, enrolled_answers as ea, tests as t WHERE ea.user_id = e.id AND e.id = ? AND e.test_id = t.id", array($user_id));
		$userData[0]['number_of_questions'] = $_SESSION['number_of_questions'];

		session_destroy();
		return $userData[0];
	}
}

?>