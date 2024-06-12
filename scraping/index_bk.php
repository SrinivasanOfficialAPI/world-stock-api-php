<?php
ini_set('memory_limit', '1000M');
// include the Simple HTML DOM parser library
include_once("simple_html_dom.php");

// specify the target website's URL
$url = "https://www.tradingview.com/markets/world-stocks/worlds-largest-companies/";

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
$htmlContent = curl_exec($curl);

// check for errors
if ($htmlContent === false) {
    // handle the error
    $error = curl_error($curl);
    echo "cURL error: " . $error;
    exit;
}

// close cURL session
curl_close($curl);

// create a new Simple HTML DOM instance and parse the HTML
$html = str_get_html($htmlContent);

// echo $html;
$table = $html->find(".table-Ngq2xrcG tbody", 0);
for ($x = 0; $x <= 100; $x++) {
    $name = $table->find(".row-RdUXZpkv tr:nth-child($x)", $x);
    $temp = ($name) ? $name->find('td:nth-child(1) span sup', 0)->plaintext : ' -- ';
    echo $temp . '<br/>';
}

exit();


for ($x = 0; $x < 100; $x++) {
    $name = $html->find(".table-Ngq2xrcG .row-RdUXZpkv td:nth-child(1) .tickerDescription-GrtoTeat", $x)->plaintext;
    $exchangeName = $html->find(".table-Ngq2xrcG tbody tr td:nth-child(3) .apply-common-tooltip", $x)->plaintext;
    echo $name . ' --- ' . $exchangeName . '<br/>';
}

exit();
foreach ($name as $article) {
    $item['title']     = $article->find('div.title', 0)->plaintext;
    $articles[] = $item;
}

// print_r($articles);
exit();

// find the first product's name
$name = $html->find(".tickerDescription-GrtoTeat", 0);

// find the first product image
$image = $html->find("img", 0);

// find the first product's price
$price = $html->find("span.price", 0);

// decode the HTML entity in the currency symbol
$decodedPrice = html_entity_decode($price->plaintext);

// print the extracted data
echo "Name: $name->plaintext \n";
echo "Price: $decodedPrice \n";
echo "Image URL: $image->src \n";

// clean up resources
$html->clear();
