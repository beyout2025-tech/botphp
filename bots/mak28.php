<?php

ob_start();
//--------
$token = "[*[TOKEN]*]"; # Token
$tokensan3 = "[*[TOKENSAN3]*]"; # Token
$admin = file_get_contents("admin.txt");
$sudo = array("$admin","299938224");
$infobot=explode("\n",file_get_contents("info.txt"));


$usernamebot=$infobot['1'];
$no3mak=$infobot['6'];
//--------
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
        return json_decode($res);
    }
}



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

$data = $up->data;
}

if(isset($update->inline_query)){
$chat_id = $update->inline_query->chat->id;
$from_id = $update->inline_query->from->id;
$name = $update->inline_query->from->first_name.' '.$update->inline_query->from->last_name;
$text_inline = $update->inline_query->query;
$mes_id = $update->inline_query->inline_message_id; 

$user = strtolower($update->inline_query->from->username); 
}
$caption = $update->message->caption;
function getChatstats1($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id='.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}
 function getmember($token,$idchannel,$from_id) {
  $join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$idchannel&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"Bad Request: user not found"') or strpos($join,'"ok": false') or strpos($join,'"status":"kicked"')) !== false){
$wataw="no";}else{$wataw="yes";}
return $wataw;


}
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

if($pro!="yes" or $pro==null){
#if($time < $dateoff){
$txtfree='<a href="https://t.me/'.$user_bot_sudo.'">• اضغط هنا لصنع '.$no3mak.' خاص بك </a>';
#}
}



if($message  and $st_ch_bots=="مفعل" and $pro!="yes"){
$stuts = getmember($tokensan3,$id_ch_sudo1,$from_id);
if($stuts=="no"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"
⛔️| عذرا عزيزي
◾| البوت لا يعمل الا اذا قمت بالاشتراك بقناة البوت
◾| وعند الغاء الاشتراك فان البوت سوف يتوقف .

",
'disable_web_page_preview'=>true,
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>" اضغط للاشتراك في القناة ", 'url'=>"https://t.me/joinchat/$link_ch_sudo1"]],

]
])
]);
return false;}
$stuts = getmember($tokensan3,$id_ch_sudo2,$from_id);
if($stuts=="no"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"
⛔️| عذرا عزيزي
◾| البوت لا يعمل الا اذا قمت بالاشتراك بقناة البوت
◾| وعند الغاء الاشتراك فان البوت سوف يتوقف .

",
'disable_web_page_preview'=>true,
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>" اضغط للاشتراك في القناة ", 'url'=>"https://t.me/joinchat/$link_ch_sudo2"]],

]
])
]);
return false;}


}

if($message  and in_array($from_id,$ban)){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ لا تستطيع استخدام البوت انت محظور ❌
",
]);return false;}

@$infosudo = json_decode(file_get_contents("sudo.json"),true);
if (!file_exists("sudo.json")) {
#	$put = [];
	$infosudo["info"]["admins"][]="$admin";
	$infosudo["info"]["st_grop"]="ممنوع";
		$infosudo["info"]["st_channel"]="مسموح";
$infosudo["info"]["fwrmember"]="معطل";
$infosudo["info"]["tnbih"]="مفعل";
$infosudo["info"]["silk"]="مفعل";
$infosudo["info"]["allch"]="مفردة";
$infosudo["info"]["start"]="non";
$infosudo["info"]["klish_sil"]="كليشة الاشتراك الاجباري";


file_put_contents("sudo.json", json_encode($infosudo));
}
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
$tt=$s["user"];
}
if($silk=="مفعل"){
	$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'url'=>$url]];

}else{
$txt=$txt."\n".$tt;

}
$false="yes";
}

}

}
$reply_markup=json_encode($keyboard);
if($false=="yes"){
	bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"$klish_sil
$txt
",

'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup,
]);
return $false;}
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
$tt=$s["user"];

}
if($silk=="مفعل"){
	$keyboard["inline_keyboard"][] = [['text'=>$namechannel,'url'=>$url]];

}


#$reply_markup=json_encode($keyboard);
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"$klish_sil
$tt
",

'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode($keyboard),
]);
return $false;

}

}

}

}


}


if($update and !in_array($from_id,$member)){file_put_contents("sudo/member.txt","$from_id\n",FILE_APPEND);

if($tnbih == "مفعل" ){
bot("sendmessage",[
"chat_id"=>$admin,
"text"=>"- دخل شخص إلى البوت 🚶‍♂
[....$name](tg://user?id=$from_id) 
- ايديه $from_id 🆔
- معرفة : $user
---------
عدد اعضاء بوتك هو : $cunte
",
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
]);
}}

if($countban<=0){
$countban="لايوجد محظورين";
}
if($text == "/start" and in_array($from_id,$sudo)){

bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"اهلا بك عزيزي الادمن في قائمة التحكم الخاص 

- الاحصائية : 

• عدد الاعضاء : $cunte

• المحظورين: $countban

",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- تعيين رسالة /start ",'callback_data'=>"start"]],[['text'=>"- التوجية من الاعضاء :$fwrmember",'callback_data'=>"fwrmember"]],
[['text'=>"- تنبية دخول الاعضاء : $tnbih",'callback_data'=>"tnbih"]],


[['text'=>"مسح قناة",'callback_data'=>"delchannel"],['text'=>"إضافة قناة",'callback_data'=>"addchannel"]],[['text'=>"- عرض قنوات الاشتراك الاجباري ",'callback_data'=>"viwechannel"]],
[['text'=>"- تعيين رسالة الاشتراك الاجباري ",'callback_data'=>"klish_sil"]],
[['text'=>"- خيارات عرض الاشتراك الاجباري ",'callback_data'=>"null"]],
[['text'=>"- ازرار انلاين :$silk ",'callback_data'=>"silk"],
['text'=>"- الرسالة :$allch ",'callback_data'=>"allch"]],
[['text'=>"- معلومات البوت ",'callback_data'=>"botinfofree"]],


]
])
]);
}

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
$countban="لايوجد محظورين";
}	

bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"اهلا بك عزيزي الادمن في قائمة التحكم الخاص 

- الاحصائية : 

• عدد الاعضاء : $cunte

• المحظورين: $countban

",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- تعيين رسالة /start ",'callback_data'=>"start"]],[['text'=>"- التوجية من الاعضاء :$fwrmember",'callback_data'=>"fwrmember"]],


[['text'=>"- تنبية دخول الاعضاء : $tnbih",'callback_data'=>"tnbih"]],

[['text'=>"مسح قناة",'callback_data'=>"delchannel"],['text'=>"إضافة قناة",'callback_data'=>"addchannel"]],

[['text'=>"- عرض قنوات الاشتراك الاجباري ",'callback_data'=>"viwechannel"]],
[['text'=>"- تعيين رسالة الاشتراك الاجباري ",'callback_data'=>"klish_sil"]],
[['text'=>"- خيارات عرض الاشتراك الاجباري ",'callback_data'=>"null"]],
[['text'=>"- ازرار انلاين :$silk ",'callback_data'=>"silk"],
['text'=>"- الرسالة :$allch ",'callback_data'=>"allch"]],
[['text'=>"- معلومات البوت ",'callback_data'=>"botinfofree"]],

]
])
]);
} 
 ###wataw### 
if($data == "botinfofree"){
$infobot=explode("\n",file_get_contents("info.txt"));

$tokenbot=$infobot['0'];
$userbot=$infobot['1'];
$namebot=$infobot['2'];
$id=$infobot['3'];
$idbots=$infobot['4'];
$no3mak=$infobot['6'];
if($pro=="yes"){
$dayon = date('Y/m/d',$dateon);
$timeon =date('H:i:s A',$dateon);
$dayoff = date('Y/m/d',$dateoff);
$timeoff =date('H:i:s A',$dateon);



$tx="✅ مفعل 

- وقت الاشتراك : 
⏰ $timeon
📅 $dayon
- موعد انتهاء الاشتراك : 
⏰ $timeoff
📅 $dayoff
";

}else{$tx="🚫 لايوجد لديك اشتراك مدفوع";}

bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- ℹ معلومات بوتك 
النوع : $no3mak
توكن : `$tokenbot`
يوزر البوت : *@$userbot*
ايدي البوت : `$idbots`

🔰 حالة الاشتراك المدفوع :$tx
 
- الاحصائية : 

• عدد الاعضاء : $cunte

• المحظورين: $countban


 ",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- العودة  ",'callback_data'=>"home"]],
]
])
]);

}

//~~~~~~~~~~~//

if($data == "start"){
$infosudo["info"]["amr"]="start";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- قم بارسال نص رسالة /start
",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- الغاء  ",'callback_data'=>"home"]],
]
])
]);

}
if($text  and $text !="/start" and $infosudo["info"]["amr"]=="start" and in_array($from_id,$sudo)){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظ كليشة /start 
-الكليشة : 
$text ",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- عودة  ",'callback_data'=>"home"]],
]
])
]);
$infosudo["info"]["amr"]="null";
$infosudo["info"]["start"]="$text";
file_put_contents("sudo.json", json_encode($infosudo));
}
if($data == "klish_sil"){
$infosudo["info"]["amr"]="klish_sil";
file_put_contents("sudo.json", json_encode($infosudo));
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- قم بارسال كليشة الاشتراك الاجباريي 
",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- الغاء  ",'callback_data'=>"home"]],
]
])
]);

}
if($text  and $text !="/start" and $infosudo["info"]["amr"]=="klish_sil" and in_array($from_id,$sudo)){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- ✅ تم حفظ كليشة الاشتراك الاجباري 
-الكليشة : 
$text ",
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- عودة  ",'callback_data'=>"home"]],
]
])
]);
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
if($fwrmember=="مفعل"){
$infosudo["info"]["fwrmember"]="معطل";
}
if($fwrmember=="معطل"){
$infosudo["info"]["fwrmember"]="مفعل";
}
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}
if($data == "tnbih"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$tnbih=$infosudo["info"]["tnbih"];
if($tnbih=="مفعل"){
$infosudo["info"]["tnbih"]="معطل";
}
if($tnbih=="معطل"){
$infosudo["info"]["tnbih"]="مفعل";
}
file_put_contents("sudo.json", json_encode($infosudo));
sendwataw($chat_id,$message_id);
}

