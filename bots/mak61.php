<?php#*wataw*

if($start=="non"){
$start="▫️ مرحبا بك عزيزي 👋🏻. 
▫️ اهدي حبيبتك او بيستك اروع الاغاني من هذا البوت 💗.

🌐 للأهداء عليك اتباع مايلي :
1︙أرسل اي بصمه او توجيه الى البوت .
2︙بعد أرسال البصمة قم بإرسال نص الاهداء .
";}

$update = json_decode(file_get_contents('php://input'));
$message  = $update->message;
$text = $message->text;
$name = $message->from->first_name;
$user = $message->from->username;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$update = json_decode(file_get_contents('php://input'));
if($update->message){
	$message = $update->message;
$message_id = $update->message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$title = $message->chat->title;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
}
if($update->callback_query){
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$title = $update->callback_query->message->chat->title;
$message_id = $update->callback_query->message->message_id;
$name = $update->callback_query->message->chat->first_name;
$user = $update->callback_query->message->chat->username;
$from_id = $update->callback_query->from->id;
}
if($update->edited_message){
	$message = $update->edited_message;
	$message_id = $message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
	}
	if($update->channel_post){
	$message = $update->channel_post;
	$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->chat->username;
$title = $message->chat->title;
$name = $message->author_signature;
$from_id = $message->chat->id;
	}
	if($update->edited_channel_post){
	$message = $update->edited_channel_post;
	$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->chat->username;
$name = $message->author_signature;
$from_id = $message->chat->id;
	}
	if($update->inline_query){
		$inline = $update->inline_query;
		$message = $inline;
		$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
$query = $message->query;
$text = $query;
		}
	if($update->chosen_inline_result){
		$message = $update->chosen_inline_result;
		$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
$inline_message_id = $message->inline_message_id;
$message_id = $inline_message_id;
$text = $message->query;
$query = $text;
		}
		$tc = $update->message->chat->type;
		$re = $update->message->reply_to_message;
		$re_id = $update->message->reply_to_message->from->id;
$re_user = $update->message->reply_to_message->from->username;
$re_name = $update->message->reply_to_message->from->first_name;
$re_messagid = $update->message->reply_to_message->message_id;
$re_chatid = $update->message->reply_to_message->chat->id;
$photo = $message->photo;
$video = $message->video;
$sticker = $message->sticker;
$file = $message->document;
$audio = $message->audio;
$voice = $message->voice;
$caption = $message->caption;
$photo_id = $message->photo[0]->file_id;
$video_id= $message->video->file_id;
$sticker_id = $message->sticker->file_id;
$file_id = $message->document->file_id;
$music_id = $message->audio->file_id;
$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$title = $message->chat->title;
if($re){
	$forward_type = $re->forward_from->type;
$forward_name = $re->forward_from->first_name;
$forward_user = $re->forward_from->username;
	}else{
$forward_type = $message->forward_from->type;
$forward_name = $message->forward_from->first_name;
$forward_user = $message->forward_from->username;
$forward_id = $message->forward_from->id;
if($forward_name == null){
	$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$forward_title = $message->forward_from_chat->title;
	}
}

$name_tag = "[$name](tg://user?id=$from_id)";

if($text == "/start" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>'⌔︙اهلا بك عزيزي الادمن {'.$name_tag.'}
⌔︙الان اختر ماتريد من الاسفل
',
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'⌔︙اضف قناة اهداء' ,'callback_data'=>"add_ch"]],
]])
]);
}

$title = $message->chat->title;
$name_tag = "[$name](tg://user?id=$from_id)";
$title = $message->chat->title;
$saiko = json_decode(file_get_contents("SAIKO.json"),1);
$admin = "$admin";
$s = $saiko['ch'];
$ch = "@$s";
//---//
if($data == "add_ch"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"⌔︙الان ارسل معرف قناتك بدون @",
]);
$saiko['ch'] = "on";
file_put_contents("SAIKO.json",json_encode($saiko));
exit();
}
if($text and $saiko['ch'] == "on"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⌔︙تم حفض قناتك
⌔︙معرف قناتك : @$text
",
'reply_to_message_id'=>$message->message_id,
]);
$saiko['ch'] = $text;
file_put_contents("SAIKO.json",json_encode($saiko));
}

if($text=="/start"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$start
$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'- قناة الاهداء 🎙️.' ,'url'=>"https://t.me/$s"]],
]])
]);
}

//---//
if($voice){
if($saiko[$from_id]['caption'] != null){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>'
⌯ عذرا عزيزي لا يمكنك استخدام البوت
⌯ انتضر الموافقة او الرفض علئ بصمتك
⌯ بصمتك {'.$saiko[$from_id]['caption'].'}
',
]);
exit();
}
}

//---//
$voice = $message->voice;
$file = $voice->file_id;
if($voice and $tc == "private"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ارسل الان الاهداء 
مثال : من أمير لـ شامة ،
",]);
$saiko[$from_id]['test'] = "ok";
$saiko[$from_id]['voice'] = "$file";
file_put_contents("SAIKO.json",json_encode($saiko));
}
if($text and $tc == "private"){
if($saiko[$from_id]['test'] == "ok"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
• تم ارسال اهدائك الى المشرف 
انتضر الموافقه عزيزي 💕.
",
]);
bot('sendvoice',[
'chat_id'=>$admin,
'voice'=>$saiko[$from_id]['voice'],
'caption'=>"
⌯ اهلا عزيزي المطور هنالك بصمة جديدة 💕.
-----------------
وصف البصمة : $text",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'⌯ رفض' ,'callback_data'=>"no:$from_id"],['text'=>'⌯ موافق' ,'callback_data'=>"on:$from_id"]],
[['text'=>$name,'url'=>"https://t.me/$user"]],
]])
]);
$saiko[$from_id]['test'] = "no";
$saiko[$from_id]['caption'] = "$text";
file_put_contents("SAIKO.json",json_encode($saiko));
}
}
$km = str_replace("no:","",$data);
$m = "no:";
if(preg_match("/^(.*)([$m])/",$data)){
bot('sendmessage',[
'chat_id'=>$km,
'text'=>"⌯ عذرا عزيزي
⌯ لقد تم رفض بصمتك بواسطة المطور 
",
]);
bot('EditMessageCaption',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'caption'=>'⌯ تم الامر بنجاح',
]);
unset($saiko[$km]['voice']);
unset($saiko[$km]['caption']);
unset($saiko[$km]['test']);
file_put_contents("SAIKO.json",json_encode($saiko));
}
$bn = str_replace("on:","",$data);
$n = "on:";
if(preg_match("/^(.*)([$n])/",$data)){
bot('sendmessage',[
'chat_id'=>$bn,
'text'=>'
تم الموافقه على بصمتك : '.$saiko[$bn]['caption'].'
',
]);
bot('EditMessageCaption',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'caption'=>'⌯ تم الامر بنجاح',
]);
bot('sendvoice',[
'chat_id'=>$ch,
'voice'=>$saiko[$bn]['voice'],
'caption'=>$saiko[$bn]['caption'],
'reply_markup'=>json_encode([ 'inline_keyboard'=>[
[['text'=>"بوت الاهداءات 👆🏾💛.",'url'=>"t.me/$usernamebot"]],
]])
]);
unset($saiko[$bn]['voice']);
unset($saiko[$bn]['caption']);
unset($saiko[$bn]['test']);
file_put_contents("SAIKO.json",json_encode($saiko));
}
if($tc == 'group' or $tc == 'supergroup'){
bot('leaveChat',[
'chat_id'=>$chat_id,
]);
}

