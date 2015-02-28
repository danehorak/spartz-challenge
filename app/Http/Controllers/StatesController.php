<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Models\Cities;

class StatesController extends Controller {

	/**
	 * States Repository
	 *
	 * @var Cities
	 */
	protected $cities;

	/**
	 * Instantiate StatesController
	 *
	 * @return StatesController
	 */
	public function __construct()
	{
		$this->cities = \App::make('App\Models\Cities');
	}

	/**
	 * GetList of all States
	 *
	 * @return StatesController
	 */
	public function index()
	{
		return $this->cities
			->select('state')
			->distinct()
			->orderBy('state', 'asc')
			->get();
	}
}