if($data == "silk"){
$infosudo = json_decode(file_get_contents("sudo.json"),true);
$skil=$infosudo["info"]["silk"];
if($skil=="مفعل"){
$infosudo["info"]["silk"]="معطل";
}
if($skil=="معطل"){
$infosudo["info"]["silk"]="مفعل";
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
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- اذا كانت القناة التي تريد اضافتها عامة قم بارسال معرفها .
* اذا كانت خاصة قم بإعادة توجية منشور من القناة إلى هنا .
",

'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- الغاء  ",'callback_data'=>"home"]],
]
])
]);
}else{
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- 🚫 لا يمكنك اضافة اكثر من  3 قنوات للإشتراك الاجباري 
",

'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

[['text'=>"- عودة  ",'callback_data'=>"home"]],
]
])
]);
}
}
if($text  and $text !="/start" and $infosudo["info"]["amr"]=="addchannel" and in_array($from_id,$sudo) and !$message->forward_from_chat ){

$ch_id = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$text"))->result->id;
$idchan=$ch_id;
if($ch_id != null){

  $checkadmin = getChatstats1($text,$token);
  if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$text"))->result->title;
$infosudo["info"]["channel"][$ch_id]["st"]="عامة";
$infosudo["info"]["channel"][$ch_id]["user"]="$text";
$infosudo["info"]["channel"][$ch_id]["name"]="$namechannel";
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن 
info channel 
user : $text 
name : $namechannel
id : $ch_id
 ",
 'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إضافة قناة آخرى  ",'callback_data'=>"addchannel"]],
 ]])
]);
}else{
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها 
 ",
'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إعادة المحاولة   ",'callback_data'=>"addchannel"]],
 ]])
]);

}
}else{
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"
❌ لم تتم إضافة القناة لا توجد قناة تمتلك هذا المعرف 
$text ",
'reply_markup'=>json_encode(['inline_keyboard'=>[
 [['text'=>"- عودة   ",'callback_data'=>"home"]],
 ]])
]);
}
$infosudo["info"]["amr"]="null";
file_put_contents("sudo.json", json_encode($infosudo));
}
if($message->forward_from_chat and $infosudo["info"]["amr"]=="addchannel" and in_array($from_id, $sudo)){
$id_channel= $message->forward_from_chat->id;
if($id_channel != null){

  $checkadmin = getChatstats1($id_channel,$token);
  if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$id_channel"))->result->title;
$infosudo["info"]["channel_id"]="$id_channel";


bot('sendMessage',[
'chat_id'=>$chat_id, 
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
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها 
 ",
'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إعادة المحاولة   ",'callback_data'=>"addchannel"]],
 ]])
]);

}
}
$infosudo["info"]["amr"]="channel_id";
file_put_contents("sudo.json", json_encode($infosudo));
}
$channel_id=$infosudo["info"]["channel_id"];

if($text  and $text !="/start" and $infosudo["info"]["amr"]=="channel_id" and in_array($from_id,$sudo) and !$message->forward_from_chat ){

  $checkadmin = getChatstats1($channel_id,$token);
  if($checkadmin == true){
$namechannel = json_decode(file_get_contents("http://api.telegram.org/bot$token/getChat?chat_id=$channel_id"))->result->title;
$infosudo["info"]["channel"][$channel_id]["st"]="خاصة";
$infosudo["info"]["channel"][$channel_id]["user"]="$text";
$infosudo["info"]["channel"][$channel_id]["name"]="$namechannel";
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"
✅ تم إضافة القناة بنجاح عزيزي الادمن 
info channel 
link : $text 
name : $namechannel
id : $channel_id
 ",
 'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إضافة قناة آخرى  ",'callback_data'=>"addchannel"]],
 ]])
]);
}else{
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"❌ البوت ليس ادمن في القناة 
- قم برفع البوت اولا لكي تتمكن من إضافتها 
 ",
'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- إعادة المحاولة   ",'callback_data'=>"addchannel"]],
 ]])
]);

}

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
	$keyboard["inline_keyboard"][] = [['text'=>"- عودة  ",'callback_data'=>"home"]];
$reply_markup=json_encode($keyboard);
	
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- هذة هي قنوات الاشتراك الاجباري الخاصة بك 
",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup
]);

}


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
$userchannel="null";
}
$keyboard["inline_keyboard"][] =
[['text'=>'🚫 حذف','callback_data'=>'deletchannel '.$co],['text'=>$st,'callback_data'=>'null']];
}}
	$keyboard["inline_keyboard"][] = [['text'=>"- عودة  ",'callback_data'=>"home"]];
$reply_markup=json_encode($keyboard);
	
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- قم بالضغط على خيار الحذف بالاسفل 
",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>$reply_markup
]);

}

if(preg_match('/^(deletchannel) (.*)/s', $data)){
$nn = str_replace('deletchannel ',"",$data);
bot('EditMessageText',[
'chat_id'=>$chat_id, 
'text'=>"- ✅ تم حذف القناة بنجاح 
-id $nn
",
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
"message_id"=>$message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[

 [['text'=>"- عودة  ",'callback_data'=>"delchannel"]],
 ]])
]);
unset($infosudo["info"]["channel"][$nn]);
file_put_contents("sudo.json", json_encode($infosudo));
}

if($message and $fwrmember=="مفعل"){
bot('ForwardMessage',[
 'chat_id'=>$admin,
 'from_chat_id'=>$chat_id,
 'message_id'=>$message->message_id,
]);
}



if($start=="non"){
$start="
- اهلا بك  ؛ $name
️ ";

}

$up = $update->callback_query;
$data = $up->data;
$forward_from = $update->message->forward_from;
$forward_from_id = $forward_from->id;
$forward_from_username = $forward_from->username;
$forward_from_first_name = $forward_from->first_name;
$reply = $update->message->reply_to_message->forward_from->id;
$reply_username = $update->message->reply_to_message->forward_from->username;
$reply_first = $update->message->reply_to_message->forward_from->first_name;


$membercall = $update->callback_query->id;
$tc = $update->message->chat->type;
$infobot=explode("\n",file_get_contents("info.txt"));


$usernamebot=$infobot['1'];

$channel = str_replace('@',file_get_contents("data/channelyes.txt"));
$admin = file_get_contents("admin.txt");
$channelcode = str_replace('@',file_get_contents("data/channelcode.txt"));
$coins_start=file_get_contents("data/coins_start.txt");

$channel = str_replace('@',file_get_contents("data/channelyes.txt"));
$admin = file_get_contents("admin.txt");
$channelcode = str_replace('@',file_get_contents("data/channelcode.txt"));
$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $forchannel->result->status;
$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tchq = $forchannelq->result->status;


function getChatMembersCount($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatMembersCount?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatstats($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}


if($coins_start==null){
$coins_start=5;
}
$adna_coins=file_get_contents("data/adna_coins.txt");

if($adna_coins==null){
$adna_coins=40;
}
$day_coins=file_get_contents("data/day_coins.txt");

if($day_coins==null){
$day_coins=5;
}

$username_admin=file_get_contents("data/username_admin.txt");
$Dev = array("$admin");
$sudo = $admin;
mkdir("data");


$infobot = json_decode(file_get_contents("https://api.telegram.org/bot$token/getme"), 1);
$userbot = $infobot["result"]["username"];
$idBot = $infobot["result"]["id"];
date_default_timezone_set("Asia/Baghdad");
$time = date("h:i a");
$year = date("Y");
$month = date("n");
$day = date("j");
$h = date("h");
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$first_name = $message->from->first_name;
$username = $message->from->username;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$admin = array("299938224","$admin");
$setting = json_decode(file_get_contents("setting.json"), 1);
$mode = $setting["1$from_id"];
$gift = $setting["gift"];
$gift1 = $setting["gift1"];
$invite = $setting["setjoincoin"];
$settm = $setting["settm"];
$coa = $setting["coa"];
$gift50 = $setting["gift50"];
$gift5 = $setting["gift5"];
$chtm = $setting["setchs"];
$priceforward = $setting["priceforward"];
$setgiftcoin = $setting["setgiftcoin"];
$pricez = $setting["pricez"];
$dev = $setting["dev"];
$name = $message->from->first_name;
$type       = $message->chat->type;

$private = $type == "private";
$supergroup = $type == "supergroup";
if (true) {
if ($text) {
$coins = $setting[$from_id]["coins"];
} else {
$coins = $setting[$chat_id2]["coins"];
}
}

$KEYBACK1 = json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h1"]]
]
]);
$KEYBACK2 = json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
]);
if ($gift1 != "✅") {
$KEY = json_encode([
"inline_keyboard" => [
[["text" => "نقاطك : $coins", "callback_data" => "coins"]],
[["text" => "تمويل قناتك او مجموعتك", "callback_data" => "tmc"]],
[["text" => "تجميع نقاط", "callback_data" => "getcoin"], ["text" => "تحويل نقاط", "callback_data" => "forwardcoin"]],
[["text" => "تمويلاتك الجارية", "callback_data" => "order"], ["text" => "معلومات حسابك", "callback_data" => "infoaccount"]],
]
]);
} elseif ($gift1 == "✅") {
$KEY = json_encode([
"inline_keyboard" => [
[["text" => "نقاطك : $coins", "callback_data" => "coins"]],
[["text" => "تمويل قناتك او مجموعتك", "callback_data" => "tmc"]],
[["text" => "تجميع نقاط", "callback_data" => "getcoin"], ["text" => "تحويل نقاط", "callback_data" => "forwardcoin"]],
[["text" => "تمويلاتك الجارية", "callback_data" => "order"], ["text" => "معلومات حسابك", "callback_data" => "infoaccount"]],
[["text" => "الهدية اليومية", "callback_data" => "gift"]],
]
]);
}
$type = $message->chat->type;
if ($time == "12:00 am") {
unlink("gift.txt");
}
if (strpos($text, "/start ") !== false and $private) {
if (!in_array($from_id, $setting["user"])) {
$sr = str_replace("/start ", "", $text);
$coins = $invite + $coins;
bot("SendMessage", [
"chat_id" => $sr,
"text" => "• قام : [$name](tg://openmessage?user_id=$from_id) بالدخول الى الرابط الخاص وحصلت على $invite نقطه ✨
• عدد نقاطك : $coins",
"parse_mode" => "markdown"
]);
$setting[$sr]["inv"] += 1;
$setting[$sr]["coins"] += $invite;
file_put_contents("setting.json", json_encode($setting));
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "• قمت بالدخول الى الرابط الدعوه الخاص بصديقك وحصل على $invite نقطه ✨"
]);
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>
• اهلأ بك عزيزي <a href='t.me/" . $username . "'>$first_name</a>👋🏼 .

• البوت مخصص لتمويل القنوات او المجموعات عن طريق تجميع النقاط .

• قم بأختيار القسم الذي تريده من الكيبورد 👇🏽.</b>

$txtfree",
"parse_mode" => "html",
'disable_web_page_preview' => true,
"reply_markup" => $KEY
]);
} else {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>
• اهلأ بك عزيزي <a href='t.me/" . $username . "'>$first_name</a>👋🏼 .

• البوت مخصص لتمويل القنوات او المجموعات عن طريق تجميع النقاط .

• قم بأختيار القسم الذي تريده من الكيبورد 👇🏽.</b>

$txtfree",
"parse_mode" => "html",
'disable_web_page_preview' => true,
"reply_markup" => $KEY
]);
}
}

 
if ($text == "/start" and $private) {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>
• اهلأ بك عزيزي <a href='t.me/" . $username . "'>$first_name</a>👋🏼 .

• البوت مخصص لتمويل القنوات او المجموعات عن طريق تجميع النقاط .

• قم بأختيار القسم الذي تريده من الكيبورد 👇🏽.</b>

$txtfree",
"parse_mode" => "html",
'disable_web_page_preview' => true,
"reply_markup" => $KEY
]);
}
if($message and !in_array($from_id, $setting["user"]) and $gift50 == "✅" and $private and !in_array($from_id,$admin)) {
$setting["user"][] = $from_id;
$setting["$from_id"]["coins"]+=$gift5;
file_put_contents("setting.json", json_encode($setting));
bot("SendMessage",[
"chat_id"=>$chat_id,
"text"=>"حصلت على $gift5 نقطه هدية من المطور ",
]);
}
if ($data == "h2") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "<b>
• اهلأ بك عزيزي <a href='t.me/" . $username . "'>$first_name</a>👋🏼 .

• البوت مخصص لتمويل القنوات او المجموعات عن طريق تجميع النقاط .

• قم بأختيار القسم الذي تريده من الكيبورد 👇🏽.</b>

