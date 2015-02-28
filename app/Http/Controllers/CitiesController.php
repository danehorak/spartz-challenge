<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Models\Cities;

class CitiesController extends Controller {

	/**
	 * Cities Repository
	 *
	 * @var Cities
	 */
	protected $cities;

	/**
	 * Instantiate CitiesController
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
	 * @return CitiesController
	 */
	public function index($state)
	{
		return $this->cities
			->select('city')
			->where('state', '=', $state)
			->distinct()
			->orderBy('city', 'asc')
			->get();
	}

	/**
	 * GetList of all Cities within the specified radius
	 *
	 * @param  Integer  Radius boundary in statute miles
	 * @return Response
	 */
	public function radius($state, $city)
	{
		// Collection of Cities
		$collection = [];

		// Radius
		$radius = \Request::all();
		$radius = ((isset($radius['radius']) AND ctype_digit($radius['radius'])) ? $radius['radius'] : 100);

		// City to measure radius from
		$city = $this->cities
			->where('state', '=', $state)
			->where('city', '=', $city)
			->firstOrFail();
		$lat  = $city->latitude;
		$long = $city->longitude;
		
		// All Cities
		$cities = $this->cities
			->where('id', '!=', $city->id)
			->get();

		// Loop through every city to determine if the city is within the specified radius
		foreach ($cities as $city) {
			if ($this->isWithinRadius($radius, $lat, $long, $city->latitude, $city->longitude))
				// Format City and Add to Collection
				$collection[] = json_decode('{"city":"' . $city->city . '","state":"' . $city->state . '"}');
		}

		// Retun Collection of cities within given boundary
		return $collection;
	}

	/**
	 * Determine if the distance between to provided points is within the provided boundary
	 *
	 * @param  Integer  Radius boundary in statute miles
	 * @param  Integer  Latitude in degrees from point 1
	 * @param  Integer  Longitude in degrees from point 1
	 * @param  Integer  Latitude in degrees from point 2
	 * @param  Integer  Longitiude in degrees from point 2
	 * @return Boolean
	 */
	protected function isWithinRadius($radius, $lat1, $lon1, $lat2, $lon2)
	{
		// Earth's Radius in Statute Miles
		$R = 3958.76;

		// Haversine Formula
		$a = sin(deg2rad($lat2 - $lat1) / 2);
		$b = sin(deg2rad($lon2 - $lon1) / 2);
		$c = cos(deg2rad($lat1));
		$d = cos(deg2rad($lat2));
		$e = $a * $a + $c * $d * $b * $b;
		$f = 2 * atan2(sqrt($e), sqrt(1 - $e));

		// Distance
		$distance = $R * $f;

		// Within Boundary?
		return $distance <= $radius;
	}
}
