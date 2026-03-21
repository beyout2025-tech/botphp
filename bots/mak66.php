<?php#*wataw*

$message = $update->message;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$name = $message->from->first_name; $text =
$message->text;
$mid = $message->message_id;
$name2 = $update->callback_query->from->first_name;
$message_id2 = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$from_id2 = $update->callback_query->from->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;


if($text == '/start'){
file_put_contents($chat_id,'');
 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- أهلا بك عزيزي: $name
- في بوت صنع فيزات وهمية .
- اولا قم بتعيين الـ Bin الخاص بك بعدها قم بصنع فيزات .

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- تعيين الـ Bin .','callback_data'=>'putBin']],[['text'=>'- صنع فيزات .','callback_data'=>'makev']],
],
])
]);
}
if($data == 'putBin'){
file_put_contents($chat_id2,'putBin');
bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- حسنا عزيزي قم بأرسال الـ Bin الخاص بك .\n- ملاحظة : يمكنك ارسال Bin متكون من 6 ارقام فقط .\n- مثال على الـ Bin => 123456 .",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- رجوع .','callback_data'=>'backkk']],
],
])
]);
}
$brokc = file_get_contents($chat_id);
if($text and $text != '/start' and $brokc == 'putBin'){
bot('sendMessage' ,[
'chat_id'=>$chat_id,
'text'=>"- حسنا عزيزي تم تعيين $text البن الخاص بك .",
'parse_mode'=>"markdown",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- رجوع .','callback_data'=>'backkk']],
],
])
]);
file_put_contents("$chat_id.txt",$text);
unlink($chat_id);
}
$Bin = file_get_contents("$chat_id2.txt"); 
if($data == 'makev' and $Bin != ''){
$codes = ['1','2','3','4','5','6','7','8','9','0'];
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$monthcode = ['01','02','03','04','05','06','07','08','09','10','11','12'];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearcode = ['2022','2023','2024','2025','2026'];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode1 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode2 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode3 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode4 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode5 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode6 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode7 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode8 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
$code1 = array_rand($codes,1);
$code2 = array_rand($codes,1);
$code3 = array_rand($codes,1);
$code4 = array_rand($codes,1);
$code5 = array_rand($codes,1);
$code6 = array_rand($codes,1);
$code7 = array_rand($codes,1);
$code8 = array_rand($codes,1);
$code9 = array_rand($codes,1);
$code10 = array_rand($codes,1);
$bcode1 = $codes[$code1];
$bcode2 = $codes[$code2];
$bcode3 = $codes[$code3];
$bcode4 = $codes[$code4];
$bcode5 = $codes[$code5];
$bcode6 = $codes[$code6];
$bcode7 = $codes[$code7];
$bcode8 = $codes[$code8];
$bcode9 = $codes[$code9];
$bcode10 = $codes[$code10];
$montherand = array_rand($monthcode,1);
$monthebrok = $monthcode[$montherand];
$yearrand = array_rand($yearcode,1);
$yearbrok = $yearcode[$yearrand];
$brok = "$bcode3$bcode10$bcode5";
$bfcode9 = "$Bin$bcode1$bcode2$bcode3$bcode4$bcode5$bcode6$bcode7$bcode8$bcode9$bcode10|$monthebrok|$yearbrok|$brok";
bot ('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"`$bfcode\n$bfcode1\n$bfcode2\n$bfcode3\n$bfcode4\n$bfcode5\n$bfcode6\n$bfcode7\n$bfcode8\n$bfcode9`\n- - - - -\n- BY => @YYYYi .", 
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- صنع فيزات مرة اخرى .','callback_data'=>'makev']],
[['text'=>'- رجوع .','callback_data'=>'backkk']],
[['text'=>"- اضغط هنا لفحص الفيزات .",'url'=>"https://www.mrchecker.net/card/ccn2/"]], 
],
])
]);
}

if($data == 'makev' and $Bin == ''){
bot('EditMessageText',[
'chat_id'=>$chat_id2, 
'message_id'=>$message_id2, 
'text'=>"- يجب عليك وضع Bin اولا.",
'parse_mode'=>"markdown",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- تعيين الـ Bin .','callback_data'=>'putBin']],
], 
])
]);
} 
if($data == 'backkk'){
file_put_contents($chat_id2,'');
 bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2, 
'text'=>"- أهلا بك عزيزي: $name
- في بوت صنع فيزات وهمية .
- اولا قم بتعيين الـ Bin الخاص بك بعدها قم بصنع فيزات .

$txtfree",
'parse_mode'=>"html",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- تعيين الـ Bin .','callback_data'=>'putBin']],
[['text'=>'- صنع فيزات .','callback_data'=>'makev']],
],
])
]);
}