$txtfree",
"parse_mode" => "html",
'disable_web_page_preview' => true,
"reply_markup" => $KEY
]);
}
if ($data == "forwardcoin") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "<b>• بمكنك تحويل عدد من النقاط الى شخص اخر من هنا🌐

- فقط ارسل عدد النقاط التي تريد ارسالها وسيتم صنع رابط ارسله الى الشخاص المراد استلام نقاط

- عموله التحويل : $priceforward</b>

$txtfree",
"parse_mode" => "html",
"reply_markup" => $KEYBACK2
]);
$setting[$chat_id2]["forward"] = "on";
file_put_contents("setting.json", json_encode($setting));
}
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$idch");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$d = $pricez * 2;
if ($allchannel[$z] != null and $private) {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "• تم خصم $d من نقاطك ⭕️, بسبب مغادره قناة[$namech]($getlinkde) اعطيتك نقاط مقابل الاشتراك بها !!!!",
"parse_mode" => "markdown"
]);
unset($setting["$from_id"]["chrubo"][$z]);
$setting["$from_id"]["chrubo"] = array_values($setting["$from_id"]["chrubo"]);
file_put_contents("setting.json", json_encode($setting));
$coin = $setting["$from_id"]["coins"];
$pluscoin = $coin - $d;
$setting["$from_id"]["coins"] -= "$d";
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
}
$allchannel = $setting[$chat_id2]["chrubo"];
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$idch");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$d = $pricez * 2;
if ($allchannel[$z] != null) {
bot("SendMessage", [
"chat_id" => $chat_id2,
"text" => "• تم خصم $d من نقاطك ⭕️, بسبب مغادره قناة[$namech]($getlinkde) اعطيتك نقاط مقابل الاشتراك بها !!!!",
"parse_mode" => "markdown"
]);
unset($setting["$chat_id2"]["chrubo"][$z]);
$setting["$chat_id2"]["chrubo"] = array_values($setting["$chat_id2"]["chrubo"]);
file_put_contents("setting.json", json_encode($setting));
$coin = $setting["$chat_id2"]["coins"];
$pluscoin = $coin - $d;
$setting["$chat_id2"]["coins"] -= "$d";
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
}
$rand = substr(str_shuffle("0123456789abcdefghijklmnopqrsuvwxyzABCDEFGHIJKLMNOPQRSUVWXYZ"), -18);
if ($text and $setting[$from_id]["forward"] == "on" and preg_match("/([0-9])/i", $text)) {
if ($coins > $priceforward) {
$ca = $text + $priceforward;
$c = $text - $priceforward;
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "
• تم خصم $ca من نقاطك

- عموله التحويل : $priceforward

• رابط تحويل النقاط : https://t.me/$userbot?start=T$rand

• ارسل الرابط للشخص المراد تحويل النقاط له 

• الرابط صالح لمده 15د

- يمكنك الضغط على زر تعطيل الرابط بعد اقل من 15د لكي تقوم بسترداد نقاطك او قم بدخول على الرابط لاسترداد نقاطك",
'disable_web_page_preview' => 'true',
'reply_markup' => json_encode([
"inline_keyboard" => [
[["text" => "تعطيل الرابط", "callback_data" => "breacklink"]],
[["text" => "رجوع", "callback_data" => "h2"]],
]
])
]);
$r = count($setting["forwad"]);
$setting[$from_id]["coins"] -= $c;
$setting["forward"][$rand]["coin"] = $ca;
$setting["forward"][$rand]["niggaa"] = $chat_id;
$setting["forward"][$rand]["count"] = $r;
$setting["forwad"][] = $rand;
$setting[$from_id]["forward"] = " ";
file_put_contents("setting.json", json_encode($setting));
} else {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "
• ليس لديك هذه القدر من النقاط 🚫!
- عموله التحويل : $priceforward
",
'reply_markup' => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]],
]
])
]);
}
}
$ex = explode("T", $text);
$d = $setting["forwad"];
if (preg_match("/^\/(start) (T)/s", $text) and $private) {
if (in_array($ex[1], $d)) {
$c = $setting["forward"][$ex[1]]["coin"];
$v = $c + $coins;
$sed = $setting["forward"][$ex[1]]["niggaa"];
$d1 = $setting["forward"][$ex[1]]["count"];
bot('sendmessage', [
'chat_id' => $chat_id,
'text' => "• تم اضافة $c نقاط الى حسابك ✅
 • بواسطه رابط التحويل من قبل : [$sed](tg://openmessage?user_id=$sed)

 • اصبحت نقاطك : $v",
'parse_mode' => "Markdown",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$sed]["forw"] += 1;
$setting[$from_id]["coins"] += $c;
$d1 = array_search($ex[1], $setting["forwad"]);
unset($setting["forwad"][$d1]);
file_put_contents("setting.json", json_encode($setting));
}
}
$dapy = explode("\n", file_get_contents("gift.txt"));
if ($data == "gift") {
if (!in_array($chat_id2, $dapy)) {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
<b> • لقد حصلت على $setgiftcoin نقاط هدية يومية 🎁 </b>
",
"parse_mode" => "html",
"reply_markup" => $KEYBACK2
]);
file_put_contents("gift.txt", $chat_id2 . "\n", FILE_APPEND);
$setting[$chat_id2]["coins"] += $setgiftcoin;
$setting[$chat_id2]["gf"] += 1;
file_put_contents("setting.json", json_encode($setting));
} else {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
<b>• لقد حصلت على الهدية مسبقا , انتظر يوم واعد المحاولة !</b>
",
"parse_mode" => "html",
"reply_markup" => $KEYBACK2
]);
}
}
if ($data == "coins") {
bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
نقاطك ($coins)",
'show_alert' => true,
]);
}
if ($data == "order") {
$i = 0;
$chs = $setting[$chat_id2]["order"];
$Ibotton1 = [];
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$chs[$i]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chs[$i]");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$mem = $setting[$chs[$i]]["member1"];
$em = $setting[$chs[$i]]["member"];
foreach ($chs as $row) {
$Ibotton1['inline_keyboard'][] = [["text" => "$namech", "url" => "$getlinkde"], ["text" => "$mem/$em", "callback_data" => "nnn"]];
$i++;
}
$Ibotton1['inline_keyboard'][] = [["text" => "تمويل قناتك او مجموعتك", "callback_data" => "tmc"]];
$Ibotton1['inline_keyboard'][] = [['text' => "رجوع", 'callback_data' => 'h2']];
$reply_markup = json_encode($Ibotton1);
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"

• جميع القنوات او مجموعاتك الجاري تمويلها التابعه لك

- اذا اردت زيادة عدد التمويل فقط قم بتمويل قناتك مجددا سيتم اضافه التمويل الجديد على القديم
",
"parse_mode" => "html",
"reply_markup" => $reply_markup
]);
}
if ($data == "tmc") {
if ($coa < $coins) {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
• ارسل عدد الاعضاء المراد تمويلهم او يمكنك الاختيار من الازرار 🌐

- ملاحضة : كل 1 عضو يساوي $settm نقطه 

- عدد نقاطك : $coins",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "طلب الكل", "callback_data" => "allc"]],
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$chat_id2]["mode"] = "tmc";
file_put_contents("setting.json", json_encode($setting));
} else {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
• عليك تجميع نقاط اكثر من $coa نقطه !",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "تجميع النقاط", "callback_data" => "getcoin"]],
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
}
}
if ($data == "allc") {
$max = $coins / $settm;
$maxmember2 = floor($max);
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
رائع الان 💜 $maxmember2

- اختر ماذا تريد ان تقوم بتمويله ؟",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "قناة خاصة", "callback_data" => "cdpv"], ["text" => "قناة عامة", "callback_data" => "chgl"]],
[["text" => "مجموعة", "callback_data" => "gp"]],
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$chat_id2]["mem"] = "$maxmember2";
file_put_contents("setting.json", json_encode($setting));
}
$mode = $setting[$from_id]["mode"];
if ($text and $mode == "tmc" and preg_match("/([0-9])/i", $text)) {
$max = $coins / $settm;
$maxmember2 = floor($max);
if ($maxmember2 >= $text) {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "
رائع الان 💜

- اختر ماذا تريد ان تقوم بتمويله ؟",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "قناة خاصة", "callback_data" => "cdpv"], ["text" => "قناة عامة", "callback_data" => "chgl"]],
[["text" => "مجموعة", "callback_data" => "gp"]],
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$chat_id]["mem"] = "$text";
file_put_contents("setting.json", json_encode($setting));
} else {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>• ليس لديك هذه القدر من النقاط 🚫!</b>",
"reply_to_message_id" => $message_id,
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "تجميع النقاط", "callback_data" => "getcoin"]],
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
}
}
if ($data == "chgl") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
- عليك اضافتي الى القناة ومن ثم ترقيتي الى مشرف فيها مع عطائي صلاحيه دعوه المستخدمين🐝

- ثم ارسل معرف القناة او رابط القناة العام

~ اقرأ الخطوات جيدا ❤️",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$chat_id2]["mode"] = "chgl";
file_put_contents("setting.json", json_encode($setting));
}
if ($data == "cdpv") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
- عليك اضافتي الى القناة ومن ثم ترقيتي الى مشرف فيها مع عطائي صلاحيه دعوه المستخدمين🐝

- ثم ارسل توجيه من القناة رساله نصيه الى هنا

~ اقرأ الخطوات جيدا ❤️",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$chat_id2]["mode"] = "cdpv";
file_put_contents("setting.json", json_encode($setting));
}
if ($data == "gp") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
- عليك اضافتي الى المجموعة ومن ثم ترقيتي الى مشرف فيها مع عطائي صلاحيه دعوه المستخدمين🐝

-ارسل في المجموعة هذه الرساله : <code>تمويل الكروب</code> 

~ اقرأ الخطوات جيدا ❤️",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
}


if ($data == "getcoin") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
مرحبا بك في قسم تجميع النقاط 📥 .

• يمكنك الحصول على نقاط بطريقتين :

1 - عن طريق الاشتراك في القنوات او المجموعات

2 - عن طريق مشاركة رابط الدعوة الى اصدقائك و سوف تحصل على $coininv نقطه عند دخول اي شخص الى الرابط الخاص بك


~ اذ كانت طريقه التجميع صعبه راسل المطور لشراء النقاط 💰 .

~ المطـور : $dev",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "الاشتراك في القنوات او المجموعات", "callback_data" => "noturbo"]],
[["text" => "الاشتراك في القنوات (تيربو)", "callback_data" => "turbo"]],
[["text" => "رابط الدعوة", "callback_data" => "yourlink"]],
[["text" => "رجوع", "callback_data" => "h2"]],
]
])
]);
}

