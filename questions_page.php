<?php
require_once('init.php');
include 'includes/header.php';


if (isset($_POST['name']) && !empty($_POST['name'])) {
	if(isset($_POST['test']) && !empty($_POST['test'])){
$data = getData(sanitize($_POST['test']), sanitize(strtolower($_POST['name']))); // Returns assoc array with user_name, test_name, test_id
$user_name = $data['user_name'];
$test_id = $data['test_id'];
$test_name = $data['test_name'];

if (checkIfThisTestExist($test_id)) { // Also sets session $_SESSION['test_id'] = id
	if(Question::getInstance()->getOneQuestion(0)) {

		Enrollment($user_name, $test_id);

		include 'includes/footer.php';
		?>
		<script src="js/js_questions_page.js"></script>
		<?php


	} else {
		echo "<div class='container'>Sorry, this test does not have any questions with answers!</div>";
	}
} else {
	echo "<div class='container'>Sorry, no test found!</div>";
}
} else {
	echo "<div class='container'>Please provide test field!</div>";
}
} else {
	echo "<div class='container'>Please provide name field!</div>";	
}
