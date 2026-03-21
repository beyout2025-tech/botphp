<?php
ob_start();
$token = "[*[TOKEN]*]";
$tokensan3 = "[*[TOKENSAN3]*]";
$admin = file_get_contents("admin.txt");
$sudo = array("$admin","5608491667");
$infobot = explode("\n",file_get_contents("info.txt"));
$usernamebot = $infobot['1'];
$no3mak = $infobot['6'];

define('API_KEY',$token);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);}}

$update = json_decode(file_get_contents("php://input"));
file_put_contents("update.txt",json_encode($update));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;$type = $message->chat->type;
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
$data = $up->data;}

if(isset($update->inline_query)){
$chat_id = $update->inline_query->chat->id;
$from_id = $update->inline_query->from->id;
$name = $update->inline_query->from->first_name.' '.$update->inline_query->from->last_name;
$text_inline = $update->inline_query->query;
$mes_id = $update->inline_query->inline_message_id; 

$user = strtolower($update->inline_query->from->username);}
$caption = $update->message->caption;
function getChatstats($chat_id,$token) {
$url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id='.$chat_id;
$result = file_get_contents($url);
$result = json_decode ($result);
$result = $result->ok;
return $result;}

function getmember($token,$idchannel,$from_id) {
$join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$idchannel&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"Bad Request: user not found"') or strpos($join,'"ok": false') or strpos($join,'"status":"kicked"')) !== false){
$wataw="no";}else{$wataw="yes";}
return $wataw;}

@mkdir("sudo");
@mkdir("data");
$member = explode("\n",file_get_contents("sudo/member.txt"));
$cunte = count($member)-1;
$ban = explode("\n",file_get_contents("sudo/ban.txt"));
$countban = count($ban)-1;
$admin=file_get_contents("admin.txt");

@$watawjson = json_decode(file_get_contents("../wataw.json"),true);
$st_ch_bots=$watawjson["info"]["st_ch_bots"];
$id_ch_sudo1=$watawjson["info"]["id_channel"];
$link_ch_sudo1=$watawjson["info"]["link_channel"];
$id_ch_sudo2=$watawjson["info"]["id_channel2"];
$link_ch_sudo2=$watawjson["info"]["link_channel2"];
$user_bot_sudo=$watawjson["info"]["user_bot"];

@$projson = json_decode(file_get_contents("pro.json"),true);
$pro=$projson["info"]["pro"];

$dateon=$projson["info"]["dateon"];
$dateoff=$projson["info"]["dateoff"];
$time=time()+(3600 * 1);

if($pro!="yes" or $pro == null){
#if($time < $dateoff){
$txtfree='';
#}
}

if($message  and $st_ch_bots == "✅" and $pro!= "yes"){
$stuts = getmember($tokensan3,$id_ch_sudo1,$from_id);
if($stuts=="no"){
bot('sendMessage',['chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"
▫️ عذراً يجب عليكَ الاشتراك بقناة البوت اولاً.
▫️ عند الاشتراك قم بإرسال /start مرةً اخرئ .
",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>true,
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"اضغط للاشتراك في القناة",'url'=>"https://t.me/$link_ch_sudo1"]],
]])]);
return false;}
$stuts = getmember($tokensan3,$id_ch_sudo2,$from_id);
if($stuts=="no"){
bot('sendMessage',['chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"
▫️ عذراً يجب عليكَ الاشتراك بقناة البوت اولاً.
▫️ عند الاشتراك قم بإرسال /start مرةً اخرئ .
",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>true,
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"اضغط للاشتراك في القناة",'url'=>"https://t.me/$link_ch_sudo2"]],
]])]);return false;}}

if($message and in_array($from_id,$ban)){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"❎ لا تستطيع استخدام البوت انت محظور",
]);return false;}