$allchannel = $setting["chanel"];
for($z0 = 0;$z0 <= count($allchannel);$z0++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[0]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z1 = 1;$z1 <= count($allchannel);$z1++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[1]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z2 = 2;$z2 <= count($allchannel);$z2++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[2]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z3 = 3;$z3 <= count($allchannel);$z3++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[3]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z4 = 4;$z4 <= count($allchannel);$z4++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[4]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z5 = 5;$z5 <= count($allchannel);$z5++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[5]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z6 = 6;$z6 <= count($allchannel);$z6++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[6]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z7 = 7;$z7 <= count($allchannel);$z7++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[7]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z8 = 8;$z8 <= count($allchannel);$z8++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[8]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
for($z9 = 9;$z9 <= count($allchannel);$z9++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[9]."&user_id=".$chat_id2));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}}
$url0 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z0]");
$getchat0 = json_decode($url0, true);
$namech0 = $getchat0["result"]["title"]; 
$userch0 = $getchat0["result"]["username"]; 
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z1]");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"]; 
$userch1 = $getchat1["result"]["username"]; 
$url2 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z2]");
$getchat2 = json_decode($url2, true);
$namech2 = $getchat2["result"]["title"]; 
$userch2 = $getchat2["result"]["username"]; 
$url3 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z3]");
$getchat3 = json_decode($url3, true);
$namech3 = $getchat3["result"]["title"]; 
$userch3 = $getchat3["result"]["username"]; 
$url4 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z4]");
$getchat4 = json_decode($url4, true);
$namech4 = $getchat4["result"]["title"]; 
$userch4 = $getchat4["result"]["username"]; 
$url5 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z5]");
$getchat5 = json_decode($url5, true);
$namech5 = $getchat5["result"]["title"]; 
$userch5 = $getchat5["result"]["username"]; 
$url6 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z6]");
$getchat6 = json_decode($url6, true);
$namech6 = $getchat6["result"]["title"]; 
$userch6 = $getchat6["result"]["username"]; 
$url7 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z7]");
$getchat7 = json_decode($url7, true);
$namech7 = $getchat7["result"]["title"]; 
$userch7 = $getchat7["result"]["username"]; 
$url8 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z8]");
$getchat8 = json_decode($url8, true);
$namech8 = $getchat8["result"]["title"]; 
$userch8 = $getchat8["result"]["username"]; 
$url9 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z9]");
$getchat9 = json_decode($url9, true);
$namech9 = $getchat9["result"]["title"]; 
$userch9 = $getchat9["result"]["username"]; 
$id0 = $getchat0["result"]["id"]; 
$id1 = $getchat1["result"]["id"]; 
$id2 = $getchat2["result"]["id"]; 
$id3 = $getchat3["result"]["id"]; 
$id4 = $getchat4["result"]["id"]; 
$id5 = $getchat5["result"]["id"]; 
$id6 = $getchat6["result"]["id"]; 
$id7 = $getchat7["result"]["id"]; 
$id8 = $getchat8["result"]["id"]; 
$id9 = $getchat9["result"]["id"]; 
if($data == "turbo" ){
if($id0 == null and $id1 == null and $id2 ==null and $id3 ==null and $id4 == null and $id5 == null and $id6 == null and $df7 == null and $id8 == null and $id9 == null){
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' => "لا يوجد قنوات في الوقت الحالي , قم يتجميع النقاط بطريقه مختلفه",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "رابط الدعوة", 'callback_data' => 'yourlink']],
[['text' => "•رجوع•", 'callback_data' => 'h2']],
]
])
]);
}else{
unset($setting[$chat_id2]["turbp"]);
$setting[$chat_id2]["turbp"]= array_values($setting[$chat_id2]["turbp"]);
file_put_contents("setting.json", json_encode($setting));
$setting[$chat_id2]["getjoinchi"][]="$id0";
$setting[$chat_id2]["getjoinchi"][]="$id1";
$setting[$chat_id2]["getjoinchi"][]="$id2";
$setting[$chat_id2]["getjoinchi"][]="$id3";
$setting[$chat_id2]["getjoinchi"][]="$id4";
$setting[$chat_id2]["getjoinchi"][]="$id5";
$setting[$chat_id2]["getjoinchi"][]="$id6";
$setting[$chat_id2]["getjoinchi"][]="$id7";
$setting[$chat_id2]["getjoinchi"][]="$id8";
$setting[$chat_id2]["getjoinchi"][]="$id9";
file_put_contents("setting",json_encode($setting));
$link0 = $setting[$id0]["link"];
$link0 = trim($link0,"https://t.me/");
$link1 = $setting[$id1]["link"];
$link1 = trim($link1,"https://t.me/");
$link2 = $setting[$id2]["link"];
$link2 = trim($link2,"https://t.me/");
$link3 = $setting[$id3]["link"];
$link3 = trim($link3,"https://t.me/");
$link4 = $setting[$id4]["link"];
$link4 = trim($link4,"https://t.me/");
$link5 = $setting[$id5]["link"];
$link5 = trim($link5,"https://t.me/");
$link6 = $setting[$id6]["link"];
$link6 = trim($link6,"https://t.me/");
$link7 = $setting[$id7]["link"];
$link7 = trim($link7,"https://t.me/");
$link8 = $setting[$id8]["link"];
$link8 = trim($link8,"https://t.me/");
$link9 = $setting[$id9]["link"];
$link9 = trim($link9,"https://t.me/");
$allchannel = $setting["chanel"];
bot("EditMessageText",[
"chat_id"=>$chat_id2,
"message_id"=>$message_id2,
"text"=>"
<b> 
• اشترك في القنوات 
- ثم اضغط على التالي للتحصل على $pricez مقابل كل قناة🌎 </b>

• نقاطك الحاليه : $coins


",
"parse_mode"=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$namech0",'url'=>"t.me/$link0"]],
[['text'=>"$namech1",'url'=>"t.me/$link1"]],
[['text'=>"$namech2",'url'=>"t.me/$link2"]],
[['text'=>"$namech3",'url'=>"t.me/$link3"]],
[['text'=>"$namech4",'url'=>"t.me/$link4"]],
[['text'=>"$namech5",'url'=>"t.me/$link5"]],
[['text'=>"$namech6",'url'=>"t.me/$link6"]],
[['text'=>"$namech7",'url'=>"t.me/$link7"]],
[['text'=>"$namech8",'url'=>"t.me/$link8"]],
[['text'=>"$namech9",'url'=>"t.me/$link9"]],
[['text'=>"تحقق",'callback_data'=>'turech']],
[['text'=>"•رجوع•",'callback_data'=>'getcoin']],
]
])
]);
}}
$ex = explode("##", $data);
if ($ex[0] == "badchannel") {
$url4 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$ex[1]");
$getchat4 = json_decode($url4, true);
$namech4 = $getchat4["result"]["title"];
$userch4 = $getchat4["result"]["username"];
$id4 = $getchat4["result"]["id"];
$usernames = $update->callback_query->from->username;
$idusers = $update->callback_query->from->id;
$names = $update->callback_query->from->first_name;
$membercall = $update->callback_query->id;
$link4 = $setting[$id4]["link"];
$link4 = trim($link4,"https://t.me/");
bot('answercallbackquery', [
'callback_query_id' => $membercall,
'text' => "تم ارسال الابلاغ الى مبرمج البوت, وسوف يقوم بمراجعة القناة ومعرفة محتوى القناة ،
نشكرك للتعاون معنا♥️ !",
'show_alert' => true
]);
for ($d = 0; $d < 5; $d++) {
bot('sendmessage', [
'chat_id' => "$admin[$d]",
'text' => "
• بلاغ جديد على قناة : [$namech4]($link4) ❗️

- ايدي المبلغ : $idusers
- اسم المبلغ : -[$names](t.me/$usernames)",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "ابلاغ كاذب", "callback_data" => "h2"]],
[["text" => "الغاء تمويل القناة", "callback_data" => "detm"]]
]
])
]);
}
}
if ($data == "turech") {
$getjoinchannel = $setting[$chat_id2]["getjoinchi"];
for ($i = 0; $i <= count($getjoinchannel); $i++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $getjoinchannel[$i] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel == 'member' or $okchannel == 'creator' or $okchannel == 'administrator') {
$key = array_search("$getjoinchannel[$z]", $setting[$chat_id2]["getjoinchi"]);
$setting[$chat_id2]["turbp"][] = $key;
unset($setting[$chat_id2]["getjoinchi"][$key]);
$setting[$chat_id2]["getjoinchi"] = array_values($setting[$chat_id2]["getjoinchi"]);
file_put_contents("setting.json", json_encode($setting));
$search = array_search($getjoinchannel[$i], $setting["chanel"]);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$i"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$idch = $getchat1["result"]["id"];
$coinchannel = $setting["member"];
$settingnelincoin = $coinchannel[$i];
$downchannel = $settingnelincoin - 1;
if ($downchannel > 0) {
@$setting = json_decode(file_get_contents("setting.json"), true);
$setting["member"]["$i"] = "$downchannel";
$setting["member"] = array_values($setting["member"]);
$setting[$idch]["member"] += 1;
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
@$setting = json_decode(file_get_contents("setting.json"), true);
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting[$idch]["member"];
$chhhhhhanel = $setting["chanel"]["$i"];
@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$i"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$idch = $getchat1["result"]["id"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting["member1"]["$i"];
$chhhhhhanel = $setting["chanel"]["$i"];
$setting[$idch]["member1"] -= 1;
file_put_contents("setting.json", json_encode($setting));
$link = $setting[$idch]["link"];
$member = $setting[$idch]["member"];
$member1 = $setting[$idch]["member1"];
if ($chhhhhhanel != "" and $chhhhhhanel != null) {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• شترك شخص جديد في قناتك : [$namech1](t.me/$userch1)

- العدد المطلوب $member عضو
- العدد المتبقي $member1 عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
$link0 = $setting[$idch]["link"];
$link0 = trim($link0,"https://t.me/");
if ($member1 == "0") {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
for ($d = 0; $d < 5; $d++) {
bot('sendmessage', [
'chat_id' => $admin[$d],
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
bot('sendmessage', [
'chat_id' => "$chtm",
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
unset($setting[$idch]["member"]);
$a51 = array_search($idch,$setting["chanel"]);
unset($setting["chanel"]["$a51"]);
unset($setting[$idch]["admin"]);
$setting["chanel"] = array_values($setting["chanel"]);
$setting[$idch]["member"] = array_values($setting[$idch]["member"]);
$setting[$idch]["admin"]= array_values($setting[$idch]["admin"]);
file_put_contents("setting.json", json_encode($setting));
}
$allchannel = $setting["chanel"];
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
}
}
}
$r34 = count($setting[$chat_id2]["turbp"]);
$faes = $pricez * $r34;
$setting[$chat_id2]["coins"] += $faes;
file_put_contents("setting.json", json_encode($setting));
bot("Editmessagetext", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
- <b> • تم اضافة {$faes} نقاط الى حسابك ✅
• بسبب الاشتراك في $r34 قنوات 

- (اذا قمت بمغادرة اي قناة سيتم خصم ضعف النقاط)</b>",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "التالي", "callback_data" => "turbo"]],
[["text" => "رجوع", "callback_data" => "getcoin"]]
]
])
]);
unset($setting[$chat_id2]["getjoinchi"][$key]);
$setting[$chat_id2]["getjoinchi"] = array_values($setting[$chat_id2]["getjoinchi"]);
file_put_contents("setting.json", json_encode($setting));
if (!in_array($getjoinchannel[$i], $setting["$chat_id2"]["chrubo"])) {
$setting["$chat_id2"]["chrubo"][] = $getjoinchannel[$i];
file_put_contents("setting.json", json_encode($setting, true));
}
}
$allchannel = $setting["chanel"];
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$idch");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
if ($userch == null) {
$getlinkde = $jsonlink['result'];
} elseif ($userch != null) {
$getlinkde = "t.me/$userch";
}

if ($data == "noturbo") {
if ($idch == null) {
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' => "لا يوجد قنوات في الوقت الحالي , قم يتجميع النقاط بطريقه مختلفه",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "رابط الدعوة", 'callback_data' => 'yourlink']],
[['text' => "•رجوع•", 'callback_data' => 'h2']],
]
])
]);
} else {

bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "• اشترك في القناة : [$namech](tg://openmessage?user_id=$idch)
 
- من ثم اضغط على تحقق لكي تحصل على $pricez نقطه 🌎

• نقاطك الحاليه : $coins",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "$namech", 'url' => "$getlinkde"]],
[['text' => "التالي", 'callback_data' => 'truechannel'], ['text' => "تحقق", 'callback_data' => 'truechannel1']],
[['text' => "ابلاغ", 'callback_data' => 'badchannel']],
[['text' => "•رجوع•", 'callback_data' => 'getcoin']],
]
])
]);
$setting[$chat_id2]["cc3"] = $idch;
$setting[$chat_id2]["cc1"] = $z + 1;
$setting[$chat_id2]["arraychannel"] = $z;
file_put_contents("setting.json", json_encode($setting));
}
}

