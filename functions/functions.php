<?php
/*
//
// General functions
//
*/



function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function Test () 
{
	$db = DB::getInstance();
	return new Test($db);
}

function Enrollment ($user, $test_id) 
{
	$db = DB::getInstance();
	return new Enrollment($db, $user, $test_id);
}

function setSession ($key, $value) 
{
	$_SESSION[$key] = $value;
}


/*
//
// Functions for getQuestions page
//
*/

function renderHTMLAnswers($answers) 
{
	$x = 1;
	$i = 0;
	$return_val = null;

	foreach ($answers as $answer) {
		if ($x == 1) {
			$return_val .= "<div id='outerAnswer'>";
			$i = 0;
		}
		$return_val .=  "<button val='" . $answer['id'] . "' id='ans{$answer['id']}'>" . $answer['answer'] . "</button>";
		$x++;
		if ($x == 3) {
			$return_val .=  "</div>";
			$i = 1;
			$x = 1;
		}
		
	} if($i = 0) {
		$return_val .=  "</div>";
	}

	return $return_val;
}

function renderHTMLQuestion($question, $qn)
{
	$return_val = null;
	$return_val .= "<div class='container'><h3>";
	$return_val .= $question['question'];
	$return_val .= "</h3><div id='answers-container'>";
	$answers = parseAnswers($question['allAnswers']);
	$return_val .= renderHTMLAnswers($answers);
	$return_val .= "</div>"; 
	$return_val .= getNextOrFinishButton($qn);
	$return_val .= "</div><br />";
	$return_val .= getProgressBar($qn);
	return $return_val;
}

function postUserAnswerIfExist($qn, $question_id) 
{
	if (isset($_POST['selected']) && !empty($_POST['selected']) && $qn >= 1) {
		$previousQuestion = Question::getInstance()->getOneQuestion($qn-1);
		insertAnswer($qn, $_SESSION['test_id'], $_POST['selected'], $previousQuestion['question_id'], $previousQuestion['correctAnswerId']);
		return true;
	} else {
		return false;
	}
}

function Answer() 
{
	$db = DB::getInstance();
	return new Answer($db);
}

function insertAnswer($qn, $test_id, $selected, $question_id, $correct_answer_id) 
{
	Answer()->insertNewAnswer($test_id, $_SESSION['userId'], $selected, $correct_answer_id, $question_id);
}

function parseAnswers($answers)
{
		$answers = explode(",", $answers); 

		$answers_new;
		$return_val;
		$x = 0;
		foreach ($answers as $answer) {
		$answers_new[$x]['id'] = sanitize(substr($answer, 0, strpos($answer, ':')));
		$answers_new[$x]['answer'] = sanitize(substr($answer, strpos($answer, ':') + 1));
		$x++; 
		}

		return $answers_new;
}

function getNextOrFinishButton($qn) 
{
	if($qn < $_SESSION['number_of_questions']-1){
		return "<button id='btn-next'>Next Question </button>";
	} else {
		return "<button id='btn-finish'>Finish Test!</button>";
	}
}

function getProgressBar($qn) {
	if ($qn == 0){
		$percentage = 0;
	} else {
		$percentage = ($qn / $_SESSION['number_of_questions']) * 100;
	}

	return "<div id='myProgress'><div style='width:" . $percentage . "%;' id='myBar'></div>";
}




/*
//
// Functions for questions page
//
*/

function checkIfThisTestExist ($test_id) 
{
	if(DB::getInstance()->query("SELECT id FROM tests WHERE id = ?", array($test_id))) {
		setSession('test_id', $test_id);
		return true;
	} else {
		return false;
	}
}

function getData ($test_params, $user) 
{
	$return_val;

	$return_val['user_name'] = $user;
	$return_val['test_name'] = substr($test_params, 0, strrpos($test_params, ",")); // Returns test_name as string
	$return_val['test_id'] = substr($test_params, (strrpos($test_params, ",") + 2)); // Returns test_id as string

	return $return_val;
}

