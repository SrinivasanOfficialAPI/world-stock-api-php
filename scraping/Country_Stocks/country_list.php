<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allow specific headers
header("Content-Type: application/json; charset=UTF-8"); // Specify JSON response format
include_once("../common_functions.php");

$tempArr = array('stocks-usa', 'stocks-canada', 'stocks-austria', 'stocks-belgium', 'stocks-switzerland', 'stocks-cyprus', 'stocks-czech', 'stocks-germany', 'stocks-denmark', 'stocks-estonia', 'stocks-spain', 'stocks-finland', 'stocks-france', 'stocks-greece', 'stocks-hungary', 'stocks-iceland', 'stocks-italy', 'stocks-lithuania', 'stocks-latvia', 'stocks-luxembourg', 'stocks-netherlands', 'stocks-norway', 'stocks-poland', 'stocks-portugal', 'stocks-serbia', 'stocks-russia', 'stocks-romania', 'stocks-sweden', 'stocks-slovakia', 'stocks-turkey', 'stocks-united-kingdom', 'stocks-uae', 'stocks-bahrain', 'stocks-egypt', 'stocks-israel', 'stocks-kenya', 'stocks-kuwait', 'stocks-morocco', 'stocks-nigeria', 'stocks-qatar', 'stocks-ksa', 'stocks-tunisia', 'stocks-south-africa', 'stocks-argentina', 'stocks-brazil', 'stocks-chile', 'stocks-colombia', 'stocks-mexico', 'stocks-peru', 'stocks-venezuela', 'stocks-australia', 'stocks-bangladesh', 'stocks-china', 'stocks-hong-kong', 'stocks-indonesia', 'stocks-india', 'stocks-japan', 'stocks-korea', 'stocks-sri-lanka', 'stocks-malaysia', 'stocks-new-zealand', 'stocks-philippines', 'stocks-pakistan', 'stocks-singapore', 'stocks-thailand', 'stocks-taiwan', 'stocks-vietnam');


$outputArr = [];
foreach ($tempArr as $val) {
	$countryCode = str_replace('stocks-', '', $val);
	$samArr = array(
		'countryCode' => ucfirst($countryCode),
		'countryParam' => $val
	);
	array_push($outputArr, $samArr);
}

$outputJsonArr = array('status' => 'success', 'data' => $outputArr);
echo json_encode($outputJsonArr, JSON_UNESCAPED_SLASHES);
exit();
