<?php

class Question
{
	private static $_instance;
	private $db, $test_id, $questions;
    public $_error,
           $_query,
           $_results,
           $_count;

    private function __construct() 
    {
    	$this->test_id = $_SESSION['test_id'];
    	$this->db = DB::getInstance();
    	try {
    		$this->questions = $this->db->getInstance()->query("
			SELECT 
			    q.id as question_id,
			    q.question,
	            (SELECT a.id FROM answers as a WHERE is_correct = 1 AND q.id = a.question_id) correctAnswerId, 
			    GROUP_CONCAT(CONCAT(a.id,':',a.answer) ORDER BY a.id) allAnswers
			FROM questions AS q
			JOIN answers AS a ON (a.question_id=q.id)
			WHERE q.test_id = ?
			GROUP BY q.id
			", array($this->test_id));

            if ($this->questions) {
			     $_SESSION['number_of_questions'] = $this->count();
            } 

    	} catch (PDOError $e) {
    		echo "Error: $e";
    	}
    }

    private function count() 
    {
    	foreach($this->questions as $question) {
    		$this->_count++;
    	}
    	return $this->_count;
    }

    public static function getInstance()
    {
    	if (!isset(self::$_instance)) {
			self::$_instance = new Question();
		}
		
		return self::$_instance;
    }

    public function getQuestions () 
    {
    	return $this->$questions;
    }

    public function getOneQuestion ($qn) 
    {
        if (isset($this->questions[$qn])) {
    	   return $this->questions[$qn];
        } else {
            return false;
        }
    }
}


?>