<?php#*wataw*

if ($text == '/start' ){
bot('sendMessage',['chat_id'=>$chat_id, 
'text'=>"- أهلا بك عزيزي
- بوت حذف ( مسح ) خلفيات الصور
- فقط أرسل الصوره وأنتظر ثواني...

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);}

if($message->photo){
define('token', $token);
$data = json_decode(json_encode($message),true);
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.telegram.org/bot'. token .'/getfile?file_id='.$data["photo"][count($data["photo"]) -1]["file_id"] ,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',));
$response = json_decode(curl_exec($curl), true);
curl_close($curl);
if($response["ok"]){
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.remove.bg/v1.0/removebg',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => array('image_url'=> "https://api.telegram.org/file/bot". token ."/".$response["result"]["file_path"],
'size' => 'auto'),
CURLOPT_HTTPHEADER => array('X-Api-Key: 5Gv5DVmbqagQkKRziaMbY8em'),
));
$response = curl_exec($curl);
curl_close($curl);
if(json_decode($response, true)["errors"]){
bot("sendmessage",["chat_id"=>$chat_id,"text"=>json_decode($response, true)["errors"][0]["title"]]);
}else{
file_put_contents("BxxBot.png", $response);
bot("senddocument",["chat_id"=>$from_id,
"document"=>new CURLFILE('./BxxBot.png')]);
unlink("./BxxBot.png");}}}

