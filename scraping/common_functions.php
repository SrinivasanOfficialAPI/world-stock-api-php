<?php
include_once("simple_html_dom.php");

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

function getWorldStockArray($stockCat)
{
	$html = getHtmlFromUrl("https://www.tradingview.com/markets/world-stocks/$stockCat/");
	$table = $html->find(".table-Ngq2xrcG tbody", 0);
	$outputArr = [];
	for ($x = 0; $x <= 100; $x++) {
		$tableTrData = $table->find(".row-RdUXZpkv tr:nth-child($x)", $x);
		if ($tableTrData) {

			$td0 = $tableTrData->find("td:nth-child(1) span sup", 0)->plaintext;
			$td2 = $tableTrData->find("td", 2)->plaintext;
			$td3 = $tableTrData->find("td", 3)->plaintext;
			$td4 = $tableTrData->find("td", 4)->plaintext;
			$td5 = $tableTrData->find("td", 5)->plaintext;
			$td6 = $tableTrData->find("td", 6)->plaintext;
			$td7 = $tableTrData->find("td", 7)->plaintext;
			$td8 = $tableTrData->find("td", 8)->plaintext;
			$td9 = $tableTrData->find("td", 9)->plaintext;
			$td10 = $tableTrData->find("td", 10)->plaintext;
			$td11 = $tableTrData->find("td", 11)->plaintext;
			$td12 = $tableTrData->find("td", 12)->plaintext;
			$td13 = $tableTrData->find("td", 13)->plaintext;

			$case1 = array("worlds-largest-companies", "worlds-non-us-companies", "worlds-largest-oil-and-gas-companies", "worlds-largest-semiconductors-producers", "worlds-largest-telecommunication-companies", "worlds-largest-tech-companies", "worlds-largest-biotech-companies", "worlds-largest-finance-companies", "worlds-largest-banks", "worlds-largest-e-commerce-companies", "worlds-largest-software-companies", "worlds-largest-automakers", "worlds-largest-hotels-and-resorts", "worlds-largest-restaurant-chains", "worlds-largest-stores", "worlds-largest-beverage-companies", "worlds-largest-food-companies");

			$case2 = array("worlds-largest-employers", "worlds-highest-revenue", "worlds-highest-revenue-per-employee", "worlds-highest-profit-per-employee", "worlds-highest-earnings", "worlds-highest-dividends");


			switch ($stockCat) {

				case in_array($stockCat, $case1):
					$outputArr[] = array(
						"companyName" => $td0,
						"exchange" => $td2,
						"marketCaptitalization" => $td3,
						"price" => $td4,
						"priceChange" => $td5,
						"volume" => $td6,
						"relativeVolume" => $td7,
						"priceToEarningsRatio" => $td8,
						"epsDiluted" => $td9,
						"epsDilutedGrowth" => $td10,
						"dividentYeild" => $td11,
						"sector" => $td12,
						"analystRating" => $td13,
					);
					break;

				case in_array($stockCat, $case2):
					$colName1 = "";

					if ($stockCat == "worlds-largest-employers") {
						$colName1 = "numberOfEmployees";
					} else if ($stockCat == "worlds-highest-revenue") {
						$colName1 = "totalRevenue";
					} else if ($stockCat == "worlds-highest-revenue-per-employee") {
						$colName1 = "revenuePerEmployee";
					} else if ($stockCat == "worlds-highest-profit-per-employee") {
						$colName1 = "netIncomePerEmployee";
					} else if ($stockCat == "worlds-highest-earnings") {
						$colName1 = "netIncome";
					} else if ($stockCat == "worlds-highest-dividends") {
						$colName1 = "dividentYeild";
					}

					$td14 = $tableTrData->find("td", 14)->plaintext;
					$outputArr[$x] = array(
						"companyName" => $td0,
						"exchange" => $td2,
						"price" => $td4,
						"priceChange" => $td5,
						"volume" => $td6,
						"relativeVolume" => $td7,
						"marketCaptitalization" => $td8,
						"priceToEarningsRatio" => $td9,
						"epsDiluted" => $td10,
						"epsDilutedGrowth" => $td11,
						"dividentYeild" => $td12,
						"sector" => $td13,
						"analystRating" => $td14,
					);
					$outputArr[$x][$colName1] = $td3;
					break;
			}
		}
	}
	return $outputArr;
}

