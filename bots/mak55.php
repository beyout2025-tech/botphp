<?php#*wataw*

ini_set('show_errors', 1);
error_reporting(E_ALL);

function save($array){
file_put_contents('fi.json', json_encode($array));}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$name = $message->from->first_name;
$message_id = $update->callback_query->message->message_id;
$from_id = $message->from->id;
$username = $message->from->username;
$id = isset($update->callback_query) ? $update->callback_query->from->id : $update->message->from->id;
$tc = json_decode(file_get_contents('fi.json'),1);
$photo = "https://sssbs56.000webhostapp.com/Api-SssQs/Api.php?text1=$text&text2=$tc[$chat_id]";

if($text == "/start"){
bot('sendphoto',['chat_id'=>$chat_id,
'photo'=>"https://k.top4top.io/p_2016oc8k11.jpg",
'parse_mode'=>'Markdown',
'reply_to_message_id'=>$message->message_id,]);}

if($text == "/start"){
unset($twice[$chat_id]);
save($twice);
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"
- أهلاً بك: $name
- في بوت التصميم بالسناب. 
قم بأرسال الأسم الاول لوضعه على الصورة ✨،
#ملاحظه : يمكن استخدام اللغه العربيه او الانكلش

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
]);}

if($text != null and $text != '/start' and !isset($tc[$chat_id])){
$tc[$chat_id] = $text;
save($tc);
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>'- تم حفظ الأسم الاول ، الان قم بأرسال الأسم الثاني 👇🏽،']);
} elseif($text != null and $text != '/start' and isset($tc[$chat_id])){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>'• جاري التصميم انتظر قليلاً . . . 💚']);
bot('sendphoto',['chat_id'=>$chat_id, 
'photo'=>$photo,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- قناة البوت ، ⚜",'url'=>"t.me/yyyyi"]]]])]);
unset($tc[$chat_id]);
save($tc);}
