<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Users Repository
	 *
	 * @var Users
	 */
	protected $users;

	/**
	 * Instantiate UsersController
	 *
	 * @return UsersController
	 */
	public function __construct()
	{
		$this->users = \App::make('App\Models\Users');
	}

	/**
	 * GetList of all Users
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->users
			->select(\DB::raw('CONCAT(`first`, " ", `last`) AS "user"'))
			->orderBy('first', 'asc')
			->orderBy('last', 'asc')
			->get();
	}

	/**
	 * Mark a City as visited by this User
	 *
	 * @param  String    "Firstname Lastname"
	 * @return Response
	 */
	public function addvisit($user)
	{
		// Find the User
		$user = explode(' ', $user);
		$user = $this->users
			->where('first', '=', $user[0])
			->where('last', '=', $user[1])
			->firstOrFail();

		// Find the Cities this User has visited
		$cities = \Request::all();

		// Malformed JSON
		if (empty($cities))
			throw new HttpException(400, 'Malformed POST content.'); 

		// Store Cities that were not found for output
		$not_found = [];

		// Single City POST
		if (isset($cities['city']) AND isset($cities['state'])) {
			// City visited
			$found = \App\Models\Cities::where('city', '=', $cities['city'])
				->where('state', '=', $cities['state'])
				->first();

			// City Not Found
			if (is_null($found)) $not_found[] = $city;

			// Insert Into `cities_visited`
			\App\Models\CitiesVisited::firstOrCreate(['user_id'=>$user->id, 'city_id'=>$found->id]);

		// Multiple Cities Post
		} else {
			foreach ($cities as $city) {
				// City visited
				$found = \App\Models\Cities::where('city', '=', $city['city'])
					->where('state', '=', $city['state'])
					->first();

				// City Not Found
				if (is_null($found)) $not_found[] = $city;
					
				// Insert Into `cities_visited`
				else
				\App\Models\CitiesVisited::firstOrCreate(['user_id'=>$user->id, 'city_id'=>$found->id]);
			}
		}

		if (count($not_found))
			return ['warning'=>'The following Cities were not able to be added.', 'cities'=>$not_found];
		else
			return '';
	}

	/**
	 * GetList of all Cities a User has visited
	 *
	 * @param  String    "Firstname Lastname"
	 * @return Response
	 */
	public function visits($user)
	{
		// Collection of Cities this User has visited
		$collection = [];

		// Find the User
		$user = explode(' ', $user);
		$cities = $this->users
			->where('first', '=', $user[0])
			->where('last', '=', $user[1])
			->firstOrFail()
			->belongsToMany('App\Models\Cities', 'cities_visited', 'user_id', 'city_id')
			->get();

		// Format Cities
		foreach ($cities as $city) {
			$collection[] = json_decode('{"city":"' . $city->city . '","state":"' . $city->state . '"}');
		}

		// Return collection
		return $collection;
	}
}
