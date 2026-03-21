<?php#*wataw*

$update   = json_decode(file_get_contents('php://input'));
$message  = $update->message;
$text     = $message->text;
$message_id = $message->message_id;
$chat_id  = $message->chat->id;
$botme = "BxxBot";
if(isset($update->channel_post)){
$channel_post = $update->channel_post;
$channel_id   = $update->channel_post->chat->id;
$channel_text = $update->channel_post->text;
$channel_message_id= $update->channel_post->message_id;
$document = $update->channel_post->document;
$sticker= $update->channel_post->sticker;
$photo= $update->channel_post->photo;
$video= $update->channel_post->video;
$forward= $update->channel_post->forward_from_chat;
$contact= $update->channel_post->contact;
$voice= $update->channel_post->voice;
$audio= $update->channel_post->audio;
$location = $update->channel_post->location;
}
if(!file_exists("data.json")) {
file_put_contents("data.json", "{\"channel\":[]}");
}
$settings = json_decode(file_get_contents("am.json"),true);
function save($id){
$get = json_decode(file_get_contents("data.json"), true);
if(!in_array($id, $get['channel'])) {
$get['channel'][$id] = array('text' => YES,'gif'=>YES,'user'=>YES,'video'=>YES,'audio'=>YES,'links'=>YES,'voice'=>YES,'fwd'=>YES,'doc'=>YES, 'loc'=>YES,'sticker'=>YES,'photo'=>YES,'postt'=>NO);
file_put_contents("data.json", json_encode($get));
return true;
}else{
return false;
}
}
function lock($id,$val){
$get = json_decode(file_get_contents("data.json"), true);
$get['channel'][$id][$val] = NO;
file_put_contents("data.json", json_encode($get));
return true;
}
function not($id,$val){
$get = json_decode(file_get_contents("data.json"), true);
$get['channel'][$id][$val] = YES;
file_put_contents("data.json", json_encode($get));
return true;
}
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->userame;
$text = $message->text;
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
$text  = $message->text;
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
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$text = $update->message->text;
$name = $update->message->from->first_name;
$user = $message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
$from_id2 = $update->callback_query->from->id;
$data = $update->callback_query->data;
$forwardid = $update->message->forward_from->id;
$type = $update->message->chat->type;
$re_id = $update->message->reply_to_message->forward_from->id;
$re = $update->message->reply_to_message;
date_default_timezone_set('Asia/Baghdad');
$settings = json_decode(file_get_contents("am.json"),true);
$set = $settings["set"];
$ch = $settings["settings"]["ch"];
$mych = $settings["settings"]["mych"];
$chid1 = $settings["settings"]["chid1"];
$usermych = $settings["settings"]["usermych"];
$memmych = $settings["settings"]["memmych"];
$userch2 = $settings["settings"]["userch2"];
$idch2 = $settings["settings"]["idch2"];
$memch2 = $settings["settings"]["memch2"];
$DevInfo = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=$admin"));
$DevUser = $DevInfo->result->username;
$DevName = $DevInfo->result->first_name;
$TokenInfo = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$UserBot = $TokenInfo->result->username; 
$NameBot = $TokenInfo->result->first_name; 
$IdBot = $TokenInfo->result->id;
$get_chat = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChatMembersCount?chat_id=$chat_id"));
$membergp = $get_chat->result;
$title = $message->chat->title;
if($message and $from_id == $admin and !in_array($from_id, $settings["admins"])){
$settings["admins"][] = "$admin"; 
file_put_contents("am.json",json_encode($settings,true)); 
}
if($type != "private"){
if($settings["settings"]["tnbeh"] == "مفعل"){
if($message and !in_array($chat_id, $settings["groups"])){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"
⚤︎ تم اضافة مجموعه جديده ↫
⚥︎ اسم الضافني ↫ $name
⚥︎ معرف الضافني ↫ ❨ @$user ❩
⚥︎ ايدي الضافني ↫ ❨ $from_id ❩
┉  ┉   ┉  ┉
⚤︎ معلومات المجموعه ↫
┉  ┉   ┉  ┉
⚥︎ اسم المجموعه ↫ ❨ $title ❩
⚥︎ عدد الاعضاء ↫ ❨ $membergp ❩
⚥︎ ايدي المجموعه 
❨ $chat_id ❩
┉  ┉   ┉  ┉
⚤︎ ٱڵوقت ↫ ".date("h").":".date("i").":".date("s")."
⚤︎ ٱڵتٱريخ ↫ ".date("Y")."/".date("n")."/".date("d")."",
]);
}}
}

if($type == "private"){
if($settings["settings"]["tnbeh"] == "مفعل"){
if($message and !in_array($from_id, $settings["member"])){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⚤︎ هنٱك مشترك جديد في ٱڵبوت 
┉  ┉   ┉  ┉
⚤︎ اسمه ↫ [$name](tg://user?id=$from_id)
⚤︎ معرفه ↫ ❨ [@$user](tg://user?id=$from_id) ❩
⚤︎ ايديه ↫ ❨ [$from_id](tg://user?id=$from_id) ❩
┉  ┉   ┉  ┉
⚤︎ ٱڵوقت ↫ ".date("h").":".date("i").":".date("s")."
⚤︎ ٱڵتٱريخ ↫ ".date("Y")."/".date("n")."/".date("d")."",
'parse_mode'=>"MarkDown",'disable_web_page_preview'=>true,
]);
}}
}

if($type != "private"){
if($message and !in_array($chat_id, $settings["groups"])){
$settings['groups'][] = "$chat_id";
file_put_contents("am.json",json_encode($settings));
}}

if($type == "private"){
if($message and !in_array($from_id, $settings["member"])){
$settings['member'][] = "$from_id";
file_put_contents("am.json",json_encode($settings));
}}

$cchj = -1;
for($i=0; $i<=count($settings['channel']); $i++){ $cchj++; }
$gps = -1;
for($i=0; $i<=count($settings['groups']); $i++){ $gps++; }
$mem = -1;
for($i=0; $i<=count($settings['member']); $i++){ $mem++; }
$Ban = -1;
for($i=0; $i<=count($settings['ban']); $i++){ $Ban++; }
$admins = -1;
for($i=0; $i<=count($settings['admins']); $i++){ $admins++; }
$Vhhhhh=json_encode(['inline_keyboard'=>[[['text'=>"",'callback_data'=>"mem"]],]]);
$HhZzz=json_encode(['inline_keyboard'=>[[['text'=>"• رجوع '🔙،",'callback_data'=>"back"]],]]);
if($update->message->left_chat_member and $update->message->left_chat_member->id == $IdBot){ $key = array_search($chat_id,$settings["groups"]); unset($settings["groups"][$key]); $settings["groups"] = array_values($settings["groups"]); file_put_contents("am.json",json_encode($settings,true)); }
if($from_id == $admin){ $st = "مطور البوت"; }elseif ($from_id != $admin){ $st = "ادمن البوت"; }
if($from_id2 == $admin){ $st2 = "مطور البوت"; }elseif ($from_id2 != $admin){ $st2 = "ادمن البوت"; }
if($message and !$settings["settings"]["togeh"]){ $settings["settings"]["togeh"]="معطل";  file_put_contents("am.json",$settings); }
if($message and !$settings["settings"]["tnbeh"]){ $settings["settings"]["tnbeh"]="معطل";  file_put_contents("am.json",$settings); }
if($message and !$settings["settings"]["bot"]){ $settings["settings"]["bot"]="مفعل";  file_put_contents("am.json",$settings); }

if($update){
$j = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ch&user_id=".$from_id);
if($message && (strpos($j,'"status":"left"') or strpos($j,'"Bad Request: USER_ID_INVALID"') or strpos($j,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *عذرا لايمكنك استخدام البوت*
⚤︎ *رجائا اشترك في قناة البوت*
⚤︎ *لتتمكن من استخدامه* 
⚤︎ *القناة ↫ ❨ $ch ❩*",'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• القناة ،💌'",'url'=>"https://t.me/$ch"]],]])]);return false;}
bot('sendMessage',['chat_id'=>$chat_id, 'text'=>" ",'reply_to_message_id'=>$message->message_id,]);}

