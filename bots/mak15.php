<?php#*wataw*

if($start=="non"){
$start="
👋🏻꒐ أهلاً بك في بوت الهمسة.
⏺꒐ يمكنك ارسال همسة لعده اشخاص مره واحده.
⚠️꒐ طريقة الاستخدام :
يمكنك ارسال همسة لشخص واحد من خلال
@$usernamebot مرحبًا @k_u_4

- او الأكثر من شخص من خلال
@$usernamebot مرحبًا بكم @k_u_4 @k_u_4
";}

$update = json_decode(file_get_contents("php://input"));
file_put_contents("upff.txt",json_encode($update));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$message_id = $message->message_id;
$name = $message->from->first_name.' '.$message->from->last_name;
$user = strtolower($message->from->username);
$t =$message->chat->title;
if(isset($update->callback_query)){
$up = $update->callback_query;
$chat_id = $up->message->chat->id;
$from_id = $up->from->id;
$user = strtolower($up->from->username); 
$name = $up->from->first_name.' '.$up->from->last_name;
$message_id = $up->message->message_id;
$mes_id = $update->callback_query->inline_message_id; 
file_put_contents("m.txt",$mes_id,"\n",FILE_APPEND);
$data = $up->data;}

if(isset($update->inline_query)){
$chat_id = $update->inline_query->chat->id;
$from_id = $update->inline_query->from->id;
$name = $update->inline_query->from->first_name.' '.$update->inline_query->from->last_name;
$text_inline = $update->inline_query->query;
$mes_id = $update->inline_query->inline_message_id; 
file_put_contents("mm.txt",$mes_id,"\n",FILE_APPEND);
$user = strtolower($update->inline_query->from->username);}

$status = bot('getChatMember',['chat_id'=>$ch,'user_id'=>$from_id,])->result->status;

$userjson = json_decode(file_get_contents("user.json"),true);
if (!file_exists("user.json")) {
$put = [];
file_put_contents("user.json", json_encode($put));}
$codejson = json_decode(file_get_contents("code.json"),true);
if (!file_exists("code.json")) {
$put = [];
file_put_contents("code.json", json_encode($put));}
$codedata = json_decode(file_get_contents("codedata.json"),true);
if (!file_exists("codedata.json")) {
$put = [];
file_put_contents("codedata.json", json_encode($put));}
$fromjson = json_decode(file_get_contents("from_id.json"),true);
if (!file_exists("from_id.json")) {
$put = [];
file_put_contents("from_id.json", json_encode($put));}
$media = json_decode(file_get_contents("media.json"),true);
if (!file_exists("media.json")) {
$put = [];
file_put_contents("media.json", json_encode($put));}
if($update){
if($user!=null){
$userjson["info"]["$user"]['id']="$from_id";
$userjson["info"]["$user"]['name']="$name";
file_put_contents("user.json", json_encode($userjson));}}

if ($text_inline==null) { 
$get=bot('answerInlineQuery',[ 
'inline_query_id'=>$update->inline_query->id,
'cache_time'=>'0',
'results' => json_encode([[ 
'type'=>'article', 
'id'=>base64_encode(rand(5,555)), 
'title'=>"اكتب الهمسه ثم يوزر الشخص او الاشخاص.",
'description'=>"@$usernamebot مرحبًا @YYUUYY \n\n @$usernamebot مرحبًا بكم @YYUUYY @dolartaem @dolartaem",
'input_message_content'=>[
'parse_mode'=>'HTML',
'message_text'=>"
- شرح استخدام البوت.
- لشخص محدد:
@$usernamebot مرحبًا @OO55W
- لاكثر مـن شخص:
@$usernamebot مرحبًا بكم @OO55W @oo66o @299938224
- شرح اكثر علئ القناه: @dolartaem
"],]])]);}

elseif ($text_inline and strpos($text_inline,'send')===false and strpos($text_inline,'get')===false  ) { 
if(strpos($text_inline,'@')!==false){
$ex = explode("@", $text_inline);
#if($ex)
$txt=$ex[0];
$us=str_replace($txt,"", $text_inline);
$co=count($ex);
if($co <= 2){
for($i=1;$i<count($ex);$i++){
$user_for =strtolower($ex[$i]);
$name_user=$userjson["info"]["$user_for"]['name'];
if($name_user!=null){
$l++;
$nn=$nn."\n$l-".$name_user;}
else
{$nn=$nn." @".$user_for;}}
}else{
$nn=$us;}

$rand=rand(111111,999999);
#mkdir("code");
if($txt!=null){
$codejson["info"]["$rand"]['text']="$txt";
file_put_contents("code.json", json_encode($codejson));}
#ile_put_contents("code/$rand.txt","$txt");
$userh=str_replace(' ',"", $us);
$userh =strtolower($userh);
bot('answerInlineQuery',[ 
'inline_query_id'=>$update->inline_query->id, 
'cache_time'=>'0',
'results' => json_encode([[ 
'type'=>'article', 
'id'=>base64_encode(rand(5,555)), 
'title'=>" 🔐 همسة سرية الى { $nn }",
'description'=>"هـو فقـط مـن يستطـيع رويـتها", 
'input_message_content'=>['parse_mode'=>'HTML',
'message_text'=>"🔐 همسة سرية الى { $nn }"],
'reply_markup'=>['inline_keyboard'=>[ 
[['text'=>'رؤية الهمسة 📒.','callback_data'=>'hamsh '.$rand.'to'.$userh.'to'.$from_id]],
]]]])]);
}else{
$rand=rand(111111,999999);
#mkdir("code");

if($text_inline!=null){
$codejson["info"]["$rand"]['text']="$text_inline";
file_put_contents("code.json", json_encode($codejson));}
#file_put_contents("code/$rand.txt","$text_inline");
$userjson = json_decode(file_get_contents("user.json"),true);
$fromjson = json_decode(file_get_contents("from_id.json"),true);
$member=$fromjson["info"][$from_id]["member"];
$member = array_reverse($member);
for($i=0;$i<count($member);$i++){
$mem=$member[$i];
$name_user=$userjson["info"]["$mem"]['name'];
if($name_user!=null){
$nn=$name_user;
}else{
$nn=$mem;}

$res[$i] = [
'type'=>'article', 
'id'=>base64_encode(rand(5,555)), 
'title'=>" 🔐 همسة سرية الى  { $nn }", 
'description'=>"هـو فقـط مـن يستطـيع رويـتها", 
'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"🔐 همسة سرية الى { $nn }"], 
'reply_markup'=>['inline_keyboard'=>[ 
[['text'=>'رؤية الهمسة 📒.','callback_data'=>'hamsh '.$rand.'to'.$mem.'to'.$from_id]],
]]];

if($i==10){break;}}
$r = json_encode($res);
file_put_contents("r.txt",$r);
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id,
'cache_time'=>'0',
'results' =>($r)]);}}

if ($text_inline and strpos($text_inline,'send')!==false ){
if(strpos($text_inline,'@')!==false){
$ex = explode("@", $text_inline);
#if($ex)
$txt=$ex[0];
$us=str_replace($txt,"", $text_inline);
$co=count($ex);
if($co <= 2){
for($i=1;$i<count($ex);$i++){
$user_for =strtolower($ex[$i]);
$name_user=$userjson["info"]["$user_for"]['name'];
if($name_user!=null){
$l++;
$nn=$nn."-".$name_user;}
else
{$nn=$nn." @".$user_for;}}
}else{
$nn=$us;}
$vo=str_replace(' ',"", $txt);
$ex3 = explode("-", $vo);
$code=$ex3[1];
$rand=rand(1111111111,9999999999);
$userh=str_replace(' ',"", $us);
$userh =strtolower($userh);
#mkdir("codedata");
if($userh!=null){
$codedata["info"]["$rand"]['user']="$userh".'@'.$user;
$codedata["info"]["$rand"]['code']="$code";
file_put_contents("codedata.json", json_encode($codedata));}
#file_put_contents("codedata/$rand.txt","$userh".'@'.$user,FILE_APPEND);
#file_put_contents("code/$rand.txt","$code");
$media = json_decode(file_get_contents("media.json"),true);
$title=$media["info"]["$code"]['title'];
$no3=$media["info"]["$code"]['no3'];
$description=$media["info"]["$code"]['description'];
bot('answerInlineQuery',[ 
'inline_query_id'=>$update->inline_query->id, 
'cache_time'=>'0',
'results' => json_encode([[ 
'type'=>'article', 
'id'=>base64_encode(rand(5,555)), 
'title'=>"🔐 $title سرية الى  { $nn }", 
'description'=>"هـو فقـط مـن يستطـيع $description", 
'input_message_content'=>['parse_mode'=>'HTML',
'message_text'=>"🔐$title سرية الى { $nn }"], 
'reply_markup'=>['inline_keyboard'=>[ 
[['text'=>'رؤية الهمسة 📒.','switch_inline_query_current_chat'=>'get'.$no3.'-'.$rand]],]] 
]])]);
}else{
bot('answerInlineQuery',[ 
'inline_query_id'=>$update->inline_query->id,
'cache_time'=>'0',
'results' => json_encode([[ 
'type'=>'article', 
'id'=>base64_encode(rand(5,555)), 
'title'=>"همسة ميديا ..", 
'description'=>"قم باضافة يوزرات الاشخاص الذين تريد ارسال همستك لهم",
'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"."], 
]])]);}}

elseif ($text_inline and strpos($text_inline,'get')!==false) { 
$vo=str_replace(' ',"", $text_inline);
$ex3 = explode("-", $vo);
$rand=$ex3[1];
$codedata = json_decode(file_get_contents("codedata.json"),true);
$code=$codedata["info"]["$rand"]['code'];
$txt=$codedata["info"]["$rand"]['user'];
$media = json_decode(file_get_contents("media.json"),true);
$title=
$media["info"]["$code"]['title'];
$description=
$media["info"]["$code"]['description'];
$no3=$media["info"]["$code"]['no3'];
$url=$media["info"]["$code"]['url'];
$file_idd=$media["info"]["$code"]['file_id'];
$mime_type=$media["info"]["$code"]['mime_type'];
$e=explode("@",$txt); 

if($user==null){
$user=$from_id;}

if(in_array($user,$e) or  $from_id== $admin ){
bot('answerInlineQuery',[ 
'inline_query_id'=>$update->inline_query->id,   
'cache_time'=>'0',
'results'=>json_encode([[ 'type'=>$no3, 
'id'=>base64_encode(rand(5,555)), 
"$url"=>"$file_idd", 
"thumb_url"=>"$file_idd", 
"mime_type"=>"$mime_type", 
'title'=>"$title..", 
'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"تم إستعراض الهمسة"],]])]); 
}else{
bot('answerInlineQuery',[ 
'inline_query_id'=>$update->inline_query->id,
'cache_time'=>'0',
'results' => json_encode([[ 
'type'=>'article', 
'id'=>base64_encode(rand(5,555)), 
'title'=>"همسة ميديا ..", 
'description'=>"الهمسة ليست لك لا تستطيع رؤريتها.",
'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"."],]])]);}}

if(preg_match('/^(hamsh) (.*)/s', $data)){
$data = str_replace('hamsh ',"",$data);
$ex = explode("to", $data);
$rand=$ex[0];
$from=$ex[1];
$custom=$ex[2];
$e=explode("@",$from); 
$codejson = json_decode(file_get_contents("code.json"),true);
$txt=$codejson["info"]["$rand"]['text'];
if($user==null){
$user=$from_id;}

if(in_array($user,$e)  or $from_id==$custom or $from_id== $admin){
$mb_str=mb_strlen($txt,"utf-8");
if($mb_str<=200){
bot('answerCallbackQuery',[ 
'callback_query_id'=>$update->callback_query->id, 
'text'=>$txt, 
'show_alert'=>true]);
}else{
bot('answerCallbackQuery',[ 
'callback_query_id'=>$update->callback_query->id, 
'text'=>"⚠ المعذرة لايمكنني عرض رسالة الهمسة هنا الرسالة طويلة جداً لذا ساقوم بارسالها اليك على خاص البوت.",
'show_alert'=>true]);
bot('sendMessage',['chat_id'=>$from_id,
'text'=>"
 📣 الهمسة هي :
( $txt )",]);}
} else{
bot('answerCallbackQuery',[ 
'callback_query_id'=>$update->callback_query->id, 
'text'=>"عذراً هذه الهمسة ليست لك 👍🏻.", 
'show_alert'=>true]);}

$fromjson = json_decode(file_get_contents("from_id.json"),true);
$ex2 = explode("@", $from);
for($i=0;$i<count($ex2);$i++){
$user_for =strtolower($ex2[$i]);
if($user_for!=null){
if(!in_array('@'.$user_for,$fromjson["info"][$custom]["member"])){
$fromjson["info"][$custom]["member"][]="@$user_for";}}}
file_put_contents("from_id.json", json_encode($fromjson));}

if($update->message->audio){
$file_id = $update->message->audio->file_id;
$rand=rand(1111111111,9999999999);
$media["info"]["$rand"]['no3']="audio";
$media["info"]["$rand"]['url']="audio_file_id";
$media["info"]["$rand"]['file_id']="$file_id";
$media["info"]["$rand"]['title']=" همسة موسيقى  🎧";
$media["info"]["$rand"]['description']=" سماعها";
$media["info"]["$rand"]['from_id']="$from_id";
file_put_contents("media.json", json_encode($media));
bot('sendaudio',[
'chat_id'=>$chat_id, 
'audio'=>$file_id,
'caption'=>"✅ تم حفظ الهمسة موسيقى  💾 ",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الهمسة 📧",'switch_inline_query'=>'sendaudio-'.$rand]],]])]);}
  

if($update->message->voice){
$file_id = $update->message->voice->file_id;
$rand=rand(1111111111,9999999999);
$media["info"]["$rand"]['no3']="voice";
$media["info"]["$rand"]['url']="voice_file_id";
$media["info"]["$rand"]['file_id']="$file_id";
$media["info"]["$rand"]['title']=" همسة صوتية  🎧";
$media["info"]["$rand"]['description']=" سماعها";
$media["info"]["$rand"]['from_id']="$from_id";
file_put_contents("media.json", json_encode($media));
bot('sendvoice',[
'chat_id'=>$chat_id, 
'voice'=>$file_id,
'caption'=>"✅ تم حفظ الهمسة الصوتية  💾 ",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الهمسة 📧",'switch_inline_query'=>'sendvoice-'.$rand]],]])]);}
  
if($update->message->photo){
$file_id = $update->message->photo[2]->file_id;
$rand=rand(1111111111,9999999999);
$media["info"]["$rand"]['no3']="photo";
$media["info"]["$rand"]['url']="photo_file_id";
$media["info"]["$rand"]['file_id']="$file_id";
$media["info"]["$rand"]['title']=" همسة بـ صورة  🌄";
$media["info"]["$rand"]['description']=" رؤية الصورة";
$media["info"]["$rand"]['from_id']="$from_id";
file_put_contents("media.json", json_encode($media));
bot('sendphoto',[
'chat_id'=>$chat_id, 
'photo'=>$file_id,
'caption'=>"✅ تم حفظ الهمسة بــ الصورة 💾",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الهمسة 📧",'switch_inline_query'=>'sendphoto-'.$rand]],]])]);}

if($update->message->video){
$file_id = $update->message->video->file_id;
$rand=rand(1111111111,9999999999);
$media["info"]["$rand"]['no3']="video";
$media["info"]["$rand"]['url']="video_file_id";
$media["info"]["$rand"]['file_id']="$file_id";
$media["info"]["$rand"]['title']=" همسة فيديو  🎬";
$media["info"]["$rand"]['description']=" مشاهدتة";
$media["info"]["$rand"]['from_id']="$from_id";
file_put_contents("media.json", json_encode($media));
bot('sendvideo',[
'chat_id'=>$chat_id, 
'video'=>$file_id,
'caption'=>"✅ تم حفظ الهمسة بـ الفيديو  💾",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الهمسة",'switch_inline_query'=>'sendvideo-'.$rand]],]])]);}


if($update->message->sticker){
$file_id = $update->message->sticker->file_id;
$rand=rand(1111111111,9999999999);
$media["info"]["$rand"]['no3']="sticker";
$media["info"]["$rand"]['url']="sticker_file_id";
$media["info"]["$rand"]['file_id']="$file_id";
$media["info"]["$rand"]['title']=" همسة بـ ملصق  🌄";
$media["info"]["$rand"]['description']=" رؤية الملصق";
$media["info"]["$rand"]['from_id']="$from_id";
file_put_contents("media.json", json_encode($media));
bot('sendsticker',[
'chat_id'=>$chat_id, 
'sticker'=>$file_id,
'caption'=>"✅ تم حفظ الهمسة بــ الملصق 💾",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الهمسة 📧",'switch_inline_query'=>'sendsticker-'.$rand]],]])]);}

if($update->message->document){
$r = $update->message->animation;
if($r){
$file_id = $update->message->document->file_id;
$rand=rand(1111111111,9999999999);
$media["info"]["$rand"]['no3']="gif";
$media["info"]["$rand"]['url']="gif_url";
$media["info"]["$rand"]['file_id']="$file_id";
$media["info"]["$rand"]['title']="همسة صورة متحركة  🎬";
$media["info"]["$rand"]['description']="مشاهدة الصورة المتحركة";
$media["info"]["$rand"]['from_id']="$from_id";
file_put_contents("media.json", json_encode($media));
bot('senddocument',[
'chat_id'=>$chat_id, 
'document'=>$file_id,
'caption'=>"✅ تم حفظ الهمسة بشكل صورة متحركة 💾.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الهمسة 📧",'switch_inline_query'=>'senddocument-'.$rand]],]])]);}}

if($text ==  '/start' ){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>true,
'parse_mode'=>"Markdown",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- طريقة الهمسة بالايدي.",'callback_data'=>'1m']],
[['text'=>"- طريقة الهمس بالميديا.",'callback_data'=>'2m']],
]])]);}

if($data == "0m" ){
bot('editMessageText',['chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"$start

$txtfree",
'disable_web_page_preview'=>true,
'parse_mode'=>"Markdown",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- طريقة الهمسة بالايدي.",'callback_data'=>'1m']],
[['text'=>"- طريقة الهمس بالميديا.",'callback_data'=>'2m']],
]])]);}

if($data == "1m" ){
bot('editMessageText',['chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
- طريقه الهمسة بالايدي:
- قم بكتابة يوزر البوت ومن ثم الرساله ثم @ + ايدي الشخص

- كيفية همسه لشخص معين ؟

@$usernamebot مرحبًا 
@299938224

- طريقة الهمسة الجماعية:
@$usernamebot مرحبًا بالجميع 
@299938224 @OO55W @299938224

- ملاحظة ضع مع الايدي (@).
$txtfree",
'disable_web_page_preview'=> true ,
'parse_mode'=>"Markdown",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- رجوع.",'callback_data'=>"0m"]],]])]);}

if($data == "2m" ){
bot('editMessageText',['chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
- بوت همسة تكدر تهمس : بصمة , صوره , ملصق , متحركة الخ...

- فقط ادخل الئ البوت وأرسل اي شي ملصق او صور او نص الخ...
- ثم اضغط مشاركه الهمسه وحدد الشخص الذي تود أرسال الهمسه له مع يوزر او ايدي الشخص.

- بعض الامثله للتوضيح:
- @$usernamebot sendsticker-299938224 
- اهمس لشخص:
- @$usernamebot sendsticker-299938224 @OO55W
- لأرسال همسه جماعيه:
- @$usernamebot sendsticker-299938224 @OO55W @oo66o @299938224
$txtfree",
'disable_web_page_preview'=> true ,
'parse_mode'=>"Markdown",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- رجوع.",'callback_data'=>"0m"]],]])]);}
