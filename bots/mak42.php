<?php#*wataw*

if($start=="non"){
$start="
📑 أهلاً بك  في بوت الفوتوشوب 📷
• فقط قم بأرسال الصوره له وسيقوم بأعطائك الادوات اللازمه للتحرير ✨
- ملاحظه 📩 : لا يتم حفظ اي صوره في السيرفر وسيتم حذفها بعد الانتهاء من التعديل.
⎯ ⎯ ⎯ ⎯
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
$get_ids = file_get_contents("$rand1.txt");
$ids = explode("\n", $get_ids);
$bot = bot('getme',['bot'])->result->username;

if($text == "/start" ){
mkdir('photos');
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);}

if($message->photo){
$path = bot('getfile',['file_id'=>$message->photo[2]->file_id])->result->file_path;
mkdir('photos');
file_put_contents("photos/$chat_id.jpg", file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$path));
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>new CURLFile("photos/$chat_id.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
}
if ($data == 'twV') {
$data = getimagesize("photos/$chat_id2.jpg");
$dest = imagecreatefromjpeg("photos/$chat_id2.jpg");
$src = imagecreatetruecolor($data[0] ,$data[1] + 250);
imagefill($src, 0, 0, imagecolorallocate($src,255,255,255));
imagecopy($src, $dest, 0, 125, 0, 0 ,$data[0] , $data[1]);
imagejpeg($src,"photos/$chat_id2.jpg");
imagedestroy($src);
imagedestroy($dest);
bot('sendphoto',['chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'twH') {
$data = getimagesize("photos/$chat_id2.jpg");
$dest = imagecreatefromjpeg("photos/$chat_id2.jpg");
 $src = imagecreatetruecolor($data[0] + 250,$data[1]);
imagefill($src, 0, 0, imagecolorallocate($src,255,255,255));
imagecopy($src, $dest, 125, 0, 0, 0 ,$data[0] , $data[1]);
imagejpeg($src,"photos/$chat_id2.jpg");
imagedestroy($src);
imagedestroy($dest);
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if($data == 'gray'){
 $im = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($im, IMG_FILTER_GRAYSCALE);
imagejpeg($im,"photos/$chat_id2.jpg");

bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'roR') {
$source = imagecreatefromjpeg("photos/$chat_id2.jpg");
$rotate = imagerotate($source, -90, 0);
imagejpeg($rotate,"photos/$chat_id2.jpg");
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'roL') {
$source = imagecreatefromjpeg("photos/$chat_id2.jpg");
$rotate = imagerotate($source, 90, 0);
imagejpeg($rotate,"photos/$chat_id2.jpg");
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'fiO') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage,IMG_FILTER_GRAYSCALE);
imagefilter($myImage,IMG_FILTER_BRIGHTNESS,-30);
imagefilter($myImage,IMG_FILTER_COLORIZE, 90, 55, 30);  
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'fiB') {
file_put_contents("photos/$chat_id2.jpg", file_get_contents("http://powerful.elithost.ga/photoeffect/?filter=frozen&url=https://".$_SERVER['SERVER_NAME']."/p/photos/$chat_id2.jpg"));
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'fiL') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_BRIGHTNESS, 50);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'fiR') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_COLORIZE, 100, 0, 0);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'fiG') {
file_put_contents("photos/$chat_id2.jpg", file_get_contents("http://powerful.elithost.ga/photoeffect/?filter=everglow&url=https://".$_SERVER['SERVER_NAME']."/p/photos/$chat_id2.jpg"));
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}


if ($data == 'thal') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_CONTRAST, 150); 
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}
if ($data == 'filters') {
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'caption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'اضاءة.','callback_data'=>'fiL']],
[['text'=>'صوره قديمه.','callback_data'=>'fiO'],['text'=>'ابيض واسود.','callback_data'=>'gray']],
[['text'=>'احمر باهت','callback_data'=>'fiR']],
]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}


if ($data == 'green') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_COLORIZE, 0, 255, 0);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'Pink') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_COLORIZE, 100, 0, 100);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'paht') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_CONTRAST, 20);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'thabab') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_GAUSSIAN_BLUR);
imagefilter($myImage, IMG_FILTER_SELECTIVE_BLUR);
  header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'grey') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_GRAYSCALE);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'COLORIZE') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_COLORIZE, 0, 0, 100);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'BLUR') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'SMOOTH') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_SMOOTH, 5);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);
}

if ($data == 'GRACOL') {
$myImage = imagecreatefromjpeg("photos/$chat_id2.jpg");
imagefilter($myImage, IMG_FILTER_GRAYSCALE);
imagefilter($myImage, IMG_FILTER_COLORIZE, 90, 60, 30);
header("Content-type: image/jpeg");
imagejpeg($myImage,"photos/$chat_id2.jpg");
imagedestroy( $myImage );
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>new CURLFile("photos/$chat_id2.jpg"),
'hermajestycaption'=>"- @$bot",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- الفلاتر.','callback_data'=>'filters']],
[['text'=>'- توسيط عامودي ⤴️','callback_data'=>'twV'],['text'=>'- توسيط افقي ↩️','callback_data'=>'twH']],
[['text'=>'تدوير يمين ➡️ ','callback_data'=>'roR'],['text'=>'تدوير يسار ⬅️ ','callback_data'=>'roL']],]
])
]);
bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id]);}