function getCountryStockArray($stockCat, $countryParam)
{
	$html = getHtmlFromUrl("https://www.tradingview.com/markets/$countryParam/$stockCat/");
	$table = $html->find(".table-Ngq2xrcG tbody", 0);

	$outputArr = [];
	for ($x = 0; $x <= 100; $x++) {
		$tableTrData = $table->find(".row-RdUXZpkv tr:nth-child($x)", $x);
		if ($tableTrData) {

			$td0 = $tableTrData->find("td:nth-child(1) span sup", 0)->plaintext;
			$td1 = $tableTrData->find("td", 1)->plaintext;
			$td2 = $tableTrData->find("td", 2)->plaintext;
			$td3 = $tableTrData->find("td", 3)->plaintext;
			$td4 = $tableTrData->find("td", 4)->plaintext;
			$td5 = $tableTrData->find("td", 5)->plaintext;
			$td6 = $tableTrData->find("td", 6)->plaintext;
			$td7 = $tableTrData->find("td", 7)->plaintext;
			$td8 = $tableTrData->find("td", 8)->plaintext;
			$td9 = $tableTrData->find("td", 9)->plaintext;
			$td10 = $tableTrData->find("td", 10)->plaintext;
			$td11 = $tableTrData->find("td", 11)->plaintext;

			$case1 = array("market-movers-large-cap", "market-movers-small-cap", "market-movers-gainers", "market-movers-losers", "market-movers-unusual-volume", "market-movers-most-expensive", "market-movers-penny-stocks", "market-movers-ath", "market-movers-atl", "market-movers-52wk-high", "market-movers-52wk-low");

			$case2 = array("market-movers-largest-employers", "market-movers-high-dividend", "market-movers-highest-net-income", "market-movers-highest-cash", "market-movers-highest-profit-per-employee", "market-movers-highest-revenue-per-employee", "market-movers-active", "market-movers-most-volatile", "market-movers-high-beta", "market-movers-best-performing", "market-movers-highest-revenue", "market-movers-overbought", "market-movers-oversold");

			switch ($stockCat) {
				case in_array($stockCat, $case1):
					$outputArr[] = array(
						"companyName" => $td0,
						"marketCaptitalization" => $td1,
						"price" => $td2,
						"priceChange" => $td3,
						"volume" => $td4,
						"relativeVolume" => $td5,
						"priceToEarningsRatio" => $td6,
						"epsDiluted" => $td7,
						"epsDilutedGrowth" => $td8,
						"dividentYeild" => $td9,
						"sector" => $td10,
						"analystRating" => $td11
					);

					if ($stockCat == "market-movers-gainers" || $stockCat == "market-movers-losers") {
						$outputArr[$x]["priceChange"] = $td1;
						$outputArr[$x]["price"] = $td2;
						$outputArr[$x]["marketCaptitalization"] = $td5;
						$outputArr[$x]["volume"] = $td3;
						$outputArr[$x]["relativeVolume"] = $td4;
					} else if ($stockCat == "market-movers-unusual-volume") {
						$outputArr[$x]["relativeVolume"] = $td1;
						$outputArr[$x]["marketCaptitalization"] = $td5;
					} else if (($stockCat == "market-movers-most-expensive") || ($stockCat == "market-movers-penny-stocks") || ($stockCat == "market-movers-ath") || ($stockCat == "market-movers-atl") || ($stockCat == "market-movers-52wk-high") || ($stockCat == "market-movers-52wk-low")) {
						$outputArr[$x]["price"] = $td1;
						$outputArr[$x]["priceChange"] = $td2;
						$outputArr[$x]["volume"] = $td3;
						$outputArr[$x]["relativeVolume"] = $td4;
						$outputArr[$x]["marketCaptitalization"] = $td5;
					}

					break;
				case in_array($stockCat, $case2):
					$colName1 = "";

					if ($stockCat == "market-movers-largest-employers") {
						$colName1 = "numberOfEmployees";
					} else if ($stockCat == "market-movers-high-dividend") {
						$colName1 = "dividentYeildIndicated";
					} else if ($stockCat == "market-movers-highest-net-income") {
						$colName1 = "netIncome";
					} else if ($stockCat == "market-movers-highest-cash") {
						$colName1 = "cashAndShortTermInvestment";
					} else if ($stockCat == "market-movers-highest-profit-per-employee") {
						$colName1 = "netIncomePerEmployee";
					} else if ($stockCat == "market-movers-highest-revenue-per-employee") {
						$colName1 = "revenuePerEmployee";
					} else if ($stockCat == "market-movers-active") {
						$colName1 = "volumePriceOneDay";
					} else if ($stockCat == "market-movers-most-volatile") {
						$colName1 = "volatility";
					} else if ($stockCat == "market-movers-high-beta") {
						$colName1 = "betaOneYear";
					} else if ($stockCat == "market-movers-best-performing") {
						$colName1 = "performancePercentage";
					} else if ($stockCat == "market-movers-highest-revenue") {
						$colName1 = "totalRevenue";
					} else if ($stockCat == "market-movers-overbought" || $stockCat == "market-movers-oversold") {
						$colName1 = "relativeStrengthIndex";
					}

					$td12 = $tableTrData->find("td", 12)->plaintext;

					$outputArr[$x] = array(
						"companyName" => $td0,
						"price" => $td2,
						"priceChange" => $td3,
						"volume" => $td4,
						"relativeVolume" => $td5,
						"marketCaptitalization" => $td6,
						"priceToEarningsRatio" => $td7,
						"epsDiluted" => $td8,
						"epsDilutedGrowth" => $td9,
						"dividentYeild" => $td10,
						"sector" => $td11,
						"analystRating" => $td12
					);
					$outputArr[$x][$colName1] = $td1;
					break;
			}
		}
	}


	return $outputArr;
}