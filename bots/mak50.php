<?php#*wataw*
<?php 
ob_start();
$token = "5338423951:AAEEyzz3mStWO8opKGsBcKCNHn8QKFJr47U";
define("API_KEY",$token);
function bot($method,$datas=[]){
echo file_get_contents("https://api.telegram.org/bot".$API_KEY."/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
    var_dump(curl_error($ch));
    }else{
    return json_decode($res);
    }
}
$Dev = array("1956402839","1");
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $update->message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$from_id = $message->from->id;
$from_id2 = $update->callback_query->message->from->id;
$message = $update->message;
$id = $message->from->id;
$chat_id = $message->chat->id;
$bot = '@'.bot('getme',['bot'])->result->username;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$data     = $update->callback_query->data;
@$statjson = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=".$from_id),true);
@$status = $statjson['result']['status'];
$admin = "1956402839"; 
$ARMOFF = file_get_contents("ARMOF.txt");
$ARMOFF0 = file_get_contents("ARMOF0.txt");
$ARMOFF1= file_get_contents("ARMOF1.txt");
$ARMOFF5 = file_get_contents("ARMOF2.txt");
$ARMOFF6 = file_get_contents("ARMOF3.txt");
$ARMOFF20 = json_decode(file_get_contents('php://input'));
$ARMOFF18 = $update->message;
$ARMOFF13 = $ARMOFF18->chat->id;
$ARMOFF17 = $ARMOFF18->text;
$meme = $ARMOFF20->callback_query->data;
$ARMOFF12 = $ARMOFF20->callback_query->message->chat->id;
$ARMOFF14 =  $ARMOFF20->callback_query->message->message_id;
$ARMOFF15 = $ARMOFF18->from->first_name;
$ARMOFF16 = $ARMOFF18->from->username;
$ARMOFF11 = $ARMOFF18->from->id;
$ARMOFF2 = explode("\n",file_get_contents("ARMOF4.txt"));
$ArmoCH = explode("\n",file_get_contents("chall.txt"));
$ARMOFGROP = explode("\n",file_get_contents("ARMOFGR.txt"));
$ARMOFF3 = count($ARMOFF2)-1;
$ARMOFGROPnt = count($ARMOFGROP)-1;
$admin = 1956402839; 
$text_ch = $update->channel_post->text;
$ch_id = $update->channel_post->chat->id;
$getchall = file_get_contents("chall.txt");
$allgetch = explode("\n",$getchall);
$bot = file_get_contents("com.txt");
$cchcc = explode("\n",file_get_contents("chall.txt"));
$alllch = count($cchcc)-1;
$ARMOFF11 = $ARMOFF18->from->id;
$tc = $update->message->chat->type;
if($text_ch !== "/start" and !in_array($ch_id,$allgetch)){
file_put_contents("chall.txt","\n$ch_id",FILE_APPEND);
}
if($tc == 'private'){
if($message and !in_array($ARMOFF11, $ARMOFF2)) {
file_put_contents("ARMOF4.txt", $ARMOFF11."\n",FILE_APPEND);
}}
if($tc == 'group' || $tc == 'supergroup'){
if($message and !in_array($chat_id, $ARMOFGROP)) {
file_put_contents("ARMOFGR.txt", $chat_id."\n",FILE_APPEND);
}}
$ARMOFF9 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ARMOFF0&user_id=".$ARMOFF11);
$ARMOFF10 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ARMOFF1&user_id=".$ARMOFF11);
if($ARMOFF18 && (strpos($ARMOFF9,'"status":"left"') or strpos($ARMOFF9,'"Bad Request: USER_ID_INVALID"') or strpos($ARMOFF9,'"status":"kicked"') or strpos($ARMOFF10,'"status":"left"') or strpos($ARMOFF10,'"Bad Request: USER_ID_INVALID"') or strpos($ARMOFF10,'"status":"kicked"'))!== false){
if($tc == 'private'){
bot('sendMessage', [
'chat_id'=>$ARMOFF13,
'text'=>'
📧- ▫️ عذراً عزيزي  ، ☡
⚠️- يجب عليك الإشتراك في قنوات البوت أولاً
🔇- اشترك ثم ارسل ( /start )📮!
'.$ARMOFF0.'
'.$ARMOFF1,
]);return false;}}
if($ARMOFF17 == "/admin" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>"مرحبآ بك ، 
- هذه لوحة التحكم الخاصة بك ، 🔰
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🐬
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'- أوامر الإشتراك الإجباري الأول ، 📢' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، 🌚🤞🏻' ,'callback_data'=>"ARMOF0"],['text'=>'• حذف قناة ، 🌚🤙🏻' ,'callback_data'=>"delete11"]],
[['text'=>'- أوامر الإشتراك الإجباري الثاني ، 📢' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، 🌝🤞🏻' ,'callback_data'=>"ARMOF2"],['text'=>'• حذف قناة ، 🌝🤙🏻' ,'callback_data'=>"delete22"]],
[['text'=>'- عرض قنوات الإشتراك ، 📛' ,'callback_data'=>"ARMOF4"]],
[['text'=>'- أوامر الإذاعه ، 🗣' ,'callback_data'=>"ARMOF"]],
[['text'=>'• رسالة توجيه ، ⚠️' ,'callback_data'=>"ARMOF5"],['text'=>'• رسالة نصية ، ⚠️' ,'callback_data'=>"ARMOF6"]],
[['text'=>'• رساله قنوات توجيه ،⚙' ,'callback_data'=>"ARMOFch"],['text'=>'• رساله قنوات نصية ، ⚙' ,'callback_data'=>"ARMOFchtx"]],
[['text'=>'• رساله كروبات توجيه ، 👥' ,'callback_data'=>"ARMOFGro"],['text'=>'• رساله كروبات نصية ،👥' ,'callback_data'=>"ARMOFGr"]],
[['text'=>'- عدد القنوات ، 🐳' ,'callback_data'=>"ARMOF77"]],
[['text'=>'- عدد المشتركين ، 🐳' ,'callback_data'=>"ARMOF7"],['text'=>'- عدد الكروبات ، 🐳' ,'callback_data'=>"ARMOF777"]],
[['text'=>'- التنبيه عند دخول أحد للبوت ، ⚠️' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التنبيه ، 💬' ,'callback_data'=>"ARMOF9"],['text'=>'• تعطيل التنبيه ، ❎' ,'callback_data'=>"ARMOF10"]],
[['text'=>'- توجيه رسائل من الأعضاء ، 💬' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التوجيه ، 💬' ,'callback_data'=>"ARMOF11"],['text'=>'• تعطيل التوجيه ، ❎' ,'callback_data'=>"ARMOF12"]],
   ] 
   ])
]);
}
if($meme == "ARMOF" ){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
"text"=>"  • مرحبا بك ،
- هذه لوحة التحكم الخاصة بك ، 🔰
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🐬
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'- أوامر الإشتراك الإجباري الأول ، 📢' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، 🌚🤞🏻' ,'callback_data'=>"ARMOF0"],['text'=>'• حذف قناة ، 🌚🤙🏻' ,'callback_data'=>"delete11"]],
[['text'=>'- أوامر الإشتراك الإجباري الثاني ، 📢' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، 🌝🤞🏻' ,'callback_data'=>"ARMOF2"],['text'=>'• حذف قناة ، 🌝🤙🏻' ,'callback_data'=>"delete22"]],
[['text'=>'- عرض قنوات الإشتراك ، 📛' ,'callback_data'=>"ARMOF4"]],
[['text'=>'- أوامر الإذاعه ، 🗣' ,'callback_data'=>"ARMOF"]],
[['text'=>'• رسالة توجيه ، ⚙' ,'callback_data'=>"ARMOF5"],['text'=>'• رسالة نصية ،⚙' ,'callback_data'=>"ARMOF6"]],
[['text'=>'• رساله قنوات توجيه ، 📋' ,'callback_data'=>"ARMOFch"],['text'=>'• رساله قنوات نصية ، 📋' ,'callback_data'=>"ARMOFchtx"]],
[['text'=>'• رساله كروبات توجيه ، 📮' ,'callback_data'=>"ARMOFGro"],['text'=>'• رساله كروبات نصية ، 📮' ,'callback_data'=>"ARMOFGr"]],
[['text'=>'- عدد المشتركين ، 🐳' ,'callback_data'=>"ARMOF7"]],
[['text'=>'- عدد القنوات ، 🐳' ,'callback_data'=>"ARMOF77"],['text'=>'- عدد الكروبات ، 🐳' ,'callback_data'=>"ARMOF777"]],
[['text'=>'- التنبيه عند دخول أحد للبوت ، ⚠️' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التنبيه ، 💬' ,'callback_data'=>"ARMOF9"],['text'=>'• تعطيل التنبيه ، ❎' ,'callback_data'=>"ARMOF10"]],
[['text'=>'- توجيه رسائل من الأعضاء ، 💬' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التوجيه ، 💬' ,'callback_data'=>"ARMOF11"],['text'=>'• تعطيل التوجيه ، ❎' ,'callback_data'=>"ARMOF12"]],
   ] 
   ])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF0"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- حسناً ، الآن قم بإرسال معرف قناتك ليتم وضعه في خدمة الإشتراك الإجباري للقناة الأولى ، 📢
#مثال :
▪️@k_u_4',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF0");
}
if($ARMOFF17 and $ARMOFF == "ARMOF0" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- لقد تم وضع القناة بنجاح ، 📣
- قم برفع البوت أدمن داخل القناة ، 🗞',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF0.txt","$ARMOFF17");
unlink("ARMOF.txt");
}
if($meme == "delete11"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- حسناً هل أنت متأكد من أنك تريد حذف القناة من الإشتراك الإجباري ، 🚫
',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'• لا ، ❎', 'callback_data'=>'ARMOF'],
['text'=>'• نعم ، 💬','callback_data'=>'ARMOF1'],
]    
]])
]);    
}
if($meme == "ARMOF1"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- لقد تم حذف القناة الاولى من الإشتراك الإجباري بنجاح ، 📮',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
️[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF0.txt");
}
if($meme == "ARMOF2"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- حسناً ، الآن قم بإرسال معرف قناتك ليتم وضعه في خدمة الإشتراك الإجباري للقناة الثانية ، 📢
#مثال :
▪️@k_u_4',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF1");
}
if($ARMOFF17 and $ARMOFF == "ARMOF1" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- لقد تم وضع القناة بنجاح ، 📣
- قم برفع البوت أدمن داخل القناة ، 🗞',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF1.txt","$ARMOFF17");
unlink("ARMOF.txt");
}
if($meme == "delete22"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- حسناً هل أنت متأكد من أنك تريد حذف القناة من الإشتراك الإجباري ، 🚫',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'• لا ، ❎', 'callback_data'=>'ARMOF'],
['text'=>'• نعم ، 💬','callback_data'=>'ARMOF3'],
]    
]])
]);    
}
if($meme == "ARMOF3"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- لقد تم حذف القناة الثانية من الإشتراك الإجباري بنجاح ، 📮',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF1.txt");
}
if($meme == "ARMOF4"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"- هذه قائمة القنوات الأشتراك الاجباري ، 🔰
- القناة الاولى ،  $ARMOFF0 📢 
- القناة الثانية ،  $ARMOFF1 📣
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF5"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $ARMOFF3 ] مشترك ، 🐙 ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF2");
}
if($ARMOFF18 and $ARMOFF == "ARMOF2" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم التوجيه بنجاح 🦕',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFF2); $i++){
bot('forwardMessage', [
'chat_id'=>$ARMOFF2[$i],
'from_chat_id'=>$ARMOFF11,
'message_id'=>$ARMOFF18->message_id
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOF6"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $ARMOFF3 ] مشترك ، 🐠",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF3");
}
if($ARMOFF17 and $ARMOFF == "ARMOF3" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم النشر بنجاح 🐋',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFF2); $i++){
bot('sendMessage', [
'chat_id'=>$ARMOFF2[$i],
'text'=>$ARMOFF17
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFGro"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $ARMOFGROPnt ] كروب ، 🐙 ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOFGro");
}
if($message and $ARMOFF == "ARMOFGro" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم التوجيه بنجاح 🦕',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFGROP);$i++){
bot('forwardMessage',[
'chat_id'=>$ARMOFGROP[$i],
'from_chat_id'=>$ARMOFF11,
'message_id'=>$message->message_id
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFGr"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $ARMOFGROPnt ] كروب ، 🐠",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOFGr");
}
if($ARMOFF17 and $ARMOFF == "ARMOFGr" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم النشر بنجاح 🐋',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFGROP);$i++){
bot('sendMessage',[
'chat_id'=>$ARMOFGROP[$i],
'text'=>$ARMOFF17
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFch"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $alllch ] قناة ، 🐙 ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","Armofch");
}
if($message and $ARMOFF == "Armofch" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم التوجيه بنجاح 🦕',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ArmoCH);$i++){
bot('forwardMessage',[
'chat_id'=>$ArmoCH[$i],
'from_chat_id'=>$ARMOFF11,
'message_id'=>$message->message_id
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFchtx"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $alllch ] قناة ، 🐠",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","Armofoch");
}
if($ARMOFF17 and $ARMOFF == "Armofoch" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم النشر بنجاح 🐋',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ArmoCH);$i++){
bot('sendMessage',[
'chat_id'=>$ArmoCH[$i],
'text'=>$ARMOFF17
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOF7"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"- عدد مشتركين البوت  [ $ARMOFF3 ] مشترك ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF77"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"- عدد قنوات البوت  [ $alllch ] قناة ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF777"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"- عدد كروبات البوت  [ $ARMOFGROPnt ] كروب ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF9"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تفعيل دخول المشتركين ، 🐎',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF2.txt","ARMOF");
}
if($ARMOFF17 == "/start" and $ARMOFF5 == "ARMOF" and $ARMOFF11 != $admin){
bot("sendmessage",[
"chat_id"=>$admin,
"text"=>"- عضو جديد قام بالدخول الى البوت ، 🛡
- الاسم ، [$ARMOFF15](tg://user?id=$chat_id) ، 🦕
- المعرف ، [@$ARMOFF16](tg://user?id=$chat_id) ، 🐢
- الايدي ، [$ARMOFF11](tg://user?id=$chat_id) ، 🐝 
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
~  عدد المشتركين ، { $ARMOFF3 } ، 🦑 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
]);
}
if($meme == "ARMOF10"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تعطيل دخول المشتركين ، 🦍 ',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF2.txt");
}
if($meme == "ARMOF11"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تفعيل توجيه الرسائل ، 🦇',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF3.txt","ARMOF");
}
if($ARMOFF18 and $ARMOFF6 == "ARMOF" and $ARMOFF11 != $admin){
bot('forwardMessage', [
'chat_id'=>$admin,
'from_chat_id'=>$ARMOFF11,
'message_id'=>$ARMOFF18->message_id
]);
}
if($ARMOFF18 and $ARMOFF6 == "ARMOF" and $ARMOFF11 == $admin){
bot('sendMessage',[
'chat_id'=>$ARMOFF18->reply_to_message->forward_from->id,
    'text'=>$ARMOFF17,
    ]);
}
if($meme == "ARMOF12"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تعطيل توجيه الرسائل ، 🐌',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF3.txt");
} $admin = "296369326"; 
$ARMOFF = file_get_contents("ARMOF.txt");
$ARMOFF0 = file_get_contents("ARMOF0.txt");
$ARMOFF1= file_get_contents("ARMOF1.txt");
$ARMOFF5 = file_get_contents("ARMOF2.txt");
$ARMOFF6 = file_get_contents("ARMOF3.txt");
$ARMOFF20 = json_decode(file_get_contents('php://input'));
$ARMOFF18 = $update->message;
$ARMOFF13 = $ARMOFF18->chat->id;
$ARMOFF17 = $ARMOFF18->text;
$meme = $ARMOFF20->callback_query->data;
$ARMOFF12 = $ARMOFF20->callback_query->message->chat->id;
$ARMOFF14 =  $ARMOFF20->callback_query->message->message_id;
$ARMOFF15 = $ARMOFF18->from->first_name;
$ARMOFF16 = $ARMOFF18->from->username;
$ARMOFF11 = $ARMOFF18->from->id;
$ARMOFF2 = explode("\n",file_get_contents("ARMOF4.txt"));
$ArmoCH = explode("\n",file_get_contents("chall.txt"));
$ARMOFGROP = explode("\n",file_get_contents("ARMOFGR.txt"));
$ARMOFF3 = count($ARMOFF2)-1;
$ARMOFGROPnt = count($ARMOFGROP)-1;
$admin = 296369326; 
$text_ch = $update->channel_post->text;
$ch_id = $update->channel_post->chat->id;
$getchall = file_get_contents("chall.txt");
$allgetch = explode("\n",$getchall);
$bot = file_get_contents("com.txt");
$cchcc = explode("\n",file_get_contents("chall.txt"));
$alllch = count($cchcc)-1;
$ARMOFF11 = $ARMOFF18->from->id;
$tc = $update->message->chat->type;
if($text_ch !== "/start" and !in_array($ch_id,$allgetch)){
file_put_contents("chall.txt","\n$ch_id",FILE_APPEND);
}
if($tc == 'private'){
if($message and !in_array($ARMOFF11, $ARMOFF2)) {
file_put_contents("ARMOF4.txt", $ARMOFF11."\n",FILE_APPEND);
}}
if($tc == 'group' || $tc == 'supergroup'){
if($message and !in_array($chat_id, $ARMOFGROP)) {
file_put_contents("ARMOFGR.txt", $chat_id."\n",FILE_APPEND);
}}
$ARMOFF9 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ARMOFF0&user_id=".$ARMOFF11);
$ARMOFF10 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ARMOFF1&user_id=".$ARMOFF11);
if($ARMOFF18 && (strpos($ARMOFF9,'"status":"left"') or strpos($ARMOFF9,'"Bad Request: USER_ID_INVALID"') or strpos($ARMOFF9,'"status":"kicked"') or strpos($ARMOFF10,'"status":"left"') or strpos($ARMOFF10,'"Bad Request: USER_ID_INVALID"') or strpos($ARMOFF10,'"status":"kicked"'))!== false){
if($tc == 'private'){
bot('sendMessage', [
'chat_id'=>$ARMOFF13,
'text'=>'
📧- ▫️ عذراً عزيزي  ، ☡
⚠️- يجب عليك الإشتراك في قنوات البوت أولاً
🔇- اشترك ثم ارسل ( /start )📮!
'.$ARMOFF0.'
'.$ARMOFF1,
]);return false;}}
if($ARMOFF17 == "/admin" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>"مرحبآ بك ، 
- هذه لوحة التحكم الخاصة بك ، 🔰
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🐬
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'- أوامر الإشتراك الإجباري الأول ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، ' ,'callback_data'=>"ARMOF0"],['text'=>'• حذف قناة ، ' ,'callback_data'=>"delete11"]],
[['text'=>'- أوامر الإشتراك الإجباري الثاني ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، ' ,'callback_data'=>"ARMOF2"],['text'=>'• حذف قناة ، ' ,'callback_data'=>"delete22"]],
[['text'=>'- عرض قنوات الإشتراك ' ,'callback_data'=>"ARMOF4"]],
[['text'=>'- أوامر الإذاعه ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• رسالة توجيه ' ,'callback_data'=>"ARMOF5"],['text'=>'• رسالة نصية ' ,'callback_data'=>"ARMOF6"]],
[['text'=>'• رساله قنوات توجيه ' ,'callback_data'=>"ARMOFch"],['text'=>'• رساله قنوات نصية ، ⚙' ,'callback_data'=>"ARMOFchtx"]],
[['text'=>'• رساله كروبات توجيه ، 👥' ,'callback_data'=>"ARMOFGro"],['text'=>'• رساله كروبات نصية ،👥' ,'callback_data'=>"ARMOFGr"]],
[['text'=>'- عدد القنوات ' ,'callback_data'=>"ARMOF77"]],
[['text'=>'- عدد المشتركين ' ,'callback_data'=>"ARMOF7"],['text'=>'- عدد الكروبات ' ,'callback_data'=>"ARMOF777"]],
[['text'=>'- التنبيه عند دخول أحد للبوت ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التنبيه ' ,'callback_data'=>"ARMOF9"],['text'=>'• تعطيل التنبيه ، ❎' ,'callback_data'=>"ARMOF10"]],
[['text'=>'- توجيه رسائل من الأعضاء ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التوجيه ' ,'callback_data'=>"ARMOF11"],['text'=>'• تعطيل التوجيه ، ❎' ,'callback_data'=>"ARMOF12"]],
   ] 
   ])
]);
}
if($meme == "ARMOF" ){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
"text"=>"  • مرحبا بك ،
- هذه لوحة التحكم الخاصة بك ، 🔰
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🐬
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'- أوامر الإشتراك الإجباري الأول ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، ' ,'callback_data'=>"ARMOF0"],['text'=>'• حذف قناة ، ' ,'callback_data'=>"delete11"]],
[['text'=>'- أوامر الإشتراك الإجباري الثاني ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• وضع قناة ، ' ,'callback_data'=>"ARMOF2"],['text'=>'• حذف قناة ، ' ,'callback_data'=>"delete22"]],
[['text'=>'- عرض قنوات الإشتراك ' ,'callback_data'=>"ARMOF4"]],
[['text'=>'- أوامر الإذاعه ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• رسالة توجيه ، ⚙' ,'callback_data'=>"ARMOF5"],['text'=>'• رسالة نصية ' ,'callback_data'=>"ARMOF6"]],
[['text'=>'• رساله قنوات توجيه ' ,'callback_data'=>"ARMOFch"],['text'=>'• رساله قنوات نصية ' ,'callback_data'=>"ARMOFchtx"]],
[['text'=>'• رساله كروبات توجيه ' ,'callback_data'=>"ARMOFGro"],['text'=>'• رساله كروبات نصية ' ,'callback_data'=>"ARMOFGr"]],
[['text'=>'- عدد المشتركين ' ,'callback_data'=>"ARMOF7"]],
[['text'=>'- عدد القنوات ' ,'callback_data'=>"ARMOF77"],['text'=>'- عدد الكروبات ' ,'callback_data'=>"ARMOF777"]],
[['text'=>'- التنبيه عند دخول أحد للبوت ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التنبيه ' ,'callback_data'=>"ARMOF9"],['text'=>'• تعطيل التنبيه ، ❎' ,'callback_data'=>"ARMOF10"]],
[['text'=>'- توجيه رسائل من الأعضاء ' ,'callback_data'=>"ARMOF"]],
[['text'=>'• تفعيل التوجيه ' ,'callback_data'=>"ARMOF11"],['text'=>'• تعطيل التوجيه ، ❎' ,'callback_data'=>"ARMOF12"]],
   ] 
   ])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF0"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- حسناً ، الآن قم بإرسال معرف قناتك ليتم وضعه في خدمة الإشتراك الإجباري للقناة الأولى 
#مثال :
▪️@k_u_4',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF0");
}
if($ARMOFF17 and $ARMOFF == "ARMOF0" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- لقد تم وضع القناة بنجاح ، 📣
- قم برفع البوت أدمن داخل القناة ، 🗞',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF0.txt","$ARMOFF17");
unlink("ARMOF.txt");
}
if($meme == "delete11"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- حسناً هل أنت متأكد من أنك تريد حذف القناة من الإشتراك الإجباري ، 🚫
',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'• لا ، ❎', 'callback_data'=>'ARMOF'],
['text'=>'• نعم ','callback_data'=>'ARMOF1'],
]    
]])
]);    
}
if($meme == "ARMOF1"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- لقد تم حذف القناة الاولى من الإشتراك الإجباري بنجاح ',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
️[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF0.txt");
}
if($meme == "ARMOF2"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- حسناً ، الآن قم بإرسال معرف قناتك ليتم وضعه في خدمة الإشتراك الإجباري للقناة الثانية 
#مثال :
▪️@Watan_e',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF1");
}
if($ARMOFF17 and $ARMOFF == "ARMOF1" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- لقد تم وضع القناة بنجاح ، 📣
- قم برفع البوت أدمن داخل القناة ، 🗞',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF1.txt","$ARMOFF17");
unlink("ARMOF.txt");
}
if($meme == "delete22"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- حسناً هل أنت متأكد من أنك تريد حذف القناة من الإشتراك الإجباري ، 🚫',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'• لا ، ❎', 'callback_data'=>'ARMOF'],
['text'=>'• نعم ','callback_data'=>'ARMOF3'],
]    
]])
]);    
}
if($meme == "ARMOF3"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>'- لقد تم حذف القناة الثانية من الإشتراك الإجباري بنجاح ',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF1.txt");
}
if($meme == "ARMOF4"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"- هذه قائمة القنوات الأشتراك الاجباري ، 🔰
- القناة الاولى ،  $ARMOFF0  
- القناة الثانية ،  $ARMOFF1 📣
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF5"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $ARMOFF3 ] مشترك ، 🐙 ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF2");
}
if($ARMOFF18 and $ARMOFF == "ARMOF2" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم التوجيه بنجاح 🦕',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFF2); $i++){
bot('forwardMessage', [
'chat_id'=>$ARMOFF2[$i],
'from_chat_id'=>$ARMOFF11,
'message_id'=>$ARMOFF18->message_id
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOF6"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $ARMOFF3 ] مشترك ، 🐠",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOF3");
}
if($ARMOFF17 and $ARMOFF == "ARMOF3" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم النشر بنجاح 🐋',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFF2); $i++){
bot('sendMessage', [
'chat_id'=>$ARMOFF2[$i],
'text'=>$ARMOFF17
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFGro"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $ARMOFGROPnt ] كروب ، 🐙 ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOFGro");
}
if($message and $ARMOFF == "ARMOFGro" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم التوجيه بنجاح 🦕',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFGROP);$i++){
bot('forwardMessage',[
'chat_id'=>$ARMOFGROP[$i],
'from_chat_id'=>$ARMOFF11,
'message_id'=>$message->message_id
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFGr"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $ARMOFGROPnt ] كروب ، 🐠",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","ARMOFGr");
}
if($ARMOFF17 and $ARMOFF == "ARMOFGr" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم النشر بنجاح 🐋',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ARMOFGROP);$i++){
bot('sendMessage',[
'chat_id'=>$ARMOFGROP[$i],
'text'=>$ARMOFF17
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFch"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $alllch ] قناة ، 🐙 ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","Armofch");
}
if($message and $ARMOFF == "Armofch" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم التوجيه بنجاح 🦕',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ArmoCH);$i++){
bot('forwardMessage',[
'chat_id'=>$ArmoCH[$i],
'from_chat_id'=>$ARMOFF11,
'message_id'=>$message->message_id
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOFchtx"){
bot('EditMessageText',[
'chat_id'=>$ARMOFF12,
'message_id'=>$ARMOFF14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $alllch ] قناة ، 🐠",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF.txt","Armofoch");
}
if($ARMOFF17 and $ARMOFF == "Armofoch" and $ARMOFF11 == $admin){
bot("sendmessage",[
"chat_id"=>$ARMOFF13,
"text"=>'- تم النشر بنجاح 🐋',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
for($i=0;$i<count($ArmoCH);$i++){
bot('sendMessage',[
'chat_id'=>$ArmoCH[$i],
'text'=>$ARMOFF17
]);
unlink("ARMOF.txt");
}
}
if($meme == "ARMOF7"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"- عدد مشتركين البوت  [ $ARMOFF3 ] مشترك ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF77"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"- عدد قنوات البوت  [ $alllch ] قناة ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF777"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>"- عدد كروبات البوت  [ $ARMOFGROPnt ] كروب ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
}
if($meme == "ARMOF9"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تفعيل دخول المشتركين ، 🐎',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF2.txt","ARMOF");
}
if($ARMOFF17 == "/start" and $ARMOFF5 == "ARMOF" and $ARMOFF11 != $admin){
bot("sendmessage",[
"chat_id"=>$admin,
"text"=>"- عضو جديد قام بالدخول الى البوت ، 🛡
- الاسم ، [$ARMOFF15](tg://user?id=$chat_id) ، 🦕
- المعرف ، [@$ARMOFF16](tg://user?id=$chat_id) ، 🐢
- الايدي ، [$ARMOFF11](tg://user?id=$chat_id) ، 🐝 
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
~  عدد المشتركين ، { $ARMOFF3 } ، 🦑
اذا واجهت مشكلة بلبوت راسل - @k_u_4 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
]);
}
if($meme == "ARMOF10"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تعطيل دخول المشتركين ، 🦍 ',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF2.txt");
}
if($meme == "ARMOF11"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تفعيل توجيه الرسائل ، 🦇',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
file_put_contents("ARMOF3.txt","ARMOF");
}
if($ARMOFF18 and $ARMOFF6 == "ARMOF" and $ARMOFF11 != $admin){
bot('forwardMessage', [
'chat_id'=>$admin,
'from_chat_id'=>$ARMOFF11,
'message_id'=>$ARMOFF18->message_id
]);
}
if($ARMOFF18 and $ARMOFF6 == "ARMOF" and $ARMOFF11 == $admin){
bot('sendMessage',[
'chat_id'=>$ARMOFF18->reply_to_message->forward_from->id,
    'text'=>$ARMOFF17,
    ]);
}
if($meme == "ARMOF12"){
bot('EditMessageText',[
    'chat_id'=>$ARMOFF12,
    'message_id'=>$ARMOFF14,
'text'=>'- تم تعطيل توجيه الرسائل ، 🐌',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"ARMOF"]],
]])
]);
unlink("ARMOF.txt");
unlink("ARMOF3.txt");
} 
$tws = "ARMOF"; 
$name = $message->from->first_name;
if($text == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"
♱: مرحبا بك [$name](tg://user?id=$from_id)
♱: اضفني الى مجموعتك وقم برفعي مشرف
♱: بعدها ارسل تفعيل ثم الاوامر 
-------------------------",
'parse_mode'=>"MarkDown",
'disable_web_page_preview' =>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"࿄اضفني الى مجموعتك",'url'=>"http://t.me/kx_RkBOT?startgroup=new"]],
]
])
]);
}

$sttings = json_decode(file_get_contents("ARMOF.json"),1);
$message_id = $message->message_id;
if($text == "تفعيل"){
if(!$sttings[$chat_id]){
$sttings[$chat_id] = array("photo","video","sticker","animation");
file_put_contents("ARMOF.json",json_encode($sttings));
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
تم تفعيل البوت في المجموعه┇✅
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>" الميديا . ",'callback_data'=>"🔙"]]
]])
]);
$armof = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getChat?chat_id=$chat_id"))->result;
$lnbg = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/exportChatInviteLink?chat_id=$chat_id"))->result;
bot('sendMessage',[
'chat_id'=>"296369326",
 'text'=>"
 تمت اضافة  البوت في القناة التاليه : 
*Name* : *$armof->title*
*ID* : *$chat_id*
*Bio* : *$armof->description*
*link* : *$lnbg->invite_link*",
'parse_mode'=>"MarkDown",
]);
}else{
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
 تم تفعيل البوت في المجموعه مسبقا┇✅ 
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>" الميديا . ",'callback_data'=>"🔙"]]
]])
]);}}
 $sttings = json_decode(file_get_contents("ARMOF.json"),1);
