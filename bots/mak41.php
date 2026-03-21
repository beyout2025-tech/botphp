<?php#*wataw*

if($start=="non"){
$start="
▪️ مرحبًا بكَ عزيزي في ToolS Bot .

▪️ يمكنك تحويل الصيغ وتغيير حقوق ملفات Mp3 مع ميزة النشر التلقائي .
";}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->userame;
$text = $message->text;
$admin = $admin;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;
$reply = $update->message->reply_to_message;
$id = $message->from->id;
$name = $message->from->first_name;
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->userame;
$text = $message->text;
$chatid = $update->callback_query->message->chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;
$reply = $update->message->reply_to_message;
$id = $message->from->id;
$name = $message->from->first_name;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$text= $message->text;
$firstname = $update->callback_query->from->first_name;
$usernames = $update->callback_query->from->username;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$membercall = $update->callback_query->id;
$reply = $update->message->reply_to_message->forward_from->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
$gpname = $update->callback_query->message->chat->title;
$namegroup = $update->message->chat->title;
$newchatmemberid = $update->message->new_chat_member->id;
$newchatmemberu = $update->message->new_chat_member->username;
$rt = $update->message->reply_to_message;
$replyid = $update->message->reply_to_message->message_id;
$tedadmsg = $update->message->message_id;
$edit = $update->edited_message->text;
$re_id = $update->message->reply_to_message->from->id;
$re_user = $update->message->reply_to_message->from->username;
$re_name = $update->message->reply_to_message->from->first_name;
$re_msgid = $update->message->reply_to_message->message_id;
$re_chatid = $update->message->reply_to_message->chat->id;
$message_edit_id = $update->edited_message->message_id;
$chat_edit_id = $update->edited_message->chat->id;
$edit_for_id = $update->edited_message->from->id;
$edit_chatid = $update->callback_query->edited_message->chat->id;
$caption = $update->message->caption;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$name = $message->from->first_name;
$user = $message->from->username;
$from_id = $message->from->id;
$name = $update->message->from->first_name;
$user = $message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
$from_id2 = $update->callback_query->from->id;
$data = $update->callback_query->data;
$forwardid = $update->message->forward_from->id;
$type = $update->message->chat->type;
$re_id = $update->message->reply_to_message->forward_from->id;
$re = $update->message->reply_to_message;
$message = $update->message;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$name = $message->from->first_name;
$user = $message->from->username;
$ybot= "YYYYi";
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$stats = json_decode(file_get_contents("stats.json"),true);
$name = $update->message->from->first_name;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$from_id = $message->from->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$from_id = $message->from->id;
$name = $update->message->from->first_name;
$from_id = $message->from->id;
$u = explode("\n",file_get_contents("memb.txt"));
$c = count($u)-1;
$modxe = file_get_contents("usr.txt");
$username = $update->message->from->username;
$reply = $message->reply_to_message->message_id;
$list = file_get_contents("blocklist.txt");
$rep = $message->reply_to_message->forward_from; 
$id = $rep->id; 
$photo = $message->photo;
$photo2_id = $photo[count($photo)-2]->file_id;
$sticker = $message->sticker;
$sticker_id = $sticker->file_id;
$voice = $message->voice;
$voice_id = $voice->file_id;
$audio = $message->audio;
$audio_id = $audio->file_id;
$video = $message->video;
$video_id = $video->file_id;
$document = $message->document;
$file_id = $document->file_id;
$caption = $message->caption;
$from = $message->from->id;

if (!is_dir('co')) {
mkdir('co');}

if ($text == '/start' ){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'➕ أضف قناتي.','callback_data'=>"chmempers"],['text'=>'➖ حذف قناتي.','callback_data'=>"delchmemper"]],
[['text'=>'♻️ تحويل الصيغ.','callback_data'=>"hkt"],['text'=>'تغيير حقوق Mp3','callback_data'=>"fma"]],
[['text'=>'شرح استخدام البوت ⁉️','callback_data'=>"helpp"]],
]])]);}

