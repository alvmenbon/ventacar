<?php 


  
  $sltmarcas = $_POST['id'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api.autoscout24.com/makes/".$sltmarcas."/models",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
	    "X-AS24-Version: 1.1", 
        "Accept-Language: en-GB",
		"Content-Type: application/json",
		"Accept: application/json"

	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//print_r( $response);
	$json = json_decode($response, true);
    $_data =($json['_data']);
    $modelo = $_data['models'];
	
 echo (json_encode($modelo));

}


?>