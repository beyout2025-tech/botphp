<?php
ob_start(); 
$token = "7896111250:AAE-zm4PuKDPUwDt3dsLSLAPP8DbHdD7z-g";
$user_bot_sudo = "Uploadfilesmnbot";
define("API_KEY", $token);

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

function remove_dir($path){
if(is_dir($path) === false){
return false;}	
$dir = opendir($path);
while (($file = readdir($dir) )!== false)	{
if($file == '.' OR $file == '..' OR $file == 'sudo' OR $file == 'pro.json'){
continue;}
if(is_file($path.'/'.$file)){
unlink($path.'/'.$file);
}elseif(is_dir($path.'/'.$file)){
remove_dir($path.'/'.$file);}}
rmdir($path);closedir($dir);}

$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$txt = $message->caption;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$new = $message->new_chat_members;
$message_id = $message->message_id;
$type = $message->chat->type;
$name = $message->from->first_name;
if(isset($update->callback_query)){

$up = $update->callback_query;
$chat_id = $up->message->chat->id;
$from_id = $up->from->id;
$user = $up->from->username;
$name = $up->from->first_name;
$message_id = $up->message->message_id;
$data = $up->data;}
$id = $update->inline_query->from->id; 

$sudo = array("873158772","873158772");
$ameed = 873158772; 


mkdir("sudo");

$get_ban=file_get_contents('sudo/ban.txt');
$ban =explode("\n",$get_ban);

$member = explode("\n",file_get_contents("sudo/member.txt"));
$cunte = count($member)-1;

$folder="https://botphp-01s6.onrender.com";

$reply = $message->reply_to_message->message_id;
$rep = $message->reply_to_message->forward_from;

$watawjson = json_decode(file_get_contents("botmak/wataw.json"),true);
if (!file_exists("botmak/wataw.json")) {
#	$put = [];
$watawjson["info"]["st_ch_bots"]="❌";
$watawjson["info"]["user_bot"]="$user_bot_sudo";
file_put_contents("botmak/wataw.json", json_encode($watawjson));}
$st_ch_bots=$watawjson["info"]["st_ch_bots"];
$infosudo = json_decode(file_get_contents("sudo.json"),true);
if (!file_exists("sudo.json")) {
#	$put = [];
$infosudo["info"]["update"]="✅";
$infosudo["info"]["propots"]="مجانية";
$infosudo["info"]["fwrmember"]="❌";
$infosudo["info"]["tnbih"]="✅";
$infosudo["info"]["silk"]="✅";
$infosudo["info"]["allch"]="مفردة";
$infosudo["info"]["klish_sil"]="كليشة الاشتراك الاجباري";
file_put_contents("sudo.json", json_encode($infosudo));}
$updatenew=$infosudo["info"]["update"];
$propots=$infosudo["info"]["propots"];
$fwrmember=$infosudo["info"]["fwrmember"];
$tnbih=$infosudo["info"]["tnbih"];
$silk=$infosudo["info"]["silk"];
$allch=$infosudo["info"]["allch"];
$start=$infosudo["info"]["start"];
$klish_sil=$infosudo["info"]["klish_sil"];
$updatechannel=$infosudo["info"]["updatechannel"];
$admins=$infosudo["info"]["admins"];
$info_kl=$infosudo["info"]["info_kl"];
$token_kl=$infosudo["info"]["token_kl"];

if( $text=="تحديث" ){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"تم تحديث البوت بنجاح",
'reply_to_message_id'=>$message->message_id,
]);return false;}

if($message and $updatenew=="❌" and $from_id!= $ameed){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"البوت قيد التحديث الرجاء الانتظار حتى يتم الانتهاء من التحديث سيتم اشعاركم بذالك عند الانتهاء",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'اضغط هنا وتابعنا 🔬.','url'=>"t.me/botFilec"]],
]])]);return false;}

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
$admin=file_get_contents("admin.txt");

$watawjson = json_decode(file_get_contents("botmak/wataw.json"),true);
$id_ch_sudo=$watawjson["info"]["id_channel"];
$link_ch_sudo=$watawjson["info"]["link_channel"];
$user_bot_sudo=$watawjson["info"]["user_bot"];

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
$false = "yes";}}}

$reply_markup=json_encode($keyboard);
if($false=="yes"){
bot('sendmessage',['chat_id'=>$chat_id, 
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
$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'url'=>$url]];}
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"$klish_sil | $tt",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode($keyboard),
]);return $false;}}}}}
if($update and !in_array($from_id,$member)){
    file_put_contents("sudo/member.txt","$from_id\n",FILE_APPEND);
    if($tnbih == "✅" ){
        bot("sendmessage",[
            "chat_id"=>$ameed,
            "text"=>"👾 شخص جديد دخل البوت

👤 معلومات العضو الجديد:
• الاسم: $name
• المعرف: @$user
• الآيدي: $from_id


📊 إجمالي المستخدمين: $cunte",
            'disable_web_page_preview'=>'true',
            'parse_mode'=>"markdown",
        ]);
    }
}



$ban = explode("\n",file_get_contents("sudo/ban.txt"));
$countban = count($ban)-1;

$botfreeid=explode("\n",file_get_contents("infoidbots.txt"));
$countbots = count($botfreeid)-1;
if($countbots<=0){
$countbots = "لايوجد بوتات مصنوعة";}

if($message  and in_array($from_id,$ban)){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"❌ لا تستطيع استخدام البوت انت محظور",
]);return false;}

if($countban<=0){
$countban = "لايوجد محظورين";}

if($text == "/m" and in_array($from_id,$sudo)){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
- اهلا بك عزيزي في لوحة اوامر البوت يمكنك التحكم بها مثل ماتشاء..
اليك الاحصائيات:
• الاعضاء: $cunte
• المصنوعات: $countbots
",
'disable_web_page_preview'=>true,
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"حالة البوت: $updatenew",'callback_data'=>"updatenew"],['text'=>"اشتراك المصنوعات: $st_ch_bots",'callback_data'=>"st_ch_bots"]],
[['text'=>"اشتراك للبوتات 1.",'callback_data'=>"channelbots"],['text'=>"اشتراك للبوتات 2.",'callback_data'=>"channelbots2"]],
[['text'=>"تعيين قناة تحديثات البوت",'callback_data'=>"updatechannel"]],
[['text'=>"إلغاء اشتراك مدفوع",'callback_data'=>"delprobot"],['text'=>"اضافة اشتراك مدفوع",'callback_data'=>"addprobot"]],
[['text'=>"تعيين حساب المطور",'callback_data'=>"sudo"],['text'=>"تعيين (Start)",'callback_data'=>"start"]],
[['text'=>"تعيين معلومات البوت",'callback_data'=>"info_kl"],['text'=>"تعيين كليشة التوكن",'callback_data'=>"token_kl"]],
[['text'=>"التوجية: $fwrmember",'callback_data'=>"fwrmember"],['text'=>"التنبية: $tnbih",'callback_data'=>"tnbih"]],
[['text'=>"قسم الاذاعة",'callback_data'=>"sendmessage"]],
[['text'=>"حظر عضو",'callback_data'=>"ban"],['text'=>"إلغاء حظر عضو",'callback_data'=>"unban"]],
[['text'=>"مسح قناة",'callback_data'=>"delchannel"],['text'=>"إضافة قناة",'callback_data'=>"addchannel"]],
[['text'=>"قنوات الاشتراك",'callback_data'=>"viwechannel"],['text'=>"تعيين رسالة الاشتراك",'callback_data'=>"klish_sil"]],
[['text'=>"نسخة بيانات البوتات 📦",'callback_data'=>"get_all_bots_data"],['text'=>"رفع نسخة احتياطية 📤",'callback_data'=>"set_backup"]],
[['text'=>"تحميل ملفات الصانع 📥",'callback_data'=>"get_backup"],['text'=>"عرض انلاين: $silk",'callback_data'=>"silk"]],
[['text'=>"عرض الرسالة: $allch",'callback_data'=>"allch"]],
]])]);}

function sendwataw($chat_id,$message_id){
$watawjson = json_decode(file_get_contents("botmak/wataw.json"),true);
$st_ch_bots=$watawjson["info"]["st_ch_bots"];
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$updatenew=$infosudo["info"]["update"];
$propots=$infosudo["info"]["propots"];
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
$botfreeid=explode("\n",file_get_contents("infoidbots.txt"));
$countbots = count($botfreeid)-1;
if($countbots<=0){
$countbots="لايوجد بوتات مصنوعة";}
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"
- اهلا بك عزيزي في لوحة اوامر البوت يمكنك التحكم بها مثل ماتشاء..
اليك الاحصائيات:
• الاعضاء: $cunte
• المصنوعات: $countbots
",
'disable_web_page_preview'=>true,
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"حالة البوت: $updatenew",'callback_data'=>"updatenew"],['text'=>"اشتراك المصنوعات: $st_ch_bots",'callback_data'=>"st_ch_bots"]],
[['text'=>"اشتراك للبوتات 1.",'callback_data'=>"channelbots"],['text'=>"اشتراك للبوتات 2.",'callback_data'=>"channelbots2"]],
[['text'=>"تعيين قناة تحديثات البوت",'callback_data'=>"updatechannel"]],
[['text'=>"إلغاء اشتراك مدفوع",'callback_data'=>"delprobot"],['text'=>"اضافة اشتراك مدفوع",'callback_data'=>"addprobot"]],
[['text'=>"تعيين حساب المطور",'callback_data'=>"sudo"],['text'=>"تعيين (Start)",'callback_data'=>"start"]],
[['text'=>"تعيين معلومات البوت",'callback_data'=>"info_kl"],['text'=>"تعيين كليشة التوكن",'callback_data'=>"token_kl"]],
[['text'=>"التوجية: $fwrmember",'callback_data'=>"fwrmember"],['text'=>"التنبية: $tnbih",'callback_data'=>"tnbih"]],
[['text'=>"قسم الاذاعة",'callback_data'=>"sendmessage"]],
[['text'=>"حظر عضو",'callback_data'=>"ban"],['text'=>"إلغاء حظر عضو",'callback_data'=>"unban"]],
[['text'=>"مسح قناة",'callback_data'=>"delchannel"],['text'=>"إضافة قناة",'callback_data'=>"addchannel"]],
[['text'=>"قنوات الاشتراك",'callback_data'=>"viwechannel"],['text'=>"تعيين رسالة الاشتراك",'callback_data'=>"klish_sil"]],
[['text'=>"نسخة بيانات البوتات 📦",'callback_data'=>"get_all_bots_data"],['text'=>"رفع نسخة احتياطية 📤",'callback_data'=>"set_backup"]],
[['text'=>"تحميل ملفات الصانع 📥",'callback_data'=>"get_backup"],['text'=>"عرض انلاين: $silk",'callback_data'=>"silk"]],
[['text'=>"عرض الرسالة: $allch",'callback_data'=>"allch"]],
]])]);}

if($data == "addprobot"){
$infosudo["info"]["amr"]="addprobot";
bot('editmessagetext',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"💳 أرسل الآن (معرف البوت المصنوع) لإضافته للمدفوع..", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]],]])]);
 
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"✴ اضافة اشتراك مدفوع : 
قم بارسال معرف البوت المصنوع الذي تود اضافة الاشتراك المدفوع له",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);}

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="addprobot" and in_array($from_id,$sudo)){
$us_bo=str_replace('@','',$text);
$idbots=file_get_contents("user/$us_bo.txt");

if($idbots!=null){
$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$tokenbot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
bot('sendmessage',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"معلومات البوت
النوع: $no3mak
توكن : `$tokenbot`
يوزر البوت : *@$userbot*
ايدي البوت : `$idbots`
معلومات صاحب البوت
الايدي : `$id`
[صاحب البوت ](tg://user?id=$id)
",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"",'callback_data'=>"probotyes yars_".$idbots],['text'=>"",'callback_data'=>"probotyes 6mo_".$idbots],['text'=>"",'callback_data'=>"probotyes 3mo_".$idbots],['text'=>"شهر واحد",'callback_data'=>"probotyes 1mo_".$idbots]],
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ لايوجد بوت مصنوع بنفس هذا المعرف $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"معاودة المحاولة",'callback_data'=>"addprobot"]],
]])]);}

$infosudo["info"]["amr"]="null";
}

