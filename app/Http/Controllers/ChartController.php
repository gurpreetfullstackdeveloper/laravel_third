<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index()
    { 	
        return view('chart');
    }
	
	public function store(Request $request)
	{
	   //dd($request->all());  //to check all the datas dumped from the form
	   //if your want to get single element,someName in this case
	   echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js'></script>";
	   
	   $start_date = $request->start_date; 
	   $end_date   = $request->end_date;

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
		// echo "</pre>";  
		
		$near_earth_objects = array();
		$close_approach_data_array = array();
		$dates_array = array();
		$total_corresponding_asteroids = array();
		
		
		
		$near_earth_objects = $decodedData['near_earth_objects'];
		
		//$total_days = count($decodedData['near_earth_objects']); 
		// echo "<pre>";
		// print_r($near_earth_objects);
		// echo "</pre>"; 
		
			
		foreach($near_earth_objects as $key => $value)
		{					
			foreach($near_earth_objects[$key] as $key1 => $value1){			
				$total_ids_array[] = $near_earth_objects[$key][$key1]['id'];			
			}		

			$dates_array[] = $key;
			$total_corresponding_asteroids[] = count($total_ids_array);		
			$dates_array_other[][$key] = count($total_ids_array);
			
			$total_ids_array= array();
		}
		
		$json_dates = json_encode($dates_array);
		$json_total_corresponding_asteroids = json_encode($total_corresponding_asteroids);

		// echo "<pre>";
		// print_r($decodedData['near_earth_objects']);
		// echo "</pre>";  

		}

		// Closing curl
		curl_close($curl);
		
		echo '<canvas id="bar-chart" width="800" height="250"></canvas>';
	
		echo '<script>
	new Chart(document.getElementById("bar-chart"), {
		type: "bar",
		data: {
		  labels: '.$json_dates.',
		  datasets: [
			{
			  label: "Number of Asteroids (count)",
			  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd", "#8e5ea2"],
			  data: '.$json_total_corresponding_asteroids.'
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: "Date Wise Asteroids Range"
		  }
		}
	});
	</script>';
	
	}
}