$message_id = $message->message_id;
if($message->photo){
$sttings[$chat_id]["photo"][]= "$message_id";
file_put_contents("ARMOF.json",json_encode($sttings));
}
if($message->animation){
$sttings[$chat_id]["animation"][]= "$message_id";
file_put_contents("ARMOF.json",json_encode($sttings));
}
if($message->sticker){
$sttings[$chat_id]["sticker"][]= "$message_id";
file_put_contents("ARMOF.json",json_encode($sttings));
}
if($message->video){
$sttings[$chat_id]["video"][]= "$message_id";
file_put_contents("ARMOF.json",json_encode($sttings));
}
if($message->video or $message->photo or $message->sticker or $message->animation){
$sttings[$chat_id]["allmidia"][]= "$message_id";
file_put_contents("ARMOF.json",json_encode($sttings));
}
$video = count($sttings[$chat_id]["video"]);
$photo = count($sttings[$chat_id]["photo"]);
$sticker = count($sttings[$chat_id]["sticker"]);
$animation = count($sttings[$chat_id]["animation"]);
$all = count($sttings[$chat_id]["allmidia"]);
if($text == "الميديا"){
if($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"*- اهݪا بـڪ اخــ۫ـتࢪ مـٰن اݪاســفل ،*",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
 'parse_mode'=>"markdown",'disable_web_page_preview'=>true,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[['text'=>'الصور','callback_data'=>'1'],['text'=>'المتحركه','callback_data'=>'2']],
[['text'=>'الملصقات','callback_data'=>'3'],['text'=>'الفديو' ,'callback_data'=>"4"]],
[['text'=>'࿄ .الميديا. ࿄','callback_data'=>'5']],
]
])
]);
}
else
{
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"*الامر ليس لك 🚫*",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
]);
}}
$a = $sttings[$chat_id]["video"];
 $b = $sttings[$chat_id]["photo"];
 $c = $sttings[$chat_id]["animation"];
 $d = $sttings[$chat_id]["sticker"];
 $al = $sttings[$chat_id]["allmidia"];
 if($text == "حذف الفيديو"){
if($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
تم الحذف $video من الفديوهات┇✅
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
 ]);
 for($i=0;$i <count($a);$i++){
 bot('deletemessage',[
 'chat_id'=>$chat_id,
 'message_id'=>$a[$i],
 ]);
 unset($sttings[$chat_id]["video"]);
file_put_contents("ARMOF.json",json_encode($sttings));
}}else
{
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"*الامر ليس لك 🚫*",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
]);
}}
if($text == "حذف الصور"){
if($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
تم الحذف $photo من الصور┇✅
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
 ]);
 for($i=0;$i<count($b);$i++){
 bot('deletemessage',[
 'chat_id'=>$chat_id,
 'message_id'=>$b[$i],
 ]);
unset($sttings[$chat_id]["photo"]);
file_put_contents("ARMOF.json",json_encode($sttings));
}}else
{
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"*الامر ليس لك 🚫*",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
]);
}}
if($text == "حذف المتحركه"){
if($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
تم الحذف $animation من المتحركه┇✅
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
 ]);
 for($i=0;$i <count($c);$i++){
 bot('deletemessage',[
 'chat_id'=>$chat_id,
 'message_id'=>$c[$i],
 ]);
unset($sttings[$chat_id]["animation"]);
file_put_contents("ARMOF.json",json_encode($sttings));
}}else
{
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"*الامر ليس لك 🚫*",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
]);
}}
if($text == "حذف الملصقات"){
if($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
تم الحذف $sticker من الملصقات┇✅
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
 ]);
 for($i=0;$i <count($d);$i++){
 bot('deletemessage',[
 'chat_id'=>$chat_id,
 'message_id'=>$d[$i],
 ]);
unset($sttings[$chat_id]["sticker"]);
file_put_contents("ARMOF.json",json_encode($sttings));
 }
}else
{
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"*الامر ليس لك 🚫*",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
]);
}}
if($text =="امسح" or $text == "حذف الميديا"){
if($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
تم الحذف $all من الميديا┇✅
",'parse_mode'=>"markdown",'reply_to_message_id'=>$message_id,
 ]);