@$infosudo = json_decode(file_get_contents("sudo.json"),true);
if (!file_exists("sudo.json")) {
#	$put = [];
$infosudo["info"]["admins"][]="$admin";
$infosudo["info"]["st_grop"]="ممنوع";
$infosudo["info"]["st_channel"]="مسموح";
$infosudo["info"]["fwrmember"]="❎";
$infosudo["info"]["tnbih"]="✅";
$infosudo["info"]["silk"]="✅";
$infosudo["info"]["allch"]="مفردة";
$infosudo["info"]["start"]="non";
$infosudo["info"]["klish_sil"]="كليشة الاشتراك الاجباري";

file_put_contents("sudo.json", json_encode($infosudo));}
$fwrmember=$infosudo["info"]["fwrmember"];
$tnbih=$infosudo["info"]["tnbih"];
$silk=$infosudo["info"]["silk"];
$allch=$infosudo["info"]["allch"];
$start=$infosudo["info"]["start"];
$klish_sil=$infosudo["info"]["klish_sil"];
$sudo=$infosudo["info"]["admins"];

if($message){
$false="";
if($allch!="مفردة"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];

$keyboard["inline_keyboard"]=[];
foreach($orothe as $co=>$s ){
$namechannel= $s["name"];
$st= $s["st"];
$userchannel=str_replace('@','', $s["user"]);
if($namechannel!=null){
$stuts = getmember($token,$co,$from_id);
if($stuts=="no"){
if($st=="عامة"){
$url="t.me/$userchannel";
$tt=$s["user"];
}else{
$url =$s["user"];
$tt=$s["user"];}

if($silk=="✅"){
$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'url'=>$url]];
}else{
$txt=$txt."\n".$tt;}
$false="yes";}}}

$reply_markup=json_encode($keyboard);
if($false=="yes"){
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"$klish_sil | $txt",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup,
]);return $false;}
}else{
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];

foreach($orothe as $co=>$s ){
$keyboard["inline_keyboard"]=[];
$namechannel = $s["name"];
$st= $s["st"];
$userchannel = str_replace('@','', $s["user"]);
if($namechannel!=null){
$stuts = getmember($token,$co,$from_id);
if($stuts == "no"){
if($st == "عامة"){
$url = "t.me/$userchannel";
$tt = $s["user"];
}else{
$url = $s["user"];
$tt = $s["user"];}

if($silk=="✅"){
$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'url'=>$url]];}

#$reply_markup=json_encode($keyboard);
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"$klish_sil | $tt",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode($keyboard),
]);return $false;}}}}}

if($update and !in_array($from_id,$member)){file_put_contents("sudo/member.txt","$from_id\n",FILE_APPEND);
if($tnbih == "✅" ){
bot("sendmessage",["chat_id"=>$admin,
"text"=>"- دخل شخص إلى البوت 🚶‍♂
[..$name](tg://user?id=$from_id) 
- ايديه $from_id 🆔
- معرفة : @$user
---------
عدد اعضاء بوتك هو : $cunte
",
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",]);
$tok = "$tokensan3";
$data = [
'text'=>"
[▫️ دخل شخص جديد إلى بوت احد المصنوعات..](t.me/$usernamebot)

▫️ ألاسم: [..$name](tg://user?id=$from_id)
▫️ الايدي: `$from_id`
▫️ المعرف: *@$user*
▫️ عدد اعضاء بوته هو: *$cunte*
▫️ نوع البوت : *$no3mak*
▫️ معرف البوت: `@$usernamebot`
• - - - - - - - - - - - - - - - - - - - - - - - - - - - •",
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
'chat_id'=>'1682389436'];
file_get_contents("https://api.telegram.org/bot$tok/sendMessage?" . http_build_query($data));}}

if($countban<=0){
$countban="لايوجد محظورين";}

if($text == "/start" and in_array($from_id,$sudo)){
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- اهلا بك عزيزي في لوحة اوامر البوت يمكنك التحكم بها مثل ماتشاء..",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"تعيين (Start)",'callback_data'=>"start"]],
[['text'=>"التوجية: $fwrmember",'callback_data'=>"fwrmember"],['text'=>"تنبية الدخول: $tnbih",'callback_data'=>"tnbih"]],
[['text'=>"حظر عضو",'callback_data'=>"ban"],['text'=>"الغاء حظر عضو",'callback_data'=>"unban"]],
[['text'=>"مسح قائمة الحظر",'callback_data'=>"unbanall"]],
[['text'=>"قسم الادمنية",'callback_data'=>"admins"],['text'=>"قسم الاذاعة",'callback_data'=>"sendmessage"]],
[['text'=>"مسح قناة",'callback_data'=>"delchannel"],['text'=>"إضافة قناة",'callback_data'=>"addchannel"]],
[['text'=>"الاحصائيات",'callback_data'=>"a01"]],
[['text'=>"عرض قنوات الاشتراك",'callback_data'=>"viwechannel"],['text'=>"تعيين رسالة الاشتراك",'callback_data'=>"klish_sil"]],
[['text'=>"عرض ازرار انلاين: $silk",'callback_data'=>"silk"],['text'=>"عرض الرسالة: $allch",'callback_data'=>"allch"]],
[['text'=>"النسخة المدفوعة",'callback_data'=>"123"]],
]])]);}