if($update){
$j = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$chid1&user_id=".$from_id);
if($message && (strpos($j,'"status":"left"') or strpos($j,'"Bad Request: USER_ID_INVALID"') or strpos($j,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *عذرا لايمكنك استخدام البوت*
⚤︎ *رجائا اشترك في قناة البوت*
⚤︎ *لتتمكن من استخدامه* 
⚤︎ *القناة ↫ ❨ $mych ❩*",'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• القناة ،💌'",'url'=>"$mych"]],]])]);return false;}
bot('sendMessage',['chat_id'=>$chat_id, 'text'=>" ",'reply_to_message_id'=>$message->message_id,]);}

if($data =="memmych" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل معرف قناة التمويل مع @* ",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings['set'] = "memmych";
file_put_contents("am.json",json_encode($settings));
}

if($set == "memmych" and $text != "/start" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ تم حفظ معرف القناة بنجاح  قم بأرسال عدد اعضاء القناة *بعد التمويل*",
'parse_mode'=>"Markdown",'reply_to_message_id'=>$message->message_id,
]);
$settings["settings"]["usermych"]=$text;
file_put_contents("am.json",$settings);
$settings['set'] = "memmych2";
file_put_contents("am.json",json_encode($settings));
}
if($set == "memmych2" and $text != "/start" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ تم حفظ الاشتراك الاجباري على القناة
$usermych
⚤︎ سيتم حذف الاشتراك الاجباري تلقائيا عند وصول القناة الى $text عضو",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>$HhZzz,
]);
$settings["settings"]["memmych"]=$text;
file_put_contents("am.json",$settings);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
$co = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChatMemberscount?chat_id=$usermych")); 
$count = $co->result; 
$endmem = $memmych;
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$usermych&user_id=".$from_id);
if($message && $count <$endmem && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *عذرا لايمكنك استخدام البوت*
⚤︎ *رجائا اشترك في قناة البوت*
⚤︎ *لتتمكن من استخدامه* 
⚤︎ *القناة ↫ ❨ $usermych ❩*",'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• القناة ،💌'",'url'=>"https://t.me/$usermych"]],]])
]);return false;}
if($data =="memch2" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *قم بارسال رابط قناة التمويل* ",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings['set'] = "idch2";
file_put_contents("am.json",json_encode($settings));
}
if($set == "idch2" and $text != "/start" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم حفظ رابط القناة قم بأرسال ايدي القناة مثل -1234567890*",
'parse_mode'=>"Markdown",'reply_to_message_id'=>$message->message_id,
]);
$settings["settings"]["idch2"]=$text;
file_put_contents("am.json",$settings);
$settings['set'] = "memch2";
file_put_contents("am.json",json_encode($settings));
}
if($set == "memch2" and $text != "/start" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ تم حفظ معرف القناة بنجاح  قم بأرسال عدد اعضاء القناة *بعد التمويل*",
'parse_mode'=>"Markdown",'reply_to_message_id'=>$message->message_id,
]);
$settings["settings"]["userch2"]=$text;
file_put_contents("am.json",$settings);
$settings['set'] = "memch22";
file_put_contents("am.json",json_encode($settings));
}
if($set == "memch22" and $text != "/start" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ تم حفظ الاشتراك الاجباري على القناة
$userch2
⚤︎ سيتم حذف الاشتراك الاجباري تلقائيا عند وصول القناة الى $text عضو",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>$HhZzz,
]);
$settings["settings"]["memch2"]=$text;
file_put_contents("am.json",$settings);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
$co = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChatMemberscount?chat_id=$idch2")); 
$count = $co->result; 
$endmem = $memch2;
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$idch2&user_id=".$from_id);
if($message && $count <$endmem && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⚤︎ *عذرا لايمكنك استخدام البوت*
⚤︎ *رجائا اشترك في قناة البوت*
⚤︎ *لتتمكن من استخدامه* 
⚤︎ *القناة ↫ ❨ $userch2 ❩*",'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• القناة ،💌'",'url'=>"$userch2"]],]])
]);return false;}

if($type == "private"){
if($text =='/start' and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *اهلا بك عزيزي في لوحة تحكم بوت* [$NameBot](tg://user?id=$IdBot) *انت هو* ↫ $st
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
'reply_markup'=>$Vhhhhh,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
}

if($data =='back' and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في لوحة تحكم بوت* [$NameBot](tg://user?id=$IdBot) *انت هو* ↫ $st2
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>$Vhhhhh,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}

if($data == "bot" and $chat_id2 != $admin){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
]);
}
if($data == "bot" and $settings["settings"]["bot"] == "معطل" and $chat_id2 == $admin) { 
$settings["settings"]["bot"]="مفعل";
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تفعيل البوت للجميع",
]);
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في لوحة تحكم بوت* [$NameBot](tg://user?id=$IdBot) *انت هو* ↫ $st2
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>$Vhhhhh,
]);
}
elseif($data == "bot" and $settings["settings"]["bot"] == "مفعل" and $chat_id2 == $admin) { 
$settings["settings"]["bot"]="معطل";
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تعطيل البوت من الجميع",
]);
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في لوحة تحكم بوت* [$NameBot](tg://user?id=$IdBot) *انت هو* ↫ $st2
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>$Vhhhhh,
]);
}

