<?php
/* TOKEN SET  */
$char = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y",
                          "Z","a","b","c","d","e","f","g","h","j","k","l","m","n","p","q","r","s","t","u","v","w","x",
                          "y","z","1","2","3","4","5","6","7","8","9");
$keys = array();
while(count($keys) <= 10) {
    $x = mt_rand(0, count($char)-1);
    if(!in_array($x, $keys)) {
       $keys[] = $x;  
    }          
}
$token = '';
foreach($keys as $key => $val){
   $token .= $char[$val];  
}
$token_sw = $_SESSION['token'] = $token;
    echo"$token_sw";
?>