function sendwataw($chat_id,$message_id){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$fwrmember=$infosudo["info"]["fwrmember"];
$tnbih=$infosudo["info"]["tnbih"];
$silk=$infosudo["info"]["silk"];
$allch=$infosudo["info"]["allch"];
$member = explode("\n",file_get_contents("sudo/member.txt"));
$cunte = count($member)-1;
$ban = explode("\n",file_get_contents("sudo/ban.txt"));
$countban = count($ban)-1;
if($countban<=0){
$countban="لايوجد محظورين";}
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- اهلا بك عزيزي في لوحة اوامر البوت يمكنك التحكم بها مثل ماتشاء..",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"تعيين (Start)",'callback_data'=>"start"]],
[['text'=>"التوجية: $fwrmember",'callback_data'=>"fwrmember"],['text'=>"تنبية الدخول: $tnbih",'callback_data'=>"tnbih"]],
[['text'=>"حظر عضو",'callback_data'=>"ban"],['text'=>"الغاء حظر عضو",'callback_data'=>"unban"]],
[['text'=>"مسح قائمة الحظر",'callback_data'=>"unbanall"]],
[['text'=>"قسم الادمنية",'callback_data'=>"admins"],['text'=>"قسم الاذاعة",'callback_data'=>"sendmessage"]],
[['text'=>"مسح قناة",'callback_data'=>"delchannel"],['text'=>"إضافة قناة",'callback_data'=>"addchannel"]],
[['text'=>"الاحصائيات",'callback_data'=>"a01"]],
[['text'=>"عرض قنوات الاشتراك",'callback_data'=>"viwechannel"],['text'=>"تعيين رسالة الاشتراك",'callback_data'=>"klish_sil"]],
[['text'=>"عرض ازرار انلاين: $silk",'callback_data'=>"silk"],['text'=>"عرض الرسالة: $allch",'callback_data'=>"allch"]],
[['text'=>"النسخة المدفوعة",'callback_data'=>"123"]],
]])]);}

if($data == "123" ){
$infobot=explode("\n",file_get_contents("info.txt"));
$tokenbot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];

if($pro=="yes"){
$dayon = date('Y/m/d',$dateon);
$timeon = date('H:i:s A',$dateon);
$dayoff = date('Y/m/d',$dateoff);
$timeoff =date('H:i:s A',$dateon);
$dayoff = "0";
}else{
$dayoff = "0";}

if($pro=="yes"){
$dayon = date('Y/m/d',$dateon);
$timeon = date('H:i:s A',$dateon);
$dayoff = date('Y/m/d',$dateoff);
$timeoff =date('H:i:s A',$dateon);
$tx1 = "فعال";
}else{
$tx1 = "غير فعال";}
bot('EditMessageText',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"
• حالة الاشتراك المدفوع : $tx1
• تاريخ انتهاء اشتراك المدفوع : $dayoff
*- - - - - - - - - - - - - - - - - - - - - - - - - -
• النوع : $no3mak
• يوزر البوت : @$userbot
• عدد الاعضاء : $cunte
- - - - - - - - - - - - - - - - - - - - - - - - - -*
- لشراء بوت من الصانع فقط خلال التواصل مع مطور المصنع .
يمكنك الحصول على المميزات التالية :

1. حذف اي حقوق للصانع في البوت .
2. ايقاف ظهور اي اعلانات في البوت .
3. تشغيل البوت على خوادم اسرع .
- سعر البوت فقط ( 5$ ) يمكنك الحصول عليه بمراسلة المطور ( @k_u_4 ) ✅ .
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'أضغط هنا لمراسلة المطور','url'=>"t.me/Y_xbot"]],
[['text'=>'• رجوع •','callback_data'=>"home"]],
]])]);}

