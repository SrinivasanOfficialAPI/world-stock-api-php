<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allow specific headers
header("Content-Type: application/json; charset=UTF-8"); // Specify JSON response format
include_once("simple_html_dom.php");

$stockType = (!empty($_GET) && isset($_GET['stockCategory'])) ? $_GET['stockCategory'] : 'worlds-largest-companies';

function getHtmlFromUrl($url)
{
	// initialize a cURL session
	$curl = curl_init();

	// set the website URL
	curl_setopt($curl, CURLOPT_URL, $url);

	// return the response as a string
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	// follow redirects
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

	// ignore SSL verification (not recommended in production)
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	// execute the cURL session
	$htmlContent =  curl_exec($curl);
	curl_close($curl);

	// create a new Simple HTML DOM instance and parse the HTML
	return str_get_html($htmlContent);
}

$html = getHtmlFromUrl("https://www.tradingview.com/markets/world-stocks/$stockType/");


$table = $html->find(".table-Ngq2xrcG tbody", 0);
$outputArr = [];
for ($x = 0; $x <= 100; $x++) {
	$tableTrData = $table->find(".row-RdUXZpkv tr:nth-child($x)", $x);
	if ($tableTrData) {
		$companyName = $tableTrData->find('td:nth-child(1) span sup', 0)->plaintext;
		$exchange = $tableTrData->find('td:nth-child(3) span[title]', 0)->plaintext;
		$marketCap = $tableTrData->find('td', 3)->plaintext;
		$price = $tableTrData->find('td', 4)->plaintext;
		$priceChnage = $tableTrData->find('td', 5)->plaintext;
		$volume = $tableTrData->find('td', 6)->innertext;
		$relativeVolume = $tableTrData->find('td', 7)->innertext;
		$priceToEarningsRatio = $tableTrData->find('td', 8)->innertext;
		$epsDiluted = $tableTrData->find('td', 9)->plaintext;
		$epsDilutedGrowth = $tableTrData->find('td', 10)->plaintext;
		$dividentYeild = $tableTrData->find('td', 11)->innertext;
		$sector = $tableTrData->find('td', 12)->plaintext;
		$analystRating = $tableTrData->find('td', 13)->plaintext;

		$outputArr[] = array(
			'companyName' => $companyName,
			'exchange' => $exchange,
			'marketCaptitalization' => $marketCap,
			'price' => $price,
			'priceChange' => $priceChnage,
			'volume' => $volume,
			'relativeVolume' => $relativeVolume,
			'priceToEarningsRatio' => $priceToEarningsRatio,
			'epsDiluted' => $epsDiluted,
			'epsDilutedGrowth' => $epsDilutedGrowth,
			'dividentYeild' => $dividentYeild,
			'sector' => $sector,
			'analystRating' => $analystRating,
		);
	}
}

// echo '<pre>';
// print_r($outputArr);

$outputJsonArr = array('status' => 'success', 'data' => $outputArr);
echo json_encode($outputJsonArr, JSON_UNESCAPED_SLASHES);
exit();
