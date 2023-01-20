<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index()
    { 	
        return view('demo');
    }
	
	public function store(Request $request)
	{
	   //dd($request->all());  //to check all the datas dumped from the form
	   //if your want to get single element,someName in this case
	   
	   $start_date = $request->start_date; 
	   $end_date = $request->end_date; 
	   
	   // custom code starts
	   // Initializing curl
$curl = curl_init();

// Sending GET request to reqres.in
// server to get JSON data
curl_setopt($curl, CURLOPT_URL,
	"https://api.nasa.gov/neo/rest/v1/feed?start_date=".$start_date."&end_date=".$end_date."&api_key=gyvenGySaM8uZURqNClcJ18eu1eZEmhv5PxAE0Cv");

// Telling curl to store JSON
// data in a variable instead
// of dumping on screen
curl_setopt($curl,
	CURLOPT_RETURNTRANSFER, true);

// Executing curl
$response = curl_exec($curl);

// Checking if any error occurs
// during request or not
if($e = curl_error($curl)) {
	echo $e;
} else {
	
	// Decoding JSON data
	$decodedData =
		json_decode($response, true);
		
	// Outputting JSON data in
	// Decoded form
	
	// echo "<pre>";
	// print_r($decodedData['near_earth_objects']);
	// echo "</pre>";  exit;
	
	$near_earth_objects = array();
	$estimated_dia_min  = array();
	$estimated_dia_max  = array();
	$asteroid_id_array  = array();
	$list_of_asteroids  = array();
	$velocity_of_asteroids  = array();
	
	
	$near_earth_objects = $decodedData['near_earth_objects'];
	
	//$total_days = count($decodedData['near_earth_objects']); 
	
	$close_approach_data_array = array();
	
	foreach($near_earth_objects as $key => $value)
	{					
		foreach($near_earth_objects[$key] as $key1 => $value1){
			
			$estimated_dia_min[] = $near_earth_objects[$key][$key1]['estimated_diameter']['kilometers']['estimated_diameter_min'];	

			$estimated_dia_max[] = $near_earth_objects[$key][$key1]['estimated_diameter']['kilometers']['estimated_diameter_max'];	

			$close_approach_data_array = $near_earth_objects[$key][$key1]['close_approach_data'];
			
			$asteroid_id = $near_earth_objects[$key][$key1]['id'];
			$asteroid_id_array[] = $asteroid_id;
			
			foreach($close_approach_data_array as $key2 => $value2){
				$asteroid_dist_in_km = $close_approach_data_array[$key2]['miss_distance']['kilometers'];
				
				$asteroid_velocity_in_km = $close_approach_data_array[$key2]['relative_velocity']['kilometers_per_hour'];
				
				
				$list_of_asteroids[][$asteroid_id] = $asteroid_dist_in_km;
				$velocity_of_asteroids[][$asteroid_id] = $asteroid_velocity_in_km;
			}			
		}			
	}
	
	// echo "<pre>";
	// print_r($minmin($list_of_asteroids));
	// echo "</pre>"; 
	
	
	$closest_asteroid_array  =  array();
	$fastest_asteroid_array  =  array();
	
	$closest_asteroid_array  =  min($list_of_asteroids);
	$closest_asteroid_id = array_key_first($closest_asteroid_array);
	
	$fastest_asteroid_array  =  max($velocity_of_asteroids);
	$fastest_asteroid_id = array_key_first($fastest_asteroid_array);
	
	// echo "kkkkkk ".$closest_asteroid_id; 
	
	// exit;
	
	// echo "<pre>";
	// print_r($kkkk);
	// echo "</pre>"; 
	
	$average_dia_min = array_sum($estimated_dia_min)/count($estimated_dia_min);
	$average_dia_max = array_sum($estimated_dia_max)/count($estimated_dia_max);
	
	echo "<h2>Minimum Average Diameter Size of the Asteroids in kilometers is  ".$average_dia_min."</h2>";

	echo "<br><h2>Maximum Average Diameter Size of the Asteroids in kilometers is  ".$average_dia_max."</h2>";
	
	echo "<br><h2>Closest Asteroid id is ".$closest_asteroid_id."  and its distance in Kilometer is  ".$closest_asteroid_array[$closest_asteroid_id]."</h2>";
	
	echo "<br><h2>Fastest Asteroid id is ".$fastest_asteroid_id."  and its speed in Km/hr is  ".$fastest_asteroid_array[$fastest_asteroid_id]."</h2>";
	
	
	
}

// Closing curl
curl_close($curl);
	   // custom code ends 
	}
}
