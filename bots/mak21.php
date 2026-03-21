<?php#*wataw*
#حساب العمر

if($start=="non"){
$start="
اهلا بك
- في بوت حساب العمر بالتفصيل .
- يمكنك استخراج عمرك من خلال البوت  .
- ارسل تاريخ ميلادك كمثال :
1997/6/28 .
";}

$update = json_decode(file_get_contents('php://input'));
$fromid= $update->callback_query->from->id;
$username = $update->message->from->username;
$message = $update->message;
$textmsg = $message->text;
$for = $message->from->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$from_id = $message->from->id;
$name = $update->message->from->first_name;
 $chat_id = $message->chat->id;
 $message_id = $message->message_id;

$message  = $update->message;
$from_id  = $message->from->id;
$chat_id  = $message->chat->id;
$text     = $message->text;
$data     = $update->callback_query->data;
$inline   = $update->inline_query->query;
$id       = $update->inline_query->from->id;
$msg_id   = $update->inline_query->inline_message_id;
$username = $update->inline_query->from->username;
$cuser    = $update->callback_query->from->username;
$cid      = $update->callback_query->from->id;

if ($text == '/start') {
bot('sendMessage',['chat_id'=>$chat_id,
'text'=>"$start

$txtfree",
'reply_to_message_id'=>$message->message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'parse_mode'=>"html",]);}

if($text  != "/start" ){
$hours_in_day = 24;
$minutes_in_hour = 60;
$seconds_in_mins = 60;
$fractions_seconds = 100;
$food_in_day = 3;
$hours_in_sleep = 8;
$laug_in_day = 10;
$dw_in_min = 175;
$tnsf_in_min = 1;
$birth_date = new DateTime($text);
$current_date = new DateTime();
date_default_timezone_set("Asia/Baghdad");
$date = date('n');
$dat = date('j');
$diff = $birth_date->diff($current_date);
$years = $diff->y;
$mn = $diff->m;
$doy = $diff->d;
$ho = ($diff->h);
$months = ($diff->y * 12);
$weeks = floor($diff->days/7); echo "\n";
$days = $diff->days;
$dd = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour * $dw_in_min);
$dd1 = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour * $seconds_in_mins * $tnsf_in_min);
$hours = $diff->h + ($diff->days * $hours_in_day);
$food = $diff->h + ($diff->days * $food_in_day);
$laug = $diff->h + ($diff->days * $laug_in_day);
$sleep = $diff->h + ($diff->days * $hours_in_sleep);
$mins = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour);
$seconds = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour * $seconds_in_mins);
$seconds1 = $diff->h + ($diff->days * $hours_in_day * $minutes_in_hour * $seconds_in_mins * $fractions_seconds);
bot('Sendmessage',['chat_id'=>$chat_id,
'text'=>" 
📝| تاريخ ميلادك هو <b>$text

⚖️| معلومات عمرك هيه 💋 : 

- المدة التي عشتها : $years سنوات و $mn شهر و $doy يوم و $ho ساعة 

- عدد الاشهر التي عشتها : $months شهر
- عدد الايام التي عشتها : $days يوم
- عدد الساعات التي عشتها : $hours ساعه
- عدد الدقائق التي عشتها : $mins دقيقة
- عدد الثواني التي عشتها : $seconds ثانيه
- عدد اجزاء الثانية التي عشتها : $seconds1 ميلي ثانيه

- عدد وجبات الطعام التي اكلتها : $food وجبه
- عدد الساعات التي نمتها : $sleep ساعه
- عدد الضحكات التي ضحكتها : $laug ضحكه
- عدد نبضات التي نبضتها : $dd نبضه 
- تنفست حوالي : $dd1 مره 
</b>",
"parse_mode"=>"html",]);}