if($data == "hooh"){
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'➕ أضف قناتي.','callback_data'=>"chmempers"],['text'=>'➖ حذف قناتي.','callback_data'=>"delchmemper"]],
[['text'=>'♻️ تحويل الصيغ.','callback_data'=>"hkt"],['text'=>'تغيير حقوق Mp3','callback_data'=>"fma"]],
[['text'=>'شرح استخدام البوت ⁉️','callback_data'=>"helpp"]],
]])
]);
unset($stats[$chat_id2.'performer']);
unset($stats[$chat_id2.'title']);
unset($stats[$chat_id2.'thumb']);
unset($stats[$chat_id2.'caption']);
unset($stats[$chat_id2.'eDiMp3']);
unset($stats[$chat_id2.'chsend']);
unset($stats[$chat_id2.'chssend']);
unset($stats[$chat_id2.'chssend']);
}
if($data =='delchmemper' and !$stats[$chat_id2.'chsend']){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"- عذراً لا توجد قناة مضافه حاليآ.",
]);
}

if($data == "delchmemper" and $stats[$chat_id2.'chsend']){
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*▪️ تم حذف القناة بنجاح :*",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"رجوع",'callback_data'=>"hooh"]],
]])
]);
unset($stats[$chat_id2.'chsend']);
file_put_contents("stats.json",json_encode($stats));
}

if($data == "helpp"){
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>" ▪️ يمكنك تحويل الملصقات الى صور بصيغة تمكنك من أضافتها لحزمتك في البوت الرسمي.
▪️ يمكنك تحويل البصمة الى ملف صوتي والفيديو لملف صوتي ايضا.
▪️ يمكنك التعديل على ملفات الصوت وتغيير اسم الاغنية واسم الفنان والصورة المصغره الخاصة بلملف الصوتي.

▪️ النشر التلقائي :
▪️ يمكنك الاستفادة من هذه الميزة عند تحويل بصمة الى MP3 يمكنك تغير اسم الفنان + اسم الاغنية واضافة وصف كتابي + ماركدون ويتم نشرها مباشره في القناة الخاصة بك.

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"رجوع",'callback_data'=>"hooh"]],
]])
]);
}

if($data == "fma"){
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*- ارسل الي الان ملف MP3 للتعديل عليه وتغير اسم الفنان والاغنية مع ميزة النشر التلقائي*",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"رجوع",'callback_data'=>"hooh"]],
]])
]);
}

if($data == "hkt"){
bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"▪️قائمة التحويلات قم بأرسال :
1. *ملصق* ( صورة + ملف Png ).
2. *صورة* ( ملصق + ملف Png ).
3. *فيديو* ( متحركة ) ( موسيقى ).
4. *بصمة* ( ملف MP3 + تغير اسم الفنان واسم الاغنية ).
5. *موسيقى* ( بصمة صوتية ).
",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع",'callback_data'=>"hooh"]],
]])
]);
}

if($data == "chmempers"){
bot('EditMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>'
*▪️ قم بـ رفعي آدمن اولاً في القناة مع كامل الصلاحيات .
▪️ ومن ثم أرسل رسالة من القناه الى هنا عن طريق التوجيه .
⎯ ⎯ ⎯ ⎯*',
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء.','callback_data'=>"hooh"]],
]])
]);
$stats[$chat_id2.'chssend'] = "دز";
file_put_contents("stats.json",json_encode($stats));
}

$chid = $update->message->forward_from_chat->id;
if ($update->message->forward_from_chat and $stats[$chat_id.'chssend'] =="دز") {
$hassaN = json_decode(file_get_contents("http://api.telegram.org/bot".token."/getChat?chat_id=$chid"))->result;
$MuaeD = json_decode(file_get_contents("http://api.telegram.org/bot".token."/exportChatInviteLink?chat_id=$chid"))->result;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- تم اضافه قناتك في البوت.",
'disable_web_page_preview'=>true ,
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع','callback_data'=>"hooh"]],
]])
]);
$stats[$chat_id.'chsend'] = $update->message->forward_from_chat->id;
unset($stats[$chat_id.'chssend']);
file_put_contents("stats.json",json_encode($stats));
}

