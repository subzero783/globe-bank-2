<?php 

function filter_array_data($array){
	$filteredArray = [];
	foreach($array as $key => $item){
		$trimmed = trim($item);
		$stripped = addslashes($trimmed);
		$filteredArray[$key] = $stripped;
	}
	return $filteredArray;
}
function form_input_filter_string($data){
	$data = trim($data);
	$data = addslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function filter_array_stripslashes_fetch_all($array){
	$filteredArray = [];
	for($i = 0; $i < count($array); $i++){
		foreach($array[$i] as $key => $item){
			$trimmed = trim($item);
			$stripped = stripslashes($trimmed);
			$htmlEntity = htmlentities($stripped);
			$filteredArray[$i][$key] = $htmlEntity;
		}
	}
	return $filteredArray;
}

function filter_array_stripslashes_fetch($array){
	$filteredArray = [];
	foreach($array as $key => $item){
		$trimmed = trim($item);
		$stripped = stripslashes($trimmed);
		$filteredArray[$key] = $stripped;
	}
	return $filteredArray;
}

?>