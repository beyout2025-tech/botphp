<?php#*wataw*
#مستخرج روابط القنوات
if($start=="non"){
$start="
- اهلا بك في بوت استخراج رابط القناة المحذوف منشئها وبسهوله..
- طريقة الاستخدام : ارفع لبوت ادمن القناة ومن ثم ارسل معرف قناتك.

- ملاحظه : اذا حذفت البوت من الادمنيه البوت
سيتم ايقاف الرابط نهائيا ✔️";}

if ($text == '/start'){
bot('sendMessage',['chat_id' => $chat_id, 
'text' => "$start

$txtfree",
'parse_mode'=>HTML,
 'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"طريقة الاستخدام",'callback_data'=>"kk"]],
]])]);}

if($data == "kk" ){ 
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"
- اولآ : قم برفع البوت ادمن في القناة
- ثانيآ : قم بأرسال معرف قناتك الى البوت
- ملاحظه: يتم اعطائك الرابط الحقيقي للقناة وليس رابط مؤقت مما جعل البوت أفضل بوت في التليكرام.
",
'show_alert'=>true,]);}
		
if ($text and $text != '/start' && $text != '/admin' && $text != '.' && $text != '/'&& $chat_id != $list) {
if(preg_match('/([a-z])|([A-Z])/i',$text)){
$export = json_decode(file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$text"));
$linkchannel = $export->result;
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"رابط القناة هو:
$linkchannel",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
]);
}else 
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"
- عذرا يجب أرسال معرف قناتك.
- قبل ذلك ارفع البوت ادمن ومن ثم.
- ارسل معرف القناة لكي يتم استخراج الرابط.
",]);}