if($text and $stats[$chat_id.'chssend'] =="دز"){
if(preg_match('/^(@)(.*)/s' , $text, $mtch)){
$hassaN = json_decode(file_get_contents("http://api.telegram.org/bot".token."/getChat?chat_id=$text"))->result;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- تم اضافه قناتك في البوت.",
'disable_web_page_preview'=> true ,
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع' ,'callback_data'=>"hooh"]],
]])
]);
$stats[$chat_id.'chsend'] = $hassaN->id;
unset($stats[$chat_id.'chssend']);
file_put_contents("stats.json",json_encode($stats));
}}

if($data == 'eDiMp3'){
$stats[$chat_id2.'eDiMp3'] = "دز";
file_put_contents("stats.json",json_encode($stats));
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- قم بأرسال الMp3.",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if ($message->audio and $stats[$chat_id.'eDiMp3'] =="دز") {
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->audio->file_id])->result->file_path;
file_put_contents("$chat_id.mp3",file_get_contents($file));
unset($stats[$chat_id.'eDiMp3']);
file_put_contents("stats.json",json_encode($stats));
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-2,
]);
bot('sendAudio', [
'chat_id'=> $chat_id,
'audio'=>new CURLFile("$chat_id.mp3"),
'caption'=>"- @$ybot .",
'performer'=>"- @KK2KK.",
'title'=>'audio',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}

if($data == 'caption'){
$stats[$chat_id2.'caption'] = "دز";
file_put_contents("stats.json",json_encode($stats));
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- قم بأرسال الوصف الان.",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if ($text and $stats[$chat_id.'caption'] =="دز") {
unset($stats[$chat_id.'caption']);
$stats[$chat_id.'captionend'] = $text;
file_put_contents("stats.json",json_encode($stats));
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-2,
]);
bot('sendmessage', [
'chat_id'=> $chat_id,
'text'=>"- تم حفظ الوصف استخدم الازرار الان.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}

if($message->photo) {
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("$chat_id.png",file_get_contents($file));
bot('sendsticker',[
'chat_id'=>$chat_id,
'sticker'=>new CURLFile("$chat_id.png"),
]);
unlink("$chat_id.png");
}
if($message->photo) {
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("$chat_id.png",file_get_contents($file));
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile("$chat_id.png"),
'caption'=>"- @$ybot .",
]);
unlink("$chat_id.png");
}

if ($message->sticker) {
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->sticker->file_id])->result->file_path;
file_put_contents("$chat_id.jpg",file_get_contents($file));
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>new CURLFile("$chat_id.jpg"),
'caption'=>"- @$ybot .",
]);
unlink("$chat_id.jpg");
}

