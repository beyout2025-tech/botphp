<?php#*wataw*

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$username = $update->message->from->username;
$from_id = $update->message->from->id;
$message_id = $message->message_id;


if(isset($update->callback_query)){
    $chat_id = $update->callback_query->message->chat->id;
    $message_id = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    $callback_query = $update->callback_query;
    $username = $callback_query->from->username;
    $from_id = $callback_query->from->id;
$luck = rand(1,4);
if($data == "startgame"){
for ($i=1; $i <= 4; $i++) {
if($i == $luck){
$json[] = ['open' => false,'luck'=>true];
}else{
$json[] = ['open' => false,'luck'=>false];
}
}
$jsonend = ['ok'=>true,'game'=>$json,'iopen'=>1];
file_put_contents("data/$from_id.json",json_encode($jsonend));
$rows = array_chunk($json, 2);
$x = 0;
    $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = $row;
                foreach($bottons as $botton){
                    $textkey = $json[$x]['open'];
                    if($textkey){
                    $Ibotton = ["text" => "✋🏻", "callback_data" =>"opened"];
                    }else{
                    $Ibotton = ["text" => "👊🏻", "callback_data" =>"open_".$x];
                    }
                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
               $x++;
                }
                $i++;
            }
$Ibotton = ["text" => "خروج", "callback_data" =>'exit'];
$keyboard["inline_keyboard"][$i][] = $Ibotton;
    $reply_markup=json_encode($keyboard);
 bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
   'text'=>"اختار اليد التي تريد ان تكتشف فيها المحبس 💍.

ملاحظة لك محاولتين : اذا غلطت مرة الثانية تخسر ❤️",
   'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
                  'reply_markup'=>$reply_markup
        ]);
}
if(preg_match('/^(open)_(.*)/',$data)){
preg_match('/^(open)_(.*)/',$data,$match);
$x = $match[2];
$GetJson = json_decode(file_get_contents("data/$from_id.json"));
$iopen = $GetJson->iopen;
if($iopen == 1){
$luck = $GetJson->game[$x]->luck;
if($luck){
$json = $GetJson->game;
$rows = array_chunk($json, 2);
$x = 0;
    $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = $row;
                foreach($bottons as $botton){
                    $textkey = $GetJson->game[$x]->luck;
                    if($textkey){
                    $Ibotton = ["text" => "💍", "callback_data" =>"#"];
                    }else{
                    $Ibotton = ["text" => "👊🏻", "callback_data" =>"#"];
                    }
                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
               $x++;
                }
                $i++;
            }
$Ibotton = ["text" => "اللعب مرة اخرى", "callback_data" =>'startgame'];
$keyboard["inline_keyboard"][$i][] = $Ibotton;
    $reply_markup=json_encode($keyboard);
 bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
   'text'=>"مبروك لقد فزت 🎊",
                  'reply_markup'=>$reply_markup
        ]);
unlink("data/$from_id.json");

}else {
$GetJson->game[$x]->open = true;
$GetJson->iopen = $iopen + 1;
file_put_contents("data/$from_id.json",json_encode($GetJson));

$GetJson = json_decode(file_get_contents("data/$from_id.json"));
$json = $GetJson->game;
$rows = array_chunk($json, 2);
$x = 0;
    $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = $row;
                foreach($bottons as $botton){
                    $textkey = $GetJson->game[$x]->open;
                    if($textkey){
                    $Ibotton = ["text" => "✋🏻", "callback_data" =>"opened"];
                    }else{
                    $Ibotton = ["text" => "👊🏻", "callback_data" =>"open_".$x];
                    }
                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
               $x++;
                }
                $i++;
            }
$Ibotton = ["text" => "خروج", "callback_data" =>'exit'];
$keyboard["inline_keyboard"][$i][] = $Ibotton;
    $reply_markup=json_encode($keyboard);
 bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
   'text'=>"خطأ تبقت لديك محاولة واحدة",
   'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
                  'reply_markup'=>$reply_markup
        ]);
}
}
if($iopen == 2){
$luck = $GetJson->game[$x]->luck;
if($luck){
$json = $GetJson->game;
$rows = array_chunk($json, 2);
$x = 0;
    $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = $row;
                foreach($bottons as $botton){
                    $textkey = $GetJson->game[$x]->luck;
                    if($textkey){
                    $Ibotton = ["text" => "💍", "callback_data" =>"#"];
                    }else{
                    $textkeya = $GetJson->game[$x]->open;
                    if($textkeya){
                    $Ibotton = ["text" => "✋🏻", "callback_data" =>"opened"];
                    }else{
                    $Ibotton = ["text" => "👊🏻", "callback_data" =>"open_".$x];
                    }
                    }
                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
               $x++;
                }
                $i++;
            }
$Ibotton = ["text" => "اللعب مرة اخرى", "callback_data" =>'startgame'];
$keyboard["inline_keyboard"][$i][] = $Ibotton;
    $reply_markup=json_encode($keyboard);
 bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
   'text'=>"مبروك لقد فزت 🎊",
                  'reply_markup'=>$reply_markup
        ]);
unlink("data/$from_id.json");
}else {
$GetJson->game[$x]->open = true;
file_put_contents("data/$from_id.json",json_encode($GetJson));

$GetJson = json_decode(file_get_contents("data/$from_id.json"));
$json = $GetJson->game;
$rows = array_chunk($json, 2);
$x = 0;
    $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = $row;
                foreach($bottons as $botton){
                    $textkey = $GetJson->game[$x]->luck;
                    if($textkey){
                    $Ibotton = ["text" => "💍", "callback_data" =>"#"];
                    }else{
                    $textkeya = $GetJson->game[$x]->open;
                    if($textkeya){
                    $Ibotton = ["text" => "✋🏻", "callback_data" =>"opened"];
                    }else{
                    $Ibotton = ["text" => "👊🏻", "callback_data" =>"open_".$x];
                    }
                    }


                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
               $x++;
                }
                $i++;
            }
$Ibotton = ["text" => "اللعب مرة اخرى", "callback_data" =>'startgame'];
$keyboard["inline_keyboard"][$i][] = $Ibotton;
    $reply_markup=json_encode($keyboard);
 bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
   'text'=>"خطأ لقد خسرت",
   'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
                  'reply_markup'=>$reply_markup
        ]);
unlink("data/$from_id.json");
}
}
}
if($data == "opened"){
bot('answerCallbackQuery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"عذراً, لقد قمت بكشف اليد هذه"
    ]);
}
if($data == "exit"){
unlink("data/$from_id.json");
 bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id,
   'text'=>"مرحبا بكم في لعبة المحيبس ✊🏻

اضغط على بدأ للعب اللعبة.
$txtfree",
   'parse_mode'=>'html',
'disable_web_page_preview'=>'true',
                  'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"بدأ",'callback_data'=>"startgame"],
                        ]
                ]
            ])
]);
}
//---------------
}

if($text == "/start"){
                bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"مرحبا بكم في لعبة المحيبس ✊🏻

اضغط على بدأ للعب اللعبة.
$txtfree",
   'parse_mode'=>'html',
'disable_web_page_preview'=>'true',
                  'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"بدأ",'callback_data'=>"startgame"],
                        ]
                ]
            ])
]);
}
