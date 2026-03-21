<?php#*wataw*

if($start == "non"){
$start = "
- مرحبا بك ،
• في بوت كشف نسبة الحب والثقه ♥️🙎🏻‍♀️،
• كل ماعليك هو ارسال اسمك واسم حبيبك ، مثل : ( محمد و تبارك) 🖤 ،
";}

$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$text = $message->text;
$name = $message->from->first_name;
$name = $message->from->first_name;
$user = $message->from->username;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;

if ($text == '/start' ){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,]);}

$r = rand(0,99);
if($text and $text !=='/start' and $text !=='/admin' and $text !== "محمد و تبارك" and $text !== 'محمد تبارك' and $text !== "تبارك و محمد" and $text !== 'تبارك محمد'){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"نسبة الحب والثقه بين $text 👇🏿",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"%$r  ♥️",'url'=>"https://t.me/bxxbot"]]
]])]);}
    
if($text == "محمد و تبارك" or $text == 'محمد تبارك' or $text == "تبارك و محمد" or $text == 'تبارك محمد' and $text !=='/start' and $text !=='/admin'){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"نسبة الحب والثقه بين $text 👇🏿",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"%100 ♥️",'url'=>"https://t.me/bxxbot"]]
]])]);}

