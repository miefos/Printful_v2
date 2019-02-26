<?php
require_once('init.php');

$qn = $_POST['qn'];

$question = Question::getInstance()->getOneQuestion($qn);

postUserAnswerIfExist($qn, $question['question_id']);

echo renderHTMLQuestion($question,$qn);