$arraychannel = $setting[$chat_id2]["arraychannel"];
if ($data == "truechannel1") {
$getjoinchannel = $setting[$chat_id2]["cc3"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $getjoinchannel . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
اشترك في القناة اولأ!!",
'show_alert' => true,
]);
} else {
if ($idch != null and $idch != "") {
$arraychannel = $setting[$chat_id2]["arraychannel"];
$coinchannel = $setting["member"];
$settingnelincoin = $coinchannel[$arraychannel];
$downchannel = $settingnelincoin - 1;
if ($downchannel > 0) {
@$setting = json_decode(file_get_contents("setting.json"), true);
$setting["member"]["$arraychannel"] = "$downchannel";
$setting["member"] = array_values($setting["member"]);
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
}

@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$idch = $getchat1["result"]["id"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting["member1"]["$arraychannel"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$setting[$idch]["member1"] -= 1;
file_put_contents("setting.json", json_encode($setting));

$member = $setting[$idch]["member"];
$member1 = $setting[$idch]["member1"];
if ($chhhhhhanel != "" and $chhhhhhanel != null) {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• شترك شخص جديد في قناتك : [$namech1](t.me/$userch1)
 
 - العدد المطلوب $member عضو
 - العدد المتبقي $member1 عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
$allchannel = $setting["chanel"];
@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting[$idch]["member"];
$d1 = $setting["member"]["$arraychannel"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$link0 = $setting[$idch]["link"];
$link0 = trim($link0,"https://t.me/");
if ($member1 == "0") {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
for ($d = 0; $d < 5; $d++) {
bot('sendmessage', [
'chat_id' => $admin[$d],
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
bot('sendmessage', [
'chat_id' => "$chtm",
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
unset($setting[$idch]["member"]);
$a51 = array_search($idch,$setting["chanel"]);
unset($setting["chanel"]["$a51"]);
unset($setting[$idch]["admin"]);
$setting["chanel"] = array_values($setting["chanel"]);
$setting[$idch]["member"] = array_values($setting[$idch]["member"]);
$setting[$idch]["admin"]= array_values($setting[$idch]["admin"]);
file_put_contents("setting.json", json_encode($setting));
}
if (!in_array($getjoinchannel, $setting["$chat_id2"]["chrubo"])) {
$setting["$chat_id2"]["chrubo"][] = $getjoinchannel;
file_put_contents("setting.json", json_encode($setting, true));
}
$allchannel = $setting["chanel"];
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$coins = $pricez + $coins;

bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "• اشترك في القناة : [$namech](tg://openmessage?user_id=$idch)
 
- من ثم اضغط على تحقق لكي تحصل على $pricez نقطه 🌎

• نقاطك الحاليه : $coins",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "$namech", 'url' => "$getlinkde"]],
[['text' => "التالي", 'callback_data' => 'truechannel'], ['text' => "تحقق", 'callback_data' => 'truechannel1']],
[['text' => "ابلاغ", 'callback_data' => 'badchannel']],
[['text' => "•رجوع•", 'callback_data' => 'getcoin']],
]
])
]);
$setting[$chat_id2]["cc3"] = $idch;
$setting[$chat_id2]["cc1"] = $z + 1;
$setting[$chat_id2]["arraychannel"] = $z;
$setting[$chat_id2]["coins"] += $pricez;
file_put_contents("setting.json", json_encode($setting));
} else {
$getjoinchannel = $setting[$chat_id2]["cc3"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $getjoinchannel . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel == 'member' || $okchannel == 'creator' || $okchannel == 'administrator') {
$arraychannel = $setting[$chat_id2]["arraychannel"];
$coinchannel = $setting["member"];
$settingnelincoin = $coinchannel[$arraychannel];
$downchannel = $settingnelincoin - 1;
if ($downchannel > 0) {
@$setting = json_decode(file_get_contents("setting.json"), true);
$setting["member"]["$arraychannel"] = "$downchannel";
$setting["member"] = array_values($setting["member"]);
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
}

@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$idch = $getchat1["result"]["id"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting["member1"]["$arraychannel"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$setting[$idch]["member1"] -= 1;
file_put_contents("setting.json", json_encode($setting));

$member = $setting[$idch]["member"];
$member1 = $setting[$idch]["member1"];
if ($chhhhhhanel != "" and $chhhhhhanel != null) {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• شترك شخص جديد في قناتك : [$namech1](t.me/$userch1)
 
 - العدد المطلوب $member عضو
 - العدد المتبقي $member1 عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
$allchannel = $setting["chanel"];
@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting[$idch]["member"];
$d1 = $setting["member"]["$arraychannel"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$link0 = $setting[$idch]["link"];
$link0 = trim($link0,"https://t.me/");
if ($member1 == "0") {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
for ($d = 0; $d < 5; $d++) {
bot('sendmessage', [
'chat_id' => $admin[$d],
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
bot('sendmessage', [
'chat_id' => "$chtm",
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
unset($setting[$idch]["member"]);
$a51 = array_search($idch,$setting["chanel"]);
unset($setting["chanel"]["$a51"]);
unset($setting[$idch]["admin"]);
$setting["chanel"] = array_values($setting["chanel"]);
$setting[$idch]["member"] = array_values($setting[$idch]["member"]);
$setting[$idch]["admin"]= array_values($setting[$idch]["admin"]);
file_put_contents("setting.json", json_encode($setting));
}
if (!in_array($getjoinchannel, $setting["$chat_id2"]["chrubo"])) {
$setting["$chat_id2"]["chrubo"][] = $getjoinchannel;
file_put_contents("setting.json", json_encode($setting, true));
}
$allchannel = $setting["chanel"];
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' => "لا يوجد قنوات في الوقت الحالي , قم يتجميع النقاط بطريقه مختلفه",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "رابط الدعوة", 'callback_data' => 'yourlink']],
[['text' => "•رجوع•", 'callback_data' => 'h2']],
]
])
]);
$setting[$chat_id2]["cc3"] = $idch;
$setting[$chat_id2]["cc1"] = $z + 1;
$setting[$chat_id2]["arraychannel"] = $z;
$setting[$chat_id2]["coins"] += $pricez;
file_put_contents("setting.json", json_encode($setting));
}
}
}
}

$cc = $setting[$chat_id2]["cc1"];
$allchannel = $setting["chanel"];

for ($z = $cc; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$cc = $setting[$chat_id2]["cc1"];
for ($z = $cc; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$idch");
$jsonlink = json_decode($getlink, true);
if ($userch == null) {
$getlinkde = $jsonlink['result'];
} elseif ($userch != null) {
$getlinkde = "t.me/$userch";
}
if ($data == "truechannel") {
if ($idch != null and $idch != "") {
$getjoinchannel = $setting[$chat_id2]["cc3"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $getjoinchannel . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' =>
"• اشترك في القناة : [$namech](tg://user?id=$idch)
 
 - من ثم اضغط على تحقق لكي تحصل على $pricez نقطه 🌎
 
 • نقاطك الحاليه : $coins",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "$namech", 'url' => "$getlinkde"]],
[['text' => "التالي", 'callback_data' => 'truechannel'], ['text' => "تحقق", 'callback_data' => 'truechannel1']],
[['text' => "ابلاغ", 'callback_data' => 'badchannel']],
[['text' => "•رجوع•", 'callback_data' => 'getcoin']],
]
])
]);
$setting[$chat_id2]["cc3"] = $idch;
$setting[$chat_id2]["cc1"] = $z + 1;
file_put_contents("setting.json", json_encode($setting));
} else {
if ($idch != null and $idch != "") {
$arraychannel = $setting[$chat_id2]["arraychannel"];
$coinchannel = $setting["member"];
$settingnelincoin = $coinchannel[$arraychannel];
$downchannel = $settingnelincoin - 1;
if ($downchannel > 0) {
@$setting = json_decode(file_get_contents("setting.json"), true);
$setting["member"]["$arraychannel"] = "$downchannel";
$setting["member"] = array_values($setting["member"]);
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
}

@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$idch = $getchat1["result"]["id"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting["member1"]["$arraychannel"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$setting[$idch]["member1"] -= 1;
file_put_contents("setting.json", json_encode($setting));

$member = $setting[$idch]["member"];
$member1 = $setting[$idch]["member1"];
if ($chhhhhhanel != "" and $chhhhhhanel != null) {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• شترك شخص جديد في قناتك : [$namech1](t.me/$userch1)
 
 - العدد المطلوب $member عضو
 - العدد المتبقي $member1 عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
$allchannel = $setting["chanel"];
@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting[$idch]["member"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$link0 = $setting[$idch]["link"];
$link0 = trim($link0,"https://t.me/");
if ($chhhhhhanel == "1") {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• تم نتهاء تمويل قناة : $namech1ب $setmembe3r عضو 🚸 ",
]);
bot('sendmessage', [
'chat_id' => "$chtm",
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
unset($setting[$idch]["member"]);
$a51 = array_search($idch,$setting["chanel"]);
unset($setting["chanel"]["$a51"]);
unset($setting[$idch]["admin"]);
$setting["chanel"] = array_values($setting["chanel"]);
$setting[$idch]["member"] = array_values($setting[$idch]["member"]);
$setting[$idch]["admin"]= array_values($setting[$idch]["admin"]);
file_put_contents("setting.json", json_encode($setting));
}
if (!in_array($getjoinchannel, $setting["$chat_id2"]["chrubo"])) {
$setting["$chat_id2"]["chrubo"][] = $getjoinchannel;
file_put_contents("setting.json", json_encode($setting, true));
}
$allchannel = $setting["chanel"];
for ($z = 0; $z <= count($allchannel); $z++) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $allchannel[$z] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
break;
}
}
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$coins = $pricez + $coins;
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' =>
"• اشترك في القناة : [$namech](tg://user?id=$idch)
 
 - من ثم اضغط على تحقق لكي تحصل على $pricez نقطه 🌎
 
 • نقاطك الحاليه : $coins",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "$namech", 'url' => "$getlinkde"]],
[['text' => "التالي", 'callback_data' => 'truechannel'], ['text' => "تحقق", 'callback_data' => 'truechannel1']],
[['text' => "ابلاغ", 'callback_data' => 'badchannel']],
[['text' => "•رجوع•", 'callback_data' => 'getcoin']],
]
])
]);
$setting[$chat_id2]["cc3"] = $idch;
$setting[$chat_id2]["cc1"] = $z + 1;
$setting[$chat_id2]["coins"] += $pricez;
file_put_contents("setting.json", json_encode($setting));
}
}
} else {
$getjoinchannel = $setting[$chat_id2]["cc3"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $getjoinchannel . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel == 'member' || $okchannel == 'creator' || $okchannel == 'administrator') {
$arraychannel = $setting[$chat_id2]["arraychannel"];
$coinchannel = $setting["member"];
$settingnelincoin = $coinchannel[$arraychannel];
$downchannel = $settingnelincoin - 1;
if ($downchannel > 0) {
@$setting = json_decode(file_get_contents("setting.json"), true);
$setting["member"]["$arraychannel"] = "$downchannel";
$setting["member"] = array_values($setting["member"]);
$setting = json_encode($setting, true);
file_put_contents("setting.json", $setting);
}

@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$idch = $getchat1["result"]["id"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting["member1"]["$arraychannel"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$setting[$idch]["member1"] -= 1;
file_put_contents("setting.json", json_encode($setting));

$member = $setting[$idch]["member"];
$member1 = $setting[$idch]["member1"];
if ($chhhhhhanel != "" and $chhhhhhanel != null) {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• شترك شخص جديد في قناتك : [$namech1](t.me/$userch1)
 
 - العدد المطلوب $member عضو
 - العدد المتبقي $member1 عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
}
$allchannel = $setting["chanel"];
@$setting = json_decode(file_get_contents("setting.json"), true);
$url1 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=" . $setting["chanel"]["$arraychannel"] . "");
$getchat1 = json_decode($url1, true);
$namech1 = $getchat1["result"]["title"];
$userch1 = $getchat1["result"]["username"];
$setting = json_decode(file_get_contents("setting.json"), true);
$setmembe3r = $setting[$idch]["member"];
$chhhhhhanel = $setting["chanel"]["$arraychannel"];
$link0 = $setting[$idch]["link"];
$link0 = trim($link0,"https://t.me/");
if ($chhhhhhanel == "1") {
bot('sendmessage', [
'chat_id' => $setting[$idch]["admin"],
'text' => "• تم نتهاء تمويل قناة : $namech1ب $setmembe3r عضو 🚸 ",
]);
bot('sendmessage', [
'chat_id' => "$chtm",
'text' => "• تم نتهاء تمويل قناة : [$namech1](t.me/$link0) ب $setmembe3r عضو 🚸 ",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
]);
unset($setting[$idch]["member"]);
$a51 = array_search($idch,$setting["chanel"]);
unset($setting["chanel"]["$a51"]);
unset($setting[$idch]["admin"]);
$setting["chanel"] = array_values($setting["chanel"]);
$setting[$idch]["member"] = array_values($setting[$idch]["member"]);
$setting[$idch]["admin"]= array_values($setting[$idch]["admin"]);
file_put_contents("setting.json", json_encode($setting));
}
if (!in_array($getjoinchannel, $setting["$chat_id2"]["chrubo"])) {
$setting["$chat_id2"]["chrubo"][] = $getjoinchannel;
file_put_contents("setting.json", json_encode($setting, true));
}
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' => "لا يوجد قنوات في الوقت الحالي , قم يتجميع النقاط بطريقه مختلفه",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "رابط الدعوة", 'callback_data' => 'yourlink']],
[['text' => "•رجوع•", 'callback_data' => 'h2']],
]
])
]);
$setting[$chat_id2]["cc3"] = $idch;
$setting[$chat_id2]["coins"] += $pricez;
file_put_contents("setting.json", json_encode($setting));
} else {
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' => "لا يوجد قنوات في الوقت الحالي , قم يتجميع النقاط بطريقه مختلفه",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "رابط الدعوة", 'callback_data' => 'yourlink']],
[['text' => "•رجوع•", 'callback_data' => 'h2']],
]
])
]);
}
}
}