if($data == "tnbeh" and $settings["settings"]["tnbeh"] == "معطل" and in_array($from_id2, $settings["admins"])) { 
$settings["settings"]["tnbeh"]="مفعل";
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تفعيل اشعار الدخول",
]);
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"
",'parse_mode'=>"Markdown",
]);
}

elseif($data == "tnbeh" and $settings["settings"]["tnbeh"] == "مفعل" and in_array($from_id2, $settings["admins"])) { 
$settings["settings"]["tnbeh"]="معطل";
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تعطيل اشعار الدخول",
]);
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"",'parse_mode'=>"Markdown",
]);
}

if($data == "togeh" and $settings["settings"]["togeh"] == "معطل" and in_array($from_id2, $settings["admins"])) { 
$settings["settings"]["togeh"]="مفعل";
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تفعيل توجيه الرسائل",
]);
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"",'parse_mode'=>"Markdown",
]);
} 
elseif($data == "togeh" and $settings["settings"]["togeh"] == "مفعل" and in_array($from_id2, $settings["admins"])) { 
$settings["settings"]["togeh"]="معطل";
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تعطيل توجيه الرسائل",
]);
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"",'parse_mode'=>"Markdown",
]);
} 
if($data =='listchannels' and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في قسم الاشتراك الاجباري*
⚤︎ *يمكنك اضافة وحذف قناة عامه او خاصه في الاشتراك الاجباري*
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة القنوات",'callback_data'=>"listchannel"]],
[['text'=>"حذف اشتراك عام",'callback_data'=>"dch"],['text'=>"وضع اشتراك عام",'callback_data'=>"ach"]],
[['text'=>"حذف اشتراك خاص",'callback_data'=>"dmych"],['text'=>"وضع اشتراك خاص",'callback_data'=>"amych"]],
[['text'=>"• رجوع '🔙،",'callback_data'=>"back"]],
]])
]);
}
if($data =='listchannel' and !$settings["settings"]["ch"] and !$settings["settings"]["mych"]){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"لاتوجد قنوات مضافه",
]);
}
if($data =='listchannel' and $settings["settings"]["ch"] and !$settings["settings"]["mych"]){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"القنوات المتوفره :\nالقناة العامه : $ch",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"listchannels"]],
]])
]);
}
if($data =='listchannel' and $settings["settings"]["mych"] and !$settings["settings"]["ch"]){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"القنوات المتوفره :\nالقناة الخاصه : $mych",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"listchannels"]],
]])
]);
}
if($data =='listchannel' and $settings["settings"]["ch"] and $settings["settings"]["mych"]){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"القنوات المتوفره :\nالقناة العامه : $ch\nالقناة الخاصه : $mych",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"listchannels"]],
]])
]);
}

if($data =='tmoel' and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في لوحة تحكم بوت $BotName انت هو* ↫ مطور البوت
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"شرح التمويل",'callback_data'=>"sharh"]],
[['text'=>"القنوات المموله",'callback_data'=>"Channels"]],
[['text'=>"وضع تمويل لقناة خاصه",'callback_data'=>"memch2"],['text'=>"وضع تمويل لقناة عامه",'callback_data'=>"memmych"]],
[['text'=>"حذف تمويل القناة الخاصه",'callback_data'=>"delmemch2"],['text'=>"حذف تمويل القناة العامه",'callback_data'=>"delmemmych"]],
[['text'=>"• رجوع '🔙،",'callback_data'=>"back"]],
]])
]);
}
if($data == "sharh" and in_array($from_id2, $settings["admins"])) { 
bot("editmessagetext",[ 
"chat_id"=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id, 
"text"=>"طريقة الاستعمال للقناة العامه :
تقوم باختيار زر التمويل للقناة العامه بعد ذلك تقوم بارسال معرف القناة التي تريد عمل التمويل عليها
سوف يطلب منك عدد اعضاء القناة ما بعد التمويل
يجب عليك ارسال العدد الذي سوف تصل اليه القناة بعد التمويل كمثال اوضح :
عدد اعضاء القناة الان : 1000 عشو
عدد اعضاء القناة بعد التمويل : 1500
يعني عندما تصل القناة الى 1500 عضو سوف يتوقف التمويل وينتهي الاشتراك الاجباري .
┉  ┉   ┉  ┉

طريقة الاستعمال للقناة الخاصه :
تقوم باختيار زر التمويل للقناة الخاصه بعد ذلك تقوم بارسال رابط القناة التي تريد عمل التمويل عليها
بعدها تقوم بارسال ايدي القناة مع الـ - مثل -1234567890
سوف يطلب منك عدد اعضاء القناة ما بعد التمويل
يجب عليك ارسال العدد الذي سوف تصل اليه القناة بعد التمويل كما في المثال فوق .",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"tmoel"]],
]])
]);
} 

if($data == "Channels" and !$settings["settings"]["usermych"] and !$settings["settings"]["userch2"]) { 
bot('answercallbackquery',[ 
'callback_query_id'=>$update->callback_query->id, 
'text'=>"لم يتم تعيين اي تمويل", 
]); 
} 
if($data == "Channels" and $settings["settings"]["usermych"] and !$settings["settings"]["userch2"]) { 
bot("editmessagetext",[ 
"chat_id"=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id, 
"text"=>"التمويلات المتوفره :\nتمويل عام : $usermych / $memmych",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"tmoel"]],
]])
]);
} 
if($data == "Channels" and $settings["settings"]["userch2"] and !$settings["settings"]["usermych"]) { 
bot("editmessagetext",[ 
"chat_id"=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id, 
"text"=>"التمويلات المتوفره :\nتمويل خاص : $userch2 / $memch2",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"tmoel"]],
]])
]);
} 
if($data == "Channels" and $settings["settings"]["userch2"] and $settings["settings"]["usermych"]) { 
bot("editmessagetext",[ 
"chat_id"=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id, 
"text"=>"التمويلات المتوفره :\nتمويل عام : $usermych / $memmych\nتمويل خاص : $userch2 / $memch2",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"tmoel"]],
]])
]);
} 

