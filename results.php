<?php

require_once('init.php');
include 'includes/header.php';

if(isset($_SESSION['userId']) && isset($_SESSION['number_of_questions'])){
	$db = DB::getInstance();
	$result = new Result($db);

	$result = $result->getGreeting($_SESSION['userId']);


	?>


	<div id="results_container">
	<h3>Congratulations <?php echo ucwords($result['user']); ?> for completing <?php echo $result['test_name']; ?>! <br />
		You got <?php echo $result['corrects']; ?> out of <?php echo $result['number_of_questions']; ?> points! <br />You have taken the test <?php echo $result['attempt']; ?> times. </h3></div>

<?php
}else {
	echo "<div class='container'>Please take another test!</div>";
}
include 'includes/footer.php';