if(preg_match('/^(probotyes) (.*)/s', $data)){
date_default_timezone_set('Asia/Baghdad');
$nn = str_replace('probotyes ',"",$data);
$ex=explode('_',$nn);
$ash=$ex[0];
$idbots=$ex[1];
if($idbots!=null){

$mo = 86400;
$time = time()+(3600 * 1);
$ti=$time+($mo * 30);

if($ash=="yars"){$ti=$time+($mo * 12);}

if($ash=="1mo_"){$ti=$time+($mo * 1);}

$projsonmem["info"]["pro"]="yes";
$projsonmem["info"]["dateon"]="$time";
$projsonmem["info"]["dateoff"]="$ti";
file_put_contents("botmak/$idbots/pro.json", json_encode($projsonmem));

$projson = json_decode(file_get_contents("prodate.json"),true);
$projson["info"][$idbots]["pro"]="yes";
$projson["info"][$idbots]["dateon"]="$time";
$projson["info"][$idbots]["dateoff"]="$ti";
file_put_contents("prodate.json", json_encode($projson));

$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$tokenbot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];

$dayon = date('Y/m/d',$time);
$timeon =date('H:i:s A',$time);
$dayoff = date('Y/m/d',$ti);
$timeoff =date('H:i:s A',$ti);

bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"✅ تم اضافة الاشتراك المدفوع بنجاح 

النوع: $no3mak
يوزر البوت : @$userbot
ايدي البوت : $idbots

معلومات الاشتراك
- وقت الاشتراك :
⏰ $timeon
📅 $dayon
- موعد انتهاء الاشتراك :
⏰ $timeoff
📅 $dayoff
",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
bot('sendmessage',['chat_id'=>$id, 
'text'=>"✅ تم اضافة الاشتراك لبوتك المصنوع بنجاح

النوع: $no3mak
يوزر البوت : @$userbot
ايدي البوت : $idbots

معلومات الاشتراك
- وقت الاشتراك :
⏰ $timeon
📅 $dayon
- موعد انتهاء الاشتراك :
⏰ $timeoff
📅 $dayoff
",
'disable_web_page_preview'=>true,
]);}}

if($data == "delprobot"){
    $infosudo["info"]["amr"]="delprobot";
     
    bot('editmessagetext',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"🚫 أرسل الآن معرف البوت المصنوع لإلغاء اشتراكه المدفوع..", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]]]])]);
}


if($text  and $text !="/start" and $infosudo["info"]["amr"]=="delprobot" and in_array($from_id,$sudo)){
$us_bo=str_replace('@','',$text);
$idbots=file_get_contents("user/$us_bo.txt");

if($idbots!=null){
$projson = json_decode(file_get_contents("prodate.json"),true);
if($projson["info"][$idbots]["pro"]=="yes"){
date_default_timezone_set('Asia/Baghdad');
$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$tokenbot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
$time=$projson["info"][$idbots]["dateon"];
$ti=$projson["info"][$idbots]["dateoff"];

$dayon = date('Y/m/d',$time);
$timeon =date('H:i:s A',$time);
$dayoff = date('Y/m/d',$ti);
$timeoff =date('H:i:s A',$ti);

bot('sendmessage',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"
النوع: $no3mak
يوزر البوت : @$userbot
ايدي البوت : $idbots
",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"حذف",'callback_data'=>"delprobotyes ".$idbots],['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$projson = json_decode(file_get_contents("prodate.json"),true);
$projson["info"][$idbots]["pro"]="no";
file_put_contents("prodate.json", json_encode($projson));
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ هذا البوت لا يمتلك اشتراك مدفوع  $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"معاودة المحاولة",'callback_data'=>"delprobot"]],
]])]);}
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ لايوجد بوت مصنوع بنفس هذا المعرف $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"معاودة المحاولة",'callback_data'=>"delprobot"]],
]])]);}

$infosudo["info"]["amr"]="null";
}

if(preg_match('/^(delprobotyes) (.*)/s', $data)){
$idbots = str_replace('delprobotyes ',"",$data);
if($idbots!=null){

$projsonmem["info"]["pro"]="no";
file_put_contents("botmak/$idbots/pro.json", json_encode($projsonmem));

$projson = json_decode(file_get_contents("prodate.json"),true);
$projson["info"][$idbots]["pro"]="no";
file_put_contents("prodate.json", json_encode($projson));

$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$tokenbot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"🚫 تم حذف الاشتراك المدفوع بنجاح
النوع: $no3mak
يوزر البوت : @$userbot
ايدي البوت : $idbots
",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
bot('sendmessage',['chat_id'=>$id, 
'text'=>"❌ تم حذف الاشتراك المدفوع لبوتك المصنوع
النوع: $no3mak
يوزر البوت : @$userbot
ايدي البوت : $idbots
",
'disable_web_page_preview'=>true,]);}}


if($data == "ban"){
    $infosudo["info"]["amr"]="ban";
      // الحفظ أولاً لضمان الاستجابة
    bot('editmessagetext',[
        'chat_id'=>$chat_id, 
        'text'=>"🚫 أرسل الآن (أيدي العضو) المراد حظره من الصانع..",
        'parse_mode'=>"markdown",
        'disable_web_page_preview'=>true,
        "message_id"=>$message_id,
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]]]])
    ]);
}

 

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="ban" and in_array($from_id,$sudo) and is_numeric($text)){
if(!in_array($text,$ban)){
file_put_contents("sudo/ban.txt","$text\n",FILE_APPEND);
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم حظر العضو بنجاح $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
bot('sendmessage',['chat_id'=>$text,
'text'=>"❌ لقد قام الادمن بحظرك من استخدام البوت",]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"🚫 العضو محظور مسبقاً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}

$infosudo["info"]["amr"]="null";
 }

if($data == "unban"){
    $infosudo["info"]["amr"]="unban";
     
    bot('editmessagetext',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"🔓 أرسل الآن (أيدي العضو) لإلغاء الحظر عنه..", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]]]])]);
}


if($text  and $text !="/start" and $infosudo["info"]["amr"]=="unban" and in_array($from_id,$sudo) and is_numeric($text)){
if(in_array($text,$ban)){
$str=file_get_contents("sudo/ban.txt");
$str=str_replace("$text\n",'',$str);
file_put_contents("sudo/ban.txt",$str);
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم إلغاء حظر العضو بنجاح $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
bot('sendmessage',['chat_id'=>$text,
'text'=>"✅ لقد قام الادمن بإلغاء الحظر عنك.",]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"🚫 العضو ليسِ محظور مسبقاً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}


$infosudo["info"]["amr"]="null";
}

if($data == "unbanall"){
if($countban>0){
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم مسح قائمة المحظورين بنجاح ",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);}else{
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"🚫 ليس لديك اعضاء محظورين ",
'show_alert'=>true]);}}

if($data == "updatenew"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$join=$infosudo["info"]["update"];

if($join=="✅"){
$infosudo["info"]["update"]="❌";}

if($join=="❌"){
$infosudo["info"]["update"]="✅";}
 
sendwataw($chat_id,$message_id);}

if($data == "st_ch_bots"){
$watawjson = json_decode(file_get_contents("botmak/wataw.json"),true);
$join=$watawjson["info"]["st_ch_bots"];

if($join=="✅"){
$watawjson["info"]["st_ch_bots"]="❌";}

if($join=="❌"){
$watawjson["info"]["st_ch_bots"]="✅";}
file_put_contents("botmak/wataw.json", json_encode($watawjson));
sendwataw($chat_id,$message_id);}

if($data == "propots"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$join=$infosudo["info"]["propots"];
if($join=="مجانية"){
$infosudo["info"]["propots"]="مدفوعة";}
if($join=="مدفوعة"){
$infosudo["info"]["propots"]="مجانية";}
 
sendwataw($chat_id,$message_id);}
if($data == "channelbots"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$infosudo["info"]["amr"]="channelbots";
 
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- حسننا عزيزي المدير قم بإعادة توجية منشور من القناة التي تريد جعلها قناة الاشتراك الاجباري في كل البوتات المصنوعة",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);}

if($message->forward_from_chat and $infosudo["info"]["amr"]=="channelbots" and in_array($from_id, $sudo)){
$id_channel= $message->forward_from_chat->id;
if($id_channel != null){
$checkadmin = getChatstats($id_channel,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$id_channel"))->result->title;
$watawjson["info"]["id_channel"]="$id_channel";
$watawjson["info"]["name_channel"]="$namechannel";

file_put_contents("botmak/wataw.json", json_encode($watawjson));
$infosudo["info"]["amr"]="channel_idlink";
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
user : • قناة خاصة • 
name : $namechannel
id : $id_channel
*يجب عليك ارسال رابط القناة الخاص قم بارسالة الان
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- إلغاء ",'callback_data'=>"home"]],
]])]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إعادة المحاولة",'callback_data'=>"channelbots"]],
]])]);
$infosudo["info"]["amr"]="null";}}
 }

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="channel_idlink" and in_array($from_id,$sudo) and !$message->forward_from_chat ){
$tex=str_replace(['https://t.me/','http://t.me/'],'',$text);
$watawjson["info"]["st_ch_bots"]="✅";
$watawjson["info"]["link_channel"]="$tex";
file_put_contents("botmak/wataw.json", json_encode($watawjson));
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
link : $text 
t : $tex",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- تتغيير القناة   ",'callback_data'=>"chaneelbots"]],
]])]);

$infosudo["info"]["amr"]="null";
}

if($data == "channelbots2"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$infosudo["info"]["amr"]="channelbots2";
 
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- حسننا عزيزي المدير قم بإعادة توجية منشور من القناة  2 التي تريد جعلها قناة الاشتراك الاجباري في كل البوتات المصنوعة",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);}

if($message->forward_from_chat and $infosudo["info"]["amr"]=="channelbots2" and in_array($from_id, $sudo)){
$id_channel= $message->forward_from_chat->id;
if($id_channel != null){
$checkadmin = getChatstats($id_channel,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$id_channel"))->result->title;
$watawjson["info"]["id_channel2"]="$id_channel";
$watawjson["info"]["name_channel2"]="$namechannel";
file_put_contents("botmak/wataw.json", json_encode($watawjson));
$infosudo["info"]["amr"]="channel_idlink2";
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
user : • قناة خاصة • 
name : $namechannel
id : $id_channel
*يجب عليك ارسال رابط القناة الخاص قم بارسالة الان
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- إلغاء ",'callback_data'=>"home"]],
]])]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إعادة المحاولة",'callback_data'=>"channelbots"]],
]])]);
$infosudo["info"]["amr"]="null";}}
}

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="channel_idlink2" and in_array($from_id,$sudo) and !$message->forward_from_chat ){
$tex=str_replace(['https://t.me/','http://t.me/'],'',$text);
$watawjson["info"]["st_ch_bots"]="✅";
$watawjson["info"]["link_channel2"]="$tex";
file_put_contents("botmak/wataw.json", json_encode($watawjson));
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
link : $text 
t : $tex",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"تتغيير القناة",'callback_data'=>"chaneelbots2"]],
]])]);

$infosudo["info"]["amr"]="null";
}

if($data == "updatechannel"){
    $infosudo["info"]["amr"]="updatechannel";
     
    bot('editmessagetext',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"📢 أرسل الآن رابط قناة تحديثات البوت الجديدة..", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]]]])]);
}


if($text  and $text !="/start" and $infosudo["info"]["amr"]=="updatechannel" and in_array($from_id,$sudo)){
$tex=str_replace(['https://t.me/','http://t.me/'],'',$text);
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم حفظ الرابط الخاص لقناة التحديثات 
الرابط: $text | $t",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["updatechannel"]="$tex";
}

if($data == "start"){
    $infosudo["info"]["amr"]="start";
    // لاحظ أننا حذفنا سطر الحفظ لأنه موجود في آخر الملف
    // ودمجنا الأمرين في أمر واحد احترافي
    bot('editmessagetext',[
        'chat_id'=>$chat_id, 
        'message_id'=>$message_id, 
        'text'=>"📥 تعيين رسالة (Start) :\n\n- حسناً عزيزي المطور، قم بإرسال نص رسالة /start الجديدة الآن..", 
        'parse_mode'=>"markdown",
        'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"إلغاء",'callback_data'=>"home"]],
        ]])
    ]);
}


if($text  and $text !="/start" and $infosudo["info"]["amr"]=="start" and in_array($from_id,$sudo)){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم حفظ كليشة /start 
الكليشة:
$text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["start"]="$text";
}

