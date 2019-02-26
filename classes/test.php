<?php

class Test {
	
	private $db;

	function __construct ($db) {
		$this->db = $db;
	}

	// Return only those tests, who has at least one question with at least one answer
	public function getTestList(){
		$tests = $this->db->query("SELECT DISTINCT t.* FROM tests as t, questions AS q JOIN answers AS a ON (a.question_id=q.id) WHERE q.test_id = t.id GROUP BY q.id");
		return $tests;
	}

}

?>