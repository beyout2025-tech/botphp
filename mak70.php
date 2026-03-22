
<?php#*wataw*

// 1. إعدادات قاعدة البيانات الأولية (محاكاة db.json)
if(!file_exists("db.json")){
    $initial_db = [
        "users" => [],
        "admins" => ["[*ADMIN_ID*]"],
        "categories" => ["دبلومات أكاديمية", "علوم الحاسوب والبرمجة", "الأمن السيبراني", "اللغات والترجمة"],
        "courses" => [
            ["id" => 1, "name" => "دبلوم إدارة الأعمال", "description" => "تأهيل شامل لإدارة المؤسسات", "price" => 50.0, "category" => "دبلومات أكاديمية", "active" => true],
            ["id" => 2, "name" => "دبلوم الأمن السيبراني", "description" => "احتراف حماية الشبكات", "price" => 60.0, "category" => "الأمن السيبراني", "active" => true]
        ],
        "registrations" => [],
        "promo_codes" => []
    ];
    file_put_contents("db.json", json_encode($initial_db, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

// 2. استلام التحديثات من تلجرام
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;

// المتغيرات التي يستبدلها الصانع تلقائياً
$admin = "[*ADMIN_ID*]"; 
$db = json_decode(file_get_contents("db.json"), true);

// وظيفة حفظ البيانات
function save_db($data) {
    file_put_contents("db.json", json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

// نظام الحالات (Mode) لجمع بيانات التسجيل
$mode = file_get_contents("mode_$from_id.txt");

// --- القائمة الرئيسية ---
if($text == "/start"){
    unlink("mode_$from_id.txt");
    unlink("reg_tmp_$from_id.json");
    
    // إشعار دخول مستخدم جديد للمطور
    if(!in_array($from_id, $db['users'])){
        $db['users'][] = $from_id;
        save_db($db);
        $user_name = $message->from->first_name;
        $total_users = count($db['users']);
        bot('sendMessage', [
            'chat_id' => $admin,
            'text' => "تم دخول شخص جديد إلى البوت الخاص بك 👾\n-----------------------\n• معلومات العضو الجديد .\n\n• الاسم : $user_name\n• الايدي : `$from_id`\n-----------------------\n• عدد الأعضاء الكلي : $total_users",
            'parse_mode' => "Markdown"
        ]);
    }

    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "🎓 **مؤسسة كن أنت للتدريب والتأهيل**\nمرحباً بك! نحن هنا لمساعدتك في رحلة تطوير مهاراتك.\n\nاختر من القائمة الرئيسية:",
        'parse_mode' => "Markdown",
        'reply_markup' => json_encode(['inline_keyboard' => [
            [['text' => "📚 استعراض الاقسام", 'callback_data' => "show_categories"]],
            [['text' => "💬 التواصل مع الإدارة", 'url' => "https://t.me/Uploadfilesmnbot"]]
        ]])
    ]);
}

// --- استعراض الأقسام ---
if($data == "show_categories"){
    $keys = [];
    foreach($db['categories'] as $cat){
        $keys[] = [['text' => $cat, 'callback_data' => "view_cat:$cat"]];
    }
    $keys[] = [['text' => "⬅️ رجوع", 'callback_data' => "back_home"]];
    bot('editMessageText', [
        'chat_id' => $chat_id2,
        'message_id' => $message_id,
        'text' => "اختر القسم الذي تهتم به:",
        'reply_markup' => json_encode(['inline_keyboard' => $keys])
    ]);
}

// --- استعراض الدورات داخل القسم ---
if($data && strpos($data, "view_cat:") === 0){
    $cat_name = str_replace("view_cat:", "", $data);
    $keys = [];
    foreach($db['courses'] as $course){
        if($course['category'] == $cat_name && $course['active']){
            $keys[] = [['text' => $course['name'], 'callback_data' => "course_det:" . $course['id']]];
        }
    }
    $keys[] = [['text' => "⬅️ رجوع للأقسام", 'callback_data' => "show_categories"]];
    bot('editMessageText', [
        'chat_id' => $chat_id2,
        'message_id' => $message_id,
        'text' => "الدورات المتاحة في قسم **$cat_name**:",
        'parse_mode' => "Markdown",
        'reply_markup' => json_encode(['inline_keyboard' => $keys])
    ]);
}

// --- تفاصيل الدورة والبدء بالتسجيل ---
if($data && strpos($data, "course_det:") === 0){
    $c_id = str_replace("course_det:", "", $data);
    foreach($db['courses'] as $c){
        if($c['id'] == $c_id){
            $txt = "**" . $c['name'] . "**\n\n" . $c['description'] . "\n\nالسعر: " . $c['price'] . " دولار";
            bot('editMessageText', [
                'chat_id' => $chat_id2,
                'message_id' => $message_id,
                'text' => $txt,
                'parse_mode' => "Markdown",
                'reply_markup' => json_encode(['inline_keyboard' => [
                    [['text' => "📥 التسجيل في الدورة", 'callback_data' => "start_reg:$c_id"]],
                    [['text' => "⬅️ رجوع", 'callback_data' => "view_cat:" . $c['category']]]
                ]])
            ]);
        }
    }
}

// --- منطق التسجيل التسلسلي (Conversation Logic) ---
if($data && strpos($data, "start_reg:") === 0){
    $id_c = str_replace("start_reg:", "", $data);
    file_put_contents("reg_tmp_$from_id.json", json_encode(["course_id" => $id_c]));
    file_put_contents("mode_$from_id.txt", "get_name");
    bot('editMessageText', ['chat_id' => $chat_id2, 'message_id' => $message_id, 'text' => "الرجاء إدخال **اسمك الثلاثي** الكامل:"]);
}

// 1. استلام الاسم -> طلب الجنس
if($text && $mode == "get_name"){
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["name"] = $text;
    file_put_contents("reg_tmp_$from_id.json", json_encode($tmp));
    file_put_contents("mode_$from_id.txt", "get_gender");
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "أهلاً بك $text، الرجاء تحديد **الجنس**:",
        'parse_mode' => "Markdown",
        'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "ذكر", 'callback_data' => "set_gender:ذكر"], ['text' => "أنثى", 'callback_data' => "set_gender:أنثى"]]]])
    ]);
}

// 2. استلام الجنس -> طلب العمر
if($data && strpos($data, "set_gender:") === 0){
    $gender = str_replace("set_gender:", "", $data);
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["gender"] = $gender;
    file_put_contents("reg_tmp_$from_id.json", json_encode($tmp));
    file_put_contents("mode_$from_id.txt", "get_age");
    bot('editMessageText', ['chat_id' => $chat_id2, 'message_id' => $message_id, 'text' => "الرجاء إدخال **عمرك** بالأرقام:"]);
}

// 3. استلام العمر -> طلب البلد
if($text && $mode == "get_age" && is_numeric($text)){
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["age"] = $text;
    file_put_contents("reg_tmp_$from_id.json", json_encode($tmp));
    file_put_contents("mode_$from_id.txt", "get_country");
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "الرجاء إدخال **اسم البلد**:"]);
}