// زر معلومات البوت - التنسيق الصحيح
if($data == "info_kl"){
    $infosudo["info"]["amr"]="info_kl";
     
    bot('editmessagetext',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"- حسناً، أرسل كليشة (معلومات البوت) الجديدة الآن..", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]],]])]);
    }

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="info_kl" and in_array($from_id,$sudo)){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظ كليشة معلومات عن البوت 
الكليشة:
$text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";

$infosudo["info"]["info_kl"]="$text";
}

if($data == "token_kl"){
$infosudo["info"]["amr"]="token_kl";
bot('editmessagetext',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"- حسناً، أرسل الآن الكليشة التي تظهر للمستخدم عند طلب التوكن..", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]],]])]);
 
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- قم بارسال نص كليشة إرسال التوكن",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);}

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="token_kl" and in_array($from_id,$sudo)){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم حفظ كليشة إرسال التوكن
الكليشة:
$text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["token_kl"]="$text";
}

if($data == "klish_sil"){
    $infosudo["info"]["amr"]="klish_sil";
    // الحفظ هنا يضمن أن البوت "فهم" الأمر قبل أن يرسل لك الرسالة
      
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id, 
        'message_id'=>$message_id,
        'text'=>"📝 تعيين رسالة الاشتراك :\n\n- أرسل الآن نص كليشة الاشتراك الإجباري الجديدة..",
        'parse_mode'=>"markdown",
        'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]]]])
    ]);
} // القوس يغلق هنا وكل شيء بداخله محمي

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="klish_sil" and in_array($from_id,$sudo)){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم حفظ كليشة الاشتراك الاجباري 
الكليشة:
$text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["klish_sil"]="$text";
}

if($data == "sudo"){
    $infosudo["info"]["amr"]="sudo";
      // الحفظ فور تغيير الحالة
    bot('editmessagetext',[
        'chat_id'=>$chat_id, 
        'message_id'=>$message_id,
        'text'=>"- قم بارسال ايدي مطور البوت الجديد الآن.",
        'parse_mode'=>"markdown",
        'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"إلغاء",'callback_data'=>"home"]]]])
    ]);
}

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="sudo" and in_array($from_id,$sudo)){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"✅ تم حفظ حساب مطور البوت.
الحساب: $text",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["sudo"]="$text";
}

if($data == "home"){
$infosudo["info"]["amr"]="null";
 
sendwataw($chat_id,$message_id);}
if($data == "fwrmember"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$fwrmember=$infosudo["info"]["fwrmember"];
if($fwrmember=="✅"){
$infosudo["info"]["fwrmember"]="❌";}
if($fwrmember=="❌"){
$infosudo["info"]["fwrmember"]="✅";}
 
sendwataw($chat_id,$message_id);}
if($data == "tnbih"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$tnbih=$infosudo["info"]["tnbih"];
if($tnbih=="✅"){
$infosudo["info"]["tnbih"]="❌";}
if($tnbih=="❌"){
$infosudo["info"]["tnbih"]="✅";}
 
sendwataw($chat_id,$message_id);}

if($data == "silk"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$skil=$infosudo["info"]["silk"];
if($skil=="✅"){
$infosudo["info"]["silk"]="❌";}
if($skil=="❌"){
$infosudo["info"]["silk"]="✅";}
 
sendwataw($chat_id,$message_id);}

if($data == "allch"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$allch=$infosudo["info"]["allch"];
if($allch=="مفردة"){
$infosudo["info"]["allch"]="مجموعة";}
if($allch=="مجموعة"){
$infosudo["info"]["allch"]="مفردة";}
 
sendwataw($chat_id,$message_id);}

if($data == "addchannel"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];
$count=count($orothe);
if($count<4){
$infosudo["info"]["amr"]="addchannel";
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- اذا كانت القناة التي تريد اضافتها عامة قم بارسال معرفها .
* اذا كانت خاصة قم بإعادة توجية منشور من القناة إلى هنا .
",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"home"]],
]])]);}else{
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"🚫 لا يمكنك اضافة اكثر من  3 قنوات للإشتراك الاجباري",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}}
 


if($text  and $text !="/start" and $infosudo["info"]["amr"]=="addchannel" and in_array($from_id,$sudo) and !$message->forward_from_chat ){
$ch_id = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$text"))->result->id;
$idchan=$ch_id;
if($ch_id != null){
$checkadmin = getChatstats($text,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$text"))->result->title;
$infosudo["info"]["channel"][$ch_id]["st"]="عامة";
$infosudo["info"]["channel"][$ch_id]["user"]="$text";
$infosudo["info"]["channel"][$ch_id]["name"]="$namechannel";
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
user : $text 
name : $namechannel
id : $ch_id",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- إضافة قناة آخرى  ",'callback_data'=>"addchannel"]],
]])]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إعادة المحاولة",'callback_data'=>"addchannel"]],
]])]);}
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ لم تتم إضافة القناة لا توجد قناة تمتلك هذا المعرف: $text",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}
$infosudo["info"]["amr"]="null";
}

if($message->forward_from_chat and $infosudo["info"]["amr"]=="addchannel" and in_array($from_id, $sudo)){
$id_channel= $message->forward_from_chat->id;
if($id_channel != null){
$checkadmin = getChatstats($id_channel,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$id_channel"))->result->title;
$infosudo["info"]["channel_id"]="$id_channel";
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
user : • قناة خاصة • 
name : $namechannel
id : $id_channel
*يجب عليك ارسال رابط القناة الخاص قم بارسالة الان
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"addchannel"]],
]])]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إعادة المحاولة",'callback_data'=>"addchannel"]],
]])]);}}

$infosudo["info"]["amr"]="channel_id";
}
$channel_id=$infosudo["info"]["channel_id"];

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="channel_id" and in_array($from_id,$sudo) and !$message->forward_from_chat ){
$checkadmin = getChatstats($channel_id,$token);
if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$channel_id"))->result->title;
$infosudo["info"]["channel"][$channel_id]["st"]="خاصة";
$infosudo["info"]["channel"][$channel_id]["user"]="$text";
$infosudo["info"]["channel"][$channel_id]["name"]="$namechannel";
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن
info channel 
link : $text 
name : $namechannel
id : $channel_id",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"+ إضافة قناة آخرى",'callback_data'=>"addchannel"]],
]])]);
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إعادة المحاولة",'callback_data'=>"addchannel"]],
]])]);}

$infosudo["info"]["amr"]="null";
$infosudo["info"]["channel_id"]="null";
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
$userchannel="null";}
$keyboard["inline_keyboard"][] =
[['text'=>$userchannel,'callback_data'=>'cull'],['text'=>$st,'callback_data'=>'null']];}}

$keyboard["inline_keyboard"][] = [['text'=>"• رجوع •",'callback_data'=>"home"]];
$reply_markup=json_encode($keyboard);
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- هذة هي قنوات الاشتراك الاجباري الخاصة بك",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup]);}

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
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"- قم بالضغط على خيار الحذف بالاسفل",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup
]);}

if(preg_match('/^(deletchannel) (.*)/s', $data)){
$nn = str_replace('deletchannel ',"",$data);
bot('editmessagetext',['chat_id'=>$chat_id, 
'text'=>"✅ تم حذف القناة بنجاح 
- id $nn",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"• رجوع •",'callback_data'=>"delchannel"]],
]])]);
unset($infosudo["info"]["channel"][$nn]);
}

if($message and $fwrmember=="✅"){
bot('ForwardMessage',['chat_id'=>$admin,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id,]);}

$amr = $infosudo["info"]["amr"];
$no3send = $infosudo["info"]["no3send"];
$chatsend = $infosudo["info"]["chatsend"];

if($data == "sendmessage" and  in_array($from_id,$sudo)){
bot('editmessagetext',['chat_id'=>$chat_id,
'text'=>"أهلا بك عزيزي في قسم الاذاعة
 قم بتحديد نوع الاذاعة ومكان ارسال الاذاعة
ثم قم الضغط على ارسال الرسالة 
",'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"نوع الاذاعة: $no3send",'callback_data'=>"button"]],
[['text'=>"توجية",'callback_data'=>"forward"],['text'=>"MARKDOWN",'callback_data'=>"MARKDOWN"],['text'=>"HTML",'callback_data'=>"HTML"]],
[['text'=>"الارسال الى: $chatsend",'callback_data'=>"button"]],
[['text'=>"الاعضاء",'callback_data'=>"member"],['text'=>"كل البوتات",'callback_data'=>"botsall"]],
[['text'=>"ارسال الرسالة",'callback_data'=>"post"]],
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);}

function sendwataw2($chat_id,$message_id){
global $infosudo; // أضفنا هذا السطر لكي تقرأ الدالة المصفوفة من خارجها
$no3send = $infosudo["info"]["no3send"];
$chatsend = $infosudo["info"]["chatsend"];
bot('editmessagetext',['chat_id'=>$chat_id,
'text'=>"أهلا بك عزيزي في قسم الاذاعة
قم بتحديد نوع الاذاعة ومكان ارسال الاذاعة
ثم قم  الضغط على ارسال الرسالة
",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"نوع الاذاعة: $no3send",'callback_data'=>"button"]],
[['text'=>"توجية",'callback_data'=>"forward"],['text'=>"MARKDOWN",'callback_data'=>"MARKDOWN"],['text'=>"HTML",'callback_data'=>"HTML"]],
[['text'=>"الارسال الى: $chatsend",'callback_data'=>"button"]],
[['text'=>"الاعضاء",'callback_data'=>"member"],['text'=>"كل البوتات",'callback_data'=>"botsall"]],
[['text'=>"ارسال الرسالة",'callback_data'=>"post"]],
[['text'=>"• رجوع •",'callback_data'=>"home"]],
]])]);} 


if($data == "forward"){
$infosudo["info"]["no3send"] = "forward";
sendwataw2($chat_id,$message_id);}

if($data == "MARKDOWN"){
$infosudo["info"]["no3send"] = "MARKDOWN";
sendwataw2($chat_id,$message_id);}

if($data == "HTML"){
$infosudo["info"]["no3send"] = "html";
sendwataw2($chat_id,$message_id);}

if($data == "member"){
$infosudo["info"]["chatsend"] = "member";
sendwataw2($chat_id,$message_id);}

if($data == "botsall"){
$infosudo["info"]["chatsend"] = "botsall";
sendwataw2($chat_id,$message_id);}

$no3send = $infosudo["info"]["no3send"];
$chatsend = $infosudo["info"]["chatsend"];
if($data == "post" and $no3send!=null and $chatsend!=null and  in_array($from_id,$sudo) ){
$infosudo["info"]["amr"] = "sendsend";
bot('EditMessageText',[
'message_id'=>$message_id,
'chat_id'=>$chat_id,
'text'=>"قم بارسال رسالتك الان  
نوع الارسال : $no3send
مكان الارسال : $chatsend
",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"إلغاء",'callback_data'=>"set"]],]])]);}

if($data == "set" and  in_array($from_id,$sudo) ){
$infosudo["info"]["amr"] = "null";
bot('editmessagetext',['chat_id'=>$chat_id,
'text'=>"تم إلغاء الارسال بنجاح",
'message_id'=>$message_id,
]);}

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

if($message  and $text !="الاذاعة" and $amr == "sendsend" and $no3send=="forward" and  in_array($from_id,$sudo) ){
$infosudo["info"]["amr"] = "null";

if($chatsend=="member"){
$for=$member;
$txt="تم التوجية - خاص - للاعضاء فقط";
$foor=explode("\n",$for);
bot('ForwardMessage',['chat_id'=>$chat_id,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id,]);
for($i=0;$i<count($foor); $i++){
bot('ForwardMessage',['chat_id'=>$foor[$i],
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id,
]);}
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"✅ $txt",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"home"]],
]])]);}

if($chatsend=="botsall"){
$bots=explode("\n",file_get_contents("infoidbots.txt"));
$coo=count($bots)-1;
for ($i=0; $i < count($bots); $i++) { 
$idbots=$bots[$i];

include("wataw/$idbots.php");

$tokenboot="$tokenbot";
$mm=explode("\n",file_get_contents("botmak/$idbots/sudo/member.txt"));
for ($l=0; $l < count($mm); $l++) {
$id=$mm[$l];
file_get_contents("https://api.telegram.org/bot".$tokenboot."/ForwardMessage?chat_id=".$id."&from_chat_id=$chat_id&message_id=".$message->message_id);}
$co=$co+$l-1;}
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"- تمت الاذاعة في جميع البوتات المصنوعة 
- تم الارسال الى $co مستخدم.
- عدد البوتات : $coo
",
'reply_to_message_id'=>$message_id,
]);}

