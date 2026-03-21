<?php#*wataw*

if($start=="non"){
$start="
▫️ مرحبا بك عزيزي 👋🏻. 
- في بوت النودز
- اضغط علئ عرض الصور ليتم عرض الصور لك
";}

$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$from_id = $message->from->id;

if ($tc == 'private'){  
@$user = json_decode(file_get_contents("data/user.json"),true);
if(!in_array($from_id, $user["userlist"])) {
$user["userlist"][]="$from_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);}}
elseif ($tc == 'group' | $tc == 'supergroup'){  
@$user = json_decode(file_get_contents("data/user.json"),true);
if(!in_array($chat_id, $user["grouplist"])) {
$user["grouplist"][]="$chat_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);}}

if($text=="/start"){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
]);}

if($text){
$me  = rand(36,10036);
bot('sendphoto',['chat_id'=>$chat_id,
'photo'=>"https://t.me/XXXXN/$me",
'reply_to_message_id'=>$message->message_id,
'caption'=>"", 
'parse_mode'=>"MarkDown",
'parse_mode'=>'html',
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'عرض صوره اخرئ 🖤.','callback_data'=>'1']]
]])]);}

if($data == "1"){
bot('deletemessage',['chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,]);
$me  = rand(36,10036);
bot('sendphoto',['chat_id'=>$chat_id2,
'photo'=>"https://t.me/XXXXN/$me",
'reply_to_message_id'=>$message->message_id,
'caption'=>"",
'parse_mode'=>"MarkDown",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'عرض صوره اخرئ 🖤.','callback_data'=>'1']] 
]])]);}

