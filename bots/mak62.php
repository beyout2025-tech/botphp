<?php#*wataw*

$update = json_decode(file_get_contents('php://input'));
$re = $update->message->reply_to_message;
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$name = $message->from->first_name;
$from_id = $message->from->id;

$smsm = json_decode(file_get_contents("smsm.json"),1);
if($re and $text){
bot('sendmessage',['chat_id'=>$admin,
'text'=>"⌯ اهلا عزيزي المطور
⌯ هنالك رد تم اضافته جديد
⌯ الرد : $re->text
⌯ نص الرد : $text
",]);
$smsm['smsm'][$re->text] = $text;
file_put_contents("smsm.json",json_encode($smsm));}

if($text){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>$smsm['smsm'][$text],
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,]);}

if($text == "/start"){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"⌯ اهلا عزيزي : $name
⌯ في بوت سمسمي الان اضفني في كروبك

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,]);}

