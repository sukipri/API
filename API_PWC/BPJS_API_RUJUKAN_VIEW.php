<?php 
	
   $kode_sep = "0173B0760120P000924";
   $data = "1954";
   $secretKey = "3wI4D0BC26";
   $tg1 = date("Y-m-d");
   $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
   $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
 
   // urlencode…
   //$encodedSignature = urlencode($encodedSignature);
 
   echo "X-cons-id: " .$data ." ";
   echo "X-timestamp:" .$tStamp ." ";
   echo "X-signature: " .$encodedSignature;
   echo"<hr>";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_HTTPHEADER,array(
        "X-cons-id: $data",
        "X-timestamp:$tStamp",
        "X-signature:$encodedSignature",
		"Content-Type: Application/JSON",          
       	"Accept: Application/JSON"
    ));
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch , CURLOPT_URL ,$url."Rujukan/$kode_sep");
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLPROTO_HTTPS , true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	//--//
	$send = curl_exec($ch);
	 $j_son = json_decode($send,true);
    if($send===false){
        die("error fetching data: ".curl_error($ch));

    }
   
    echo"<b>Meta data</b><br>";
        echo"$send";
		echo"<hr>";
		echo"<b>Array Get</b><br>";
			foreach($j_son['response']['rujukan'] as $baris){
				echo @$baris['kode'];
				echo"<br>";
				echo $baris['nama'];
				echo"<br>";
				//echo $baris['tglKunjungan'];
			}
			//echo phpinfo();

?>