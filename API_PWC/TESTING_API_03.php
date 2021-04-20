<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    // base64 encodes the header json
    //$encoded_header = base64_encode('{"alg": "HS256","typ": "JWT"}');
    $encoded_header = base64_encode("PWC1001");

    // base64 encodes the payload json
    $encoded_payload = base64_encode("1001PWC");
    //$encoded_payload = base64_encode('{"country": "Romania","name": "RSPWC1001","email": "daftarpwc@gmail.com"}');

    // base64 strings are concatenated to one that looks like this
    $header_payload = "$encoded_header-$encoded_payload";

    //Setting the secret key
    $secret_key = 'RSPWC1001';

    // Creating the signature, a hash with the s256 algorithm and the secret key. The signature is also base64 encoded.
    $signature = base64_encode(hash_hmac('sha256', $header_payload, $secret_key, true));

    // Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
    $jwt_token = "$header_payload-$signature";

    //listing the resulted  JWT
    //echo $jwt_token;
    ///-----////
    if($jwt_token!=="UFdDMTAwMQ==-MTAwMVBXQw==-DJkjm2REQl9+fpWBQxlMEEgOcfxY2zP+dIZNqrEz0Ro="){
        $json_jwt = array(
            'response_code' => '202',
            'response_code_desc' => 'API Key Wroong'
        );  
        }else{
            $json_jwt = array(
                
                'response' => 'API Key Correct',
                'token' => $jwt_token
                //'token_pass' => $token_pass
                
            );  
        }
        $userdata= json_encode($json_jwt);
            //echo "{\"bill\":" . $edata ."}";
            echo "$userdata";
?> 