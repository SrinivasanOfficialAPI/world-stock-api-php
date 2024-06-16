<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allow specific headers
header("Content-Type: application/json; charset=UTF-8"); // Specify JSON response format
include_once("../common_functions.php");

$eftUrl = "funds-highest-expense-ratio";
$totCol = 10;
$colArr = array("stockName", "expenseratio", "price", "priceChange", "volumePrice", "relativeVolume", "assetsUnderManagement", "NAVTotalReturn", "assetClass", "focus");

$outputArr = getEftStocks($eftUrl, $colArr, $totCol);

$outputJsonArr = array('status' => 'success', 'data' => $outputArr);
echo json_encode($outputJsonArr, JSON_UNESCAPED_SLASHES);
exit();