$infosudo["info"]["no3send"] = "null";
$infosudo["info"]["chatsend"] = "null";
}

if($message and $text !="الاذاعة"  and $amr == "sendsend"and $no3send !="forward" and  in_array($from_id,$sudo) ){
$infosudo["info"]["amr"] = "null";

if($chatsend=="member"){
$for=$member;
$txt=" تم النشر - خاص - للاعضاء فقط";
$foor=explode("\n",$for);
if($text){
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$text",
'parse_mode'=>"$no3send",
'disable_web_page_preview'=>true,]);

for($i=0;$i<count($foor); $i++){
bot('sendMessage',['chat_id'=>$foor[$i],
'text'=>"$text",
'parse_mode'=>"$no3send",
'disable_web_page_preview'=>true,
]);}
}else{
$ss=str_replace("send","",$sens);
bot($sens,["chat_id"=>$chat_id,
"$ss"=>"$file_id",
'caption'=>"$caption",]);
for($i=0;$i<count($foor); $i++){
$ss=str_replace("send","",$sens);
bot($sens,["chat_id"=>$foor[$i],
"$ss"=>"$file_id",
'caption'=>"$caption",]);}}
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"✅ $txt",
'message_id'=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"home"]],
]])]);
$infosudo["info"]["no3send"] = "null";
$infosudo["info"]["chatsend"] = "null";
}

if($chatsend=="botsall"){
$bots=explode("\n",file_get_contents("infoidbots.txt"));
$coo=count($bots)-1;
for ($i=0; $i < count($bots); $i++) { 
$idbots=$bots[$i];

include("wataw/$idbots.php");

$tokenboot="$tokenbot";
$mm=explode("\n",file_get_contents("botmak/$idbots/sudo/member.txt"));
for ($l=0; $l < count($mm); $l++) {
$id=$mm[$l];
if($text){
file_get_contents("https://api.telegram.org/bot".$tokenboot."/sendMessage?chat_id=".$id."&text=$text&parse_mode=".$no3send);
}else{
$ss=str_replace("send","",$sens);
file_get_contents("https://api.telegram.org/bot".$tokenboot."/$sens?chat_id=".$id."&$ss=$file_id&caption=".$caption);}}
$co=$co+$l-1;}
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"- تمت الاذاعة في جميع البوتات المصنوعة 
- تم الارسال الى $co مستخدم.
- عدد البوتات : $coo
",
'reply_to_message_id'=>$message_id,
]);
$infosudo["info"]["no3send"] = "null";
$infosudo["info"]["chatsend"] = "null";
}}

// 1. كود إرسال النسخة الاحتياطية من الصانع إليك (الملفات الأساسية)
if($data == "get_backup" and in_array($from_id, $sudo)){
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"⏳ جاري سحب ملفات الصانع الأساسية...",
    ]);

    $files_to_send = [
        "sudo.json", 
        "infoidbots.txt", 
        "botfreeid.txt", 
        "admin.txt", 
        "code.json",
        "prodate.json",
        "responses.json",
        "sudo/member.txt", 
        "sudo/ban.txt"
    ];

    $found = 0;
    foreach($files_to_send as $file){
        if(file_exists($file)){
            bot('sendDocument',[
                'chat_id'=>$chat_id,
                'document'=>new CURLFile(realpath($file)),
                'caption'=>"📄 نسخة احتياطية للملف: " . basename($file)
            ]);
            $found++;
        }
    }

    if($found > 0){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"✅ تم إرسال ($found) ملفات أساسية بنجاح."
        ]);
    }
}

// دالة النسخة الاحتياطية الشاملة لجميع البوتات (إرسال في ملف واحد)
if($data == "get_all_bots_data" and in_array($from_id, $sudo)){
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"⏳ جاري تجميع كافة بيانات البوتات المصنوعة...",
    ]);

    $master_backup = [];
    $bots_list = explode("\n", file_get_contents("infoidbots.txt"));

    foreach($bots_list as $bot_id){
        $bot_id = trim($bot_id);
        if($bot_id != "" && is_dir("botmak/$bot_id")){
            $master_backup[$bot_id] = [
                'members' => file_exists("botmak/$bot_id/sudo/member.txt") ? file_get_contents("botmak/$bot_id/sudo/member.txt") : "",
                'responses' => file_exists("botmak/$bot_id/responses.json") ? json_decode(file_get_contents("botmak/$bot_id/responses.json"), true) : [],
                'db_courses' => file_exists("botmak/$bot_id/data/db.json") ? json_decode(file_get_contents("botmak/$bot_id/data/db.json"), true) : [],
                'db_store' => file_exists("botmak/$bot_id/data.json") ? json_decode(file_get_contents("botmak/$bot_id/data.json"), true) : []
            ];
        }
    }

    file_put_contents("all_bots_data.json", json_encode($master_backup, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    
    bot('sendDocument',[
        'chat_id'=>$chat_id,
        'document'=>new CURLFile(realpath("all_bots_data.json")),
        'caption'=>"🚀 نسخة البيانات الشاملة لجميع البوتات المصنوعة\n(تتضمن: المشتركين، الردود، المتاجر، والدورات)."
    ]);
}

// 2. كود طلب رفع النسخة الاحتياطية
if($data == "set_backup" and in_array($from_id, $sudo)){
    $infosudo["info"]["amr"]="upload_any_backup"; 
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'message_id'=>$message_id,
        'text'=>"📤 **قسم الاستعادة الشاملة**

• يمكنك إرسال ملفات الصانع (sudo.json، إلخ) أو 'الملف الشامل' (all_bots_data.json).
• سيقوم البوت بتوزيع البيانات تلقائياً على مجلدات data/db.json والمتاجر.

أرسل الملفات الآن، ثم اضغط على (تم ✅).",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>"تم الانتهاء ✅",'callback_data'=>"home"]],
            [['text'=>"إلغاء ❌",'callback_data'=>"home"]]
        ]])
    ]);
}

// --- كود استقبال وفك النسخة الاحتياطية الشاملة ---
if($message->document and $infosudo["info"]["amr"]=="upload_any_backup" and in_array($from_id, $sudo)){
    $file_name = $message->document->file_name;
    $file_id = $message->document->file_id;
    
    $get = bot('getfile',['file_id'=>$file_id])->result->file_path;
    $file_content = file_get_contents("https://api.telegram.org/file/bot".API_KEY."/$get");

    // 1. التعامل مع "الملف الشامل" لبيانات البوتات
    if($file_name == "all_bots_data.json"){
        $data_content = json_decode($file_content, true);
        if($data_content){
            foreach($data_content as $bot_id => $bot_files){
                $base_path = "botmak/$bot_id";
                if(!is_dir("$base_path/sudo")) mkdir("$base_path/sudo", 0777, true);
                if(!is_dir("$base_path/data")) mkdir("$base_path/data", 0777, true);

                if(isset($bot_files['members'])) file_put_contents("$base_path/sudo/member.txt", $bot_files['members']);
                if(isset($bot_files['responses'])) file_put_contents("$base_path/responses.json", json_encode($bot_files['responses'], JSON_UNESCAPED_UNICODE));
                if(isset($bot_files['db_courses'])) file_put_contents("$base_path/data/db.json", json_encode($bot_files['db_courses'], JSON_UNESCAPED_UNICODE));
                if(isset($bot_files['db_store'])) file_put_contents("$base_path/data.json", json_encode($bot_files['db_store'], JSON_UNESCAPED_UNICODE));
            }
            bot('sendmessage',['chat_id'=>$chat_id, 'text'=>"✅ تم بنجاح توزيع بيانات البوتات (الدورات والمتاجر والأعضاء)."]);
        }
        return false;
    }

    // 2. خريطة المسارات للملفات الفردية
    $destinations = [
        "sudo.json" => "sudo.json",
        "member.txt" => "sudo/member.txt",
        "ban.txt" => "sudo/ban.txt",
        "infoidbots.txt" => "infoidbots.txt",
        "botfreeid.txt" => "botfreeid.txt",
        "admin.txt" => "admin.txt",
        "code.json" => "code.json",
        "prodate.json" => "prodate.json",
        "responses.json" => "responses.json",
        "wataw.json" => "botmak/wataw.json"
    ];

    if(isset($destinations[$file_name])){
        $dir = dirname($destinations[$file_name]);
        if($dir != "." && !is_dir($dir)) mkdir($dir, 0777, true);

        file_put_contents($destinations[$file_name], $file_content);

        if($file_name == "sudo.json"){
            $updated_data = json_decode($file_content, true);
            if($updated_data){
                $infosudo = $updated_data;
                $infosudo["info"]["amr"] = "upload_any_backup"; 
            }
        }

        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"📥 تم استعادة الملف الفردي: **$file_name** بنجاح.",
            'reply_to_message_id'=>$message->message_id,
        ]);
        return false;
    } else {
        bot('sendmessage',['chat_id'=>$chat_id, 'text'=>"⚠️ الملف غير مدرج في نظام التوزيع التلقائي."]);
    }
}

if($data == "admins" and $from_id ==$ameed){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["admins"];
$keyboard["inline_keyboard"]=[];
foreach($orothe as $co=>$sss ){
if($co!=null and $co!=$ameed ){
$keyboard["inline_keyboard"][] =
[['text'=>' 🗑','callback_data'=>'deleteadmin '.$co.'#'.$sss],['text'=>$sss,'callback_data'=>'null']];
}}
$keyboard["inline_keyboard"][] = [['text'=>"- اضافة ادمن  ",'callback_data'=>"addadmin"]];
$keyboard["inline_keyboard"][] = [['text'=>"- عودة  ",'callback_data'=>"home"]];
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
 
bot('EditMessageText',['chat_id'=>$chat_id, 
'text'=>"- قم بارسال ايدي الادمن ",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- الغاء",'callback_data'=>"home"]],
]])]);}

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="addadmin" and $from_id ==$ameed and is_numeric($text)){
if(!in_array($text,$admins)){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$orothe= $infosudo["info"]["channel"];
$count=count($orothe);
if($count<6){
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظ  رفع الادمن بنجاح",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- عودة",'callback_data'=>"admins"]],
]])]);
$infosudo["info"]["admins"][]="$text";
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"🚫 لايمكنك اضافة اكثر من 5 ادمنية ً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- عودة  ",'callback_data'=>"admins"]],
]])]);}
}else{
bot('sendmessage',['chat_id'=>$chat_id, 
'text'=>"- ⚠ الادمن مضاف مسبقاً",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- عودة  ",'callback_data'=>"admins"]],
]])]);}
$infosudo["info"]["amr"]="null";
}

if(preg_match('/^(deleteadmin) (.*)/s', $data)){
$nn = str_replace('deleteadmin ',"",$data);
$ex=explode('#',$nn);
$id=$ex[1];
$n=$ex[0];
bot('EditMessageText',['chat_id'=>$chat_id, 
'text'=>"- ✅ تم حذف الادمن بنجاح 
$id",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- عودة",'callback_data'=>"admins"]],
]])]);
unset($infosudo["info"]["admins"][$n]);
}

$botfree=explode("\n",file_get_contents("from_id/$from_id/countuserbot.txt"));
$countbot=count($botfree)-1;
$infobots=file_get_contents("from_id/$from_id/countuserbot.txt");
if($infobots!=null ){
$infobotsmember="♻ بوتاتك المصنوعة ($countbot) هي : \n$infobots";
}else{
$infobotsmember = "لم تقم بصنع اي بوت مسبقاً";}

if($start==null){
$start = "اهلا وسهلا بك في صانع البوتات";}

if($info_kl==null){
$info_kl = "لم يتم تعيين الكليشة من قبل المدير";}

