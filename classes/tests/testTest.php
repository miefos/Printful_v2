<?php
require_once(dirname(__DIR__) . "/DB.php");
require_once(dirname(__DIR__) . "/test.php");

use \PHPUnit\Framework\TestCase;

class testTest extends TestCase
{
    public function testPushAndPop()
    {

    	 // Create a stub for the Test class.
        $db = $this->createMock(DB::class);

        // Configure the stub.
        $db->expects($this->once())
        	->method('query')
        	->with("SELECT DISTINCT t.* FROM tests as t, questions AS q JOIN answers AS a ON (a.question_id=q.id) WHERE q.test_id = t.id GROUP BY q.id")
            ->willReturn('abc');


        // Get the tests list from Test class
        $test = new Test($db);
        $tests = $test->getTestList();

        $this->assertEquals($tests, 'abc');
    }
}
?>