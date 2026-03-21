<?php#*wataw*

if($start=="non"){
$start="
👋🏻 أهلاً بك ..
▫️ في بوت كشف نسبة الرجوله .
◾ أضغط على زر كشف لكشف النسبة .
";}

$update  = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text= $message->text;
$chat_id = $message->chat->id;
$message_id  = $message->message_id;
$data= $update->callback_query->data;
$Mid = $update->callback_query->message->message_id;
$chat_id2= $update->callback_query->message->chat->id;

if($text == '/start'){
bot('SendMessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- كشف .','callback_data'=>"numbr"]],
]])]);}

if($data == 'numbr'){
$num = ['45','89','98','34','25','77','64','52','100'];
$lovnum = array_rand($num,1);
$numlov = $num[$lovnum];
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$Mid,
'text'=>"
- نسبة الرجوله الي بيك : $numlov% 😂💕.

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'كشف مرهً اخرئ.','callback_data'=>"numbr"]],
]])]);}