if ($message->sticker ){
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->sticker->file_id])->result->file_path;
file_put_contents("$chat_id.png",file_get_contents($file));
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile("$chat_id.png"),
'caption'=>"- @$ybot .",
]);
unlink("$chat_id.png");
}
if ($message->video) {
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->video->file_id])->result->file_path;
file_put_contents("$chat_id.mp4",file_get_contents($file));
bot('sendVideoNote',[
'chat_id'=>$chat_id,
'video_note'=>new CURLFile("$chat_id.mp4"),
'caption'=>"- @$ybot .",

]);
unlink("$chat_id.mp4");
}
if ($message->video) {
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->video->file_id])->result->file_path;
file_put_contents("$chat_id.ogg",file_get_contents($file));
bot('sendvoice',[
'chat_id'=>$chat_id,
'voice'=>new CURLFile("$chat_id.ogg"),
'caption'=>"- @$ybot .",
]);
unlink("$chat_id.ogg");
}
if($message->video) {
unlink("$chat_id.mp3");
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->video->file_id])->result->file_path;
file_put_contents("$chat_id.mp3",file_get_contents($file));
bot('sendaudio',[
'chat_id'=>$chat_id,
'audio'=>new CURLFile("$chat_id.mp3"),
'performer'=>"- @KK2KK.",
'title' => "- @BxxBot.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
}

if($data == 'titlem'){
$stats[$chat_id2.'title'] = "دز";
file_put_contents("stats.json",json_encode($stats));
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- قم بأرسال اسم الاغنية الجديد",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($text and $stats[$chat_id.'title'] =="دز") {
$stats[$chat_id.'titlend'] = "$text";
unset($stats[$chat_id.'title']);
file_put_contents("stats.json",json_encode($stats));
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-2,
]);
bot('sendmessage', [
'chat_id'=> $chat_id,
'text'=>"- تم حفظ الاسم استخدم الازرار الان.",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}

if($data == 'performer'){
$stats[$chat_id2.'performer'] = "دز";
file_put_contents("stats.json",json_encode($stats));
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- قم بأرسال اسم المغني الجديد",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if ($text and $stats[$chat_id.'performer'] =="دز") {
$stats[$chat_id.'performerend'] = "$text";
unset($stats[$chat_id.'performer']);
file_put_contents("stats.json",json_encode($stats));
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-2,
]);
bot('sendmessage', [
'chat_id'=>$chat_id,
'text'=>"- تم حفظ الاسم استخدم الازرار الان.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}

if($message->voice) {
unlink("$chat_id.mp3");
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->voice->file_id])->result->file_path;
file_put_contents("$chat_id.mp3",file_get_contents($file));
bot('sendAudio',[
'chat_id'=> $chat_id,
'audio'=>new CURLFile("$chat_id.mp3"),
'caption'=>"- @$ybot .",
'performer'=>"- @KK2KK.",
'title' => "- @BxxBot.",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
}

if($message->audio) {
unlink("$chat_id.ogg");
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->audio->file_id])->result->file_path;
file_put_contents("$chat_id.ogg",file_get_contents($file));
bot('sendvoice',[
'chat_id'=>$chat_id,
'voice'=>new CURLFile("$chat_id.ogg"),
]);
unlink("$chat_id.ogg");
}

if($message->audio) {
unlink("$chat_id.mp3");
$file = "https://api.telegram.org/file/bot".token."/".bot('getfile',['file_id'=>$message->audio->file_id])->result->file_path;
file_put_contents("$chat_id.mp3",file_get_contents($file));
bot('sendAudio', [
'chat_id'=> $chat_id,
'audio'=>new CURLFile("$chat_id.mp3"),
'caption'=>"- @$ybot .",
'performer'=>"- @KK2KK.",
'title' => "- @BxxBot.",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'تغيير الفنان.','callback_data'=>'performer'],['text'=>'تغيير الأسم.','callback_data'=>'titlem']],
[['text'=>'وضع وصف.','callback_data'=>'caption']],
[['text'=>'أرسلها هنآ.','callback_data'=>'sendme'],['text'=>'نشر في قناتي.','callback_data'=>'chsend']],
[['text'=>'نشر في القناة على شكل بصمه','callback_data'=>'chsend2']],
]])
]);
}

$ti = $stats[$chat_id2.'titlend'];
if(!$ti){
$endti = "- @BxxBot.";
}elseif($ti){
$endti = "$ti";
}
$pr = $stats[$chat_id2.'performerend'];
if(!$pr){
$endpr = "- @KK2KK.";
}elseif($pr){
$endpr = "$pr";
}
$ca = $stats[$chat_id2.'captionend'];
if(!$ca){
$endca = "";
}elseif($ca){
$endca = "$ca";
}