if($data == "a01" ){
bot('EditMessageText',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"
- اهلا بك في قسم الاحصائيات
•••••••••••••••••••••••••••••••••
- عدد اعضاء بوتك : $cunte
- المحظورين : $countban
",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"home"]],
]])]);}

if($data == "ban"){
$infosudo["info"]["amr"]="ban";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- قم بارسال أيدي العضو لحظره",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}

if($text and $text !="/start" and $infosudo["info"]["amr"]=="ban" and in_array($from_id,$sudo) and is_numeric($text)){
if(!in_array($text,$ban)){
file_put_contents("sudo/ban.txt","$text\n",FILE_APPEND);
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حظر العضو بنجاح $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
bot('sendmessage',['chat_id'=>$text,
'text'=>"❎ لقد قام الادمن بحظرك من استخدام البوت",]);
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"🚫 العضو محظور مسبقاً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}

$infosudo["info"]["amr"]="null";
file_put_contents("sudo.json", json_encode($infosudo));}

if($data == "unban"){
$infosudo["info"]["amr"]="unban";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- قم بارسال أيدي العضو للإلغاء الحظر عنه",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}

if($text and $text !="/start" and $infosudo["info"]["amr"]=="ban" and in_array($from_id,$sudo) and is_numeric($text)){
if(in_array($text,$ban)){

$str=file_get_contents("sudo/ban.txt");
$str=str_replace("$text\n",'',$str);
file_put_contents("sudo/ban.txt",$str);
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم الغاء حظر العضو بنجاح 
$text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
bot('sendmessage',['chat_id'=>$text,
'text'=>"✅ لقد قام الادمن بالغاء الحظر عنك.",
]);
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"🚫 العضو ليسِ محظور مسبقاً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}
$infosudo["info"]["amr"]="null";
file_put_contents("sudo.json", json_encode($infosudo));
}

if($data == "unbanall"){
if($countban>0){
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- ✅ تم مسح قائمة المحظورين بنجاح ",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}else{
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"🚫 ليس لديك اعضاء محظورين ",
'show_alert'=>true
]);}}

if($data == "start"){
$infosudo["info"]["amr"]="start";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- قم بارسال نص رسالة /start",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}

if($text and $text !="/start" and $infosudo["info"]["amr"]=="start" and in_array($from_id,$sudo)){
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظ كليشة /start 
-الكليشة : 
$text ",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["start"]="$text";
file_put_contents("sudo.json", json_encode($infosudo));
}
if($data == "klish_sil"){
$infosudo["info"]["amr"]="klish_sil";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- قم بارسال كليشة الاشتراك الاجباريي 
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);

}
if($text and $text !="/start" and $infosudo["info"]["amr"]=="klish_sil" and in_array($from_id,$sudo)){
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظ كليشة الاشتراك الاجباري 
-الكليشة : 
$text ",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["klish_sil"]="$text";
file_put_contents("sudo.json", json_encode($infosudo));
}

if($data == "home" and in_array($from_id,$sudo)){
$infosudo["info"]["amr"]="null";
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}
if($data == "fwrmember"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$fwrmember=$infosudo["info"]["fwrmember"];
if($fwrmember=="✅"){
$infosudo["info"]["fwrmember"]="❎";
}
if($fwrmember=="❎"){
$infosudo["info"]["fwrmember"]="✅";
}
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}
if($data == "tnbih"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$tnbih=$infosudo["info"]["tnbih"];
if($tnbih=="✅"){
$infosudo["info"]["tnbih"]="❎";
}
if($tnbih=="❎"){
$infosudo["info"]["tnbih"]="✅";
}
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}

if($data == "silk"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$skil=$infosudo["info"]["silk"];
if($skil=="✅"){
$infosudo["info"]["silk"]="❎";
}
if($skil=="❎"){
$infosudo["info"]["silk"]="✅";
}
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}

if($data == "allch"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$allch=$infosudo["info"]["allch"];
if($allch=="مفردة"){
$infosudo["info"]["allch"]="مجموعة";
}
if($allch=="مجموعة"){
$infosudo["info"]["allch"]="مفردة";
}
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}


if($data == "addchannel"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];
$count=count($orothe);
if($count<4){
$infosudo["info"]["amr"]="addchannel";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- اذا كانت القناة التي تريد اضافتها عامة قم بارسال معرفها .
* اذا كانت خاصة قم بإعادة توجية منشور من القناة إلى هنا .
",

'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}else{
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- 🚫 لا يمكنك اضافة اكثر من3 قنوات للإشتراك الاجباري 
",

'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}
}
if($text and $text !="/start" and $infosudo["info"]["amr"]=="addchannel" and in_array($from_id,$sudo) and !$message->forward_from_chat ){

$ch_id = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$text"))->result->id;
$idchan=$ch_id;
if($ch_id != null){

$checkadmin = getChatstats($text,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$text"))->result->title;
$infosudo["info"]["channel"][$ch_id]["st"]="عامة";
$infosudo["info"]["channel"][$ch_id]["user"]="$text";
$infosudo["info"]["channel"][$ch_id]["name"]="$namechannel";
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن 
info channel 
user : $text 
name : $namechannel
id : $ch_id
 ",
 'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إضافة قناة آخرى",'callback_data'=>"addchannel"]],
 ]])
]);
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"❎ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها 
 ",
