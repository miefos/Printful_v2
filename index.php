<?php
require_once('init.php'); // sets $GLOBALS and autoload classes
include 'includes/header.php';

session_unset();

function getTests()
{
	$tests = Test()->getTestList();

	foreach ($tests as $test)
	{
		echo "<option value='{$test['test_name']}, {$test['id']}'>{$test['test_name']}</option> <br />";
	}

}
?>
<!-- Form to start a test -->
<div class="center">
<form action="<?php echo htmlspecialchars('questions_page.php') ?>" method="POST">

	<div>
	<input required class="myInput" type="text" name="name" placeholder="Enter your name" value="" />
	</div>

	<div id="selector">
	<select required name="test">
		<option value="" hidden>Choose test</option>
		<?php getTests();?>
	</select>
	</div>

	<div>
	<button type="submit">Start the test</button>
	</div>

</form>
</div>

<?php include 'includes/footer.php';
?>


