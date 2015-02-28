<?php

class CitiesControllerTest extends TestCase {

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
	 * CitiesController::index
	 *
	 * @return void
	 */
	public function testGetResourceListAction()
	{
		$response = $this->call('GET', 'v1/states/dc/cities');

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '[{"city":"Washington"}]';
		$this->assertEquals($content, $response->getContent());
	}

	/**
	 * CitiesController::index
	 *
	 * @return void
	 */
	public function testGetResourceListWithinRadiusBoundaryAction()
	{
		$response = $this->call('GET', 'v1/states/dc/cities/washington?radius=3');

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '[{"city":"Arlington","state":"VA"}]';
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