// 4. استلام البلد -> طلب المدينة
if($text && $mode == "get_country"){
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["country"] = $text;
    file_put_contents("reg_tmp_$from_id.json", json_encode($tmp));
    file_put_contents("mode_$from_id.txt", "get_city");
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "الرجاء إدخال **اسم المدينة**:"]);
}

// 5. استلام المدينة -> طلب الهاتف
if($text && $mode == "get_city"){
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["city"] = $text;
    file_put_contents("reg_tmp_$from_id.json", json_encode($tmp));
    file_put_contents("mode_$from_id.txt", "get_phone");
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "الرجاء إدخال **رقم هاتفك (واتساب)**:"]);
}

// 6. استلام الهاتف -> طلب البريد
if($text && $mode == "get_phone"){
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["phone"] = $text;
    file_put_contents("reg_tmp_$from_id.json", json_encode($tmp));
    file_put_contents("mode_$from_id.txt", "get_email");
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "الرجاء إدخال **بريدك الإلكتروني**:"]);
}

// 7. استلام البريد -> إنهاء التسجيل وإشعار الإدارة
if($text && $mode == "get_email"){
    $tmp = json_decode(file_get_contents("reg_tmp_$from_id.json"), true);
    $tmp["email"] = $text;
    $tmp["user_id"] = $from_id;
    $tmp["status"] = "pending";
    
    $db["registrations"][] = $tmp;
    save_db($db);
    
    unlink("mode_$from_id.txt");
    unlink("reg_tmp_$from_id.json");
    
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ تم استلام طلبك بنجاح! سيتم مراجعته من قبل الإدارة وإشعارك قريباً."]);
    
    // إرسال البيانات للمدير للموافقة أو الرفض
    $course_name = "";
    foreach($db['courses'] as $c){ if($c['id'] == $tmp['course_id']) $course_name = $c['name']; }
    
    $admin_msg = "**🔔 طلب تسجيل جديد**\n\n**الدورة:** $course_name\n**الاسم:** " . $tmp['name'] . "\n**الهاتف:** " . $tmp['phone'] . "\n**الايدي:** `" . $from_id . "`";
    bot('sendMessage', [
        'chat_id' => $admin,
        'text' => $admin_msg,
        'parse_mode' => "Markdown",
        'reply_markup' => json_encode(['inline_keyboard' => [
            [['text' => "✅ قبول", 'callback_data' => "accept:" . $from_id], ['text' => "❌ رفض", 'callback_data' => "reject:" . $from_id]]
        ]])
    ]);
}

// --- العودة للبداية ---
if($data == "back_home"){
    bot('editMessageText', [
        'chat_id' => $chat_id2,
        'message_id' => $message_id,
        'text' => "🎓 القائمة الرئيسية:",
        'reply_markup' => json_encode(['inline_keyboard' => [
            [['text' => "📚 استعراض الاقسام", 'callback_data' => "show_categories"]],
            [['text' => "💬 التواصل مع الإدارة", 'url' => "https://t.me/Uploadfilesmnbot"]]
        ]])
    ]);
}

?>