if($data == "sendfile" and $chat_id2 != $admin){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
]);
}
if($data == "sendfile" and $chat_id2 == $admin){
bot('senddocument',[
'chat_id'=>$admin,
'document'=>new CURLFile("am.json"),
"caption"=>"
 الاعضاء : ".$mem."
المحظورين : ".$Ban."
البوت : ".$settings["settings"]["bot"]."
توجيه الرسائل : ".$settings["settings"]["togeh"]."
اشعار الدخول : ".$settings["settings"]["tnbeh"]."
@$UserBot",
]);
}
if($type == "private"){
if(!in_array($from_id, $settings["admins"]) and !in_array($from_id, $settings["ban"])){ 
if($message and $settings["settings"]["togeh"] == "مفعل"){ 
bot('forwardMessage',[
'chat_id'=>$admin, 
'from_chat_id'=>$from_id, 
'message_id'=>$message->message_id 
]); 
}}
}
if($type == "private"){
if($re and $text == "حظر" and $chat_id == $admin){
$settings['ban'][] = "$re_id";
file_put_contents("am.json",json_encode($settings));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم حظر العضو بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
bot('SendMessage',[
'chat_id'=>$re_id,
'text'=>"⚤︎ *تم حظرك من قبل المطور لايمكنك استخدام البوت*",'parse_mode'=>"Markdown",
]);
}}
if($type == "private"){
if($re and $text == "الغاء حظر" and $chat_id == $admin){
$key = array_search($re_id,$settings["ban"]);
unset($settings["ban"][$key]);
$settings["ban"] = array_values($settings["ban"]);
file_put_contents("am.json",json_encode($settings,true));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم الغاء حظر العضو بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
bot('SendMessage',[
'chat_id'=>$re_id,
'text'=>"⚤︎ *تم الغاء حظرك من البوت*",'parse_mode'=>"Markdown",
]);
}
}
if($data == 'BAN' and !$settings["ban"]){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"لايوجد اعضاء محظورين",
]);
}
if($data == 'BAN' and $settings["ban"]){
$keyboard["inline_keyboard"]=[];
for ($i=0; $i < count($settings['ban']); $i++) {
$Info = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$settings["ban"][$i]));
$Name = $Info->result->first_name;
$keyboard["inline_keyboard"][$i] = [['text'=>"- ".$Name,'url'=>"tg://user?id=".$settings['ban'][$i]],['text'=>"حذف",'callback_data'=>'idban#'.$settings['ban'][$i]]];
}
$reply_markup = json_encode($keyboard); 
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ اهلا بك في قائمة المحظورين
⚤︎ عدد المحظورين ↫ $Ban
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>$reply_markup,
]);
}
$idban = explode('#', $data);
if($idban[0] == "idban" and $chat_id2 == $admin){
$key = array_search($idban[1],$settings["ban"]);
unset($settings["ban"][$key]);
$settings["ban"] = array_values($settings["ban"]);
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم حذف العضو المحظور",
]);
$keyboard["inline_keyboard"]=[];
for ($i=0; $i < count($settings['ban']); $i++) {
$Info = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$settings["ban"][$i]));
$Name = $Info->result->first_name;
$Userame = $Info->result->username;
$keyboard["inline_keyboard"][$i] = [['text'=>"- ".$Name,'url'=>"tg://user?id=".$settings['ban'][$i]],['text'=>"حذف",'callback_data'=>'idban#'.$settings['ban'][$i]]];
}
$reply_markup = json_encode($keyboard); 
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ اهلا بك في قائمة المحظورين
⚤︎ عدد المحظورين ↫ $Ban
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>$reply_markup,
]);
}
$idban = explode('#', $data);
if($idban[0] == "idban" and $chat_id2 != $admin){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا لاتستطيع حذف المحظورين",
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في لوحة تحكم بوت* [$NameBot](tg://user?id=$IdBot) *انت هو* ↫ $st2
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>$Vhhhhh,
]);
}
if($data =='botinfo'){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⌯ *اسم البوت* ↫ ❨ $NameBot ❩
⌯ *معرف البوت* ↫ ❨ [@$UserBot] ❩
⌯ *ايدي البوت* ↫ ❨ $IdBot ❩
⌯ *صاحب البوت* ↫ ❨ [$DevName](tg://user?id=$admin) ❩
┉  ┉   ┉  ┉
",
'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
'reply_markup'=>$HhZzz,
]);
}
if($data =='mem'){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *عدد مشتركين البوت* ↫ ".$mem,'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
}
if($data =='cchj'){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *عدد القنوات في البوت* ↫ ".$cchj,'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
}
if($data =='admins' and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في قسم الادمنيه*
⚤︎ *يمكنك اضافة وحذف اي ادمن من خلال القائمه وايضا اضافة عدد غير محدود من الادمنيه*
⚤︎ *يمكن للادمنيه تحكم في لوحة البوت مثلك ولا يمكنهم رفع ادمنيه او استلام رسائل موجهة او تنبيه الدخول او حظر وحذف الاعضاء ولا يمكنهم تعطيل البوت*
⚤︎ *عدد ادمنية البوت* ↫ $admins
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة الادمنيه",'callback_data'=>"listadmins"]],
[['text'=>"حذف ادمن",'callback_data'=>"deladmin"],['text'=>"اضف ادمن",'callback_data'=>"addadmin"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
if($data =='listadmins' and !$settings['admins']){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"لم يتم رفع اي ادمن",
]);
}
if($data =='listadmins' and $settings['admins']){
$keyboard["inline_keyboard"]=[];
for ($i=0; $i < count($settings['admins']); $i++) {
$Info = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=".$settings["admins"][$i]));
$Name = $Info->result->first_name;
$Userame = $Info->result->username;
$keyboard["inline_keyboard"][$i] = [['text'=>"- ".$Name,'url'=>"tg://user?id=".$settings['admins'][$i]],['text'=>"حذف",'callback_data'=>'id#'.$settings['admins'][$i]]];
}
$reply_markup = json_encode($keyboard); 
bot('sendmessage',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *قائمة ادمنية بوت* [$NameBot](tg://user?id=$IdBot) ",'parse_mode'=>"Markdown",
'reply_markup'=>$reply_markup,
]);
}
$da = explode('#', $data);
if($da[0] == "id" and $chat_id2 == $admin){
$key = array_search($da[1],$settings["admins"]);
unset($settings["admins"][$key]);
$settings["admins"] = array_values($settings["admins"]);
file_put_contents("am.json",json_encode($settings,true));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم حذف الادمن",
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"
⚤︎ *اهلا بك عزيزي في قسم الادمنيه*
⚤︎ *يمكنك اضافة وحذف اي ادمن من خلال القائمه وايضا اضافة عدد غير محدود من الادمنيه*
⚤︎ *يمكن للادمنيه تحكم في لوحة البوت مثلك ولا يمكنهم رفع ادمنيه او استلام رسائل موجهة او تنبيه الدخول*
⚤︎ *عدد ادمنية البوت* ↫ $admins
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة الادمنيه",'callback_data'=>"listadmins"]],
[['text'=>"حذف ادمن",'callback_data'=>"deladmin"],['text'=>"اضف ادمن",'callback_data'=>"addadmin"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
$da = explode('#', $data);
if($da[0] == "id" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $admin){
$key = array_search($da[1],$settings["admins"]);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا لاتستطيع حذف الادمنيه",
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في قسم الادمنيه*
⚤︎ *يمكنك اضافة وحذف اي ادمن من خلال القائمه وايضا اضافة عدد غير محدود من الادمنيه*
⚤︎ *يمكن للادمنيه تحكم في لوحة البوت مثلك ولا يمكنهم رفع ادمنيه او استلام رسائل موجهة او تنبيه الدخول*
⚤︎ *عدد ادمنية البوت* ↫ $admins
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قائمة الادمنيه",'callback_data'=>"listadmins"]],
[['text'=>"حذف ادمن",'callback_data'=>"deladmin"],['text'=>"اضف ادمن",'callback_data'=>"addadmin"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
}
if($data == "addadmin" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $admin){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
]);
}
if($data == "deladmin" and in_array($chat_id2, $settings["admins"]) and $chat_id2 != $admin){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"عذرا الامر ليس لك",
]);
}
if($data == "addadmin" and $chat_id2 == $admin){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل ايدي الشخص ليتم رفعه ادمن في البوت*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر",'callback_data'=>"admins"]],
]])
]);
$settings['set'] = "addadmin";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set =="addadmin" and $chat_id == $admin){
$settings['admins'][] = $text;
file_put_contents("am.json",json_encode($settings));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم رفع العضو بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"admins"]],
]])
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"⚤︎ *تم رفعك في قائمة الادمنيه بواسطة مطور البوت*",'parse_mode'=>"Markdown",
]);
}