if($token_kl==null){
$token_kl="
- لإنشاء بوت قم بإرسال التوكن من بوت : 
( @botfather ).
الان قم بارسال التوكن الخاص بك لصنع:
";}

$amrmem=file_get_contents("from_id/$from_id/amr.txt");
if($text=="/start"){
mkdir("from_id");
mkdir("from_id/$from_id");
file_put_contents("from_id/$from_id/amr.txt","");
bot('sendmessage',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"أهلاً بك [$name](tg://user?id=$chat_id)

$start",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'معلومات اكثر عن البوت💡','callback_data'=>"infobot"]],
[['text'=>'صنع بوت جديد','callback_data'=>"sn3botfre"],['text'=>'قائمة بوتاتك','callback_data'=>"botsmember"]],
[['text'=>'اضافة ملف الى الصانع','callback_data'=>"uplode"]],
[['text'=>'قناة تحديثات البوت 🔬','url'=>"https://t.me/$updatechannel"]],
]])]);}

if($data=="infobot"){
file_put_contents("from_id/$from_id/amr.txt","");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"أهلا بك يا [$name](tg://user?id=$chat_id)

$info_kl",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);}

if($data=="freebot"){
file_put_contents("from_id/$from_id/amr.txt","");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"أهلاً بك [$name](tg://user?id=$chat_id)

$start",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'معلومات اكثر عن البوت💡','callback_data'=>"infobot"]],
[['text'=>'صنع بوت جديد','callback_data'=>"sn3botfre"],['text'=>'قائمة بوتاتك','callback_data'=>"botsmember"]],
[['text'=>'اضافة ملف الى الصانع','callback_data'=>"uplode"]],
[['text'=>'قناة تحديثات البوت 🔬','url'=>"https://t.me/$updatechannel"]],
]])]);}

if($data == "sn3botfre" ){
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"- قم بإختيار نوعية البوت الذي تود صنعه 🎙️ ..",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• قائمة البوتات •','callback_data'=>"null"]],
[['text'=>'','callback_data'=>"mak 6"],['text'=>'بوت سايت','callback_data'=>"mak 2"]],
[['text'=>'بوت الازرار','callback_data'=>"mak 3"],['text'=>'بوت المتجر','callback_data'=>"mak 4"]],
[['text'=>'بوت البصمات','callback_data'=>"mak 5"],['text'=>'بوت تواصل','callback_data'=>"mak 1"]],
[['text'=>'بوت دورات تدريبية 🎓','callback_data'=>'mak 70']],
[['text'=>'بوت التعليقات','callback_data'=>"mak 7"],['text'=>'ادارة منشورات القناة','callback_data'=>"mak 8"]],
[['text'=>'بوت زخرفة','callback_data'=>"mak 9"],['text'=>'فيديوهات ستوري','callback_data'=>"mak 10"]],
[['text'=>'تحليل الشخصية','callback_data'=>"mak 11"],['text'=>'العاب انلاين','callback_data'=>"mak 12"]],
[['text'=>'تحويل الصيغ','callback_data'=>"mak 13"],['text'=>'إستخراج روابط القنوات','callback_data'=>"mak 14"]],
[['text'=>'بوت همسة','callback_data'=>"mak 15"],['text'=>'بوت كشف الكذب','callback_data'=>"mak 16"]],
[['text'=>'• المزيد من البوتات • ','callback_data'=>"makll"]],
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);}

if($data == "makll" ){
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"- قم بإختيار نوعية البوت الذي تود صنعه 🎙️ ..",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• قائمة البوتات •','callback_data'=>"null"]],
[['text'=>'','callback_data'=>"mak 6"],['text'=>'بوت سايت','callback_data'=>"mak 2"]],
[['text'=>'بوت الازرار','callback_data'=>"mak 3"],['text'=>'بوت المتجر','callback_data'=>"mak 4"]],
[['text'=>'بوت البصمات','callback_data'=>"mak 5"],['text'=>'بوت تواصل','callback_data'=>"mak 1"]],
[['text'=>'بوت دورات تدريبية 🎓','callback_data'=>'mak 70']],
[['text'=>'بوت التعليقات','callback_data'=>"mak 7"],['text'=>'ادارة منشورات القناة','callback_data'=>"mak 8"]],
[['text'=>'بوت زخرفة','callback_data'=>"mak 9"],['text'=>'فيديوهات ستوري','callback_data'=>"mak 10"]],
[['text'=>'تحليل الشخصية','callback_data'=>"mak 11"],['text'=>'العاب انلاين','callback_data'=>"mak 12"]],
[['text'=>'تحويل الصيغ','callback_data'=>"mak 13"],['text'=>'إستخراج روابط القنوات','callback_data'=>"mak 14"]],
[['text'=>'بوت همسة','callback_data'=>"mak 15"],['text'=>'بوت كشف الكذب','callback_data'=>"mak 16"]],
[['text'=>'حذف الحساب','callback_data'=>"mak 17"],['text'=>'بوت الاعلانات','callback_data'=>"mak 18"]],
[['text'=>'بوت الاذكار','callback_data'=>"mak 19"],['text'=>'الاكواد الجاهزة','callback_data'=>"mak 20"]],
[['text'=>'حساب العمر','callback_data'=>"mak 21"],['text'=>'ستوري انستكرام','callback_data'=>"mak 22"]],
[['text'=>'البلورة السحرية','callback_data'=>"mak 23"],['text'=>'زخرفة تمبلر','callback_data'=>"mak 24"]],
[['text'=>'مشاركة بدون توجية','callback_data'=>"mak 25"],['text'=>'حجر ورقة مقص','callback_data'=>"mak 26"]],
[['text'=>'حماية القنوات','callback_data'=>"mak 27"],['text'=>'تمويل القنوات','callback_data'=>"mak 28"]],
[['text'=>'نسبة الحب','callback_data'=>"mak 29"],['text'=>'دعم القنوات','callback_data'=>"mak 30"]],
[['text'=>'نسبة الجمال','callback_data'=>"mak 31"],['text'=>'معاني الاسماء','callback_data'=>"mak 32"]],
[['text'=>'يوتيوب','callback_data'=>"mak 33"],['text'=>'تيك توك','callback_data'=>"mak 34"]],
[['text'=>'اسئلة جريئه','callback_data'=>"mak 35"],['text'=>'الفقرات','callback_data'=>"mak 36"]],
[['text'=>'','callback_data'=>"mak 37"],['text'=>'بوت ردود','callback_data'=>"mak 38"]],
[['text'=>'ماسح الخلفيات','callback_data'=>"mak 39"],['text'=>'ملصقات','callback_data'=>"mak 40"]],
[['text'=>'تعديل حقوق الاغاني','callback_data'=>"mak 41"],['text'=>'الفلاتر','callback_data'=>"mak 42"]],
[['text'=>'مسح الميديا','callback_data'=>"mak 50"]],
[['text'=>'نسبة الرجوله','callback_data'=>"mak 51"],['text'=>'نسبة المثلية','callback_data'=>"mak 52"]],
[['text'=>'الابراج','callback_data'=>"mak 53"],['text'=>'حذف رسايل القنوات','callback_data'=>"mak 54"]],
[['text'=>'تصميم اجمل ثنائي','callback_data'=>"mak 55"],['text'=>'خيره','callback_data'=>"mak 56"]],
[['text'=>'كشف المستقبل','callback_data'=>"mak 57"],['text'=>'ستوريات وصور','callback_data'=>"mak 58"]],
[['text'=>'باقات انترنت','callback_data'=>"mak 59"],['text'=>'تصاميم صور','callback_data'=>"mak 60"]],
[['text'=>'اهداء الاغاني','callback_data'=>"mak 61"],['text'=>'سمسمي','callback_data'=>"mak 62"]],
[['text'=>'كت تويت','callback_data'=>"mak 63"],['text'=>'نودز','callback_data'=>"mak 64"]],
[['text'=>'ازرار شفافه','callback_data'=>"mak 65"],['text'=>'فيزه','callback_data'=>"mak 66"]],
[['text'=>'خاص بالانستكرام','callback_data'=>"mak 67"],['text'=>'لعبة محيبس','callback_data'=>"mak 68"]],
[['text'=>'الالعاب','callback_data'=>"mak 69"]],
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);}

$botfree=explode("\n",file_get_contents("from_id/$from_id/countbot.txt"));
$countbot=count($botfree);
if(preg_match('/^(mak) (.*)/s', $data)){
$nu = str_replace('mak ',"",$data);
if($nu == 1){ $b= "بوت تواصل";}
if($nu == 2){ $b= "بوت سايت";}
if($nu == 3){ $b= "بوت الازرار";}
if($nu == 4){ $b= "بوت المتجر";}
if($nu == 5){ $b= "بوت البصمات";}
if($nu == 6){ $b= "بوت ";}
if($nu == 7){ $b= "بوت التعليقات";}
if($nu == 8){ $b= "بوت ادارة منشور القنوات";}
if($nu == 9){ $b= "بوت الزخرفة";}
if($nu == 10){ $b= "بوت فيديوهات ستوري";}
if($nu == 11){ $b= "بوت تحليل الشخصية";}
if($nu == 12){ $b= "بوت العاب انلاين";}
if($nu == 13){ $b= "بوت تحويل الصيغ";}
if($nu == 14){ $b= "بوت إستخراج روابط القنوات";}
if($nu == 15){ $b= "بوت همسة";}
if($nu == 16){ $b= "بوت كشف الكذب";}
if($nu == 17){ $b= "حذف الحساب";}
if($nu == 18){ $b= "بوت الاعلانات";}
if($nu == 19){ $b= "بوت الاذكار";}
if($nu == 20){ $b= "بوت الاكواد الجاهزة";}
if($nu == 21){ $b= "بوت حساب العمر";}
if($nu == 22){ $b= "بوت تحميل انستقرام";}
if($nu == 23){ $b= "بوت البلورة السحرية";}
if($nu == 24){ $b= "بوت زخرفة تمبلر";}
if($nu == 25){ $b= "بوت مشاركة بدون توجية";}
if($nu == 26){ $b= "بوت حجر ورقة مقص";}
if($nu == 27){ $b= "بوت حماية القنوات";}
if($nu == 28){ $b= "بوت تمويل القنوات";}
if($nu == 29){ $b= "بوت نسبة الحب";}
if($nu == 30){ $b= "بوت دعم القنوات";}
if($nu == 31){ $b = "بوت نسبة الجمال";}
if($nu == 32){ $b = "بوت معاني الاسماء";}
if($nu == 33){ $b = "بوت تحميل من يوتيوب";}
if($nu == 34){ $b = "بوت تحميل من تيك توك";}
if($nu == 35){ $b = "بوت الاسئلة الجريئه";}
if($nu == 36){ $b = "بوت انشاء الفقرات";}
if($nu == 37){ $b = "بوت لايك";}
if($nu == 38){ $b = "بوت ردود";}
if($nu == 39){ $b = "بوت ادارة ماسح الخلفيات";}
if($nu == 40){ $b = "بوت صنع حزم ملصقات";}
if($nu == 41){ $b = "بوت تعديل حقوق الاغاني";}
if($nu == 42){ $b = "بوت الفلاتر";}
if($nu == 43){ $b = "بوت رشق تليكرام";}
if($nu == 44){ $b = "بوت رشق فيسبوك";}
if($nu == 45){ $b = "بوت رشق يوتيوب";}
if($nu == 46){ $b = "بوت رشق سناب جات";}
if($nu == 47){ $b = "بوت رشق انستكرام";}
if($nu == 48){ $b = "بوت شحن شدات ببجي";}
if($nu == 49){ $b = "بوت رشق تيك توك";}
if($nu == 50){ $b = "بوت مسح الميديا";}
if($nu == 51){ $b = "بوت نسبة الرجوله";}
if($nu == 52){ $b = "بوت نسبة المثلية";}
if($nu == 53){ $b = "بوت الابراج";}
if($nu == 54){ $b = "بوت حذف رسايل القناة";}
if($nu == 55){ $b = "بوت تصميم اجمل ثنائي";}
if($nu == 56){ $b = "بوت الخيره";}
if($nu == 57){ $b = "بوت كشف المستقبل";}
if($nu == 58){ $b = "بوت الصور و الاستوريات";}
if($nu == 59){ $b = "بوت باقات انترنت مجانية";}
if($nu == 60){ $b = "بوت تصاميم الصور";}
if($nu == 61){ $b = "بوت اهداء الاغاني";}
if($nu == 62){ $b = "بوت سمسمي";}
if($nu == 63){ $b = "بوت كت تويت";}
if($nu == 64){ $b = "بوت النودز";}
if($nu == 65){ $b = "بوت الازرار الشفافه";}
if($nu == 66){ $b = "بوت الفيزات";}
if($nu == 67){ $b = "بوت الخاص بالانستكرام";}
if($nu == 68){ $b = "بوت لعبة المحيبس";}
if($nu == 69){ $b = "بوت الالعاب";}
if($nu == 70){ $b = "بوت دورات تدريبية 🎓";}

file_put_contents("from_id/$from_id/botmak.txt","mak$nu");
file_put_contents("from_id/$from_id/no3mak.txt","$b");
file_put_contents("from_id/$from_id/amr.txt","sn3free");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"$token_kl : $b",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);}

