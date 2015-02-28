<?php

class UsersControllerTest extends TestCase {

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
	 * UsersController::index
	 *
	 * @return void
	 */
	public function testGetResourceListAction()
	{
		$response = $this->call('GET', 'v1/users');

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '[{"user":"Andrew Anderson"},{"user":"Andrew Watson"},{"user":"Bill Brown"},{"user":"Chris Jones"},{"user":"Eliscia Smith"},{"user":"Henry Harrison"},{"user":"Jim Smith"},{"user":"John Smith"},{"user":"Jose Gonzales"},{"user":"Michael Jackson"}]';
		$this->assertEquals($content, $response->getContent());
	}

	/**
	 * UsersController::addvisits
	 *
	 * @return void
	 */
	public function testAddVisitsAction()
	{
		// Truncate Cities Visited
		\App\Models\CitiesVisited::truncate();

		$response = $this->call('POST', 'v1/users/andrew anderson/visits', [['city'=>'Boulder', 'state'=>'CO'],['city'=>'Denver', 'state'=>'CO']]);

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '';
		$this->assertEquals($content, $response->getContent());

		//-----------------------------------------------------

		$response = $this->call('POST', 'v1/users/andrew anderson/visits', ['city'=>'Whittier', 'state'=>'CA']);

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '';
		$this->assertEquals($content, $response->getContent());
	}

	/**
	 * UsersController::visits
	 *
	 * @return void
	 */
	public function testVisitsAction()
	{
		$response = $this->call('GET', 'v1/users/andrew anderson/visits');

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '[{"city":"Whittier","state":"CA"},{"city":"Denver","state":"CO"},{"city":"Boulder","state":"CO"}]';
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