if($data =="deladmin" and $chat_id2 == $admin){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل ايدي الشخص ليتم حذفه من قائمه الادمنيه في البوت*",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"admins"]],
]])
]);
$settings['set'] = "deladmin";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set =="deladmin" and $chat_id == $admin){
$key = array_search($text,$settings["admins"]);
unset($settings["admins"][$key]);
$settings["admins"] = array_values($settings["admins"]);
file_put_contents("am.json",json_encode($settings,true));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم حذف الادمن بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"admins"]],
]])
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"⚤︎ *تم حذفك من قائمة الادمنيه بواسطة المطور*",'parse_mode'=>"Markdown",
]);
}
if($data =='abs' and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *اهلا بك عزيزي في قسم الاذاعه*
⚤︎ *عدد مشتركين البوت* ↫ $mem
⚤︎ *عدد المجموعات والقنوات* ↫ $gps
┉  ┉   ┉  ┉
",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"اذاعه للكل",'callback_data'=>"sendall"],['text'=>"اذاعه توجيه للكل",'callback_data'=>"forwardall"]],
[['text'=>"اذاعه للخاص",'callback_data'=>"sendpv"],['text'=>"اذاعه توجيه للخاص",'callback_data'=>"forwardpv"]],
[['text'=>"اذاعه للكروبات",'callback_data'=>"sendgps"],['text'=>"اذاعه توجيه للكروبات",'callback_data'=>"forwardgps"]],
[['text'=>"اذاعه للقنوات",'callback_data'=>"sendcch"],['text'=>"اذاعه توجيه للقنوات",'callback_data'=>"forwardcchj"]],
[['text'=>"• رجوع '🔙،" ,'callback_data'=>"back"]],
]])
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
if($data == "sendall" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للكل* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "sendall";
file_put_contents("am.json",json_encode($settings));
}
$sendDopv = 0;
$sendnotpv = 0;
$sendDosu = 0;
$sendnotsu = 0;
$sendDocchj = 0;
$sendnotcchj = 0;
if($message and $set == "sendall" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك للكل*
⚤︎ الى ↫ ❨ $mem ❩ مشترك 
⚤︎ وفي ↫ ❨ $gps ❩ مجموعه
⚤︎ وفي ↫ ❨ $cchj ❩ قناة
",
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
for($j=0;$j<count($settings['member']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/sendmessage?chat_id=".$settings['member'][$j]."&text=$text";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['member'][$j];
$sendDopv++;
}else{
echo "\n error to send ".$settings['member'][$j];
$sendnotpv++;
}}
$msg_id = bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تمت الاذاعه للخاص و بالاحصائيات التاليه ✔️ 
التوجيه الناجح ✔️ : ( $sendDopv )
التوجيه الفاشل ✖️: ( $sendnotpv )
يتم الاذاعه الى المجموعات ✏️",
'reply_to_message_id'=>$message_id, 
 'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
])->result->message_id; 
for($j=0;$j<count($settings['groups']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/sendmessage?chat_id=".$settings['groups'][$j]."&text=$text";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['groups'][$j];
$sendDosu++;
}else{
echo "\n error to send ".$settings['groups'][$j];
$sendnotsu++;
}}
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$msg_id, 
]); 
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"الاحصائيات النهائيه للاذاعه هي : 
في خاص البوت :
التوجيه الناجح ✔️ : ( $sendDopv )
التوجيه الفاشل ✖️: ( $sendnotpv )
في مجموعات البوت :
التوجيه الناجح ✔️ : ( $sendDosu )
التوجيه الفاشل ✖️: ( $sendnotsu )",
 'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
if($data == "forwardall" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها بالتوجيه* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "forwardall";
file_put_contents("am.json",json_encode($settings));
}
$forwardDopv = 0;
$forwardnotpv = 0;
$forwardDosu = 0;
$forwardnotsu = 0;
$forwardDohu = 0;
$forwardnothu = 0;
if($message and $set == "forwardall" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك بالتوجيه*
⚤︎ الى ↫ ❨ $mem ❩ مشترك 
⚤︎ وفي ↫ ❨ $gps ❩ مجموعه
⚤︎ وفي ↫ ❨ $cchj ❩ قناة
",
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
for($j=0;$j<count($settings['member']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/forwardMessage?chat_id=".$settings['member'][$j]."&from_chat_id=$from_id&message_id=$message->message_id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['member'][$j];
$forwardDopv++;
}else{
echo "\n error to send ".$settings['member'][$j];
$forwardnotpv++;
}}
$mes_id = bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تم التوجيه بالخاص و بالاحصائيات التاليه ✔️ 
التوجيه الناجح ✔️ : ( $forwardDopv ) 
التوجيه الفاشل ✖️: ( $forwardnotpv ) 
يتم التوجيه الى المجموعات ✏️",
'reply_to_message_id'=>$message_id, 
 'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
])->result->message_id; 
for($j=0;$j<count($settings['groups']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/forwardMessage?chat_id=".$settings['groups'][$j]."&from_chat_id=$from_id&message_id=$message->message_id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['groups'][$j];
$forwardDosu++;
}else{
echo "\n error to send ".$settings['groups'][$j];
$forwardnotsu++;
}}
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mes_id, 
]); 
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"الاحصائيات النهائيه للاذاعه هي : 
في خاص البوت :
التوجيه الناجح ✔️ : ( $forwardDopv ) 
التوجيه الفاشل ✖️: ( $forwardnotpv ) 
في مجموعات البوت :
التوجيه الناجح ✔️ : ( $forwardDosu ) 
التوجيه الفاشل ✖️: ( $forwardnotsu )  ",
 'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
