<?php#*wataw*

if($start=="non"){
$start="
👋🏻 أهلآ بك عزيزي في بوت حذف رسائل القنوات ،
- يمكنك من خلال البوت حذف رسائل القناة ،
- قم برفع البوت ادمن في قناتك وارسل لي توجية لآخر رساله في القناة ،
- البوت لايحتاج لاي شي فقط قم بعمل التوجية ،
- انت فقط الذي تحدد عدد الرسائل التي ترغب في حذفها ،وسوف يقوم البوت بحذفها مباشرةً ،
";}

error_reporting(0);
set_time_limit(0);

$update = json_decode(file_get_contents('php://input'));
$text = $update->message->text;
$chat_id = $update->message->chat->id;
$chat_id  =$message->chat->id;
$name =$message->from->first_name;
$user =$message->from->username;
$message_id =$update->message->message_id;
$from_id =$update->message->from->id;
$message =$update->message;
$chat_id =$message->chat->id;
$text =$message->text;
$chat_id2 =$update->callback_query->message->chat->id;
$message_id =$update->callback_query->message->message_id;
$data =$update->callback_query->data;
$from_id =$message->from->id;


if(!file_exists("data")){mkdir("data");}
if($text == '/start'){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$start
$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,]);}

elseif($update->message->forward_from_chat){
$channel = $update->message->forward_from_chat->username;
$message_id = $update->message->forward_from_message_id;
$botid = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY.'/getme'))->result->id;
$truechannel = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChatMember?chat_id=@$channel&user_id=".$botid))->result->status;

if($truechannel == 'administrator'){
file_put_contents("data/$chat_id.txt","count|$channel|$message_id");
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"
- قم بأرسال عدد الرسائل التي تريد حذفها ،
- يجب أن يكون الرقم بين 1 و 100 فقط ،
",]);
}else{
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"- عذراً البوت ليس ادمن في القناة ،
- ارفع البوت ادمن في القناة واعطي صلاحيه الحذف واعد المحاوله ، 
",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- تابعنا.",'url'=>"t.me/yyyyi"]],]])]);}}

elseif(strpos(file_get_contents("data/$chat_id.txt"),"count|") !== false){
if($text >= 1 and $text <= 100){
$get = explode("|",file_get_contents("data/$chat_id.txt"));
$channel = $get[1];
$message_id = $get[2];
unlink("data/$chat_id.txt");
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"- أنتظر لحظه ،",]);
$next = $message_id - $text;
for($x = $message_id; $x >= $next; $x--){
bot('deleteMessage',['chat_id'=>"@$channel",
'message_id'=>$x]);

if($x < 1 ){ break; }}
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"- تم مسح جميع الرسائل المحدده ،",]);
}else{
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"
- قم بأرسال عدد الرسائل التي تريد حذفها ،
- يجب أن يكون الرقم بين 1 و 100 فقط ،
",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- تابعنا.",'url'=>"t.me/yyyyi"]],]])]);}}
