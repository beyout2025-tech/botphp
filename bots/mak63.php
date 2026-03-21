<?php#*wataw*

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
$voice_id = $message->voice->file_id;
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
$saiko = json_decode(file_get_contents("saiko.json"),true);
$m = count($saiko['kt']) -1;
$ameer = rand("0",$m);
$o = count($saiko['kt']);

if($text == "/start" ){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اهلا بك في بوت كت ستار اضفني في مجموعتك وارسل كت او /get ✅
⎯ ⎯ ⎯ ⎯
$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
]);
}

if ($text == "/start" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
عزيزي الادمن اوامر هي :
عدد الاسئله: لعرض الاسئلة المتوفره
لاضافة سؤال : اضف سؤال + السؤال
لحذف سؤال : حذف سؤال + السؤال
⎯ ⎯ ⎯ ⎯
",
'reply_to_message_id'=>$message->message_id,
]);
}

//من هنا تبدي اوامر الادمن
if($text == "عدد الاسئله" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"♪ عدد الاسئله هي { *$o* } سؤال
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
}
$add_kt = str_replace("اضف سؤال ","",$text);
if($text == "اضف سؤال $add_kt" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"♪ تم اضافة السؤال بنجاح
♪ السؤال { *$add_kt* }
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
$saiko['kt'][] = $add_kt;
file_put_contents("saiko.json",json_encode($saiko));
}
$del_kt = str_replace("حذف سؤال ","",$text);
if($text == "حذف سؤال $del_kt" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"♪ تم حذف السؤال بنجاح
♪ السؤال { *$del_kt* }
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
$key = array_search($del_kt,$saiko["kt"]);
unset($saiko["kt"][$key]);
$saiko["kt"] = array_values($saiko["kt"]); 
file_put_contents("saiko.json",json_encode($saiko));
}
//من هنا تبدي اوامر الادمن والعضو
$ok = $saiko['kt'][$ameer];
if($text == "كت" or $text == "تويت" or $text == "كت تويت"){
if($o == "0"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
♪ *عذرا عزيزي لا يوجد اسئلة*
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}

if($text == "كت" or $text == "/get" or $text == "كت تويت"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"♪ *$ok*",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
}
}