$sendDopv = 0;
$sendnotpv = 0;
if($data == "sendpv" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للخاص* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "sendpv";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set == "sendpv" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك*
⚤︎ الى ↫ ❨ $mem ❩ مشترك ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
for($j=0;$j<count($settings['member']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/sendmessage?chat_id=".$settings['member'][$j]."&text=$text";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['member'][$j];
$sendDopv++;
}else{
echo "\n error to send ".$settings['member'][$j];
$sendnotpv++;
}
}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تمت الاذاعة بنجاح ✔️ 
الاذاعة الناجحة ✔️ : ( $sendDopv ) 
الاذاعة الفاشلة ✖️: ( $sendnotpv ) ",
'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
if($data == "forwardpv" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للخاص بالتوجيه* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '??،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "forwardpv";
file_put_contents("am.json",json_encode($settings));
}
$forwardDopv = 0;
$forwardnotpv = 0;
if($message and $set == "forwardpv" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك بالتوجيه*
⚤︎ الى ↫ ❨ $mem ❩ مشترك ",'parse_mode'=>"Markdown",
 'reply_markup'=>json_encode([ 
 'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
for($j=0;$j<count($settings['member']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/forwardMessage?chat_id=".$settings['member'][$j]."&from_chat_id=$from_id&message_id=$message->message_id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['member'][$j];
$forwardDopv++;
}else{
echo "\n error to send ".$settings['member'][$j];
$forwardnotpv++;
}}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تم التوجيه بنجاح ✔️ 
التوجيه الناجح ✔️ : ( $forwardDopv ) 
التوجيه الفاشل ✖️: ( $forwardnotpv ) ",
 'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}

$sendDogps = 0;
$sendnotgps = 0;
if($data == "sendgps" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للكروبات* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "sendgps";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set == "sendgps" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك*
⚤︎ في ↫ ❨ $gps ❩ مجموعه",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
for($j=0;$j<count($settings['groups']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/sendmessage?chat_id=".$settings['groups'][$j]."&text=$text";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['groups'][$j];
$sendDogps++;
}else{
echo "\n error to send ".$settings['groups'][$j];
$sendnotgps++;
}
}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تمت الاذاعة بنجاح ✔️ 
الاذاعة الناجحة ✔️ : ( $sendDogps ) 
الاذاعة الفاشلة ✖️: ( $sendnotgps ) ",
'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
if($data == "forwardgps" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للكروبات بالتوجيه* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "forwardgps";
file_put_contents("am.json",json_encode($settings));
}
$forwardDosu = 0;
$forwardnotsu = 0;
if($message and $set == "forwardgps" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك بالتوجيه*
⚤︎ في ↫ ❨ $gps ❩ مجموعه",'parse_mode'=>"Markdown",
 'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
for($j=0;$j<count($settings['groups']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/forwardMessage?chat_id=".$settings['groups'][$j]."&from_chat_id=$from_id&message_id=$message->message_id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['groups'][$j];
$forwardDosu++;
}else{
echo "\n error to send ".$settings['groups'][$j];
$forwardnotsu++;
}}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تم التوجيه بالمجموعات و بالاحصائيات التاليه ✔️ 
التوجيه الناجح ✔️ : ( $forwardDosu ) 
التوجيه الفاشل ✖️: ( $forwardnotsu ) ",
 'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}

$sendDocchj = 0;
$sendnotcchj = 0;
if($data == "sendcch" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للقنوات* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "sendcch";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set == "sendcch" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك*
⚤︎ في ↫ ❨ $cchj ❩ قناة",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
for($j=0;$j<count($settings['channel']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/sendmessage?chat_id=".$settings['channel'][$j]."&text=$text";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['channel'][$j];
$sendDocchj++;
}else{
echo "\n error to send ".$settings['channel'][$j];
$sendnotcchj++;
}
}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تمت الاذاعة بنجاح ✔️ 
الاذاعة الناجحة ✔️ : ( $sendDocchj )
الاذاعة الفاشلة ✖️: ( $sendnotcchj )
",
'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}

if($data == "forwardcchj" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل الرساله لاذاعتها للقنوات بالتوجيه* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
$settings['set'] = "forwardcchj";
file_put_contents("am.json",json_encode($settings));
}
$forwardDohu = 0;
$forwardnothu = 0;
if($message and $set == "forwardcchj" and in_array($from_id, $settings["admins"])){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"⚤︎ *جاري اذاعة رسالتك بالتوجيه*
⚤︎ في ↫ ❨ $cchj ❩ قناة",'parse_mode'=>"Markdown",
 'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"abs"]],
]])
]);
for($j=0;$j<count($settings['channel']); $j++){
$url = "https://api.telegram.org/bot".API_KEY."/forwardMessage?chat_id=".$settings['channel'][$j]."&from_chat_id=$from_id&message_id=$message->message_id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);
if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$settings['channel'][$j];
$forwardDohu++;
}else{
echo "\n error to send ".$settings['channel'][$j];
$forwardnothu++;
}}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تم التوجيه بالقنوات و بالاحصائيات التاليه ✔️ 
التوجيه الناجح ✔️ : ( $forwardDohu )
التوجيه الفاشل ✖️: ( $forwardnothu )
",
 'reply_markup'=>$HhZzz,
]);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}