if($data == "sendme"){
bot('sendAudio',[
'chat_id'=>$chat_id2,
'audio'=>new CURLFile("$chat_id2.mp3"),
'caption'=>$endca,
'performer'=>$endpr,
'title' =>$endti,
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
unlink("$chat_id2.mp3");
unlink("$chat_id2.jpg");
unset($stats[$chat_id2.'performerend']);
unset($stats[$chat_id2.'performer']);
unset($stats[$chat_id2.'titlend']);
unset($stats[$chat_id2.'title']);
unset($stats[$chat_id2.'captionend']);
unset($stats[$chat_id2.'caption']);
unset($stats[$chat_id2.'thumb']);
file_put_contents("stats.json",json_encode($stats));
}

if($data =='chsend' and !$stats[$chat_id2.'chsend']){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"- عذراً لا توجد قناة مضافه حاليآ.",
]);
}

if($data == "chsend" and $stats[$chat_id2.'chsend']){
bot('sendAudio',[
'chat_id'=>$stats[$chat_id2.'chsend'],
'audio'=>new CURLFile("$chat_id2.mp3"),
'caption'=>$endca,
'performer'=>$endti,
'title' =>$endpr
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- تم النشر في القناة بنجاح ✔️.",
]);
unlink("$chat_id2.mp3");
unlink("$chat_id2.jpg");
unset($stats[$chat_id2.'performerend']);
unset($stats[$chat_id2.'performer']);
unset($stats[$chat_id2.'titlend']);
unset($stats[$chat_id2.'title']);
unset($stats[$chat_id2.'captionend']);
unset($stats[$chat_id2.'caption']);
file_put_contents("stats.json",json_encode($stats));
bot('sendMessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*▪️ مرحبًا بكَ عزيزي في ToolS Bot .

▪️ يمكنك تحويل الصيغ وتغيير حقوق ملفات Mp3 مع ميزة النشر التلقائي .*",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'➕ أضف قناتي.','callback_data'=>"chmempers"],['text'=>'➖ حذف قناتي.','callback_data'=>"delchmemper"]],
[['text'=>'♻️ تحويل الصيغ.','callback_data'=>"hkt"],['text'=>'تغيير حقوق Mp3','callback_data'=>"fma"]],
[['text'=>'شرح استخدام البوت ⁉️','callback_data'=>"helpp"]],
]])
]);
}

if($data =='chsend2' and !$stats[$chat_id2.'chsend']){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"- عذراً لا توجد قناة مضافه حاليآ.",
]);
}

if($data == "chsend2" and $stats[$chat_id2.'chsend']){
bot('sendvoice',[
'chat_id'=>$stats[$chat_id2.'chsend'],
'voice'=>new CURLFile("$chat_id2.mp3"),
'caption'=>$endca,
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"- تم النشر في القناة بنجاح ✔️.",
]);
unlink("$chat_id2.mp3");
unlink("$chat_id2.ogg");
unlink("$chat_id2.jpg");
unset($stats[$chat_id2.'performerend']);
unset($stats[$chat_id2.'performer']);
unset($stats[$chat_id2.'titlend']);
unset($stats[$chat_id2.'title']);
unset($stats[$chat_id2.'captionend']);
unset($stats[$chat_id2.'caption']);
file_put_contents("stats.json",json_encode($stats));
bot('sendMessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*▪️ مرحبًا بكَ عزيزي في ToolS Bot .

▪️ يمكنك تحويل الصيغ وتغيير حقوق ملفات Mp3 مع ميزة النشر التلقائي .*",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'➕ أضف قناتي.','callback_data'=>"chmempers"],['text'=>'➖ حذف قناتي.','callback_data'=>"delchmemper"]],
[['text'=>'♻️ تحويل الصيغ.','callback_data'=>"hkt"],['text'=>'تغيير حقوق Mp3','callback_data'=>"fma"]],
[['text'=>'شرح استخدام البوت ⁉️','callback_data'=>"helpp"]],
]])
]);
}