$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$id1 = $update->message->forward_from->id;
$infos1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$forward_id&user_id=$idBot"), true);
$bot = $infos1['result']['status'];
$can_bot_invite = $infos1['result']['can_invite_users'];
if ($can_bot_invite == 1) {
$can = "✅";
} else {
$can = "❌";
}

if ($forward and $mode == "cdpv") {
if ($can == "✅") {
$max = $setting["$from_id"]["mem"] / $settm;
$maxmember = $setting["$from_id"]["mem"];
$max1 = $settm * $maxmember;
$maxmember1 = floor($max1);
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "
• تم خصم ($max1) نقاط
- وبدء تمويل قناتك $maxmember عضو 🚸
<b>
- اذا قمت بطرد البوت من القناة او تنزيله من الادمنيه اثناء التمويل سيتم ستبعاد قناتك من التمويل !!! $id1
</b>
",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$forward_id");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$url1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/createChatInviteLink?chat_id=$idch&expire_date=month&member_limit=9999"),1);
$urll = $url1["result"]["invite_link"];
$setting[$idch]["link"] = $urll;
$setting["chanel"][] = $idch;
$setting[$idch]["member1"] = $setting["$from_id"]["mem"];
$setting[$idch]["member"] = $setting["$from_id"]["mem"];
$setting[$idch]["admin"] = "$from_id";
$setting[$from_id]["order"][] = "$idch ";
$setting[$from_id]["mode"] = " ";
$setting[$from_id]["coins"] -= $max1;
file_put_contents("setting.json", json_encode($setting));
$mem = $setting[$from_id]['mem'];
bot("SendMessage", [
"chat_id" => "$admin[1]",
"text" => "
• تم بدء تمويل قناة : [$namech]($urll) | $mem عضو 🚸

- ايدي الشخص : [$from_id]
- اسم شخص : [$name](tg://openmessage?user_id=$from_id)
- عدد نفاط الشخص : $coins",
"parse_mode" => "markdown",
]);
bot("SendMessage", [
"chat_id" => "$admin[0]",
"text" => "
• تم بدء تمويل قناة : [$namech]($urll) | $mem عضو 🚸

- ايدي الشخص : [$from_id]
- اسم شخص : [$name](tg://openmessage?user_id=$from_id)
- عدد نفاط الشخص : $coins",
"parse_mode" => "markdown",
]);
} else {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>• البوت ليس ادمن في قناة</b>",
"reply_to_message_id" => $message_id,
"parse_mode" => "html"
]);
}
}
$infos1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=$idBot"), true);
$bot = $infos1['result']['status'];
$can_bot_invite = $infos1['result']['can_invite_users'];
if ($can_bot_invite == 1) {
$can = "✅";
} else {
$can = "❌";
}
@$statjson = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=" . $from_id), true);
@$status = $statjson['result']['status'];
if ($status == 'creator' or $status == 'administrator') {
if ($text == "تمويل الكروب" and $supergroup) {
if ($can == "✅") {
if ($coa < $coins) {
$max = $coins / $settm;
$maxmember = $max;
$maxmember2 = floor($maxmember);
$max1 = $settm * $maxmember;
$maxmember1 = floor($max1);
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "
• تم خصم ($max1) نقاط
- وبدء تمويل قناتك $maxmember2 عضو 🚸
<b>
- اذا قمت بطرد البوت من القناة او تنزيله من الادمنيه اثناء التمويل سيتم ستبعاد قناتك من التمويل !!!
</b>
",
"parse_mode" => "html",
]);
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$chat_id");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$url1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/createChatInviteLink?chat_id=$idch&expire_date=month&member_limit=9999"),1);
$urll = $url1["result"]["invite_link"];
$setting[$idch]["link"] = $urll;
$setting["chanel"][] = $idch;
$setting[$idch]["member1"] = $setting["$from_id"]["mem"];
$setting[$idch]["member"] = $setting["$from_id"]["mem"];
$setting[$idch]["admin"] = "$from_id";
$setting[$from_id]["order"][] = "$idch ";
$setting[$from_id]["mode"] = " ";
$setting[$from_id]["coins"] -= $max1;
file_put_contents("setting.json", json_encode($setting));
$mem = $setting[$from_id]['mem'];
bot("SendMessage", [
"chat_id" => "$admin[1]",
"text" => "
• تم بدء تمويل قناة : [$namech]($urll) | $mem عضو 🚸

- ايدي الشخص : [$from_id]
- اسم شخص : [$name](tg://openmessage?user_id=$from_id)
- عدد نفاط الشخص : $coins",
"parse_mode" => "markdown",
]);
bot("SendMessage", [
"chat_id" => "$admin[0]",
"text" => "
• تم بدء تمويل قناة : [$namech]($urll) | $mem عضو 🚸

- ايدي الشخص : [$from_id]
- اسم شخص : [$name](tg://openmessage?user_id=$from_id)
- عدد نفاط الشخص : $coins",
"parse_mode" => "markdown",
]);
} else {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "• عليك تجميع نقاط اكثر من $coa نقطه !",
"reply_to_message_id" => $message_id,
"parse_mode" => "html"
]);
}
} else {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
<b>• البوت ليس ادمن في قناة</b>",
"parse_mode" => "html"
]);
}
}
}
$infos1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$text&user_id=$idBot"), true);
$bot = $infos1['result']['status'];
$can_bot_invite = $infos1['result']['can_invite_users'];
if ($can_bot_invite == 1) {
$can = "✅";
} else {
$can = "❌";
}
if ($text and $mode == "chgl") {
if ($can == "✅") {
$max = 25 / $settm;
$maxmember = $setting["$from_id"]["mem"];
$max1 = $settm * $maxmember;
$maxmember1 = floor($max1);
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "
• تم خصم ($max1) نقاط
- وبدء تمويل قناتك $maxmember عضو 🚸
<b>
- اذا قمت بطرد البوت من القناة او تنزيله من الادمنيه اثناء التمويل سيتم ستبعاد قناتك من التمويل !!!
</b>
",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$text");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$url1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/createChatInviteLink?chat_id=$idch&expire_date=month&member_limit=9999"),1);
$urll = $url1["result"]["invite_link"];
$setting[$idch]["link"] = $urll;
$setting["chanel"][] = $idch;
$setting[$idch]["member1"] = $setting["$from_id"]["mem"];
$setting[$idch]["member"] = $setting["$from_id"]["mem"];
$setting[$idch]["admin"] = "$from_id";
$setting[$from_id]["order"][] = "$idch ";
$setting[$chat_id]["mode"] = " ";
$setting[$from_id]["coins"] -= $max1;
file_put_contents("setting.json", json_encode($setting));
$mem = $setting[$from_id]['mem'];
bot("SendMessage", [
"chat_id" => "$admin[1]",
"text" => "
• تم بدء تمويل قناة : [$namech]($urll) | $mem عضو 🚸

- ايدي الشخص : [$from_id]
- اسم شخص : [$name](tg://openmessage?user_id=$from_id)
- عدد نفاط الشخص : $coins",
"parse_mode" => "markdown",
]);
bot("SendMessage", [
"chat_id" => "$admin[0]",
"text" => "
• تم بدء تمويل قناة : [$namech]($urll) | $mem عضو 🚸

- ايدي الشخص : [$from_id]
- اسم شخص : [$name](tg://openmessage?user_id=$from_id)
- عدد نفاط الشخص : $coins",
"parse_mode" => "markdown",
]);
} else {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>• البوت ليس ادمن في قناة</b>",
"reply_to_message_id" => $message_id,
"parse_mode" => "html"
]);
}
}

$coinina = $setting[$chat_id2]["inv"];
$chs = $setting[$chat_id2]["chs"];
$gf = $setting[$chat_id2]["gf"];
$forw = $setting[$chat_id2]["forw"];
if ($data == "yourlink") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "
انسخ الرابط ثم قم بمشاركته مع اصدقائك 📥 .

