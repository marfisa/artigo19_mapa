<?php

/**
 * Script to import the radios from a CSV file.
 */

require_once(__DIR__ . '/../src/includes/utils.inc.php');

$file = __DIR__  .'/../radios.csv';
$row = 0;
$handle = fopen($file, 'r');

if ($handle !== false) {
	while (($data = fgetcsv($handle)) !== false) {
		$row++;
		
		// csv file header
		if ($row == 1) {
			$headerSize = count($data);
			continue;
		}
		
		if (count($data) > $headerSize) {
			die("Line $row has more fields than file header.");
		}
		
		//parse the csv line and insert the new radio in the db
		insertRadio($data);
		
	}
	fclose($handle);
}

echo "\nOK!\n\n";

/**
 * Main function to insert radios in the database. Call auxiliary functions
 * to format the data that is going to be inserted for each radio.
 * 
 * @param array $data radio data from the csv file
 * @return void
 */
function insertRadio(array $data) {
	global $row;
	
	//remove white spaces from the end and beggining of the strings
	$data = array_map('trim', $data);
	
	if (!empty($data[0])) {
		$name = addslashes($data[0]);
	} else {
		die("Mandatory field 'name' is empty in line $row\n");
	}
	
	$address = addslashes($data[1]);
	$city = addslashes($data[2]);
	$state = formatState($data[3]);
	$city_code = getCityCode($data[2], $state);
	$license = formatLicense($data[4]);
	list($latitude, $longitude) = formatCoordinates($data[5]);
	list($channel, $frequency) = formatChannelAndFrequency($data[6]);
	$identifier = $data[7];
	
	if (!empty($latitude) && !empty($longitude)) {
		$visible = 1;
	} else {
		$visible = 0;
	}
	
	$time = time();
	
	query(
		"INSERT INTO radios_comunitarias (razao_social, endereco, cod_municipio, municipio, uf, latitude, longitude, canal, frequencia, indicador, visivel, licenca, created)
		VALUES ('$name', '$address', '$city_code', '$city', '$state', '$latitude', '$longitude', '$channel', '$frequency', '$identifier', '$visible', '$license', FROM_UNIXTIME($time))"
	);
}

function formatLicense($string) {
	global $row;
	
	$license = '';
	
	if ($string == '( S )') {
		$license = 'definitiva';
	} else if ($string == '( N )') {
		$license = 'sem';
	} else if (empty($string)) {
		$license = 'provisoria';
	} else {
		die("Invalid value '$string' for license field in line $row.\n");
	}
	
	return $license;
}

function formatState($string) {
	global $row;
	
	if (strlen($string) > 2) {
		die("Invalid value '$string' for state field in line $row.\n");
	}
	
	return $string;
}

function formatCoordinates($string) {
	if (empty($string)) {
		return array(false, false);
	}
	
	list($latitude, $longitude) = explode('/', $string);
	
	$latitude = coordinatesFromDmsToDecimal($latitude);
	$longitude = coordinatesFromDmsToDecimal($longitude);
	
	return array($latitude, $longitude);
}

/**
 * Converts DMS (degrees/minutes/seconds)
 * to decimal format longitude / latitude
 * 
 * @param $deg
 * @param $min
 * @param $sec
 * @return unknown_type
 */
function coordinatesFromDmsToDecimal($coordinate) {
	$matches = array();
	preg_match('/(\d\d)(\w)(\d\d)(\d\d).*/', $coordinate, $matches);
	
	$deg = $matches[1];
	$min = $matches[3];
	$sec = $matches[4];
	
	$decimalCoordinate = $deg + ((($min*60) + ($sec)) / 3600); 
	
	if ($matches[2] == 'S' || $matches[2] == 'W') {
		$decimalCoordinate = (0 - $decimalCoordinate);
	}
	 
    return $decimalCoordinate;
}

function formatChannelAndFrequency($string) {
	if (!empty($string)) {
		return explode(' / ', $string);
	} else {
		return array(false, false);
	}
}

/**
 * Try to get IBGE city code from city name.
 * 
 * @param string $city city name
 * @param string $uf state code
 * @return int city code
 */
function getCityCode($city, $uf) {
	$city = addslashes($city);
	$result = query("SELECT im.codigo FROM ipso_municipio im, ipso_uf ipf WHERE im.nome LIKE '$city' AND ipf.uf = '$uf' AND ipf.id_uf = im.id_uf");
	
	$code = mysql_fetch_row($result);

	return $code[0];
}