mkdir("wataw");
if($text and $amrmem =="sn3free"){
file_put_contents("from_id/$from_id/amr.txt","");

$no3mak=file_get_contents("from_id/$from_id/no3mak.txt");
$botmak=file_get_contents("from_id/$from_id/botmak.txt");
$url = "https://api.telegram.org/bot".$text."/getWebhookInfo";
$check_token = json_decode(file_get_contents($url));
$check = $check_token;
$yes=$check->ok ;
bot('sendmessage',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"⏰ انتظر قليلا جارٍ فحص التوكن",]);

if($yes == "true"){
$url = "https://api.telegram.org/bot$text/getme";
$getidbots = json_decode(file_get_contents($url) , true);
$idbot = $getidbots['result']['id'];
$userbot = $getidbots['result']['username'];
$name1bot = $getidbots["result"]["first_name"];
$userbot=trim($userbot);
$idbot=trim($idbot);

mkdir("botmak");
mkdir("user");
mkdir("botmak/$idbot");

$botfree=explode("\n",file_get_contents("botfreeid.txt"));
$botfreeid=explode("\n",file_get_contents("infoidbots.txt"));
$botfrom=explode("\n",file_get_contents("from_id/$from_id/countbot.txt"));
$idbotfrom=explode("\n",file_get_contents("from_id/$from_id/idbot.txt"));
$infobots="$userbot==code#$userbot#$idbot";

# تخزين البوتات للعضو
if(!in_array($userbot,$botfrom )){
file_put_contents("from_id/$from_id/countuserbot.txt","@$userbot\n",FILE_APPEND);

file_put_contents("from_id/$from_id/countbot.txt",$userbot."\n",FILE_APPEND);}

if(!in_array($infobots,$idbotfrom )){
file_put_contents("from_id/$from_id/idbot.txt","$infobots\n",FILE_APPEND);}

if(!in_array($from_id,$botfree )){
file_put_contents("botfreeid.txt",$from_id."\n",FILE_APPEND);}

if(!in_array($idbot,$botfreeid )){
file_put_contents("infoidbots.txt",$idbot."\n",FILE_APPEND);}

file_put_contents("botmak/$idbot/admin.txt","$from_id");

$mak=file_get_contents("bots/mak.php");
$bot=file_get_contents("bots/$botmak.php");

$mak=str_replace("[*[TOKEN]*]","$text",$mak);
$mak=str_replace("[*[TOKENSAN3]*]","$token",$mak);

$bot=str_replace("<?php#*wataw*","$mak",$bot);
file_put_contents("botmak/$idbot/$userbot.php","$bot");

if($botmak=="mak28" ){
$bot=file_get_contents("bots/$botmak.php");

$bot=str_replace("[*[TOKEN]*]","$text",$bot);
$bot=str_replace("[*[TOKENSAN3]*]","$token",$bot);

file_put_contents("botmak/$idbot/$userbot.php","$bot");}

if( $botmak=="mak6" ){
$bot=file_get_contents("bots/$botmak.php");

$bot=str_replace("[*[TOKENBOT]*]","$text",$bot);
$bot=str_replace("[*[TOKENSAN3BOT]*]","$token",$bot);

file_put_contents("botmak/$idbot/$userbot.php","$bot");
}

// بوت الدورات التدريبية المعتمد
if($botmak == "mak70"){
    $bot_template = file_get_contents("bots/mak70.php");
    $bot_template = str_replace("[*[TOKEN]*]", "$text", $bot_template);
    $bot_template = str_replace("[*[TOKENSAN3]*]", "$token", $bot_template);
    file_put_contents("botmak/$idbot/$userbot.php", $bot_template);
}


	
file_get_contents("https://api.telegram.org/bot".$text."/setwebhook?url=".$folder."/botmak/".$idbot."/$userbot.php");
file_put_contents("botmak/$idbot/info.txt","-- محمي --\n$userbot\n$name1bot\n$from_id\n$idbot\n$botmak\n$no3mak");
$propots=$infosudo["info"]["propots"];
file_put_contents("user/$userbot.txt","$idbot");
file_put_contents("wataw/$idbot.php",'<?php '."\n".'$tokenbot= "'.$text.'";');
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id+1,
"text"=>"مبروك تم صنع بوتك بنجاح
- معرف البوت : @$userbot
- نوع البوت: $no3mak
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"اضغط هنا للدخول 📌",'url'=>"https://t.me/$userbot?start"]],
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);
bot('sendmessage',['chat_id'=>$ameed,
'message_id'=>$message_id,
"text"=>"
تم صنع بوت مجاني بنجاح ✅
النوع : $no3mak
توكن : `$text`
يوزر البوت : `$userbot@`
namebot : `$name1bot`
idbot : `$idbot`
معلومات صاحب البوت 🙎 
الاسم : *$name*
الايدي : `$from_id`
[$name](tg://user?id=$from_id)",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"اضغط هنا للدخول 📌",'url'=>"https://t.me/$userbot?start"]],
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);
}else{
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id+1,
"text"=>"🚫 هناك خطاء التوكن الذي قمت بارسالة خاطئ قم بالارسال مره اخرى",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'حاول مرةً اخرئ.','callback_data'=>"sn3botfre"]],
]])]);}}

$botfree=explode("\n",file_get_contents("botfreeid.txt"));
$botf=file_get_contents("from_id/$from_id/countuserbot.txt");
if($data=="botsmember"){
if(in_array($from_id, $botfree) and $botf != "" and $botf != " " and $botf!= null){
$idbotfrom=explode("\n",file_get_contents("from_id/$from_id/idbot.txt"));

$keyboard["inline_keyboard"]=[];
for ($i=0; $i < count($idbotfrom); $i++) { 
$ex = explode("#", $idbotfrom[$i]);
$idbot=$ex['2'];
$userbot="@".$ex['1'];
$in="infobot ".$ex['1'];
$number = strlen($idbot);

$infobot=explode("\n",file_get_contents("botmak/$idbot/info.txt"));
$userbott=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];

if($number > 4){
$keyboard["inline_keyboard"][$i] = [['text'=>$userbot,'url'=>"t.me/$userbott"],
['text'=>$no3mak,'url'=>"t.me/$userbott"],['text'=>'معلومات اكثر ','callback_data'=>$in]];
}}
$keyboard["inline_keyboard"][] = [['text'=>"- إذاعة لكل البوتات ",'callback_data'=>"sendpostbotsall"]];
$keyboard["inline_keyboard"][] = [['text'=>"• رجوع • ",'callback_data'=>"freebot"]];	$reply_markup=json_encode($keyboard);
unlink("from_id/$from_id/yes.txt");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
• هذه هي قائمة بوتاتك المصنوعة ..
$infobotsmember
- قم بالضغط على معلومات اكثر لعرض معلوماتة وامكانية التعديل علية.
",
"message_id"=>$message_id,
'reply_markup'=>$reply_markup]);
}else{
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"❌ عذراً لم تقم بصنع بوت من قبل ",
'reply_markup'=>json_encode([ 'inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);}}

if(preg_match('/^(infobot) (.*)/s', $data)){
$userbot = str_replace('infobot ',"",$data);
$userbot = str_replace(' ',"",$userbot);
$idbots=file_get_contents("user/$userbot.txt");
$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
include("wataw/$idbots.php");
$tokenboot="$tokenbot";
$mm=explode("\n",file_get_contents("botmak/$idbots/sudo/member.txt"));
$co=count($mm)-1;
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"معلومات البوت المصنوع  : `$use`
النوع : $no3mak
ايدي البوت : `$idbots`
اسم البوت : `$namebot`
التوكن : `$tokenboot`
• عدد الاعضاء المشتركين في البوت : $co
",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'🚫 حذف','callback_data'=>"deletebot ".$userbot]],
[['text'=>'♻ تغيير النوع','callback_data'=>"naglbot ".$userbot],['text'=>'','callback_data'=>"naglbotmember ".$userbot]],
[['text'=>'• رجوع •','callback_data'=>"botsmember"]],
]])]);}

if(preg_match('/^(deletebot) (.*)/s', $data)){
$userbot = str_replace('deletebot ',"",$data);
$userbot = str_replace(' ',"",$userbot);

$idbots=file_get_contents("user/$userbot.txt");
$botfrom=explode("\n",file_get_contents("from_id/$from_id/countbot.txt"));
			
if(in_array($userbot,$botfrom ) and $idbots!=null){
$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$tokenbot=$infobot['0'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
#حذف البوت 
$us=file_get_contents("from_id/$from_id/countbot.txt");
$us=str_replace("$userbot\n","",$us);
file_put_contents("from_id/$from_id/countbot.txt",$us);

#حذف ازرار
$ussss="$userbot==code#$userbot#$idbots";
$uss=file_get_contents("from_id/$from_id/idbot.txt");
$uss=str_replace("$ussss\n","",$uss);
file_put_contents("from_id/$from_id/idbot.txt",$uss);

unlink("botmak/user/$userbot.txt");

unlink("botmak/$idbots/$userbot.php");

$us2="@$userbot";
$us1=file_get_contents("from_id/$from_id/countuserbot.txt");
$us1=str_replace("$us2\n","",$us1);
file_put_contents("from_id/$from_id/countuserbot.txt",$us1);
$us11=file_get_contents("infoidbots.txt");
$us11=str_replace("$idbots\n","",$us11);
file_put_contents("infoidbots.txt",$us11);
if(is_dir("botmak/$idbots")){

remove_dir("botmak/$idbots");}

include("wataw/$idbots.php");

$tokenboot="$tokenbot";
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"✅ تم حذف البوت بنجاح",
'disable_web_page_preview'=>'true',
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"botsmember"]],
]])]);
bot('sendmessage',['chat_id'=>$ameed,
'message_id'=>$message_id,
"text"=>"تم حذف بوت مجاني  ❌ 
النوع : $no3mak
توكن : `$tokenboot`
يوزر البوت : *@$userbot*
ايدي البوت : `$idbot`
معلومات صاحب البوت
الاسم : *$name*
الايدي : `$from_id`
[$name](tg://user?id=$from_id)",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
]);}}

