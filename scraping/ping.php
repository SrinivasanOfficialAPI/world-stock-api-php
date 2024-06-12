<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allow specific headers
header("Content-Type: application/json; charset=UTF-8"); // Specify JSON response format

$outputJsonArr = array('status' => 'success', 'data' => 'API is working');
echo json_encode($outputJsonArr, JSON_UNESCAPED_SLASHES);
exit();