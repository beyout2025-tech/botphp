<?php#*wataw*

if($start=="non"){
$start="
📑 أهلاً بك $name
▫️ في بوت تحميل من Youtube 👋🏻.
▫️ ارسل رابط الفديو لتحميله بصيغه تسجيل او ملف صوتي او فيديو ℹ️.
▫️ او أرسل كلمة او نص للبحث 📄.
▫️ يمكنك ايضأ البحث عن طريق معرف البوت.
⎯ ⎯ ⎯ ⎯";}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$name = $update->message->from->first_name;
$from_id = $update->message->from->id;
$sttings = json_decode(file_get_contents("vid.json"),1);

$s = "https://amer.cf/api/yt.php";

if($text == "/start" and !in_array($from_id,$ebu)){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"مشاركة البوت",'switch_inline_query'=>'']],
]])]);}

if($text != "/start" and !preg_match("/(.*?)(youtube)|(you)(.*?)/",$text)  and !in_array($from_id,$ebu)){
$api = json_decode(file_get_contents("https://xcmcmx.ml/api/yy.php?serch=".urlencode($text)), true);
$keyboard["inline_keyboard"]=[];
for ($i=0; $i < 25; $i++) {
$keyboard["inline_keyboard"][$i] = [['text'=>$api['Info']['Title'][$i],'callback_data'=>'dl#'.$api['Info']['Id'][$i]]];}
$reply_markup = json_encode($keyboard);
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>'نتائج البحث عن '.$text.' 🎙️',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>$reply_markup,]);
$hso['data'] = "stop";
file_put_contents("start.json",json_encode($hso));}

$do = explode('#', $data);
$photo = "http://www.youtube.com/watch?v=".$do[1];
$api2 = json_decode(file_get_contents($s."?q=360&vid=".$do[1]), true);
$Title2 = $api2['title'];
$mp42 = $api2['url'];
if($do[0] == "dl"){
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('sendphoto',['chat_id'=>$chat_id2,
'photo'=>$photo,
"caption"=>"$Title2",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'MP4 🖥️','callback_data' =>"vi#"]],
[['text'=>'MP3 🎼','callback_data' =>"au#"],['text'=>'🎧 بصمه صوتيه','callback_data' =>"vo#"]],
[['text'=>"مشاركة البوت",'switch_inline_query'=>'']]]])]);
$sttings[$chat_id2]['Title'] = "$Title2";
$sttings[$chat_id2]['mp4'] = "$mp42";
file_put_contents("vid.json",json_encode($sttings));}

$url_info = file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe");
$json_info = json_decode($url_info);
$userr = $json_info->result->username;
if($text != "/start" and preg_match("/(.*?)(youtube)|(you)(.*?)/",$text) and !in_array($from_id,$ebu)){
$api = json_decode(file_get_contents($s."?q=360&vid=".$text), true);
$Title = $api['title'];
$mp4 = $api['url'];
bot('sendphoto',['chat_id'=>$chat_id,
'photo'=>$text,
"caption"=>"$Title",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'MP4 🖥️','callback_data' =>"vi#"]],
[['text'=>'MP3 🎼','callback_data' =>"au#"],['text'=>'🎧 بصمه صوتيه','callback_data' =>"vo#"]],
[['text'=>"مشاركة البوت",'switch_inline_query'=>'']]]])]);
$sttings[$chat_id]['Title'] = "$Title";
$sttings[$chat_id]['mp4'] = "$mp4";
file_put_contents("vid.json",json_encode($sttings));}
if($data == "au#"){
if($sttings[$chat_id2]['Title'] == null){
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('sendMessage',['chat_id'=>$chat_id2,
'text'=>"*هناك خطء بالفيدو او ان حجم الفديو كبير*",
'parse_mode'=>"MarkDown",]);
}else{
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"جار ارسال مقطع الصوتي",]);
file_put_contents($sttings[$chat_id2]['Title'].".mp3",file_get_contents($sttings[$chat_id2]['mp4']));
bot('sendaudio',['chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'audio'=>new CURLFile($sttings[$chat_id2]['Title'].".mp3"),
"caption"=>"- Bot : @$userr",]);
unlink($sttings[$chat_id2]['Title'].".mp3");
unset($sttings[$chat_id2]);
file_put_contents("vid.json",json_encode($sttings));}}

if($data == "vi#"){
if($sttings[$chat_id2]['Title'] == null){
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('sendMessage',['chat_id'=>$chat_id2,
'text'=>"عذراً حدث خطاء ما حاول مجدداً ⚠️",]);
}else{
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"جار ارسال مقطع الفيديو",]);
file_put_contents($sttings[$chat_id2]['Title'].".mp4",file_get_contents($sttings[$chat_id2]['mp4']));
bot('sendvideo',['chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'video'=>new CURLFile($sttings[$chat_id2]['Title'].".mp4"),
"caption"=>"- Bot : @$userr",]);
unlink($sttings[$chat_id2]['Title'].".mp4");
unset($sttings[$chat_id2]);
file_put_contents("vid.json",json_encode($sttings));}}

if($data == "vo#"){
if($sttings[$chat_id2]['Title'] == null){
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('sendMessage',['chat_id'=>$chat_id2,
'text'=>"عذراً حدث خطاء ما حاول مجدداً ⚠️",]);
}else{
bot('deleteMessage',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,]);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"جار ارسال التسجيل الصوتي",]);
file_put_contents($sttings[$chat_id2]['Title'].".ogg",file_get_contents($sttings[$chat_id2]['mp4']));
bot('sendvoice',['chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'voice'=>new CURLFile($sttings[$chat_id2]['Title'].".ogg"),
"caption"=>"- Bot : @$userr",]);
unlink($sttings[$chat_id2]['Title'].".ogg");
unset($sttings[$chat_id2]);
file_put_contents("vid.json",json_encode($sttings));}}

if($update->inline_query->query){
$item = json_decode(file_get_contents("https://xcmcmx.ml/api/y.php?search=".urlencode($update->inline_query->query)),true);
$keyboard["inline_keyboard"]=[];
for($i=0;$i<25;$i++){
$inlinesearchs[$i] = ['type'=>'article',
'id'=>base64_encode(rand(5,555)),
'thumb_url'=>$item["results"][$i]["image"],
'title'=>$item["results"][$i]["title"],
'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"https://www.youtube.com/watch?v=".$item["results"][$i]["url"]],];}
$Urls = json_encode($inlinesearchs);
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id, 
'results' =>($Urls)]);}

if ($update->inline_query->query == "") {
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'cache_time'=>'0',
'results'=>json_encode([['type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>"اكتب الكلمة التي تريد البحث عنها",
'description'=>"كـمثال احبك",
'input_message_content'=>['parse_mode'=>'MarkDown',
'message_text'=>"*
- للبحث في يوتيوب.
- يمكنك وضع معرف البوت @UoUBot ثم الكلمة للبحث عنها.*
*- كمثال:* `@UOUBot احبك`
*- سوف يظهر لك اكثر من 20 خيار اختر الذي يناسبك.
*"],
'reply_markup' => ['inline_keyboard'=>[
[['text'=>"اضغط هنا للدخول للبوت",'url'=>'t.me/uoubot']],
[['text'=>"مشاركة البوت",'switch_inline_query'=>'']]
]]]])]);}

