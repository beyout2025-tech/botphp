<?php#*wataw*

$update = json_decode(file_get_contents('php://input'));
$from_id = $update->message->from->id;
$chat_id = $update->message->chat->id;
$text = $update->message->text;
$message = $update->message;
$get_welc = file_get_contents('setwelc.txt');
$ex_welc = explode("\n", $get_welc);
$mid = $message->message_id;
$welc = file_get_contents('welcome.txt');
$get_ids = file_get_contents('ids.txt');
$ids = explode("\n", $get_ids);
$get_bc = file_get_contents('bc.txt');
$bc = explode("\n", $get_bc);
$count = count($ids);
$chat = file_get_contents('chat.txt');
$ex_chat = explode("\n", $chat);
$get_ban = file_get_contents('ban.txt');
$ban = explode("\n", $get_ban);
$reply = $message->reply_to_message->forward_from->id;
$count_ban = count($ban);
$get_fwd = file_get_contents('fwd.txt');
$ffwd = explode("\n", $get_fwd);
$fwd = $message->forward_from_chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$sudo = "$admin";
$rep = $message->reply_to_message;
$json = json_decode(file_get_contents('data.json'),true);
if ($text and !in_array($chat_id, explode("\n", file_get_contents('mem.txt')))) {
file_put_contents('mem.txt', $chat_id."\n",FILE_APPEND);}

if ($chat_id == $sudo || $chat_id2 == $sudo) {
if ($text == "/start" or $text == "/help") {
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"
👋🏻 أهلاً بك في بوتك الخاص بالتواصل 👮🏻.
⚠️ اليك الاوامر شكرا لتفعيلك خدماتنا 🌐

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'parse_mode'=>HTML,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'قائمة الاوامر 📃','callback_data'=>'commands']],
[['text'=>"المشتركين.",'callback_data'=>'mem'],['text'=>'المحظورين','callback_data'=>'bn']],
[['text'=>'اعدادات البوت ⚙️','callback_data'=>'se']],]])]);}

if ($data == 'back') {
unlink('mode.txt');
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"
👋🏻 أهلاً بك في بوتك الخاص بالتواصل 👮🏻.
⚠️ اليك الاوامر شكرا لتفعيلك خدماتنا 🌐

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'parse_mode'=>HTML,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'قائمة الاوامر 📃','callback_data'=>'commands']],
[['text'=>"المشتركين.",'callback_data'=>'mem'],['text'=>'المحظورين','callback_data'=>'bn']],
[['text'=>'اعدادات البوت ⚙️','callback_data'=>'se']],]])]);}

if ($data =='commands') {
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>'📋 قائمة اﻷوامر : 
⚠️ جميع هذه الإوامر مع الرد على الرسالة .

▫️حظر = لحظر عضو معين🚫.
▫️الغاء حظر = لالغاء الحظر عن العضو 🗑
▫️مع الاوامر الشفافة ادنى ..
-',
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"ازالة حظر الكل 🚫 ! ",'callback_data'=>'bd']],
[['text'=>'رجوع.','callback_data'=>'back']]
]])]);}

if ($data == 'se') {
unlink('mode.txt');
file_put_contents('setwelc.txt', ' ');
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"اليك اعدادات البوت الخاص بك ⚙️..
▫️ ↴ يمكنك تغيير رسالة الترحيب - `/start`.
▫️وايضا رسالة الرد عند أستلام الرسالة 📬.
-",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'تغير الترحيب ⚠️  ','callback_data'=>'starjt'],['text'=>'تغير الاستلام 📬  ','callback_data'=>'hwelc']],
[['text'=>'رجوع ','callback_data'=>'back']]
]])]);}

if($data == 'hwelc'){
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"ارسل رسالة التسليم الان 🗒",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'الغاء 🚫 .','callback_data'=>'se']]
]])]);file_put_contents('setwelc.txt', $chat_id2);}

if($text and in_array($from_id, $ex_welc)){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"تم تغير رسالة الاستلام 🗒  : $text",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'حفظ ورجوع ☑️ ','callback_data'=>'se']]
]])]);
file_put_contents('welcome.txt', $text);
file_put_contents('setwelc.txt', '');}

if($data == 'bn'){
$b = count(explode("\n", file_get_contents('bans.txt')));
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
 'text'=>"عدد الاعضاء المحظورين ( $b ) 🚫 
▫️ لايمكنهم ارسال رسالة الى البوت
▫️ لايمكنهم تلقي رسائل من البوت 
▫️ لا يمكنهم تفعيل اي خاصية من البوت ..",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"ازالة حظر الكل 🚫 ! ",'callback_data'=>'bd']],
[['text'=>"رجوع ",'callback_data'=>'back']],
]])]);}