for($i=0;$i <count($al);$i++){
 bot('deletemessage',[
 'chat_id'=>$chat_id,
 'message_id'=>$al[$i],
 ]);
 unset($sttings[$chat_id]["video"]);
 unset($sttings[$chat_id]["sticker"]);
 unset($sttings[$chat_id]["animation"]);
 unset($sttings[$chat_id]["photo"]);
 unset($sttings[$chat_id]["allmidia"]);
file_put_contents("ARMOF.json",json_encode($sttings));
}}else{
if($start=="non"){
$start="
📒꒐ اهلا بك عزيزي ↫ $name
🎗️꒐ في بوت حذف الميديا
👥꒐ فقط اضف البوت لمجموعتك
⚙️꒐ وارسل تفعيل ومن ثم الاوامر
";}

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
$title = $message->chat->title;
$admin = "$admin";
$sttings = json_decode(file_get_contents("media.json"),1);
$adminn = json_decode(file_get_contents("admin.json"),1);
$chat = json_decode(file_get_contents("chat.json"),1);
$saiko = json_decode(file_get_contents("saiko.json"),1);
//---//
if($sttings["media"][$chat_id]==null){
$sttings["media"][$chat_id]=0;
file_put_contents("media.json",json_encode($sttings));
}
if($saiko["az1"]==null){
$saiko["az1"]=0;
file_put_contents("saiko.json",json_encode($saiko));
}
if($saiko["az2"]==null){
$saiko["az2"]=0;
file_put_contents("saiko.json",json_encode($saiko));
}
//---//
$oo = $message->message_id;
if ($message->sticker){
file_put_contents("media.json");
$sttings['ameer'][$chat_id][] = "$oo";
$sttings["media"][$chat_id]+=1;
file_put_contents("media.json",json_encode($sttings));
}
if ($message->photo){
file_put_contents("media.json");
$sttings['ameer'][$chat_id][] = "$oo";
$sttings["media"][$chat_id]+=1;
file_put_contents("media.json",json_encode($sttings));
}
if ($message->video){
file_put_contents("media.json");
$sttings['ameer'][$chat_id][] = "$oo";
$sttings["media"][$chat_id]+=1;
file_put_contents("media.json",json_encode($sttings));
}
if ($message->video_note){
file_put_contents("media.json");
$sttings['ameer'][$chat_id][] = "$oo";
$sttings["media"][$chat_id]+=1;
file_put_contents("media.json",json_encode($sttings));
}
if ($message->animation){
file_put_contents("media.json");
$sttings['ameer'][$chat_id][] = "$oo";
$sttings["media"][$chat_id]+=1;
file_put_contents("media.json",json_encode($sttings));
}
if ($message && !in_array($from_id,$saiko['id'])){
if ($tc == "private"){
file_put_contents("saiko.json");
$saiko['id'][] = "$from_id";
file_put_contents("saiko.json",json_encode($saiko));
}
}


//---//
if($text == "/start" and $from_id == $admin){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"
📄꒐ اهلا عزيزي المطور
📬꒐ الان اختر ما تريد من الاسفل
",
 'parse_mode'=>"html",
 'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'📊꒐ الاحصائيات' ,'callback_data'=>"sall"],['text'=>'📢꒐ قسم الاذاعة' ,'callback_data'=>"az"]],
]])
]);
}
if($data == "back"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'
📄꒐ اهلا عزيزي المطور
📬꒐ الان اختر ما تريد من الاسفل
',
 'parse_mode'=>"html",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'📊꒐ الاحصائيات' ,'callback_data'=>"sall"],['text'=>'📢꒐ قسم الاذاعة' ,'callback_data'=>"az"]],
]])
]);
$saiko['saiko'] = "bbbbbbbb";
file_put_contents("saiko.json",json_encode($saiko));
}
$bb = $chat['ok'];
$b = count($bb);
$nn = $saiko['id'];
$n = count($nn);
$j = $saiko["az1"];
$m = $saiko["az2"];
$v = $saiko["az3"];
if($data == "sall"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'
*🤖꒐ احصائيات البوت*
*🏌️‍♂️꒐ عدد المجموعات : '.$b.'*
*👥꒐ عدد المشتركين : '.$n.'*

*🎤꒐ احصائيات الاذاعة*
*📔꒐ اذاعة خاص : '.$j.'*
*📬꒐ اذاعة خاص بالتوجية : '.$m.'*
',
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙꒐ رجوع' ,'callback_data'=>"back"]],
]])
]);
}
if($data == "az"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'
*📄꒐ اهلا عزيزي المطور*
*📢꒐ في قسم الاذاعة الان اختر من الاسفل*
',
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🎙️꒐ اذاعة خاص' ,'callback_data'=>"az1"],['text'=>'🎙️꒐ اذاعة خاص بالتوجية' ,'callback_data'=>"az2"]],
[['text'=>'🔙꒐ رجوع' ,'callback_data'=>"back"]],
]])
]);
}
if($data == "az1"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'
*🎤꒐ الان ارسل رسالتك ليتم ارسالها للاعضاء*
*⚙️꒐ ملاحظة : الاذاعة ستكون بالماركدون*
',
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙꒐ رجوع' ,'callback_data'=>"back"]],
]])
]);
$saiko['saiko'] = "okaz1";
file_put_contents("saiko.json",json_encode($saiko));
}
if($text and $saiko['saiko'] == "okaz1" and $from_id == $admin){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>'
*📔꒐ تم ارسال رسالتك لـ '.$n.'*
',
 'parse_mode'=>"MarkDown",
 'reply_markup'=>json_encode([ 
  'inline_keyboard'=>[
[['text'=>'🔙꒐ رجوع' ,'callback_data'=>"back"]],
]])
]);
for($i=0;$i<count($saiko['id']); $i++){
bot('sendMessage', [
'chat_id'=>$saiko['id'][$i],
'text'=>$text,
 'parse_mode'=>"MarkDown",
]);
$saiko['saiko'] = "noaz1";
$saiko["az1"]+=1;
file_put_contents("saiko.json",json_encode($saiko));
exit();
}
}
if($data == "az2"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>'
*🎤꒐ الان ارسل رسالتك ليتم توجيهها*
',
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'🔙꒐ رجوع' ,'callback_data'=>"back"]],
]])
]);
$saiko['saiko'] = "okaz2";
file_put_contents("saiko.json",json_encode($saiko));
}
if($text and $saiko['saiko'] == "okaz2" and $from_id == $admin){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>'
*📔꒐ تم توجية رسالتك لـ '.$n.'*
',
 'parse_mode'=>"MarkDown",
 'reply_markup'=>json_encode([ 
  'inline_keyboard'=>[
[['text'=>'🔙꒐ رجوع' ,'callback_data'=>"back"]],
]])
]);
for($i=0;$i<count($saiko['id']); $i++){
bot('forwardMessage', [
'chat_id'=>$saiko['id'][$i],
'from_chat_id'=>$from_id,
'message_id'=>$message->message_id
]);
$saiko['saiko'] = "noaz2";
$saiko["az2"]+=1;
file_put_contents("saiko.json",json_encode($saiko));
exit();
}
}
$sudo = $info['id'];
$sudo = $admin;
$g = bot('getchatmember',[
'chat_id'=>$sudo,
'user_id'=>$sudo,
])->result->user;
$u = $g->id;
$n = $g->first_name." ".$g->last_name;
if($text == '/start'){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>'true',
'reply_to_message_id'=>$message->message_id,
]);
} 
//---//
if($tc == "private"){
exit();
}
if($from_id == $admin){
if($text== "تفعيل"){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ المجموعة مفعله",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($from_id == $admin){
if($text== "تفعيل"){
if(!in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم تفعيل المجموعة",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
$chat['ok'][] = "$chat_id";
file_put_contents("chat.json",json_encode($chat));
exit();
}
}
}
if($from_id == $admin){
if($text== "تعطيل"){
if(!in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ المجموعة معطله",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($from_id == $admin){
if($text== "تعطيل"){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم تعطيل المجموعة",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
$key = array_search($chat_id,$chat["ok"]);
unset($chat["ok"][$key]);
$chat["ok"] = array_values($chat["ok"]); 
$chat = json_encode($chat,true);
file_put_contents("chat.json",$chat);
exit();
}
}
}
$statjson = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=".$from_id),true);
$status = $statjson['result']['status'];
if($status == "creator"){
if($text== "تفعيل"){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ المجموعة مفعله",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($status == "creator"){
if($text== "تفعيل"){
if(!in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم تفعيل المجموعة",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
$chat['ok'][] = "$chat_id";
file_put_contents("chat.json",json_encode($chat));
exit();
}
}
}
if($status == "creator"){
if($text== "تعطيل"){
if(!in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ المجموعة معطله",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($status == "creator"){
if($text== "تعطيل"){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم تعطيل المجموعة",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
$key = array_search($chat_id,$chat["ok"][$chat_id]);
unset($chat["ok"][$chat_id][$key]);
$chat["ok"][$chat_id] = array_values($chat["ok"][$chat_id]); 
$chat = json_encode($chat,true);
file_put_contents("chat.json",$chat);
exit();
}
}
}
$statjson = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=".$from_id),true);
$status = $statjson['result']['status'];
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
if($text == "الاوامر"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⏺꒐ اوامر البوت للمنظفين :-
الميديا - لعرض عدد الميديا المرسله
امسح - لحذف الميديا المرسله

⏺꒐ اوامر البوت للمالك :-
رفع منظف - تنزيل منظف
المنظفين - مسح المنظفين
⎯ ⎯ ⎯ ⎯
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
if($text == "الاوامر"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⏺꒐ اوامر البوت للمنظفين :-
الميديا - لعرض عدد الميديا المرسله
امسح - لحذف الميديا المرسله

⏺꒐ اوامر البوت للمالك :-
رفع منظف - تنزيل منظف
المنظفين - مسح المنظفين
⎯ ⎯ ⎯ ⎯
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
$media = $sttings["media"][$chat_id];
$ameer = $sttings["ameer"][$chat_id];
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
if($text == "الميديا"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🔢꒐ عدد الميديا : $media
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if(in_array($from_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
if($text == "الميديا"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🔢꒐ عدد الميديا : $media
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
if($text == "الميديا"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🔢꒐ عدد الميديا : $media
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
if($text == "امسح"){
if($media == "0"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🔢꒐ عدد الميديا : $media
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
if(in_array($from_id,$sttings['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
if($text == "امسح"){
if($media == "0"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🔢꒐ عدد الميديا : $media
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
if($text == "امسح"){
if($media == "0"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🔢꒐ عدد الميديا : $media
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
date_default_timezone_set("Asia/Baghdad");
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
if($text == "امسح"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⏳꒐ انتظر قليلاً
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
for($i=0;$i<=$sttings["media"][$chat_id];$i++){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>"$ameer[$i]",
]);
}
$date = $message->date;
$gettime = time();
$sppedtime = $gettime - $date;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم حذف $media ميديا
⏰꒐ استغرق $sppedtime ثانية
",
'reply_to_message_id'=>$message->message_id,
]);
unset($sttings['media'][$chat_id]);
unset($sttings['ameer'][$chat_id]);
file_put_contents("media.json",json_encode($sttings));
exit();
}
}
}
date_default_timezone_set("Asia/Baghdad");
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
if($text == "امسح"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⏳꒐ انتظر قليلاً
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
for($i=0;$i<=$sttings["media"][$chat_id];$i++){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>"$ameer[$i]",
]);
}
$date = $message->date;
$gettime = time();
$sppedtime = $gettime - $date;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم حذف $media ميديا
⏰꒐ استغرق $sppedtime ثانية
",
'reply_to_message_id'=>$message->message_id,
]);
unset($sttings['media'][$chat_id]);
unset($sttings['ameer'][$chat_id]);
file_put_contents("media.json",json_encode($sttings));
exit();
}
}
}
date_default_timezone_set("Asia/Baghdad");
if(in_array($from_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
if($text == "امسح"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⏳꒐ انتظر قليلاً
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
for($i=0;$i<=$sttings["media"][$chat_id];$i++){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>"$ameer[$i]",
]);
}
$date = $message->date;
$gettime = time();
$sppedtime = $gettime - $date;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅꒐ تم حذف $media ميديا
⏰꒐ استغرق $sppedtime ثانية
",
'reply_to_message_id'=>$message->message_id,
]);
unset($sttings['media'][$chat_id]);
unset($sttings['ameer'][$chat_id]);
file_put_contents("media.json",json_encode($sttings));
exit();
}
}
}
if($text == "رفع منظف"){
if($from_id == $admin){
if($re){
if(!in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو :* $re_name *تم رفعه منظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
$adminn['admin'][$chat_id][] = "$re_id";
file_put_contents("admin.json",json_encode($adminn));
exit();
}
}
}
}
}
if($text == "رفع منظف"){
if($status == "creator"){
if($re){
if(!in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو :* $re_name *تم رفعه منظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
$adminn['admin'][$chat_id][] = "$re_id";
file_put_contents("admin.json",json_encode($adminn));
exit();
}
}
}
}
}
if($text == "رفع منظف"){
if($from_id == $admin){
if($re){
if(in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو : *$re_name *بالفعل منظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
}
if($text == "رفع منظف"){
if($status == "creator"){
if($re){
if(in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو : *$re_name *بالفعل منظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
}
if($text == "تنزيل منظف"){
if($from_id == $admin){
if($re){
if(in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو :* $re_name *تم تنزيله من المنظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
$key = array_search($re_id,$adminn["admin"][$chat_id]);
unset($adminn["admin"][$chat_id][$key]);
$adminn["admin"][$chat_id] = array_values($adminn["admin"][$chat_id]); 
$adminn = json_encode($adminn,true);
file_put_contents("admin.json",$adminn);
exit();
}
}
}
}
}
if($text == "تنزيل منظف"){
if($status == "creator"){
if($re){
if(in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو :* $re_name *تم تنزيله من المنظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
$key = array_search($re_id,$adminn["admin"][$chat_id]);
unset($adminn["admin"][$chat_id][$key]);
$adminn["admin"][$chat_id] = array_values($adminn["admin"][$chat_id]); 
$adminn = json_encode($adminn,true);
file_put_contents("admin.json",$adminn);
exit();
}
}
}
}
}
if($text == "تنزيل منظف"){
if($from_id == $admin){
if($re){
if(!in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو :*  $re_name *ليس منظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
}
if($text == "تنزيل منظف"){
if($status == "creator"){
if($re){
if(!in_array($re_id,$adminn['admin'][$chat_id])){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
*العضو :*  $re_name *ليس منظف*
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
}
if($text == "مسح المنظفين"){
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
تم مسح القائمة
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
unset($adminn['admin'][$chat_id]);
file_put_contents("admin.json",json_encode($adminn));
exit();
}
}
}
if($text == "مسح المنظفين"){
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
تم مسح القائمة
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
unset($adminn['admin'][$chat_id]);
file_put_contents("admin.json",json_encode($adminn));
exit();
}
}
}
if($text == "المنظفين"){
if($adminn['admin'][$chat_id] == null){
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
قائمة المنظفين فارغة
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
$taag = $adminn["admin"][$chat_id];
if($text == "المنظفين"){
if($adminn['admin'][$chat_id] == null){
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
قائمة المنظفين فارغة
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
}
$taag = $adminn['admin'][$chat_id];
if($text == "المنظفين"){
if($from_id == $admin){
if(in_array($chat_id,$chat['ok'])){
for($z = 0;$z <= count($taag)-1;$z++){
$Apitag = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$taag[$z]"));
$Usertag = $Apitag->result->username;
$first_natg = $Apitag->result->first_name;
$idtg = $Apitag->result->id;
$tagmy = $tagmy."$z - [$first_natg](tg://user?id=$idtg)"."\n";
}
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
قائمة المنظفين :

$tagmy
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
$taag = $adminn['admin'][$chat_id];
if($text == "المنظفين"){
if($status == "creator"){
if(in_array($chat_id,$chat['ok'])){
for($z = 0;$z <= count($taag)-1;$z++){
$Apitag = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$taag[$z]"));
$Usertag = $Apitag->result->username;
$first_natg = $Apitag->result->first_name;
$idtg = $Apitag->result->id;
$tagmy = $tagmy."$z - [$first_natg](tg://user?id=$idtg)"."\n";
}
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
قائمة المنظفين :

$tagmy
",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message->message_id,
]);
exit();
}
}
}