if($data == "amych" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *قم باراسل رابط القناة الخاصه* ",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings['set'] = "mych";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set =="mych" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم حفظ رابط القناة الخاصه قم بأرسال ايدي القناة مثل -1234567890*",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings["settings"]["mych"]=$text;
$settings['set'] = "chid1";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set =="chid1" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم حفظ القناة الخاصه بنجاح* 
⚤︎ *قم برفع البوت ادمن في* [$mych]",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings["settings"]["chid1"]=$text;
file_put_contents("am.json",$settings);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
if($data == "ach" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *ارسل معرف قناتك مع @* ",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings['set'] = "ch";
file_put_contents("am.json",json_encode($settings));
}
if($text and $set =="ch" and in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *تم حفظ القناة العامه بنجاح* 
⚤︎ *قم برفع البوت ادمن في* [$text]",'parse_mode'=>"Markdown",
'reply_markup'=>$HhZzz,
]);
$settings["settings"]["ch"]=$text;
file_put_contents("am.json",$settings);
unset($settings['set']);
file_put_contents("am.json",json_encode($settings));
}
if($data == "dch" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *تم حذف القناة العامه بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"listchannels"]],
]])
]);
unset($settings["settings"]["ch"]);
$settingsss = json_encode($settingsss,true);
file_put_contents("am.json",$settingsss);
}
if($data == "dmych" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *تم حذف القناة الخاصه بنجاح* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"listchannels"]],
]])
]);
unset($settings["settings"]["mych"]);
unset($settings["settings"]["chid1"]);
$settingsss = json_encode($settingsss,true);
file_put_contents("am.json",$settingsss);
}
if($data == "delmemmych" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *تم حذف قناة التمويل العامه* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"tmoel"]],
]])
]);
unset($settings["settings"]["usermych"]);
unset($settings["settings"]["memmych"]);
$settingsss = json_encode($settingsss,true);
file_put_contents("am.json",$settingsss);
}
if($data == "delmemch2" and in_array($from_id2, $settings["admins"])){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"⚤︎ *تم حذف قناة التمويل الخاصه* ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"tmoel"]],
]])
]);
unset($settings["settings"]["userch2"]);
unset($settings["settings"]["memch2"]);
unset($settings["settings"]["idch2"]);
$settingsss = json_encode($settingsss,true);
file_put_contents("am.json",$settingsss);
}
if($type == "private"){
if($message and in_array($from_id, $settings["ban"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ *عذرا عزيزي* ↫ [$name](tg://user?id=$chat_id)
⚤︎ *انت محظور من قبل المطور لايمكنك استخدام البوت*",
'disable_web_page_preview'=>true,'parse_mode'=>"Markdown",
]);return false;}
}
if($type == "private"){
if($message and $settings["settings"]["bot"] == "معطل" and !in_array($from_id, $settings["admins"])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚤︎ عذرا عزيزي البوت معطل الى اشعاراً اخر\n⚤︎ [تابع قناة البوت لمعرفة متى يتم تفعيله](https://t.me/wwttw)",
'disable_web_page_preview'=>true,'parse_mode'=>'MarkDown',
]);return false;}}

if($text == '/start' and !in_array($from_id, $settings["admins"])){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
- اهلا ".$message->from->first_name." .
 — — — — — — — — — 
⌔︙ في بوت حمايه القنوات المتميز..
⌔︙قم بأضافه للبوت ك مشرف في قناتك..
⌔︙ثم قم بأرسال تفعيل الى القناة..
⌔︙ارسل الاوامر لمعرفه طريقه استخدام البوت..
— — — — — — — — —
$txtfree ",
'reply_to_message_id'=>$message_id, 
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]); 
}

if($channel_text == "تفعيل" ){
if(!in_array($channel_id, $settings["channel"])){
save($channel_id);
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"
⌔︙تم تفعيل البوت في القناة بنجاح..
⌔︙ارسل الاوامر الان..
⌔︙معرف البوت @$botme
",
]);
$settings['channel'][] = "$channel_id";
file_put_contents("am.json",json_encode($settings));
$vhhhhh = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=$channel_id"))->result;
$lnbg = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/exportChatInviteLink?chat_id=$channel_id"))->result;
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
 تمت اضافة  البوت في القناة التاليه :
*Name* : *$vhhhhh->title*
*ID* : *$vhhhhh->id*
*User* : @$vhhhhh->username
*Bio* : *$vhhhhh->description*
*link* : *$lnbg->invite_link*",
'parse_mode'=>"MarkDown",
]);
}else{
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"
⌔︙تم تفعيل البوت سابقا في القناة
⌔︙معرف البوت @$botme",
]);}
}

if($channel_text == 'الاعدادات'){
$fff = json_decode(file_get_contents("data.json"));
$photo = $fff->channel->$channel_id->photo;
$textt = $fff->channel->$channel_id->text;
$video = $fff->channel->$channel_id->video;
$audio = $fff->channel->$channel_id->audio;
$voice = $fff->channel->$channel_id->voice;
$sticke = $fff->channel->$channel_id->sticker;
$links = $fff->channel->$channel_id->links;
$user = $fff->channel->$channel_id->user;
$doc = $fff->channel->$channel_id->doc;
$loc = $fff->channel->$channel_id->loc;
$gif= $fff->channel->$channel_id->gif;
$postt = $fff->channel->$channel_id->postt;
$fwdi= $fff->channel->$channel_id->fwd;
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"
⌔︙الملصقات ⇦ $sticke
⌔︙البصمات ⇦ $voice
⌔︙الصوت ⇦ $audio
⌔︙الفيديو ⇦ $video
⌔︙الحقوق ⇦ $postt
⌔︙التوجيه ⇦ $fwdi
⌔︙الصور ⇦ $photo
⌔︙الرسائل ⇦ $textt
⌔︙الروابط ⇦ $links
⌔︙المعرف ⇦ $user
⌔︙الملفات ⇦ $doc
⌔︙الموقع ⇦ $loc
⌔︙معرف البوت @$botme
— — — — — — — — — ",
]);
}

