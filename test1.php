<?php

# An HTTP POST request example

# a pass-thru script to call my Play server-side code.
# currently needed in my dev environment because Apache and Play run on
# different ports. (i need to do something like a reverse-proxy from
# Apache to Play.)

# the POST data we receive from Sencha (which is not JSON)
$name="name";
$lastname="mudzimuirema";
$order=mt_rand(100000, 999999);
$country="ZW";
$currency="USD";
$amount="521";
$callback_url="www.google.com";
$email="tatekevvy@gmail.com";
$contact="263777222265";
$vendor_id= "102334229AQE401";
$callback_url="www.akellobooks.com"; 
  
  
  
  $data = array( 
                        "first_name"=>$name,
			"last_name"=>$lastname,
			"order_number"=>$order,
			"country"=>$country,
			"currency"=>$currency,
			"amount"=>$amount,
			"redirect_url"=>$callback_url,
			"email_address"=>$email,
			"mobile_number"=>$contact,
			"vendor_id" => $vendor_id,
			"callback_url"=>$callback_url
  );

# data needs to be POSTed to the Play url as JSON.
$data_string = json_encode($data);

$url = 'http://34.249.120.94:8080/payonline/buyonline/transactions/';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//execute post
$result = curl_exec($ch);


//close connection
curl_close($ch);

$result = filter_var($result, FILTER_SANITIZE_URL);

//$content = strip_tags($result);
//$link = file_get_contents($content);

echo $result;



?>