if(preg_match('/^(naglbot) (.*)/s', $data)){
$userbot = str_replace('naglbot ',"",$data);
$userbot = str_replace(' ',"",$userbot);
if($userbot!=null){
file_put_contents("from_id/$from_id/nagl.txt","$userbot");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"أهلاً بك عزيزي :
- قم بأختيار نوع البوت الذي تريد نقل @$userbot اليه..
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• قائمة البوتات •','callback_data'=>"null"]],
[['text'=>'','callback_data'=>"ngl 6"],['text'=>'بوت سايت','callback_data'=>"ngl 2"]],
[['text'=>'بوت الازرار','callback_data'=>"ngl 3"],['text'=>'بوت المتجر','callback_data'=>"ngl 4"]],
[['text'=>'بوت البصمات','callback_data'=>"ngl 5"],['text'=>'بوت تواصل','callback_data'=>"ngl 1"]],
[['text'=>'بوت دورات تدريبية 🎓','callback_data'=>'ngl 70']],
[['text'=>'بوت التعليقات','callback_data'=>"ngl 7"],['text'=>'ادارة منشورات القناة','callback_data'=>"ngl 8"]],
[['text'=>'بوت زخرفة','callback_data'=>"ngl 9"],['text'=>'فيديوهات ستوري','callback_data'=>"ngl 10"]],
[['text'=>'تحليل الشخصية','callback_data'=>"ngl 11"],['text'=>'العاب انلاين','callback_data'=>"ngl 12"]],
[['text'=>'تحويل الصيغ','callback_data'=>"ngl 13"],['text'=>'إستخراج روابط القنوات','callback_data'=>"ngl 14"]],
[['text'=>'بوت همسة','callback_data'=>"ngl 15"],['text'=>'بوت كشف الكذب','callback_data'=>"ngl 16"]],
[['text'=>'حذف الحساب','callback_data'=>"ngl 17"],['text'=>'بوت الاعلانات','callback_data'=>"ngl 18"]],
[['text'=>'بوت الاذكار','callback_data'=>"ngl 19"],['text'=>'الاكواد الجاهزة','callback_data'=>"ngl 20"]],
[['text'=>'حساب العمر','callback_data'=>"ngl 21"],['text'=>'ستوري انستكرام','callback_data'=>"ngl 22"]],
[['text'=>'البلورة السحرية','callback_data'=>"ngl 23"],['text'=>'زخرفة تمبلر','callback_data'=>"ngl 24"]],
[['text'=>'مشاركة بدون توجية','callback_data'=>"ngl 25"],['text'=>'حجر ورقة مقص','callback_data'=>"ngl 26"]],
[['text'=>'حماية القنوات','callback_data'=>"ngl 27"],['text'=>'تمويل القنوات','callback_data'=>"ngl 28"]],
[['text'=>'نسبة الحب','callback_data'=>"ngl 29"],['text'=>'دعم القنوات','callback_data'=>"ngl 30"]],
[['text'=>'نسبة الجمال','callback_data'=>"ngl 31"],['text'=>'معاني الاسماء','callback_data'=>"ngl 32"]],
[['text'=>'يوتيوب','callback_data'=>"ngl 33"],['text'=>'تيك توك','callback_data'=>"ngl 34"]],
[['text'=>'اسئلة جريئه','callback_data'=>"ngl 35"],['text'=>'الفقرات','callback_data'=>"ngl 36"]],
[['text'=>'','callback_data'=>"ngl 37"],['text'=>'بوت ردود','callback_data'=>"ngl 38"]],
[['text'=>'ماسح الخلفيات','callback_data'=>"ngl 39"],['text'=>'ملصقات','callback_data'=>"ngl 40"]],
[['text'=>'تعديل حقوق الاغاني','callback_data'=>"ngl 41"],['text'=>'الفلاتر','callback_data'=>"ngl 42"]],
[['text'=>'مسح الميديا','callback_data'=>"ngl 50"]],
[['text'=>'نسبة الرجوله','callback_data'=>"ngl 51"],['text'=>'نسبة المثلية','callback_data'=>"ngl 52"]],
[['text'=>'الابراج','callback_data'=>"ngl 53"],['text'=>'حذف رسايل القنوات','callback_data'=>"ngl 54"]],
[['text'=>'تصميم اجمل ثنائي','callback_data'=>"ngl 55"],['text'=>'خيره','callback_data'=>"ngl 56"]],
[['text'=>'كشف المستقبل','callback_data'=>"ngl 57"],['text'=>'ستوريات وصور','callback_data'=>"ngl 58"]],
[['text'=>'باقات انترنت','callback_data'=>"ngl 59"],['text'=>'تصاميم صور','callback_data'=>"ngl 60"]],
[['text'=>'اهداء الاغاني','callback_data'=>"ngl 61"],['text'=>'سمسمي','callback_data'=>"ngl 62"]],
[['text'=>'كت تويت','callback_data'=>"ngl 63"],['text'=>'نودز','callback_data'=>"ngl 64"]],
[['text'=>'ازرار شفافه','callback_data'=>"ngl 65"],['text'=>'فيزه','callback_data'=>"ngl 66"]],
[['text'=>'خاص بالانستكرام','callback_data'=>"ngl 67"],['text'=>'لعبة محيبس','callback_data'=>"ngl 68"]],
[['text'=>'الالعاب','callback_data'=>"ngl 69"]],
[['text'=>'• رجوع •','callback_data'=>"botsmember"]],
]])]);}}

if(preg_match('/^(ngl) (.*)/s', $data)){
$nu = str_replace('ngl ',"",$data);
if($nu == 1){ $b= "بوت تواصل";}
if($nu == 2){ $b= "بوت سايت";}
if($nu == 3){ $b= "بوت الازرار";}
if($nu == 4){ $b= "بوت المتجر";}
if($nu == 5){ $b= "بوت البصمات";}
if($nu == 6){ $b= "بوت ";}
if($nu == 7){ $b= "بوت التعليقات";}
if($nu == 8){ $b= "بوت ادارة منشور القنوات";}
if($nu == 9){ $b= "بوت الزخرفة";}
if($nu == 10){ $b= "بوت فيديوهات ستوري";}
if($nu == 11){ $b= "بوت تحليل الشخصية";}
if($nu == 12){ $b= "بوت العاب انلاين";}
if($nu == 13){ $b= "بوت تحويل الصيغ";}
if($nu == 14){ $b= "بوت إستخراج روابط القنوات";}
if($nu == 15){ $b= "بوت همسة";}
if($nu == 16){ $b= "بوت كشف الكذب";}
if($nu == 17){ $b= "بوت حذف الحساب";}
if($nu == 18){ $b= "بوت الاعلانات";}
if($nu == 19){ $b= "بوت الاذكار";}
if($nu == 20){ $b= "بوت الاكواد الجاهزة";}
if($nu == 21){ $b= "بوت حساب العمر";}
if($nu == 22){ $b= "بوت تحميل انستقرام";}
if($nu == 23){ $b= "بوت البلورة السحرية";}
if($nu == 24){ $b= "بوت زخرفة تمبلر";}
if($nu == 25){ $b= "بوت مشاركة بدون توجية";}
if($nu == 26){ $b= "بوت حجر ورقة مقص";}
if($nu == 27){ $b= "بوت حماية القنوات";}
if($nu == 28){ $b= "بوت تمويل القنوات";}
if($nu == 29){ $b= "بوت نسبة الحب";}
if($nu == 30){ $b= "بوت دعم القنوات";}
if($nu == 31){ $b = "بوت نسبة الجمال";}
if($nu == 32){ $b = "بوت معاني الاسماء";}
if($nu == 33){ $b = "بوت تحميل من يوتيوب";}
if($nu == 34){ $b = "بوت تحميل من تيك توك";}
if($nu == 35){ $b = "بوت الاسئلة الجريئه";}
if($nu == 36){ $b = "بوت انشاء الفقرات";}
if($nu == 37){ $b = "بوت لايك";}
if($nu == 38){ $b = "بوت ردود";}
if($nu == 39){ $b = "بوت ادارة ماسح الخلفيات";}
if($nu == 40){ $b = "بوت صنع حزم ملصقات";}
if($nu == 41){ $b = "بوت تعديل حقوق الاغاني";}
if($nu == 42){ $b = "بوت الفلاتر";}
if($nu == 43){ $b = "بوت رشق تليكرام";}
if($nu == 44){ $b = "بوت رشق فيسبوك";}
if($nu == 45){ $b = "بوت رشق يوتيوب";}
if($nu == 46){ $b = "بوت رشق سناب جات";}
if($nu == 47){ $b = "بوت رشق انستكرام";}
if($nu == 48){ $b = "بوت شحن شدات ببجي";}
if($nu == 49){ $b = "بوت رشق تيك توك";}
if($nu == 50){ $b = "بوت مسح الميديا";}
if($nu == 51){ $b = "بوت نسبة الرجوله";}
if($nu == 52){ $b = "بوت نسبة المثلية";}
if($nu == 53){ $b = "بوت الابراج";}
if($nu == 54){ $b = "بوت حذف رسايل القناة";}
if($nu == 55){ $b = "بوت تصميم اجمل ثنائي";}
if($nu == 56){ $b = "بوت الخيره";}
if($nu == 57){ $b = "بوت كشف المستقبل";}
if($nu == 58){ $b = "بوت الصور و الاستوريات";}
if($nu == 59){ $b = "بوت باقات انترنت مجانية";}
if($nu == 60){ $b = "بوت تصاميم الصور";}
if($nu == 61){ $b = "بوت اهداء الاغاني";}
if($nu == 62){ $b = "بوت سمسمي";}
if($nu == 63){ $b = "بوت كت تويت";}
if($nu == 64){ $b = "بوت النودز";}
if($nu == 65){ $b = "بوت الازرار الشفافه";}
if($nu == 66){ $b = "بوت الفيزات";}
if($nu == 67){ $b = "بوت الخاص بالانستكرام";}
if($nu == 68){ $b = "بوت لعبة المحيبس";}
if($nu == 69){ $b = "بوت الالعاب";}
if($nu == 70){ $b = "بوت دورات تدريبية 🎓";}

$ngluser=file_get_contents("from_id/$from_id/nagl.txt");
unlink("from_id/$from_id/nagl.txt");
$idbots=file_get_contents("user/$ngluser.txt");

include("wataw/$idbots.php");
$tokenboot="$tokenbot";
$url = "https://api.telegram.org/bot".$tokenboot."/getWebhookInfo";
$check_token = json_decode(file_get_contents($url));
$check = $check_token;
$yes=$check->ok ;

if($yes == "true"){
$url = "https://api.telegram.org/bot$tokenboot/getme";
$getidbots = json_decode(file_get_contents($url) , true);
$idbot = $getidbots['result']['id'];
$userbot = $getidbots['result']['username'];
$name1bot = $getidbots["result"]["first_name"];
$userbot=trim($userbot);
$idbot=trim($idbot);
if(is_dir("botmak/$idbot")){

remove_dir("botmak/$idbot");}

mkdir("botmak");
mkdir("user");
mkdir("botmak/$idbot");

$mak=file_get_contents("bots/mak.php");
$bot=file_get_contents("bots/mak$nu.php");
$mak=str_replace("[*[TOKEN]*]","$tokenboot",$mak);
$mak=str_replace("[*[TOKENSAN3]*]","$token",$mak);
$bot=str_replace("<?php#*wataw*","$mak",$bot);
file_put_contents("botmak/$idbot/$userbot.php","$bot");

if($nu == "28" ){
$bot=file_get_contents("bots/mak$nu.php");
$bot=str_replace("[*[TOKEN]*]","$tokenboot",$bot);
$bot=str_replace("[*[TOKENSAN3]*]","$token",$bot);
file_put_contents("botmak/$idbot/$userbot.php","$bot");}

if( $nu == "6" ){
$bot=file_get_contents("bots/mak$nu.php");
$bot=str_replace("[*[TOKENBOT]*]","$tokenboot",$bot);
$bot=str_replace("[*[TOKENSAN3BOT]*]","$token",$bot);
file_put_contents("botmak/$idbot/$userbot.php","$bot");}
file_put_contents("botmak/$idbot/admin.txt","$from_id");
file_get_contents("https://api.telegram.org/bot".$tokenboot."/setwebhook?url=".$folder."/botmak/".$idbot."/$userbot.php");
file_put_contents("botmak/$idbot/info.txt","-- محمي --\n$userbot\n$name1bot\n$from_id\n$idbot\nmak$nu\n$b");

// برمجة زر نقل الدورات التدريبية المعتمد
if($nu == "70"){
    $bot_template = file_get_contents("bots/mak70.php");
    $bot_template = str_replace("[*[TOKEN]*]", "$tokenboot", $bot_template);
    $bot_template = str_replace("[*[TOKENSAN3]*]", "$token", $bot_template);
    file_put_contents("botmak/$idbot/$userbot.php", $bot_template);
}
 
$iin = "infobot ".$userbot;
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"
- تم تتغير نوع بوتك بنجاح.
- معرف البوت : @$userbot.
النوع : $b
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"اضغط هنا للدخول 📌",'url'=>"https://t.me/$userbot?start"]],
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);

bot('sendmessage',['chat_id'=>$ameed,
'message_id'=>$message_id,
"text"=>"👮|  تم تغيير نوع بوت مجاني بنجاح ✅ 
معلومات البوت: 
النوع : $b
توكن : *$tokenbot*
يوزر البوت : `@$userbot`
namebot : *$name1bot*
idbot : $idbot
معلومات صاحب البوت:
الاسم : *$name*
الايدي : $from_id
[$name](tg://user?id=$from_id)",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"اضغط هنا للدخول 📌",'url'=>"https://t.me/$userbot?start"]],
[['text'=>'• رجوع •','callback_data'=>"freebot"]],
]])]);
}else{
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>"🚫 هناك خطاء التوكن المخزن في البيانات الخاصة بك قد تم تحديثه قم بإعادة صنع البوت من جديد بالتوكن الجديد",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'حاول مرةً اخرئ.','callback_data'=>"botsmember"]],
]])]);}}

$codejson = json_decode(file_get_contents("code.json"),true);
if (!file_exists("code.json")) {
$put = [];
file_put_contents("code.json", json_encode($put));}

