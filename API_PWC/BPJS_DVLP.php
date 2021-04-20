<?php 
   $kode_sep = "0001699489427";
   $data = "1954";
   $secretKey = "3wI4D0BC26";
   $tg1 = date("Y-m-d");
   $url = "https://new-api.bpjs-kesehatan.go.id/new-vclaim-rest/Peserta/nokartu/$kode_sep/";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
   $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
 
   // urlencode…
   $encodedSignature = urlencode($encodedSignature);
 
   echo "X-cons-id: " .$data ." ";
   echo "X-timestamp:" .$tStamp ." ";
   echo "X-signature: " .$encodedSignature;
   echo"<hr>";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_HTTPHEADER,array(
        "X-cons-id: $data",
        "X-timestamp:$tStamp",
        "X-signature:$encodedSignature"
    ));
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch , CURLOPT_URL ,$url.$kode_sep);
$send = curl_exec($ch);
    if($send===false){
        die("error fetching data: ".curl_error($ch));

    }
    
    echo"<p></p>";
        echo htmlspecialchars("$send" , ENT_QUOTES);

?>