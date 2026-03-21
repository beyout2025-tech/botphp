<?php#*wataw*

if($start=="non"){
$start = "
👋🏻 اهلا بك عزيزي @$user
◽ في بوت فيديوهات ستوري 🎥 ،
◽ يمكنك عن طريق البوت سحب فيديوهات خاصة بستوريات الانستكرام 🔬 ،

◽ الان قم بالضغط على زر عرض الفيديوهات لعرض الفيديوهات لك 📽️ ،
";}

$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$name = $message->from->first_name;
$user = $message->from->username;
$message_id = $update->message->message_id;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$data = $update->callback_query->data;
$name = $message->from->first_name;
$user = $message->from->username;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$chat_id = $message->chat->id;
$name = $message->from->first_name;
$username = $update->message->from->username;
$reply = $message->reply_to_message->message_id;
$rep = $message->reply_to_message->forward_from; 
$from_id = $message->from->id;
$name = $update->message->from->first_name;
$first_name = $message->from->first_name;
$chat_id = $message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$name = $message->from->first_name;
$user = $message->from->username;
$from_id = $message->from->id;

if($text == '/start'){
bot('sendMessage',['chat_id'=>$chat_id,
'message_id'=>$message_id2,
'text'=>"
$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>'true',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- عرض الفيديوهات 🎥.",'callback_data'=>"zjz"]],
]])]);}

if ($data == "fm"){
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"
$start

$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"- عرض الفيديوهات 🎥.",'callback_data'=>"zjz"]],
]])]);}

if ($data == "zjz" ){
bot('EditMessageText',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>'
◽ تم عرض لك قائمة الفيديوهات 🎥 ،
◽ اضغط على اي رقم تريده وسوف ارسل لك الفيديو 📽️ ،
◽ الفيديوهات جميعها لستوريات الانستكرام ♥️ ،
',
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'1','callback_data'=>'f1'],['text'=>'2','callback_data'=>'f2'],['text'=>'3','callback_data'=>'f3'],['text'=>'4','callback_data'=>'f4'],['text'=>'5','callback_data'=>'f5']],
[['text'=>'6','callback_data'=>'f6'],['text'=>'7','callback_data'=>'f7'],['text'=>'8','callback_data'=>'f8'],['text'=>'9','callback_data'=>'f9'],['text'=>'10','callback_data'=>'f10']],
[['text'=>'11','callback_data'=>'f11'],['text'=>'12','callback_data'=>'f12'],['text'=>'13','callback_data'=>'f13'],['text'=>'14','callback_data'=>'f14'],['text'=>'15','callback_data'=>'f15']],
[['text'=>'16','callback_data'=>'f16'],['text'=>'17','callback_data'=>'f17'],['text'=>'18','callback_data'=>'f18'],['text'=>'19','callback_data'=>'f19'],['text'=>'20','callback_data'=>'f20']],
[['text'=>'21','callback_data'=>'f21'],['text'=>'22','callback_data'=>'f22'],['text'=>'23','callback_data'=>'f23'],['text'=>'24','callback_data'=>'f24'],['text'=>'25','callback_data'=>'f25']],
[['text'=>'26','callback_data'=>'f26'],['text'=>'27','callback_data'=>'f27'],['text'=>'28','callback_data'=>'f28'],['text'=>'29','callback_data'=>'f29'],['text'=>'30','callback_data'=>'f30']],
[['text'=>'31','callback_data'=>'f31'],['text'=>'32','callback_data'=>'f32'],['text'=>'33','callback_data'=>'f33'],['text'=>'34','callback_data'=>'f34'],['text'=>'35','callback_data'=>'f35']],
[['text'=>'36','callback_data'=>'f36'],['text'=>'37','callback_data'=>'f37'],['text'=>'38','callback_data'=>'f38'],['text'=>'39','callback_data'=>'f39'],['text'=>'40','callback_data'=>'f40']],
[['text'=>'41','callback_data'=>'f41'],['text'=>'42','callback_data'=>'f42'],['text'=>'43','callback_data'=>'f43'],['text'=>'44','callback_data'=>'f44'],['text'=>'45','callback_data'=>'f45']],
[['text'=>'46','callback_data'=>'f46'],['text'=>'47','callback_data'=>'f47'],['text'=>'48','callback_data'=>'f48'],['text'=>'49','callback_data'=>'f49'],['text'=>'50','callback_data'=>'f50']],
[['text'=>"- رجوع 🚸 ،",'callback_data'=>"fm"]],]])]);}