- كل شخص يقوم بالدخول ستحصل على $priceforward نقطه 📊 .

- بإمكانك عمل اعلان خاص برابط الدعوة الخاص بك 📬 .

~ رابط الدعوة :

https://t.me/$userbot?start=$chat_id2

- مشاركتك للرابط : $coinina 🌀
",
'disable_web_page_preview' => 'true',
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]],
]
])
]);
}
if ($data == "infoaccount") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "<b>
• مرحبا بك في معلومات حسابك في بوت التمويل 🌀

- عدد القنوات او المجموعات الجاري تمويلها : 0
- عدد نقاط حسابك : $coins


- عدد عمليات التحويل التي قمت بها : $forw
- عدد القنوات التي شتركت بها : $chs
- عدد الهدايا اليومية التي جمعتها : $gf
- عدد الاعضاء الذي قمت بطلبهم في عمليات التمويل : 0

- عدد مشاركاتك لرابط الدعوة : $coinina

- المستخدمين الاكثر مشاركة لرابط الدعوى :
</b>
",
'disable_web_page_preview' => 'true', "parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]],
]
])
]);
}

$getjoinchannel = $setting[$chat_id2]["cc3"];
if ($data == "badchannel") {
$url4 = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$getjoinchannel");
$getchat4 = json_decode($url4, true);
$namech4 = $getchat4["result"]["title"];
$userch4 = $getchat4["result"]["username"];
$link4 = $setting[$id4]["link"];
$link4 = trim($link4,"https://t.me/");
$usernames = $update->callback_query->from->username;
$idusers = $update->callback_query->from->id;
$names = $update->callback_query->from->first_name;
$membercall = $update->callback_query->id;
bot('answercallbackquery', [
'callback_query_id' => $membercall,
'text' => "تم ارسال الابلاغ الى مبرمج البوت, وسوف يقوم بمراجعة القناة ومعرفة محتوى القناة ،
نشكرك للتعاون معنا♥️ !",
'show_alert' => true
]);
for ($d = 0; $d < 5; $d++) {
bot('sendmessage', [
'chat_id' => "$admin[$d]",
'text' => "
• بلاغ جديد على قناة : [$namech4]($link4) ❗️

- ايدي المبلغ : $idusers
- اسم المبلغ : -[$names](t.me/$usernames)",
'disable_web_page_preview' => 'true', 'parse_mode' => "Markdown",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "ابلاغ كاذب", "callback_data" => "h2"]],
[["text" => "الغاء تمويل القناة", "callback_data" => "detm"]]
]
])
]);
}
}
if ($data == "detm") {
bot('editmessagetext', [
'chat_id' => $chat_id2,
'message_id' => $message_id2,
'text' => "تم حذف القناة من التمويل",
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "•رجوع•", 'callback_data' => 'h2']],
]
])
]);
$arraychannel = $coinchannel - $getjoinchannel;
unset($setting[$idch]["member"]);
$a51 = array_search($idch,$setting["chanel"]);
unset($setting["chanel"]["$a51"]);
unset($setting[$idch]["admin"]);
$setting["chanel"] = array_values($setting["chanel"]);
$setting[$idch]["member"] = array_values($setting[$idch]["member"]);
$setting[$idch]["admin"]= array_values($setting[$idch]["admin"]);
file_put_contents("setting.json", json_encode($setting));
}
$KEYADMIN = json_encode([
"inline_keyboard" => [
[["text"=>"تعيين حساب المطور","callback_data"=>"setting##dev"]],
[["text"=>"تعيين قناة اثباتات","callback_data"=>"setting##setchs"]],
[["text"=>"هدية تلقائي:$gift50","callback_data"=>"gift50"],["text"=>"تعيين عدد الهدية التلقائية","callback_data"=>"setting##gift5"]],
[["text" => "تعيين نقاط الدخول", "callback_data" => "setting##setjoincoin"], ["text" => "سعر التمويل", "callback_data" => "setting##settm"]],
[["text" => "تعيين حد ادنى للنقاط", "callback_data" => "setting##coa"]],
[["text" => "تعيين عدد الهدية", "callback_data" => "setting##setgiftcoin"], ["text" => " الهدية:$gift1", "callback_data" => "ongift"]],
[["text" => "تعيين سعر الاشتراك", "callback_data" => "setting##pricez"]],
[["text" => "تعيين سعر عمولة التحويل", "callback_data" => "setting##priceforward"], ["text" => "صنع رابط هدية", "callback_data" => "createlink"]],
[["text" => "اذاعة قناة", "callback_data" => "sendch"]],
[["text" => "اضافة قناة", "callback_data" => "addcn"], ["text" => "مسح كل القنوات", "callback_data" => "delchaw"]],
[["text" => "جميع القنوات", "callback_data" => "allch"]],
]
]);


