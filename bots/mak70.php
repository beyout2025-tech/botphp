<?php#*wataw*

// 1. إعداد المجلدات الضرورية (مثل نظام المتجر تماماً)
if(!is_dir('data')){ mkdir('data'); }
if(!is_dir('data/stats')){ mkdir('data/stats'); }

$db_file = 'data/sales.txt'; // نفس اسم ملف بيانات المتجر لضمان التوافق

// 2. إنشاء قاعدة البيانات إذا لم تكن موجودة
if(!file_exists($db_file)){
    $initial_db = [
        "mode" => null,
        "categories" => ["دبلومات أكاديمية", "علوم الحاسوب", "اللغات"],
        "courses" => [],
        "registrations" => []
    ];
    file_put_contents($db_file, json_encode($initial_db, JSON_UNESCAPED_UNICODE));
}

// 3. جلب البيانات الأساسية
$sales = json_decode(file_get_contents($db_file), true);
$admin = "[*[ADMIN_ID]*]"; // المتغير الذي يستبدله صانعك

// دالة الحفظ (نفس اسم دالة المتجر)
function save($array){
    file_put_contents('data/sales.txt', json_encode($array, JSON_UNESCAPED_UNICODE));
}

// 4. منطق المطور (لوحة التحكم)
if($chat_id == $admin){
    if($text == "/start" or $data == "admin_back"){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>"مرحــبـاً مطــوري العزيز 🎓\nأنت الآن في لوحة تحكم بوت الدورات.\n\nيمكنك إدارة الأقسام والدورات من هنا 👇",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'➕ إضافة قسم','callback_data'=>'add_cat'],['text'=>'➖ حذف قسم','callback_data'=>'del_cat']],
                    [['text'=>'➕ إضافة دورة','callback_data'=>'add_course'],['text'=>'📥 الطلبات','callback_data'=>'view_orders']],
                    [['text'=>'📊 الإحصائيات','callback_data'=>'stats_bot']]
                ]
            ])
        ]);
        $sales['mode'] = null;
        save($sales);
    }

    // إضافة قسم (بنفس منطق إضافة عرض في المتجر)
    if($data == 'add_cat'){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>'أرسل الآن اسم القسم الجديد (مثال: علوم الحاسوب):',
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء','callback_data'=>'admin_back']]]])
        ]);
        $sales['mode'] = 'add_cat_name';
        save($sales);
    }

    if($text != '/start' and $sales['mode'] == 'add_cat_name'){
        $sales['categories'][] = $text;
        $sales['mode'] = null;
        save($sales);
        bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم إضافة القسم ($text) بنجاح!"]);
    }
} 

// 5. منطق المستخدم العادي
else {
    if($text == "/start" or $data == "user_home"){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"🎓 **مرحباً بك في بوت الدورات التدريبية**\n\nتفضل باختيار القسم الذي تود استعراض دوراته 👇",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'📚 استعراض الأقسام','callback_data'=>'user_cats']],
                    [['text'=>'💬 التواصل مع الإدارة','url'=>"tg://user?id=$admin"]]
                ]
            ])
        ]);
    }

    if($data == "user_cats"){
        $keys = [];
        foreach($sales['categories'] as $cat){
            $keys[] = [['text'=>$cat, 'callback_data'=>"view_cat:$cat"]];
        }
        $keys[] = [['text'=>'🔙 رجوع','callback_data'=>'user_home']];
        bot('editMessageText',[
            'chat_id'=>$chat_id2,
            'message_id'=>$message_id,
            'text'=>"📌 الأقسام المتاحة حالياً:",
            'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
        ]);
    }
}

// 6. نظام الإحصائيات (إجباري ليعمل البوت في بيئة الصانع)
if ($update && !in_array($from_id, explode("\n", @file_get_contents("data/stats/users.txt")))) {
    file_put_contents("data/stats/users.txt", $from_id."\n", FILE_APPEND);
}
?>