if ($data == 'f1'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/0Pvd",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f2"]],]])]);}


if ($data == 'f2'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/bFlr",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f3"]],]])]);}


if ($data == 'f3'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/ZsEb",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f4"]],]])]);}


if ($data == 'f4'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/xlM4",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f5"]],]])]);}


if ($data == 'f5'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/WNc5",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f6"]],]])]);}


if ($data == 'f6'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/bwCs",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f7"]],]])]);}


if ($data == 'f7'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/pnAX",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f8"]],]])]);}


if ($data == 'f8'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/QPlO",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f9"]],]])]);}


if ($data == 'f9'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/J2gC",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f10"]],]])]);}


if ($data == 'f10'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/6naN",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f11"]],]])]);}


if ($data == 'f11'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/ao6W",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f12"]],]])]);}


if ($data == 'f12'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/0stC",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f13"]],]])]);}


if ($data == 'f13'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/EfC7",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f14"]],]])]);}


if ($data == 'f14'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/Y7xb",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f15"]],]])]);}


if ($data == 'f15'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/jMHh",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f16"]],]])]);}


if ($data == 'f16'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/GXom",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f17"]],]])]);}


if ($data == 'f17'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/iE0k",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f18"]],]])]);}


if ($data == 'f18'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/pl5M",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f19"]],]])]);}


if ($data == 'f19'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/Gh7W",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f20"]],]])]);}


if ($data == 'f20'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/t21e",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f21"]],]])]);}


if ($data == 'f21'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/BJZS",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f22"]],]])]);}


if ($data == 'f22'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/czy6",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f23"]],]])]);}


if ($data == 'f23'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/SpD5",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f24"]],]])]);}


if ($data == 'f24'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/8NH2",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f25"]],]])]);}


if ($data == 'f25'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/ku2H",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f26"]],]])]);}


if ($data == 'f26'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/R8ut",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f27"]],]])]);}


if ($data == 'f27'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/GgtR",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f28"]],]])]);}


if ($data == 'f28'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/5Cwd",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f29"]],]])]);}


if ($data == 'f29'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/8gP8",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f30"]],]])]);}


if ($data == 'f30'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/Yeb7",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f31"]],]])]);}


if ($data == 'f31'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/8u3T",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f32"]],]])]);}


if ($data == 'f32'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/6zba",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f33"]],]])]);}


if ($data == 'f33'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/lAhE",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f34"]],]])]);}


if ($data == 'f34'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/st8P",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f35"]],]])]);}


if ($data == 'f35'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/E1kX",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f36"]],]])]);}


if ($data == 'f36'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/pXiB",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f37"]],]])]);}


if ($data == 'f37'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/OltX",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f38"]],]])]);}


if ($data == 'f38'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/QFH7",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f39"]],]])]);}


if ($data == 'f39'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/2CoC",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f40"]],]])]);}


if ($data == 'f40'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/aYUL",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f41"]],]])]);}


if ($data == 'f41'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/2MnZ",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f42"]],]])]);}


if ($data == 'f42'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/eYqg",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f43"]],]])]);}


if ($data == 'f43'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/1ny8",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f44"]],]])]);}


if ($data == 'f44'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/uPq4",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f45"]],]])]);}


if ($data == 'f45'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/PlRn",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f46"]],]])]);}


if ($data == 'f46'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/hOCK",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f47"]],]])]);}


if ($data == 'f47'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/nGCo",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f48"]],]])]);}


if ($data == 'f48'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/eYqg",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f49"]],]])]);}


if ($data == 'f49'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/rLou",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"f50"]],
]])]);}

if ($data == 'f50'){
bot('sendVideo',['chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'video'=>"https://0i.is/VqEF",
'caption'=>"
- تم تحميل الفيديو لك 🎥.
- لتحميل فيديو اخر اضغط على زر فيديو جديد 👋🏻.

$txtfree",
'parse_mode'=>"html",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>'- فيديو جديد 🎥','callback_data'=>"zjz"]],]])]);}

