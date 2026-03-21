<?php#*wataw*

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$id = $message->from->id;
$chat_id = $message->chat->id;
$bot = '@'.bot('getme',['bot'])->result->username;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data     = $update->callback_query->data;

$temp = json_decode(file_get_contents('temp.json'),true);
$msg = json_decode(file_get_contents('msgs.json'),true);
if ($message->photo or $message->document or $message->video or $message->voice or $message->audio) {
    $text = $message->caption;
}
if (!file_exists('temp.json')) {
    file_put_contents("temp.json", '{}');
}if (!file_exists('msgs.json')) {
    file_put_contents("msgs.json", '{"last":1}');
}
if ($text == '/start') {
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"
. - اهلا بك عزيزي في بوت صنع كودات ( ازرار شفافه) 
- اضغط على 'انشاء رساله جديده' لصنع منشور خاص بك . 
$txtfree",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']],
            
            ]
            ])
        ]);
}

if ($data == 'cr') {
    $temp[$chat_id2]['mode'] = 'head';
    bot('editMessageText',[
        'chat_id'=>$chat_id2,
        'message_id'=>$message_id,
        'text'=>"
- حسنا عزيزي الآن قم بأرسال النص الأعلى . 
- يمكن أن يكون ( نص، صوره، ملصق، فيديو، اغنيه، بصمه، ملف، متحركه) . 
", 
        ]);
         file_put_contents('temp.json', json_encode($temp));
}
if ($temp[$chat_id]['mode'] == 'head') {
    if ($message->text) {
        $temp[$chat_id]['type'] = 'text';
        $temp[$chat_id]['text'] = $text;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ النص الأعلى . 
- هل تريد اضافة ازرار شفافة الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم ",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));
    }
    if ($message->photo) {
        $temp[$chat_id]['type'] = 'photo';
        $temp[$chat_id]['caption'] = $text;
        $temp[$chat_id]['file_id'] = $message->photo[0]->file_id;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ الصوره . 
- هل تريد اضافة ازرار شفافة الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));    
    }
    if ($message->video) {
        $temp[$chat_id]['type'] = 'video';
        $temp[$chat_id]['caption'] = $text;
        $temp[$chat_id]['file_id'] = $message->video->file_id;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ الفيديو . 
- هل تريد اضافة ازرار شفافة الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));    
    }
    if ($message->voice) {
        $temp[$chat_id]['type'] = 'voice';
        $temp[$chat_id]['caption'] = $text;
        $temp[$chat_id]['file_id'] = $message->voice->file_id;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ البصمه . 
- هل تريد اضافة ازرار شفافة الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));    
    }
    if ($message->audio) {
        $temp[$chat_id]['type'] = 'audio';
        $temp[$chat_id]['caption'] = $text;
        $temp[$chat_id]['file_id'] = $message->audio->file_id;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ الأغنيه . 
- هل تريد اضافة ازرار شفافة الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));    
    }
     if ($message->sticker) {
        $temp[$chat_id]['type'] = 'sticker';
        $temp[$chat_id]['caption'] = $text;
        $temp[$chat_id]['file_id'] = $message->sticker->file_id;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ الملصق . 
- هل تريد اضافة ازرار شفافة الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));    
    }
    if ($message->document) {
        $temp[$chat_id]['type'] = 'doc';
        $temp[$chat_id]['caption'] = $text;
        $temp[$chat_id]['file_id'] = $message->document->file_id;
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"- تم حفظ الملف . 
- هل تريد اضافة ازرار شفافه الآن؟ ",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>"- نعم",'callback_data'=>'yes'],['text'=>"- لا",'callback_data'=>"no"]]
                ]
                ])
            ]);
        $temp[$chat_id]['mode'] = null;
    file_put_contents('temp.json', json_encode($temp));    
    }
}
if ($data == 'no') {
    bot('editMessageText',[
        'chat_id'=>$chat_id2,
        'message_id'=>$message_id,
        'text'=>'- انتظر ثواني ... '
        ]);
    if ($temp[$chat_id2]['type'] == 'text') {
        $msg[$msg['last'] + 1]['type'] = 'text';
        $msg[$msg['last'] + 1]['text'] = $temp[$chat_id2]['text'];
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$temp[$chat_id2]['text'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    if ($temp[$chat_id2]['type'] == 'photo') {
        $msg[$msg['last'] + 1]['type'] = 'photo';
        $msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id2]['file_id'];
        $msg[$msg['last'] + 1]['caption'] = $temp[$chat_id2]['caption'];
        bot('sendPhoto',[
            'chat_id'=>$chat_id2,
            'file_id'=>$temp[$chat_id2]['file_id'],
            'caption'=>$temp[$chat_id2]['caption'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    if ($temp[$chat_id2]['type'] == 'video') {
        $msg[$msg['last'] + 1]['type'] = 'video';
        $msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id2]['file_id'];
        $msg[$msg['last'] + 1]['caption'] = $temp[$chat_id2]['caption'];
        bot('sendvideo',[
            'chat_id'=>$chat_id2,
            'file_id'=>$temp[$chat_id2]['file_id'],
            'caption'=>$temp[$chat_id2]['caption'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    if ($temp[$chat_id2]['type'] == 'audio') {
        $msg[$msg['last'] + 1]['type'] = 'audio';
        $msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id2]['file_id'];
        $msg[$msg['last'] + 1]['caption'] = $temp[$chat_id2]['caption'];
        bot('sendaudio',[
            'chat_id'=>$chat_id2,
            'file_id'=>$temp[$chat_id2]['file_id'],
            'caption'=>$temp[$chat_id2]['caption'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    if ($temp[$chat_id2]['type'] == 'voice') {
        $msg[$msg['last'] + 1]['type'] = 'voice';
        $msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id2]['file_id'];
        $msg[$msg['last'] + 1]['caption'] = $temp[$chat_id2]['caption'];
        bot('sendvoice',[
            'chat_id'=>$chat_id2,
            'file_id'=>$temp[$chat_id2]['file_id'],
            'caption'=>$temp[$chat_id2]['caption'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    if ($temp[$chat_id2]['type'] == 'sticker') {
        $msg[$msg['last'] + 1]['type'] = 'sticker';
        $msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id2]['file_id'];
        $msg[$msg['last'] + 1]['caption'] = $temp[$chat_id2]['caption'];
        bot('sendsticker',[
            'chat_id'=>$chat_id2,
            'file_id'=>$temp[$chat_id2]['file_id'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    if ($temp[$chat_id2]['type'] == 'doc') {
        $msg[$msg['last'] + 1]['type'] = 'doc';
        $msg[$msg['last'] + 1]['file_id'] = $temp[$chat_id2]['file_id'];
        $msg[$msg['last'] + 1]['caption'] = $temp[$chat_id2]['caption'];
        bot('senddocument',[
            'chat_id'=>$chat_id2,
            'file_id'=>$temp[$chat_id2]['file_id'],
            'parse_mode'=>'html'
            ]);
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
            'chat_id'=>$chat_id2,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    }
    $temp[$chat_id2]['type'] = null;
    $temp[$chat_id2]['mode'] = null;
    $temp[$chat_id2]['text'] = null;  
    $temp[$chat_id2]['caption'] = null;
    $temp[$chat_id2]['file_id']= null;
    file_put_contents('temp.json', json_encode($temp));
    file_put_contents('msgs.json', json_encode($msg));
}
if ($data == "yes") {
    $temp[$chat_id2]['mode'] = 'keyboard';
    file_put_contents('temp.json', json_encode($temp));
    bot('editMessageText',[
        'chat_id'=>$chat_id2,
        'message_id'=>$message_id,
        'text'=>"
- حسنا عزيزي ارسل الأزرار الشفافة الآن بلشكل التالي =>
النص = الرابط
النص = الرابط , النص = الرابط
النص = الرابط , النص = الرابط ,  النص = الرابط
- مثال على ذلك =>
- BROK = T.me/i_BRK
- BROK =T.me/i_BRK , - BROK = T.me/i_BRK
- - BROK = T.me/i_BRK , - BROK =T.me/i_BRK , - BROK = T.me/i_BRK 
       ", 
        ]);
}
if ($text != '/start' and $temp[$chat_id]['mode']=='keyboard') {
    $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
    $rows = explode("\n",$text);
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = explode(",",$row);
                foreach($bottons as $botton){
                    $data = explode("=",$botton."=");
                    $Ibotton = ["text" => trim($data[0]), "url" => trim($data[1])];
                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
                }
                $i++;
            }
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>'- انتظر ثواني ... '
        ]);
    $reply_markup=json_encode($keyboard);
    if ($temp[$chat_id]['type'] == 'text') {
        $msg['last'] = $msg['last'] + 1;
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$temp[$chat_id]['text'],
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
    $msg[$msg['last']]['text'] = $temp[$chat_id]['text'];
    $msg[$msg['last']]['type'] = 'text_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
    if ($temp[$chat_id]['type'] == 'photo') {
        $msg['last'] = $msg['last'] + 1;
        bot('sendPhoto',[
        'chat_id'=>$chat_id,
        'file_id'=>$temp[$chat_id]['file_id'],
        'caption'=>$temp[$chat_id]['caption'],
        'parse_mode'=>'html',
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
        $msg[$msg['last']]['file_id'] = $temp[$chat_id]['file_id'];
        $msg[$msg['last']]['caption'] = $temp[$chat_id]['caption'];
    $msg[$msg['last']]['type'] = 'photo_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
   
    if ($temp[$chat_id]['type'] == 'voice') {
        $msg['last'] = $msg['last'] + 1;
        bot('sendvoice',[
        'chat_id'=>$chat_id,
        'file_id'=>$temp[$chat_id]['file_id'],
        'caption'=>$temp[$chat_id]['caption'],
        'parse_mode'=>'html',
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
        $msg[$msg['last']]['file_id'] = $temp[$chat_id]['file_id'];
        $msg[$msg['last']]['caption'] = $temp[$chat_id]['caption'];
    $msg[$msg['last']]['type'] = 'voice_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
    if ($temp[$chat_id]['type'] == 'audio') {
        $msg['last'] = $msg['last'] + 1;
        bot('sendaudio',[
        'chat_id'=>$chat_id,
        'file_id'=>$temp[$chat_id]['file_id'],
        'caption'=>$temp[$chat_id]['caption'],
        'parse_mode'=>'html',
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
        $msg[$msg['last']]['file_id'] = $temp[$chat_id]['file_id'];
        $msg[$msg['last']]['caption'] = $temp[$chat_id]['caption'];
    $msg[$msg['last']]['type'] = 'audio_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
    if ($temp[$chat_id]['type'] == 'sticker') {
        $msg['last'] = $msg['last'] + 1;
        bot('sendsticker',[
        'chat_id'=>$chat_id,
        'file_id'=>$temp[$chat_id]['file_id'],
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
        $msg[$msg['last']]['file_id'] = $temp[$chat_id]['file_id'];
        $msg[$msg['last']]['caption'] = $temp[$chat_id]['caption'];
    $msg[$msg['last']]['type'] = 'sticker_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
    if ($temp[$chat_id]['type'] == 'doc') {
        $msg['last'] = $msg['last'] + 1;
        bot('senddocument',[
        'chat_id'=>$chat_id,
        'file_id'=>$temp[$chat_id]['file_id'],
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
        $msg[$msg['last']]['file_id'] = $temp[$chat_id]['file_id'];
        $msg[$msg['last']]['caption'] = $temp[$chat_id]['caption'];
    $msg[$msg['last']]['type'] = 'doc_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
    if ($temp[$chat_id]['type'] == 'video') {
        $msg['last'] = $msg['last'] + 1;
        bot('sendvideo',[
        'chat_id'=>$chat_id,
        'file_id'=>$temp[$chat_id]['file_id'],
        'caption'=>$temp[$chat_id]['caption'],
        'parse_mode'=>'html',
        'reply_markup'=>($reply_markup)
        ]);
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$bot.' '.$msg['last'],
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
            [['text'=>'- انشاء رساله جديده','callback_data'=>'cr']]]])
            ]);
    
        $msg[$msg['last']]['file_id'] = $temp[$chat_id]['file_id'];
        $msg[$msg['last']]['caption'] = $temp[$chat_id]['caption'];
    $msg[$msg['last']]['type'] = 'video_keyboard';
    $msg[$msg['last']]['reply_markup'] = $keyboard;
    }
    $temp[$chat_id]['type'] = null;
    $temp[$chat_id]['mode'] = null;
    $temp[$chat_id]['text'] = null;  
    $temp[$chat_id]['caption'] = null;
    $temp[$chat_id]['file_id']= null;
    file_put_contents('temp.json', json_encode($temp));
    file_put_contents("msgs.json", json_encode($msg));
}
$inline = $update->inline_query->query;
if ($inline) {
    $type = $msg[$inline]['type'];
    if ($type == 'text_keyboard') {
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'article',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال النص . ",
             'input_message_content'=>['parse_mode'=>'HTML','message_text'=>$msg[$inline]['text']],
            'reply_markup'=>$msg[$inline]['reply_markup']
          ]])
        ]);
    }
    if ($type == 'text') {
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'article',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال النص . ",
             'input_message_content'=>['parse_mode'=>'HTML','message_text'=>$msg[$inline]['text']],
          ]])
        ]);
    }
    if ($type == 'voice') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'voice',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال البصمه . ",
                'voice_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'voice',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال البصمه . ",
                'voice_file_id'=>$msg[$inline]['file_id'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'voice_keyboard') {
       if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'voice',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال البصمه . ",
                'voice_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'voice',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال البصمه . ",
                'voice_file_id'=>$msg[$inline]['file_id'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'photo') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'photo',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الصوره . ",
                'photo_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'photo',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الصوره . ",
                'photo_file_id'=>$msg[$inline]['file_id'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'photo_keyboard') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'photo',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الصوره . ",
                'photo_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'photo',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الصوره . ",
                'photo_file_id'=>$msg[$inline]['file_id'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'sticker') {
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'sticker',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الملصق . ",
                'sticker_file_id'=>$msg[$inline]['file_id'],

          ]])
        ]);
    }
    if ($type == 'sticker_keyboard') {
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'sticker',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الملصق . ",
                'sticker_file_id'=>$msg[$inline]['file_id'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
          ]])
        ]);
    }
    if ($type == 'audio') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'audio',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الأغنيه . ",
                'audio_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'audio',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الأغنيه . ",
                'audio_file_id'=>$msg[$inline]['file_id'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'audio_keyboard') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'audio',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الأغنيه . ",
                'audio_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'audio',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الأغنيه . ",
                'audio_file_id'=>$msg[$inline]['file_id'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'video') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'video',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الفيديو . ",
                'video_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'video',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الفيديو . ",
                'video_file_id'=>$msg[$inline]['file_id'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'video_keyboard') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'video',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الفيديو . ",
                'video_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'video',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الفيديو . ",
                'video_file_id'=>$msg[$inline]['file_id'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
    if ($type == 'doc_keyboard') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'document',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الملف . ",
                'document_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'document',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الملف . ",
                'document_file_id'=>$msg[$inline]['file_id'],
                'reply_markup'=>$msg[$inline]['reply_markup'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
     if ($type == 'doc') {
        if($msg[$inline]['caption'] != null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'document',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الملف . ",
                'document_file_id'=>$msg[$inline]['file_id'],
                'caption'=>$msg[$inline]['caption'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
        if($msg[$inline]['caption'] == null){
        bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' => json_encode([[
                'type'=>'document',
                'id'=>base64_encode(rand(5,555)),
                'title'=>"- اضغط هنا لأرسال الملف . ",
                'document_file_id'=>$msg[$inline]['file_id'],
                'input_message_content'=>['parse_mode'=>'HTML'],
          ]])
        ]);
        }
    }
}