if ($text == "/start" and in_array($from_id, $admin) and $private) {
$setting["1$chat_id"] = " ";
file_put_contents("setting.json", json_encode($setting));
bot("SendMessage", [
"chat_id" => $chat_id,
"text" =>
"
- عدد النقاط الدخول :$invite
- عدد نقاط الاشتراك : $pricez
- سعر التمويل : $settm
- عموله التحويل : $priceforward
- ادنى حد للنقاط : $coa
- عدد نقاط الهديه اليوميه :$setgiftcoin

- يمكن للعضو ارسال <code>/id</code> لارسال الايدي الخاص به
",
"parse_mode" => "html",
"reply_markup" => $KEYADMIN
]);
}
if ($data == "ongift" and $gift1 != "✅") {
$setting["1$chat_id2"] = " ";
$setting["gift1"] = "✅";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
- عدد النقاط الدخول :$invite
- عدد نقاط الاشتراك : $pricez
- سعر التمويل : $settm
- عموله التحويل : $priceforward
- ادنى حد للنقاط : $coa
- عدد نقاط الهديه اليوميه :$setgiftcoin

- يمكن للعضو ارسال <code>/id</code> لارسال الايدي الخاص به
",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text"=>"تعيين حساب المطور","callback_data"=>"setting##dev"]],
[["text"=>"تعيين قناة اثباتات","callback_data"=>"setting##setchs"]],
[["text"=>"هدية تلقائي:$gift50","callback_data"=>"gift50"],["text"=>"تعيين عدد الهدية التلقائية","callback_data"=>"setting##gift5"]],
[["text" => "تعيين نقاط الدخول", "callback_data" => "setting##setjoincoin"], ["text" => "سعر التمويل", "callback_data" => "setting##settm"]],
[["text" => "تعيين حد ادنى للنقاط", "callback_data" => "setting##coa"]],
[["text" => "تعيين عدد الهدية", "callback_data" => "setting##setgiftcoin"], ["text" => " الهدية:✅", "callback_data" => "ongift"]],
[["text" => "تعيين سعر الاشتراك", "callback_data" => "setting##pricez"]],
[["text" => "تعيين سعر عمولة التحويل", "callback_data" => "setting##priceforward"], ["text" => "صنع رابط هدية", "callback_data" => "createlink"]],
[["text" => "اذاعة قناة", "callback_data" => "sendch"]],
[["text" => "اضافة قناة", "callback_data" => "addcn"], ["text" => "مسح كل القنوات", "callback_data" => "delchaw"]],
[["text" => "جميع القنوات", "callback_data" => "allch"]],
]
])
]);
}
if ($data == "ongift" and $gift1 == "✅") {
$setting["1$chat_id2"] = " ";
$setting["gift1"] = "❌";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
- عدد النقاط الدخول :$invite
- عدد نقاط الاشتراك : $pricez
- سعر التمويل : $settm
- عموله التحويل : $priceforward
- ادنى حد للنقاط : $coa
- عدد نقاط الهديه اليوميه :$setgiftcoin

- يمكن للعضو ارسال <code>/id</code> لارسال الايدي الخاص به
",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text"=>"تعيين حساب المطور","callback_data"=>"setting##dev"]],
[["text"=>"تعيين قناة اثباتات","callback_data"=>"setting##setchs"]],
[["text"=>"هدية تلقائي:$gift50","callback_data"=>"gift50"],["text"=>"تعيين عدد الهدية التلقائية","callback_data"=>"setting##gift5"]],
[["text" => "تعيين نقاط الدخول", "callback_data" => "setting##setjoincoin"], ["text" => "سعر التمويل", "callback_data" => "setting##settm"]],
[["text" => "تعيين حد ادنى للنقاط", "callback_data" => "setting##coa"]],
[["text" => "تعيين عدد الهدية", "callback_data" => "setting##setgiftcoin"], ["text" => " الهدية:❌", "callback_data" => "ongift"]],
[["text" => "تعيين سعر الاشتراك", "callback_data" => "setting##pricez"]],
[["text" => "تعيين سعر عمولة التحويل", "callback_data" => "setting##priceforward"], ["text" => "صنع رابط هدية", "callback_data" => "createlink"]],
[["text" => "اذاعة قناة", "callback_data" => "sendch"]],
[["text" => "اضافة قناة", "callback_data" => "addcn"], ["text" => "مسح كل القنوات", "callback_data" => "delchaw"]],
[["text" => "جميع القنوات", "callback_data" => "allch"]],
]
])
]);
}
$mode = $setting["1$from_id"];
if ($data == "allch") {
$r7j = 0;
$keyboard1 = [];
$order = $setting["chanel"];
foreach ($order as $row) {
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$order[$r7j]");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$mem = $setting["member"];
$d = $setting[$idch]["member"];
$keyboard1["inline_keyboard"][] = [["text" => "$namech", "url" => "t.me/$userch"], ["text" => "$mem[$r7j]/$d", "callback_data" => " "]];
$r7j++;
}
$keyboard1["inline_keyboard"][] = [["text" => "رجوع", "callback_data" => "h1"]];
$order1 = json_encode($keyboard1);
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "هنا جميع القنوات",
"reply_markup" => $order1
]);
}
if ($data == "createlink") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "<b>حسنا عزيزي ارسل عدد الهدية</b>",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
$setting["1$chat_id2"] = "$data";
file_put_contents("setting.json", json_encode($setting));
}
$rand = substr(str_shuffle("0123456789abcdefghiklmnopqrsuvwxyzABCDEFGHIKLMNOPQRSUVWXYZ"), -18);
if ($text and $mode == "createlink") {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "

• رابط تحويل النقاط : https://t.me/$userbot?start=J$rand

• ارسل الرابط للشخص المراد تحويل النقاط له 

• الرابط صالح لمده 15د

- يمكنك الضغط على زر تعطيل الرابط بعد اقل من 15د لكي تقوم بسترداد نقاطك او قم بدخول على الرابط لاسترداد نقاطك",
'disable_web_page_preview' => 'true',
'reply_markup' => json_encode([
"inline_keyboard" => [
[["text" => "تعطيل الرابط", "callback_data" => "breacklink"]],
[["text" => "رجوع", "callback_data" => "h2"]],
]
])
]);
$r = count($settig["forwad"]);
$setting["forward"][$rand]["coin"] = $text;
$setting["forward"][$rand]["niggaa"] = $chat_id;
$setting["forward"][$rand]["count"] = $r;
$setting["forwad"][] = $rand;
$setting[$from_id]["forward"] = " ";
$setting["1$chat_id"] = "";
file_put_contents("setting.json", json_encode($setting));
}
$ex = explode("J", $text);
$d = $setting["forwad"];
if (preg_match("/^\/(start) (J)/s", $text) and $private) {
if (in_array($ex[1], $d)) {
$c = $setting["forward"][$ex[1]]["coin"];
$v = $c + $coins;
$sed = $setting["forward"][$ex[1]]["niggaa"];
$d1 = $setting["forward"][$ex[1]]["count"];
bot('sendmessage', [
'chat_id' => $chat_id,
'text' => "• تم اضافة $c نقاط الى حسابك ✅
 • بواسطه رابط التحويل من قبل : مالك البوت

 • اصبحت نقاطك : $v",
'parse_mode' => "Markdown",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رجوع", "callback_data" => "h2"]]
]
])
]);
$setting[$sed]["forw"] += 1;
$setting[$from_id]["coins"] += $c;
$d1 = array_search($ex[1], $setting["forwad"]);
unset($setting["forwad"][$d1]);
file_put_contents("setting.json", json_encode($setting));
}
}
if ($data == "gift50" and $gift50 != "✅") {
$setting["1$chat_id2"] = " ";
$setting["gift50"] = "✅";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
- عدد النقاط الدخول :$invite
- عدد نقاط الاشتراك : $pricez
- سعر التمويل : $settm
- عموله التحويل : $priceforward
- ادنى حد للنقاط : $coa
- عدد نقاط الهديه اليوميه :$setgiftcoin

- يمكن للعضو ارسال <code>/id</code> لارسال الايدي الخاص به
",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text"=>"تعيين حساب المطور","callback_data"=>"setting##dev"]],
[["text"=>"تعيين قناة اثباتات","callback_data"=>"setting##setchs"]],
[["text"=>"هدية تلقائي:✅","callback_data"=>"gift50"],["text"=>"تعيين عدد الهدية التلقائية","callback_data"=>"setting##gift5"]],
[["text" => "تعيين نقاط الدخول", "callback_data" => "setting##setjoincoin"], ["text" => "سعر التمويل", "callback_data" => "setting##settm"]],
[["text" => "تعيين حد ادنى للنقاط", "callback_data" => "setting##coa"]],
[["text" => "تعيين عدد الهدية", "callback_data" => "setting##setgiftcoin"], ["text" => " الهدية:$gift1", "callback_data" => "ongift"]],
[["text" => "تعيين سعر الاشتراك", "callback_data" => "setting##pricez"]],
[["text" => "تعيين سعر عمولة التحويل", "callback_data" => "setting##priceforward"], ["text" => "صنع رابط هدية", "callback_data" => "createlink"]],
[["text" => "اذاعة قناة", "callback_data" => "sendch"]],
[["text" => "اضافة قناة", "callback_data" => "addcn"], ["text" => "مسح كل القنوات", "callback_data" => "delchaw"]],
[["text" => "جميع القنوات", "callback_data" => "allch"]],
]
])
]);
}
if ($data == "gift50" and $gift50 == "✅") {
$setting["1$chat_id2"] = " ";
$setting["gift50"] = "❌";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
- عدد النقاط الدخول :$invite
- عدد نقاط الاشتراك : $pricez
- سعر التمويل : $settm
- عموله التحويل : $priceforward
- ادنى حد للنقاط : $coa
- عدد نقاط الهديه اليوميه :$setgiftcoin

- يمكن للعضو ارسال <code>/id</code> لارسال الايدي الخاص به
",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text"=>"تعيين حساب المطور","callback_data"=>"setting##dev"]],
[["text"=>"تعيين قناة اثباتات","callback_data"=>"setting##setchs"]],
[["text"=>"هدية تلقائي:❌","callback_data"=>"gift50"],["text"=>"تعيين عدد الهدية التلقائية","callback_data"=>"setting##gift5"]],
[["text" => "تعيين نقاط الدخول", "callback_data" => "setting##setjoincoin"], ["text" => "سعر التمويل", "callback_data" => "setting##settm"]],
[["text" => "تعيين حد ادنى للنقاط", "callback_data" => "setting##coa"]],
[["text" => "تعيين عدد الهدية", "callback_data" => "setting##setgiftcoin"], ["text" => " الهدية:$gift1", "callback_data" => "ongift"]],
[["text" => "تعيين سعر الاشتراك", "callback_data" => "setting##pricez"]],
[["text" => "تعيين سعر عمولة التحويل", "callback_data" => "setting##priceforward"], ["text" => "صنع رابط هدية", "callback_data" => "createlink"]],
[["text" => "اذاعة قناة", "callback_data" => "sendch"]],
[["text" => "اضافة قناة", "callback_data" => "addcn"], ["text" => "مسح كل القنوات", "callback_data" => "delchaw"]],
[["text" => "جميع القنوات", "callback_data" => "allch"]],
]
])
]);
}
if ($data == "addcn") {
$setting["1$chat_id2"] = "addcn";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "<b>حسنا عزيزي ارسل العدد الان</b>",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
}
if ($text and $mode == "addcn") {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "حسنا ارسل معرف القناة وتأكد من رفع البوت ادمن"
]);
$setting["1$chat_id"] = "addcn1";
$setting[$from_id]['mem'] = $text;
file_put_contents("setting.json", json_encode($setting));
}
if ($text and $mode == "addcn1") {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "تم الحفظ"
]);
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$text");
$getchat = json_decode($url, true);
$namech = $getchat["result"]["title"];
$userch = $getchat["result"]["username"];
$idch = $getchat["result"]["id"];
$url1 = json_decode(file_get_contents("https://api.telegram.org/bot$token/createChatInviteLink?chat_id=$idch&expire_date=month&member_limit=9999"),1);
$urll = $url1["result"]["invite_link"];
$setting[$idch]["link"] = $urll;
$setting["chanel"][] = $idch;
$setting[$idch]["member1"] = $setting["$from_id"]["mem"];
$setting[$idch]["member"] = $setting["$from_id"]["mem"];
$setting[$idch]["admin"] = "$from_id";
$setting[$from_id]["order"][] = "$idch ";
$setting[$from_id]["mode"] = " ";
$setting["1$from_id"] = " ";
file_put_contents("setting.json", json_encode($setting));
}
if ($data == "h1") {
$setting["1$chat_id2"] = " ";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" =>
"
- عدد النقاط الدخول :$invite
- عدد نقاط الاشتراك : $pricez
- سعر التمويل : $settm
- عموله التحويل : $priceforward
- ادنى حد للنقاط : $coa
- عدد نقاط الهديه اليوميه :$setgiftcoin

- يمكن للعضو ارسال <code>/id</code> لارسال الايدي الخاص به
",
"parse_mode" => "html",
"reply_markup" => $KEYADMIN
]);
}
if ($data == "sendch") {
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "<b>حسنا عزيزي ارسل القناة</b>",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
$setting["1$chat_id2"] = "sendch";
file_put_contents("setting.json", json_encode($setting));
}
if ($text != "/start" and $mode == "sendch") {
$sddrf = str_replace(["https://t.me/", "t.me/", "@"], ["", "", ""], $text);
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>تم الحفظ \n ارسل عدد النقاط التي سيحصل على العضو من الاشتراك</b>",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
$setting["2$chat_id"] = "$sddrf";
$setting["1$chat_id"] = "sendmem";
file_put_contents("setting.json", json_encode($setting));
}
if ($text != "/start" and $mode == "sendmem") {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>تم الاذاعة</b>",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
$d = $setting["2$chat_id"];
$setting[$d] = "$text";
$setting["1$chat_id"] = "";
file_put_contents("setting.json", json_encode($setting));
$d1 = $setting["user"];
$d12 = $setting["2$chat_id"];
for ($d = 0; $d < count($d1); $d++) {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=@$d12");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
bot("SendMessage", [
"chat_id" => $d1[$d],
"text" => "<b>مرحبا عزيزي 🌏</b>
• يمكنك الحصول على $text نقاط مجانا كل ما عليك هو الاشتراك في <a href='t.me/$d12'>القناة</a>ثم الضغط على زر تم الاشتراك",
"parse_mode" => "html",
"reply_markup" => json_encode([
"inline_keyboard" => [
[["text" => "رابط القناة", "url" => "t.me/$d12"]],
[["text" => "تحقق من الاشتراك ✅", "callback_data" => "true##$d12"]]
]
])
]);
}
}
$ex = explode("##", $data);

$d = $setting[$chat_id2]["adch"];
if ($ex[0] == "true") {
if (!in_array("$ex[1]", $d)) {
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $ex[1] . "&user_id=" . $chat_id2));
$okchannel = $getchannel->result->status;
if ($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator') {
bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
اشترك في القناة اولأ!!",
'show_alert' => true,
]);
} else {
bot("deletemessage", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
]);
$d = $setting[$ex[1]];
$coins = $coins + $d;
bot("sendmessage", [
"chat_id" => $chat_id2,
"text" => "
<b>
• حصلت على $d نقطة بسبب الاشتراك في القناة 🦾
• ملاحظه : اذا قمت ب مغادره القناة سيتم خصم ضعف النقاط من حسابك 👋

</b>
 اصبحت نقاطك : $coins",
"parse_mode" => "html",
]);
$setting["$chat_id2"]["coins"] += $setting[$ex[1]];
$setting["$chat_id2"]["adch"][] = $ex[1];
file_put_contents("setting.json", json_encode($setting));
}
} else {
bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
لقد حصلت على نقاط سابقأ!!",
'show_alert' => true,
]);
}
}


$ex = explode("##", $data);
if ($ex[1] == "setjoincoin") {
$S = "<b>• ارسل عدد النقاط التي يحصل عليها المستخدم من مشاركة الرابط الخاص به .</b>";
} elseif ($ex[1] == "settm") {
$S = "<b>• ارسل عدد النقاط مقابل العضو الواحد 📬</b>";
} elseif ($ex[1] == "coa") {
$S = "<b>• ارسل حد ادنى للنقاط</b>";
} elseif ($ex[1] == "pricez") {
$S = "<b>• ارسل سعر الاشتراك مقابل القناة الواحدة</b>";
} elseif ($ex[1] == "priceforward") {
$S = "<b>• ارسل عدد النقاط التي تخصم عند التحويل 📬</b>";
} elseif ($ex[1] == "setgiftcoin") {
$S = "<b>• ارسل عدد النقاط التي يحصل عليها المستخدم من الهدية .</b>";
}
elseif ($ex[1] == "setchs") {
$S = "<b>• ارسل معرف القناة وتأكد من رفع البوت ادمن فيها .</b>";
}
elseif ($ex[1] == "gift5") {
$S = "<b>• ارسل عدد النقاط التي يحصل عليه العضو الجديد .</b>";
}
elseif ($ex[1] == "dev") {
$S = "<b>• ارسل معرف حساب المطور او بوت تواصل   .</b>";
}
if ($ex[0] == "setting") {
$setting["1$chat_id2"] = "$ex[1]";
file_put_contents("setting.json", json_encode($setting));
bot("EditMessageText", [
"chat_id" => $chat_id2,
"message_id" => $message_id2,
"text" => "$S",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
}
if ($text and $mode == "setjoincoin" or $mode == "settm" or $mode == "coa" or $mode == "pricez" or $mode == "priceforward" or $mode == "setgiftcoin" or $mode =="setchs" or $mode == "gift5" or $mode == "dev") {
bot("SendMessage", [
"chat_id" => $chat_id,
"text" => "<b>• تم الحفظ</b>",
"parse_mode" => "html",
"reply_markup" => $KEYBACK1
]);
$setting["$mode"] = $text;
$setting["1$chat_id"] = " ";
file_put_contents("setting.json", json_encode($setting));
}