if($channel_text == "الرابط" ){
bot('sendmessage',[
'chat_id'=>$channel_id,
'text'=>"*https://t.me/".$update->channel_post->chat->username."*
⌔︙معرف البوت @$botme
— — — — — — — — — ",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "الايدي" ){
bot('sendmessage',[
'chat_id'=>$channel_id,
'text'=>"`".$channel_id."`
⌔︙معرف البوت @$botme
— — — — — — — — — ",
'parse_mode'=>"MarkDown",
]);
}

if($channel_text=="الاوامر"){
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"
⌔︙ اهلا بك في اوامر الحمايه .
 — — — — — — — — — 
⌔︙ تعطيل تفعيل ⇦ الملصقات
⌔︙ تعطيل تفعيل ⇦ المتحركه
⌔︙ تعطيل تفعيل ⇦ البصمات
⌔︙ تعطيل تفعيل ⇦ التوجيه
⌔︙ تعطيل تفعيل ⇦ الحقوق
⌔︙ تعطيل تفعيل ⇦ الملفات
⌔︙ تعطيل تفعيل ⇦ الرسائل
⌔︙ تعطيل تفعيل ⇦ الروابط
⌔︙ تعطيل تفعيل ⇦ المعرف
⌔︙ تعطيل تفعيل ⇦ الفيديو
⌔︙ تعطيل تفعيل ⇦ الصوت
⌔︙ تعطيل تفعيل ⇦ الموقع
⌔︙ تعطيل تفعيل ⇦ الصور
⌔︙ تعطيل تفعيل ⇦ الكل
 — — — — — — — — — 
⌔︙الاوامر الخدميه .
 — — — — — — — — — 
⌔︙الرابط ⇦ لعرض رابط القناة
⌔︙الايدي ⇦ لعرض ايدي القناة
⌔︙مسح + عدد ⇦ لمسح الرسائل
⌔︙معرف البوت @$botme
— — — — — — — — — ",
'parse_mode'=>"MarkDown",
]);
}
if(preg_match('/^(مسح) (.*)/', $channel_text, $del)){
for($i=$channel_message_id; $i>=$channel_message_id-$del[2]; $i--){
bot('deletemessage',[
'chat_id'=>$channel_id,
'message_id' =>$i,
]);
}
bot('sendmessage',[
'chat_id' =>$channel_id,
'text' =>"⌔︙ تم *$channel_text* من المنشورات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",]);
}

if($channel_text == "تعطيل الصور"){
lock($channel_id,'photo');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الصور
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}

if($channel_text == "تفعيل الصور"){
not($channel_id,'photo');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الصور
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}

if($channel_text == "تعطيل الرسائل"){
lock($channel_id,'text');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الرسائل
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الرسائل"){
not($channel_id,'text');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الرسائل
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الملصقات"){
lock($channel_id,'sticker');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الملصقات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الملصقات"){
not($channel_id,'sticker');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الملصقات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الموقع"){
lock($channel_id,'loc');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الموقع
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الموقع"){
not($channel_id,'loc');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الموقع
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الملفات"){
lock($channel_id,'doc');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الملفات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الملفات"){
not($channel_id,'doc');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الملفات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل التوجيه"){
lock($channel_id,'fwd');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل التوجيه
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل التوجيه"){
not($channel_id,'fwd');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل التوجيه
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل البصمات"){
lock($channel_id,'voice');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل البصمات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل البصمات"){
not($channel_id,'voice');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل البصمات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الروابط"){
lock($channel_id,'links');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الروابط
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الروابط"){
not($channel_id,'links');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الروابط
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الحقوق"){
lock($channel_id,'postt');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الحقوق
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الحقوق"){
not($channel_id,'postt');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الحقوق
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الصوت"){
lock($channel_id,'audio');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الصوت
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الصوت"){
not($channel_id,'audio');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الصوت
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الفيديو"){
lock($channel_id,'video');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الفيديو
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الفيديو"){
not($channel_id,'video');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الفيديو
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل المعرف"){
lock($channel_id,'user');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل المعرفات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل المعرف"){
not($channel_id,'user');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل المعرفات
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل المتحركه") {
lock($channel_id,'gif');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل المتحركه
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل المتحركه") {
not($channel_id,'gif');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل المتحركه
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تعطيل الكل") {
lock($channel_id,'postt');
lock($channel_id,'gif');
lock($channel_id,'text');
lock($channel_id,'user');
lock($channel_id,'video');
lock($channel_id,'audio');
lock($channel_id,'links');
lock($channel_id,'voice');
lock($channel_id,'fwd');
lock($channel_id,'doc');
lock($channel_id,'loc');
lock($channel_id,'sticker');
lock($channel_id,'photo');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تعطيل الكل
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
if($channel_text == "تفعيل الكل") {
not($channel_id,'postt');
not($channel_id,'gif');
not($channel_id,'text');
not($channel_id,'user');
not($channel_id,'video');
not($channel_id,'audio');
not($channel_id,'links');
not($channel_id,'voice');
not($channel_id,'fwd');
not($channel_id,'doc');
not($channel_id,'loc');
not($channel_id,'sticker');
not($channel_id,'photo');
bot('sendMessage',[
'chat_id'=>$channel_id,
'text'=>"⌔︙تم تفعيل الكل
⌔︙معرف البوت @$botme",
'parse_mode'=>"MarkDown",
]);
}
$size = json_decode(file_get_contents("data.json"));
$photo1 = $size->channel->$channel_id->photo;
if($photo and $photo1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$sticker1 = $size->channel->$channel_id->voice;
if($sticker and $sticker1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$text1 = $size->channel->$channel_id->text;
if($channel_text and $text1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$voice1 = $size->channel->$channel_id->voice;
if($voice and $voice1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$audio1 = $size->channel->$channel_id->audio;
if($audio and $audio1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$video1 = $size->channel->$channel_id->video;
if($video and $video1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$links1 = $size->channel->$channel_id->links;
if(preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me|(.*)telesco.me|telesco.me(.*)/i',$channel_text) and $links1 == "معطل"){
 bot('deleteMessage',[
 'chat_id'=>$channel_id,
 'message_id'=>$channel_message_id
]);
} 
$user1 = $size->channel->$channel_id->user;
if(preg_match('/^(.*)@|@(.*)|(.*)@(.*)|(.*)#(.*)|#(.*)|(.*)#/',$channel_text) and $user1 == "معطل"){
 bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
 ]);
}
$doc1 = $size->channel->$channel_id->doc;
if($document and $doc1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$loc1 = $size->channel->$channel_id->loc;
if($location and $loc1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}
$sticker1 = $size->channel->$channel_id->sticker;
if($sticker and $sticker1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id,
]);
}

$fwd1 = $size->channel->$channel_id->fwd;
if($forward and $fwd1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id
]);
}

$gif1 = $size->channel->$channel_id->gif;
if($document and $channel_post->document->mime_type == "video/mp4" and $gif1 == "معطل"){
bot('deleteMessage',[
'chat_id'=>$channel_id,
'message_id'=>$channel_message_id,
]);
}

$postt1 = $size->channel->$channel_id->postt;
if($update->channel_post and $postt1 == "مفعل"){
bot('editMessageCaption',[
'chat_id'=>$update->channel_post->chat->id,
'caption'=>"[".$update->channel_post->caption."] 
⌔︙ 𝒕𝒆𝒍𝒆𝒈𝒓𝒂𝒎 : [@".$update->channel_post->chat->username."] ",
'message_id'=>$update->channel_post->message_id,
'parse_mode'=> 'Markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⇱ 𝑺𝒉𝒂𝒓𝒆", "url"=>"https://t.me/share/url?url=https://t.me/".$update->channel_post->chat->username."/".$update->channel_post->message_id]],
]])
]);
}
