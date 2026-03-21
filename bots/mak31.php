<?php#*wataw*

if($start=="non"){
$start="
اهلا بك عزيزي في بوت معرفة نسبة جمالك
ارسل صورتك للبوت وسوف يرسل لك نسبة جمالك البوت امن ولا يحفظ الصور
";}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$user_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;

if($text == '/start'){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,]);}

$ameer = rand(1,100);
if($message->photo){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"نسبة جمال الصوره هوه : $ameer %",
'reply_to_message_id'=>$message->message_id,]);}