if($data == 'bd'){
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"هل انت متاكد من حذف جميع المحظورين ؟ ❗️",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'لا 🚫 .','callback_data'=>'bn'],['text'=>'نعم ☑️ .','callback_data'=>'dd']]
]])]);}

if($data == "dd" ){
file_put_contents("bans.txt", "");
bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'message_id'=>$message_id,
'text'=>"تم ازالة جميع المحظورين 🗑",
'show_alert'=>true]);
unlink('mode.txt');
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"
👋🏻 أهلاً بك في بوتك الخاص بالتواصل 👮🏻.
⚠️ اليك الاوامر شكرا لتفعيلك خدماتنا 🌐

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'parse_mode'=>HTML,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'قائمة الاوامر 📃','callback_data'=>'commands']],
[['text'=>"المشتركين.",'callback_data'=>'mem'],['text'=>'المحظورين','callback_data'=>'bn']],
[['text'=>'اعدادات البوت ⚙️','callback_data'=>'se']],]])]);}

if ($data == 'mem') {
$c = count(explode("\n", file_get_contents('mem.txt')));
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
 'text'=>"عدد اعضاء بوتك هو ( $c ) 👥
▫️ ايضا يمكنك الرد على العضو بعمل رد عليه",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"رجوع ",'callback_data'=>'back']],
]])]);}

if ($text and file_get_contents('mode.txt') == 'data') {
 bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"تم ارسال رسالتك الى جميع الاعضاء 📃 ..
عدا المحظورين من البوت ( $b ) 🚫.
-",]);
for ($i=0; $i < count($c); $i++) {
bot('sendMessage',['chat_id'=>$c[$i],
'text'=>$text,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'اضغط للاشتراك بالقناة ♥️..','url'=>'t.me/yyyyi']],
]])]);}

$c = count(explode("\n", file_get_contents('mem.txt')));
unlink('mode.txt');}

if ($data == 'starjt' ){
file_put_contents('mode.txt', 'starjt');
bot('editMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"⚠️ حسنا عزيزي  ..
▫️الان ارسل رسالة الترحيب - `/start`
▫️حتى اقوم بتغيرها ووضعها في البوت ..
-",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'الغاء 🚫 .','callback_data'=>'se']]
]])]);}

if ($text and file_get_contents('mode.txt') == 'starjt') {
file_put_contents("start.txt",$text);
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"تم وضع رسالة الترحيب ♥️..
📩 الرسالة هي ( $text )
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'تغير الرسالة ♻️','callback_data'=>'starjt']],
[['text'=>'رجوع','callback_data'=>'se']]
]])]);unlink('mode.txt');}

if ($rep and $text != 'حظر' and $text != 'الغاء حظر') {
bot('sendMessage',[
'chat_id'=>$json['msgs'][$rep->text],
'text'=>$text]);}

if ($rep and $text == 'حظر') {
file_put_contents('bans.txt', $json['msgs'][$rep->text]."\n",FILE_APPEND);
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"تم الحظر بنجاح 🚫..",
'reply_to_message_id'=>$message->message_id,]);}

if ($rep and $text == 'الغاء حظر') {
file_put_contents('bans.txt', str_replace($json['msgs'][$rep->text], '', file_get_contents('bans.txt')));
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"تم الغاء الحظر بنجاح ✅..",
'reply_to_message_id'=>$message->message_id,
]);}} else {

if ($text == '/start') {
$name = $message->from->first_name;
$startp = file_get_contents('start.txt');
date_default_timezone_set('Asia/Baghdad');
$time = date('h:i');
$date = date('20y/m/d');
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"
👋🏻 أهلاً بك ( `$name` ) ♥️.

$startp \n\n📆 $time|$date

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'parse_mode'=>HTML,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'','url'=>'t.me/KKLBot']],]])]);}

$name = $message->from->first_name;
$username = $message->from->username;
if ($text != '/start' and !in_array($chat_id, explode("\n", file_get_contents('bans.txt')))) {
$json['msgs'][$text] = $chat_id;
file_put_contents("data.json", json_encode($json));
file_put_contents('welcome.txt');
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$welc

$txtfree",
'parse_mode'=>"MarkDown",
'parse_mode'=>HTML,
'disable_web_page_preview'=>true,  
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'اضغط للاشتراك بالقناة ♥️.','url'=>'t.me/yyyyi']],]])]);
bot('forwardMessage',['chat_id'=>$sudo,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id]);}

if ($text and in_array($chat_id, explode("\n", file_get_contents('bans.txt')))) {
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"انت محظور ولا يمكنك مراسلة البوت 👮🏻🚫..",
'reply_to_message_id'=>$message->message_id,]);}}

