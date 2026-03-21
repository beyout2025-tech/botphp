<?php#*wataw*

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$name = $message->from->first_name;
$message_id = $update->callback_query->message->message_id;
$from_id = $message->from->id;
$username = $message->from->username;

if($text == "/start"){
bot('sendphoto',['chat_id'=>$chat_id,
'photo'=>"https://sssass.ml/TTS/q4.php?T1=علي و زهراء&color=اسود",
'caption'=>"
- صمم اسمك واسم حبيبتك 🧡.
- التصميم: عربي و انكليزي 💛.
- مثل الصوره اعلاه 👆🏾.

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"html",
'disable_web_page_preview'=>true,]);}

if ($text != "/start"  and $chat_id != $admin ){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"⏳ جارٍ التصميم أنتظر قليلأ ♥️...",
'reply_to_message_id'=>$message->message_id,]);
bot("sendMediaGroup",["chat_id"=>$chat_id,
"media"=>json_encode([
['caption'=>"- أنت فرصة حلوه للتغاضي عن بشاعة الحياة 🥺♥️،", "type"=>"photo", "media" => "https://sssass.ml/TTS/q1.php?T1=$text&color=اسود"],
[ "type"=>"photo", "media" => "https://sssass.ml/TTS/q2.php?T1=$text&color=اسود"],
[ "type"=>"photo", "media" => "https://sssass.ml/TTS/q3.php?T1=$text&color=اسود"],
[ "type"=>"photo", "media" => "https://sssass.ml/TTS/q4.php?T1=$text&color=اسود"],
[ "type"=>"photo", "media" => "https://sssass.ml/TTS/q5.php?T1=$text&color=اسود"],
[ "type"=>"photo", "media" => "https://sssass.ml/TTS/q6.php?T1=$text&color=اصفر"],
]),]);
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"☑️ تم تصميم للاسم: $text
📢 لتصميم جديد أرسل اسمك واسم حبيبتك.
",]);}
