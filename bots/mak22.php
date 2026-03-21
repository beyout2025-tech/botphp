<?php#*wataw*

if($start == "non"){
$start = "
👋🏻 أهلاً بك
📑 في بوت تحميل ستوري انستكرام.
💡فقط قم بإرسال يوزر الحساب مع ( @ ).
📈 البوت لا يستطيع التحميل من الحسابات الخاصة..
📉 فقط قم بإرسال الحسابات العامة لتحميلها.
";}

function dop($vu){
$usert = "$usernamebot";
$get = curl_init();
curl_setopt($get, CURLOPT_URL, 'https://iggram.net/search/?key='.$usert);
curl_setopt($get, CURLOPT_HTTPHEADER, array('origin: https://iggram.net', 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'));
curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
curl_setopt($get, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($get);
curl_close($get);
$responser = explode('<div class="search-result-box" id="search-profile-results" style="display: block;">',$response)[1];
$responser = explode('<div class="search-result-box" id="search-tags-results" style="display: none;">',$responser)[0];
$res = explode('<div class="result-ava">',$responser);
for ($i =0; $i <= count($res); $i++) {
preg_match('#<a href="(.*?)">#',$res[$i],$echo);
preg_match('/(\w+)&/',$echo[1],$username);
preg_match('/(\d+)/',$echo[1],$userid);
if($username[1] == $usert){
$get = curl_init();
curl_setopt($get, CURLOPT_URL, 'https://iggram.net/profile/?key='.$username[1].'&user_id='.$userid[1]);
curl_setopt($get, CURLOPT_HTTPHEADER, array('origin: https://iggram.net', 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'));
curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
curl_setopt($get, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($get);
curl_close($get);
preg_match_all('/data-postid="(.*?)"/', $response, $matches);
break;}}
$curl = curl_init("https://iggram.net/wp-admin/admin-ajax.php");
curl_setopt($curl, CURLOPT_URL,"https://iggram.net/wp-admin/admin-ajax.php");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array("Content-Type: application/x-www-form-urlencoded",);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$data = "action=stories_API&datakey=".$username[1]."&datauserid=".$userid[1]."&datapostid=".$matches[1][0];
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
$_ex = explode('<div class="item">',$resp);
$array['ok'] = true;
for($i=1;$i<count($_ex);$i++) {
preg_match('/data-post-type="(.*?)"/', $_ex[$i], $type);
preg_match('/data-stories="stories" href="(.*?)"/', $_ex[$i], $href);
$array['results'][] = [
'type' => $type[1],
'url'  => $href[1],];}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$user_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$TokenInfo = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$UserBot = $TokenInfo->result->username; 

if($text == '/start'){
bot('sendmessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id]);}

if(strstr($text,"@")){
$ci = bot('sendmessage',['chat_id'=>$chat_id,'text'=>"*جار معالجه اليوزر انتظر قليلاً* ..🔄",'parse_mode'=>'Markdown'])->result->message_id;
$FunctionGet = json_decode(dop(str_replace('@','',$text)), true);
if($FunctionGet["ok"] == false){
bot('editMessageText',['chat_id'=>$chat_id,'message_id' =>$ci,'text' => "*الحساب خاص او ان الشخص لم يرفع استوريات..*",'parse_mode' => 'Markdown']);
}else{
bot('editMessageText',['chat_id'=>$chat_id,'message_id' =>$ci,'text' => "*جار التحميل ..*",'parse_mode' => 'Markdown']);
for ($i=0; $i < count($FunctionGet["result"]["storys"]); $i++) {
if(preg_match('/(.*?)(mp4)(.*?)/',$FunctionGet["result"]["storys"][$i])){
bot("sendvideo",["chat_id"=>$chat_id,"video"=>$FunctionGet["result"]["storys"][$i],'caption'=>"- @".$UserBot." ✅."]);
}else{
bot("sendPhoto",["chat_id"=>$chat_id,"photo"=>$FunctionGet["result"]["storys"][$i],'caption'=>"- @".$UserBot." ✅."]);}}
bot('deleteMessage',['chat_id'=>$chat_id,'message_id'=>$ci]);
bot('sendmessage',['chat_id'=>$chat_id,'text'=>"تم التحميل بنجاح ✅",'parse_mode'=>'Markdown']);}}

