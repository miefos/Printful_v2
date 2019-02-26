<?php

class Enrollment 
{
	private $db, $user, $test_id, $attempt;

	public function __construct ($db, $user, $test_id) 
	{
		$this->db = $db;
		$this->user = $user;
		$this->test_id = $test_id;
		$this->insertUser();
	}

	private function insertUser() {
		if($attempt = $this->db->query("SELECT MAX(attempt) FROM enrolled WHERE user = ? AND test_id = ?", array($this->user, $this->test_id)))
		{
			$attempt = $attempt[0]['MAX(attempt)'] + 1;
		} else {
			$attempt = 1;
		}

		$newUser = $this->db->query("
			INSERT INTO enrolled (user, test_id, attempt)
			VALUES (?, ?, ?)
			",array($this->user, $this->test_id, $attempt));

		$selectUserId = $this->db->query("SELECT MAX(id) max FROM enrolled")[0]['max'];
		$_SESSION['userId'] = $selectUserId;
	}


}


?>