if(preg_match('/^(naglbotmember) (.*)/s', $data)){
$userbotfree = str_replace('naglbotmember ',"",$data);
$code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -35);
$idbots=file_get_contents("user/$userbotfree.txt");
$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$userbot=$infobot['1'];
$id=$infobot['3'];
$no3mak=$infobot['6'];
$codejson["info"][$code]["st"]="yes";
$codejson["info"][$code]["idbot"]="$idbots";
$codejson["info"][$code]["userbot"]="$userbot";
$codejson["info"][$code]["admin"]="$id";

file_put_contents("code.json", json_encode($codejson));
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"• هذا هو كود النقل الخاص ببوتك 
https://t.me/$user_bot_sudo?start=$code
- قم بارسالة للشخص الذي تريد نقل البوت اليه.
تحذير:
عند نقل البوت لشخص اخر ستفقد امكانية التحكم في البوت .
",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"botsmember"]],
]])]);}

if(preg_match('/^\/([Ss]tart) (.*)/',$text)){
preg_match('/^\/([Ss]tart) (.*)/',$text,$match);
$code=$match[2];
$codejson = json_decode(file_get_contents("code.json"),true);
$st=$codejson["info"][$code]["st"];
$idbots=$codejson["info"][$code]["idbot"];
$userbots=$codejson["info"][$code]["userbot"];
$admin=$codejson["info"][$code]["admin"];
$idbots=file_get_contents("user/$userbots.txt");
$botfrom=explode("\n",file_get_contents("from_id/$admin/countbot.txt"));
if($admin!=$from_id){
if($st=="yes" and $admin!=null){	
if(in_array($userbots,$botfrom ) and $idbots!=null){

$infobot=explode("\n",file_get_contents("botmak/$idbots/info.txt"));
$tokenboot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
#حذف البوت 
$us=file_get_contents("from_id/$admin/countbot.txt");
$us=str_replace("$userbot\n","",$us);
file_put_contents("from_id/$admin/countbot.txt",$us);

#حذف ازرار
$ussss="$userbot==code#$userbot#$idbots";
$uss=file_get_contents("from_id/$admin/idbot.txt");
$uss=str_replace("$ussss\n","",$uss);
file_put_contents("from_id/$admin/idbot.txt",$uss);

$us2="@$userbot";
$us1=file_get_contents("from_id/$admin/countuserbot.txt");
$us1=str_replace("$us2\n","",$us1);
file_put_contents("from_id/$admin/countuserbot.txt",$us1);

$us5=file_get_contents("botmak/$idbots/info.txt");
$us5=str_replace("$admin","$from_id",$us5);
file_put_contents("botmak/$idbots/info.txt",$us5);

# تخزين البوتات للعضو

file_put_contents("from_id/$from_id/countuserbot.txt","@$userbot\n",FILE_APPEND);
file_put_contents("from_id/$from_id/countbot.txt",$userbot."\n",FILE_APPEND);
#bots

$idbotfrom=explode("\n",file_get_contents("from_id/$from_id/idbot.txt"));
if(!in_array($ussss,$idbotfrom )){
file_put_contents("from_id/$from_id/idbot.txt","$ussss\n",FILE_APPEND);}

$botfree=explode("\n",file_get_contents("botfreeid.txt"));
if(!in_array($from_id,$botfree )){
file_put_contents("botfreeid.txt",$from_id."\n",FILE_APPEND);}

file_put_contents("botmak/$idbots/admin.txt","$from_id");
$us6=file_get_contents("botmak/$idbots/sudo.json");
$us6=str_replace("$admin","$from_id",$us6);
file_put_contents("botmak/$idbots/sudo.json",$us6);

#unlink("botmak/$idbots/sudo.json");

$mm=explode("\n",file_get_contents("botmak/$idbots/sudo/member.txt"));
$co=count($mm)-1;
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"✅ تم نقل البوت اليك بنجاح 
بيانات البوت
- اسم البوت : $namebot
- معرف البوت : @$userbots
- نوع البوت : $no3mak
- توكن البوت : $tokenboot
- عدد الاعضاء المشتركين في البوت : $co
",]);
bot('sendmessage',['chat_id'=>$ameed,
"text"=>"تم نقل [بوت](t.me/$userbot) الى [$from_id](tg://user?id=$from_id)",
'parse_mode'=>"MarkDown",]);
unset($codejson["info"][$code]);
file_put_contents("code.json", json_encode($codejson));}
}else{
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"ارسال /start .!",
'reply_to_message_id'=>$message_id,
]);}
}else{
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"لايمكنك نقل البوت لنفسك",
'reply_to_message_id'=>$message_id,
]);}}

$datatime = json_decode(file_get_contents("datatime.json"),true);
$datatimesend = $datatime["info"][$from_id]["date"];

if($data=="sendpostbotsall"){
$timeuoto=time()+(3600 * 1);
$day = date('Y-m-d',$timeuoto);
if($day!=$datatimesend){
$datatime["info"][$from_id]["date"]="$day";
file_put_contents("datatime.json", json_encode($datatime));
file_put_contents("from_id/$from_id/amr.txt","sendpostbotsall");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>" حسنا قم بارسال النص لكي يتم 
ارسال الاذاعة في هذة البوتات

$infobotsmember",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'• رجوع •','callback_data'=>"botsmember"]],
]])]);}
else{
bot('answercallbackquery',[
'callback_query_id'=>$up->id,
"text"=>"🚫 عذراً لاتستطيع عمل الاذاعة لكل بوتاتك المصنوعة اكثر من مرة واحدة فقط في اليوم $day 
- ستتمكن من نشر الاذاعة غداً
-  يمكنك عمل الاذاعة من داخل بوتاتك المصنوعة
",'show_alert'=>true,]);}}

if($text and $amrmem =="sendpostbotsall"){
file_put_contents("from_id/$from_id/amr.txt","");
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"جارٍ عمل الاذاعة",
'reply_to_message_id'=>$message_id,]);
$bots=explode("\n",file_get_contents("from_id/$from_id/countbot.txt"));
$coo=count($bots)-1;
for ($i=0; $i < count($bots); $i++) { 
$userbots=$bots[$i];
$idbots=file_get_contents("user/$userbots.txt");

include("wataw/$idbots.php");

$tokenboot="$tokenbot";
$mm=explode("\n",file_get_contents("botmak/$idbots/sudo/member.txt"));
for ($l=0; $l < count($mm); $l++) {
$id=$mm[$l];
file_get_contents("https://api.telegram.org/bot".$tokenboot."/sendmessage?chat_id=".$id."&text=$text");}
$co=$co+$l-1;}
bot('sendmessage',['chat_id'=>$chat_id,
"text"=>"- تمت الاذاعة في جميع البوتات المصنوعة 
- تم الارسال الى $co مستخدم.
- عدد البوتات : $coo
",
'reply_to_message_id'=>$message_id,
]);}

if($data=="uplode"){
file_put_contents("from_id/$from_id/amr.txt","uplode");
bot('editmessagetext',['chat_id'=>$chat_id,
'message_id'=>$message_id,
"text"=>" اهلا [$name](tg://user?id=$chat_id)
*• أرسل ملف php الآن !*
• بشروط :

1. لا يحتوي الملف على أي أخطاء برمجيه
2. يجب أن يكون عمله دون الحاجة إلى اتصال بخدمات خارجية (api)
3. لا يحتوي على معرف لقناة أو مطور ( يتم وضع معرف المطور عند صنع البوت من قبل المستخدم )
",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'إلغاء الارسال','callback_data'=>"freebot"]],
]])]);}

$tw_sudo=$infosudo["info"]["sudo"];

// --- كود استقبال وفك النسخة الاحتياطية الشاملة (JSON & Individual Files) ---
if($message->document and $infosudo["info"]["amr"]=="upload_any_backup" and in_array($from_id, $sudo)){
    $file_name = $message->document->file_name;
    $file_id = $message->document->file_id;
    
    $get = bot('getfile',['file_id'=>$file_id])->result->file_path;
    $file_content = file_get_contents("https://api.telegram.org/file/bot".API_KEY."/$get");

    // 1. التعامل مع "الملف الشامل" (all_bots_data.json) الذي يجمع كل بيانات البوتات
    if($file_name == "all_bots_data.json"){
        $data_content = json_decode($file_content, true);
        if($data_content){
            foreach($data_content as $bot_id => $bot_files){
                $base_path = "botmak/$bot_id";
                if(!is_dir("$base_path/sudo")) mkdir("$base_path/sudo", 0777, true);
                if(!is_dir("$base_path/data")) mkdir("$base_path/data", 0777, true);

                // توزيع ملفات كل بوت في مسارها الصحيح (أعضاء، ردود، دورات، متاجر)
                if(isset($bot_files['members'])) file_put_contents("$base_path/sudo/member.txt", $bot_files['members']);
                if(isset($bot_files['responses'])) file_put_contents("$base_path/responses.json", json_encode($bot_files['responses'], JSON_UNESCAPED_UNICODE));
                if(isset($bot_files['db_courses'])) file_put_contents("$base_path/data/db.json", json_encode($bot_files['db_courses'], JSON_UNESCAPED_UNICODE));
                if(isset($bot_files['db_store'])) file_put_contents("$base_path/data.json", json_encode($bot_files['db_store'], JSON_UNESCAPED_UNICODE));
            }
            bot('sendmessage',['chat_id'=>$chat_id, 'text'=>"✅ تم فك وتوزيع 'الملف الشامل' على كافة مجلدات البوتات بنجاح!"]);
        }
        return false;
    }

    // 2. خريطة المسارات للملفات الفردية التابعة للصانع الأساسي
    $destinations = [
        "sudo.json" => "sudo.json",
        "member.txt" => "sudo/member.txt",
        "ban.txt" => "sudo/ban.txt",
        "infoidbots.txt" => "infoidbots.txt",
        "botfreeid.txt" => "botfreeid.txt",
        "admin.txt" => "admin.txt",
        "code.json" => "code.json",
        "prodate.json" => "prodate.json",
        "responses.json" => "responses.json",
        "wataw.json" => "botmak/wataw.json" 
    ];

    if(isset($destinations[$file_name])){
        $dir = dirname($destinations[$file_name]);
        if($dir != "." && !is_dir($dir)) mkdir($dir, 0777, true);

        file_put_contents($destinations[$file_name], $file_content);

        // تحديث مصفوفة الإعدادات فوراً إذا كان الملف المرفوع هو sudo.json
        if($file_name == "sudo.json"){
            $updated_data = json_decode($file_content, true);
            if($updated_data){
                $infosudo = $updated_data;
                $infosudo["info"]["amr"] = "upload_any_backup"; 
            }
        }

        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"📥 تم استعادة الملف الفردي: **$file_name** بنجاح.
            
يمكنك إرسال باقي الملفات أو الضغط على (تم ✅) للعودة للرئيسية.",
            'parse_mode'=>"markdown",
            'reply_to_message_id'=>$message->message_id,
        ]);
        
        return false; 
    } else {
        bot('sendmessage',['chat_id'=>$chat_id, 'text'=>"⚠️ الملف ($file_name) غير مدعوم في نظام الاستعادة التلقائي."]);
    }
}

if($message and $amrmem =="uplode" and !$data){
if( $update->message->document ){
file_put_contents("from_id/$from_id/amr.txt","");
$file_id = $update->message->document->file_id;
bot('senddocument',["chat_id"=>"$ameed",
"document"=>"$file_id",]);
bot('sendmessage',["chat_id"=>"$ameed",
'message_id'=>$message_id,
"text"=>"- طلب ارسال ملف جديد
معلومات المرسل:
الاسم : *$name*
الايدي : $from_id
[$name](tg://user?id=$from_id)",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,]);
bot('sendmessage',["chat_id"=>"$chat_id",
'message_id'=>$message_id,
"text"=>"✅ تم الارسال الى: [📣 مطور البوت .](https://t.me/ريو)",
'parse_mode'=>"MarkDown",]);
}else{
bot('sendmessage',["chat_id"=>"$chat_id",
'message_id'=>$message_id,
"text"=>"🚫 قم بإرسال الملفات فقط",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'إلغاء الارسال','callback_data'=>"freebot"]],
]])]);}}

file_put_contents("sudo.json", json_encode($infosudo)); 
file_put_contents("botmak/wataw.json", json_encode($watawjson)); 

?>