'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إعادة المحاولة ",'callback_data'=>"addchannel"]],
 ]])
]);

}
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"
❎ لم تتم إضافة القناة لا توجد قناة تمتلك هذا المعرف 
$text ",
'reply_markup'=>json_encode(['inline_keyboard'=>[
 [['text'=>"• رجوع • ",'callback_data'=>"home"]],
 ]])
]);
}
$infosudo["info"]["amr"]="null";
file_put_contents("sudo.json", json_encode($infosudo));
}
if($message->forward_from_chat and $infosudo["info"]["amr"]=="addchannel" and in_array($from_id, $sudo)){
$id_channel= $message->forward_from_chat->id;
if($id_channel != null){

$checkadmin = getChatstats($id_channel,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$id_channel"))->result->title;
$infosudo["info"]["channel_id"]="$id_channel";
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن 
info channel 
user : • قناة خاصة • 
name : $namechannel
id : $id_channel
*يجب عليك ارسال رابط القناة الخاص قم بارسالة الان
 ",
 'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- الغاء ",'callback_data'=>"addchannel"]],
 ]])
 ]);
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"❎ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها 
 ",
'reply_markup'=>json_encode(['inline_keyboard'=>[
 [['text'=>"- إعادة المحاولة ",'callback_data'=>"addchannel"]],
 ]])
]);}}

$infosudo["info"]["amr"]="channel_id";
file_put_contents("sudo.json", json_encode($infosudo));
}
$channel_id=$infosudo["info"]["channel_id"];

if($text and $text !="/start" and $infosudo["info"]["amr"]=="channel_id" and in_array($from_id,$sudo) and !$message->forward_from_chat ){
$checkadmin = getChatstats($channel_id,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$channel_id"))->result->title;
$infosudo["info"]["channel"][$channel_id]["st"]="خاصة";
$infosudo["info"]["channel"][$channel_id]["user"]="$text";
$infosudo["info"]["channel"][$channel_id]["name"]="$namechannel";
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
link : $text 
name : $namechannel
id : $channel_id",
 'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- إضافة قناة آخرى",'callback_data'=>"addchannel"]],
]])
]);
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"❎ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها 
 ",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- إعادة المحاولة ",'callback_data'=>"addchannel"]],
 ]])]);}

