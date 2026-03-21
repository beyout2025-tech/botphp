<?php#*wataw*

if($start=="non"){
$start="
 اهلا بك
•  بوت معاني الاسماء ،🦄!
• قم بارسال الاسم فقط وسوف يقوم ،
• البوت بارسال المعنئ الكامل للاسم ،🕊
";}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$from_id = $message->from->id;
$name = $update->message->from->first_name;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$username = $update->message->from->username;
$reply = $message->reply_to_message->message_id;

if($text == "/start" ){
bot('sendMessage',['chat_id'=>$chat_id,
'text' => "$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,]);}

if($text != '/start'  ){
$save = json_decode(file_get_contents('https://sssass.ml/api/name.php?Name='.$text),true);
$Name = $save["Mean"]["Name"];
$title = $save["Mean"]['title'];
$Description = $save["Mean"]['Description']; 
$ren1 = str_replace('\&quot;', ' ', $Description); 
$ren = str_replace('personal adjectives personality names', ' ', $ren1);
$Image = $save["Mean"]['Image'];
$ok = bot('sendMessage', ['chat_id'=>$chat_id,
'text' =>"- الاسم : $Name 🤍.\n- المعنى ⬇️💞.\n$title\n $ren",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"📡",'url'=>"t.me/bxxbot"]],]
]),])->ok;
if($ok == true){
echo "ok";
}else{
bot('sendMessage',['chat_id'=>$chat_id2,'text'=>"",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"📡",'url'=>"t.me/bxxbot"]],
]])]);}}

