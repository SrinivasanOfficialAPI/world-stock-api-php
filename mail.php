<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_POST) {
	$data = json_encode($_POST, JSON_FORCE_OBJECT);

	$to = "info@rootcoir.com";
	$subject = "Contact US - Rootcoir";

	$message =
		"
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table style='text-align : left;'>
<tbody>
<tr>
<th>Full Name</th>
<td style='width:30px;text-align : center;'>:</td>
<td>" .
		$data["form_full_name"] .
		"</td>
</tr>
<tr>
<th>Company Name</th>
<td style='width:30px;text-align : center;'>:</td>
<td>" .
		$data["form_company_name"] .
		"</td>
</tr>
<tr>
<th>Email</th>
<td style='width:30px;text-align : center;'>:</td>
<td>" .
		$data["form_email"] .
		"</td>
</tr>
<tr>
<th>Phone</th>
<td style='width:30px;text-align : center;'>:</td>
<td>" .
		$data["form_phone"] .
		"</td>
</tr>
<tr>
<th>Message</th>
<td style='width:30px;text-align : center;'>:</td>
<td>" .
		$data["form_message"] .
		"</td>
</tr>
</tbody>
</table>
</body>
</html>
";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= "From: <info@rootcoir.com>" . "\r\n";

	if (mail($to, $subject, $message, $headers)) {
		$outputJson = [
			"status" => "success",
			"message" => "Mail Send Successfully"
		];
		echo json_encode($outputJson, JSON_UNESCAPED_SLASHES);
		exit();
	} else {
		$outputJson = [
			"status" => "error",
			"message" => "Error Occurred while sending mail"
		];
		header("HTTP/1.1 500 Internal Server Error");
		echo json_encode($outputJson, JSON_UNESCAPED_SLASHES);
		exit();
	}
} else {
	$outputJson = [
		"status" => "error",
		"message" => "Only POST Request allowed"
	];
	header("HTTP/1.1 500 Internal Server Error");
	echo json_encode($outputJson, JSON_UNESCAPED_SLASHES);
	exit();
}

?>