$infosudo["info"]["amr"]="null";
$infosudo["info"]["channel_id"]="null";
file_put_contents("sudo.json", json_encode($infosudo));
}

if($data == "viwechannel" and in_array($from_id, $sudo)){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];

$keyboard["inline_keyboard"]=[];

foreach($orothe as $co ){

$namechannel= $co["name"];
$st= $co["st"];
$userchannel= $co["user"];
if($namechannel!=null){
	$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'callback_data'=>'null']];
if($st=="خاصة"){
$userchannel="null";
}
$keyboard["inline_keyboard"][] =
[['text'=>$userchannel,'callback_data'=>'cull'],['text'=>$st,'callback_data'=>'null']];
}}
	$keyboard["inline_keyboard"][] = [['text'=>"• رجوع •",'callback_data'=>"home"]];
$reply_markup=json_encode($keyboard);
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- هذة هي قنوات الاشتراك الاجباري الخاصة بك ",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup
]);}

if($data == "delchannel" and in_array($from_id, $sudo)){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];

$keyboard["inline_keyboard"]=[];

foreach($orothe as $co=>$s ){

$namechannel= $s["name"];
$st= $s["st"];
$userchannel= $s["user"];
if($namechannel!=null){
	$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'callback_data'=>'null']];
if($st=="خاصة"){
$userchannel="null";}
$keyboard["inline_keyboard"][] =
[['text'=>'🚫 حذف','callback_data'=>'deletchannel '.$co],['text'=>$st,'callback_data'=>'null']];}}

$keyboard["inline_keyboard"][] = [['text'=>"• رجوع •",'callback_data'=>"home"]];
$reply_markup=json_encode($keyboard);
	
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- قم بالضغط على خيار الحذف بالاسفل",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup
]);}

if(preg_match('/^(deletchannel) (.*)/s', $data)){
$nn = str_replace('deletchannel ',"",$data);
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"✅ تم حذف القناة بنجاح 
id $nn",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"delchannel"]],
]])]);
unset($infosudo["info"]["channel"][$nn]);
file_put_contents("sudo.json", json_encode($infosudo));}

if($message and $fwrmember=="✅"){
bot('ForwardMessage',['chat_id'=>$admin,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id,]);}

