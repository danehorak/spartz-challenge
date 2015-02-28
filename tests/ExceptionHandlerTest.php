<?php

class ExceptionHandlerTest extends TestCase {

	/**
	 * Setup the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		Session::start();
	}

	/**
	 * 404 Exception - Bad URL
	 *
	 * @return void
	 */
	public function testFourOhFourAction()
	{
		$response = $this->call('GET', 'v1/wrong-controller');

		// Should return status 404
		$this->assertEquals(404, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '{"error":"Please see documentation for correct use of API","code":404}';
		$this->assertEquals($content, $response->getContent());
	}


	/**
	 * Clean up the testing environment before the next test.
	 *
	 * @return void
	 */
	public function tearDown()
	{
		parent::tearDown();
	}

}
