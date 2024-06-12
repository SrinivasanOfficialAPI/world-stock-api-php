<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allow specific headers
header("Content-Type: application/json; charset=UTF-8"); // Specify JSON response format
include_once("../common_functions.php");


$outputJsonArr = [];
if (empty($_GET)) {
	http_response_code(400);
	$outputJsonArr = array('status' => 'error', 'data' => 'Required query parameter "countryParam" is missing');
	echo json_encode($outputJsonArr, JSON_UNESCAPED_SLASHES);
	exit();
} else {
	$outputArr = getCountryStockArray('market-movers-high-dividend', $_GET['countryParam']);
	$outputJsonArr = array('status' => 'success', 'data' => $outputArr);
	echo json_encode($outputJsonArr, JSON_UNESCAPED_SLASHES);
	exit();
}