$amr = file_get_contents("sudo/amr.txt");
$no3send =file_get_contents("no3send.txt");
$chatsend=file_get_contents("chatsend.txt");
if($data == "sendmessage" and in_array($from_id,$sudo)){
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"أهلا بك عزيزي في قسم الاذاعة
 قم بتحديد نوع الاذاعة ومكان ارسال الاذاعة
ثم قم الضغط على ارسال الرسالة
",'message_id'=>$message_id,
'reply_markup'=>json_encode([ 'inline_keyboard'=>[
[['text'=>"نوع الاذاعة : $no3send",'callback_data'=>"button"]],
[['text'=>"توجية",'callback_data'=>"forward"],['text'=>"MARKDOWN",'callback_data'=>"MARKDOWN"],['text'=>"HTML",'callback_data'=>"HTML"]],
[['text'=>"الارسال الى: $chatsend",'callback_data'=>"button"]],
[['text'=>"الكل",'callback_data'=>"all"],['text'=>"الاعضاء",'callback_data'=>"member"]],
[['text'=>"الكروبات",'callback_data'=>"gruops"],['text'=>"القنوات",'callback_data'=>"channel"]],
[['text'=>"ارسال الرسالة",'callback_data'=>"post"]],
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}

function sendwataw2($chat_id,$message_id){
$no3send =file_get_contents("no3send.txt");
$chatsend=file_get_contents("chatsend.txt");
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"أهلا بك عزيزي في قسم الاذاعة
 قم بتحديد نوع الاذاعة ومكان ارسال الاذاعة
ثم قم بالضغط على ارسال الرسالة
",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"نوع الاذاعة : $no3send",'callback_data'=>"button"]],
[['text'=>"توجية",'callback_data'=>"forward"],['text'=>"MARKDOWN",'callback_data'=>"MARKDOWN"],['text'=>"HTML",'callback_data'=>"HTML"]],
[['text'=>"الارسال الى: $chatsend",'callback_data'=>"button"]],
[['text'=>"الكل",'callback_data'=>"all"],['text'=>"الاعضاء",'callback_data'=>"member"]],
[['text'=>"الكروبات",'callback_data'=>"gruops"],['text'=>"القنوات",'callback_data'=>"channel"]],
[['text'=>"ارسال الرسالة",'callback_data'=>"post"]],
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);} 

if($data == "forward"){
file_put_contents("no3send.txt","forward");
sendwataw2($chat_id,$message_id);}

if($data == "MARKDOWN"){
file_put_contents("no3send.txt","MARKDOWN");
sendwataw2($chat_id,$message_id);}

if($data == "HTML"){
file_put_contents("no3send.txt","html");
sendwataw2($chat_id,$message_id);}

if($data == "all"){
file_put_contents("chatsend.txt","all");
sendwataw2($chat_id,$message_id);}


if($data == "member"){
file_put_contents("chatsend.txt","member");
sendwataw2($chat_id,$message_id);}

if($data == "gruops"){
file_put_contents("chatsend.txt","gruops");
sendwataw2($chat_id,$message_id);}

if($data == "channel"){
file_put_contents("chatsend.txt","channel");
sendwataw2($chat_id,$message_id);}

$no3send =file_get_contents("no3send.txt");
$chatsend=file_get_contents("chatsend.txt");
if($data == "post" and $no3send!=null and $chatsend!=null and in_array($from_id,$sudo) ){
file_put_contents("sudo/amr.txt","sendsend");
bot('EditMessageText',[
'message_id'=>$message_id,
'chat_id'=>$chat_id,
'text'=>"قم بارسال رسالتك الان
نوع الارسال : $no3send
مكان الارسال : $chatsend
",
'message_id'=>$message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"الغاء",'callback_data'=>"set"]],
]])]);}
if($data == "set" and in_array($from_id,$sudo) ){
unlink("sudo/amr.txt");
bot('EditMessageText',[
'chat_id'=>$chat_id,
'text'=>"تم إلغاء الارسال بنجاح",
'message_id'=>$message_id,]);}

$forward = $update->message->forward_from;
$photo=$message->photo;
$video=$message->video;
$document=$message->document;
$sticker=$message->sticker;
$voice=$message->voice;
$audio=$message->audio;
$member =file_get_contents("sudo/member.txt");

if($photo){
$sens="sendphoto";
$file_id = $update->message->photo[1]->file_id;}

if($document){
$sens="senddocument";
$file_id = $update->message->document->file_id;}

if($video){
$sens="sendvideo";
$file_id = $update->message->video->file_id;}

if($audio){
$sens="sendaudio";
$file_id = $update->message->audio->file_id;}

if($voice){
$sens="sendvoice";
$file_id = $update->message->voice->file_id;}

if($sticker){
$sens="sendsticker";
$file_id = $update->message->sticker->file_id;}

if($message and $text !="الاذاعة" and $amr == "sendsend" and $no3send=="forward" and in_array($from_id,$sudo) ){
unlink("sudo/amr.txt");

if($chatsend=="all"){
$for=$member."\n".$groups."\n".$channels;
$txt=" تم التوجية - عام للجميع";}
if($chatsend=="member"){
$for=$member;
$txt="تم التوجية - خاص - للاعضاء فقط";}
if($chatsend=="gruops"){
$for=$groups;
$txt=" تم التوجية - خاص - الكروبات فقط";}

if($chatsend=="channel"){
$txt=" تم التوجية - خاص - القنوات فقط";
$for=$channels;}
file_put_contents("get.txt","0");
file_put_contents("sudo/send.txt","$for");
$foor=explode("\n",$for);
bot('ForwardMessage',['chat_id'=>$chat_id,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id,]);
for($i=0;$i<count($foor); $i++){
bot('ForwardMessage',[
'chat_id'=>$foor[$i],
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id,
]);}
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"✅ $txt",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"home"]],]])]);
unlink("no3send.txt");
unlink("chatsend.txt");}

