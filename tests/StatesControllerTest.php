<?php

class StatesControllerTest extends TestCase {

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
	 * StatesController::index
	 *
	 * @return void
	 */
	public function testGetResourceListAction()
	{
		$response = $this->call('GET', 'v1/states');

		// Should return status 200
		$this->assertEquals(200, $response->getStatusCode());

		// Assert Correct content is retuned
		$content = '[{"state":"AK"},{"state":"AL"},{"state":"AR"},{"state":"AZ"},{"state":"CA"},{"state":"CO"},{"state":"CT"},{"state":"DC"},{"state":"DE"},{"state":"FL"},{"state":"GA"},{"state":"HI"},{"state":"IA"},{"state":"ID"},{"state":"IL"},{"state":"IN"},{"state":"KS"},{"state":"KY"},{"state":"LA"},{"state":"MA"},{"state":"MD"},{"state":"ME"},{"state":"MI"},{"state":"MN"},{"state":"MO"},{"state":"MS"},{"state":"MT"},{"state":"NC"},{"state":"ND"},{"state":"NE"},{"state":"NH"},{"state":"NJ"},{"state":"NM"},{"state":"NV"},{"state":"NY"},{"state":"OH"},{"state":"OK"},{"state":"OR"},{"state":"PA"},{"state":"RI"},{"state":"SC"},{"state":"SD"},{"state":"TN"},{"state":"TX"},{"state":"UT"},{"state":"VA"},{"state":"VT"},{"state":"WA"},{"state":"WI"},{"state":"WV"},{"state":"WY"}]';
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
