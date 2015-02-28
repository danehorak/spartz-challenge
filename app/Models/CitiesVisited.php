<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitiesVisited extends Model {

	protected $table = 'cities_visited';

	protected $fillable = ['user_id', 'city_id'];

	public $timestamps = false;

}