if($message and $text !="الاذاعة"and $amr == "sendsend"and $no3send !="forward" and in_array($from_id,$sudo) ){
unlink("sudo/amr.txt");

if($chatsend=="all"){
$for=$member."\n".$groups."\n".$channels;
$txt=" تم النشر - عام للجميع";}
if($chatsend=="member"){
$for=$member;
$txt=" تم النشر - خاص - للاعضاء فقط";}
if($chatsend=="gruops"){
$for=$groups;
$txt=" تم النشر - خاص - الكروبات فقط";}

if($chatsend=="channel"){
$txt=" تم النشر - خاص - القنوات فقط";
$for=$channels;}
file_put_contents("sudo/send.txt","$for");
file_put_contents("get.txt","0");
$foor=explode("\n",$for);
if($text){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$text",
'parse_mode'=>"$no3send",
'disable_web_page_preview'=>true,]);

for($i=0;$i<count($foor); $i++){
bot('sendMessage', [
'chat_id'=>$foor[$i],
'text'=>"$text",
'parse_mode'=>"$no3send",
'disable_web_page_preview'=>true,
]);}
}else{
$ss=str_replace("send","",$sens);
bot($sens,[
"chat_id"=>$chat_id,
"$ss"=>"$file_id",
'caption'=>"$caption",]);

for($i=0;$i<count($foor); $i++){
$ss=str_replace("send","",$sens);
bot($sens,[
"chat_id"=>$foor[$i],
"$ss"=>"$file_id",
'caption'=>"$caption",]);}}

bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"✅ $txt",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"home"]],]])]);
unlink("no3send.txt");
unlink("chatsend.txt");} 

if($data == "admins" and $from_id==$admin){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["admins"];

$keyboard["inline_keyboard"]=[];

foreach($orothe as $co=>$sss ){
if($co!=null and $co!=$admin ){

$keyboard["inline_keyboard"][] =
[['text'=>' 🗑','callback_data'=>'deleteadmin '.$co.'#'.$sss],['text'=>$sss,'callback_data'=>'null']];
}}
	$keyboard["inline_keyboard"][] = [['text'=>"- اضافة ادمن",'callback_data'=>"addadmin"]];
	$keyboard["inline_keyboard"][] = [['text'=>"• رجوع •",'callback_data'=>"home"]];
$reply_markup=json_encode($keyboard);
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- تستطيع فقط رفع 5 ادمنية 
*تنوية : الادمنية يستطيعون التحكم بإعدادات البوت ماعدا قسم الادمنية .
",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup
]);}

if($data == "addadmin"){
$infosudo["info"]["amr"]="addadmin";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"- قم بارسال ايدي الادمن",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}

if($text and $text !="/start" and $infosudo["info"]["amr"]=="addadmin" and $from_id ==$admin and is_numeric($text)){
if(!in_array($text,$admins)){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];
$count=count($orothe);
if($count<6){
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظرفع الادمن بنجاح",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"admins"]],
]])]);
$infosudo["info"]["admins"][]="$text";
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"🚫 لايمكنك اضافة اكثر من 5 ادمنية ً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"admins"]],
]])]);}
}else{
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- ⚠ الادمن مضاف مسبقاً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"admins"]],
]])]);}

$infosudo["info"]["amr"]="null";
file_put_contents("sudo.json", json_encode($infosudo));}

if(preg_match('/^(deleteadmin) (.*)/s', $data)){
$nn = str_replace('deleteadmin ',"",$data);
$ex=explode('#',$nn);
$id=$ex[1];
$n=$ex[0];
bot('EditMessageText',['chat_id'=>$chat_id,
'text'=>"✅ تم حذف الادمن بنجاح 
id $id",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"admins"]],
]])]);
unset($infosudo["info"]["admins"][$n]);
file_put_contents("sudo.json", json_encode($infosudo));}

