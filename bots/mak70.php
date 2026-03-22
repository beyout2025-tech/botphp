<?php#*wataw*
/*
بناءً على نظام المتجر:
1. يتم دمج الإعدادات تلقائياً عبر <?php#*wataw*
2. يستخدم نظام المجلدات data/ لضمان الخصوصية
*/

// إعداد المجلدات والقواعد
if(!is_dir('data')){ mkdir('data'); }
$db_file = 'data/courses_db.json';

if(!file_exists($db_file)){
    $initial = [
        "categories" => ["دبلومات أكاديمية", "علوم الحاسوب", "اللغات"],
        "courses" => [],
        "registrations" => []
    ];
    file_put_contents($db_file, json_encode($initial, JSON_UNESCAPED_UNICODE));
}

$db = json_decode(file_get_contents($db_file), true);
$admin = "[*[ADMIN_ID]*]"; // سيستبدله الصانع تلقائياً

// دالة الحفظ
function save_db($array) {
    global $db_file;
    file_put_contents($db_file, json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

// القائمة الرئيسية (للمستخدم)
if($text == "/start"){
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "🎓 **مرحباً بك في بوت الدورات التدريبية**\n\nنحن هنا لمساعدتك في تطوير مهاراتك العلمية والعملية.\nاختر من القائمة المتاحة أدناه 👇",
        'parse_mode' => "Markdown",
        'reply_markup' => json_encode(['inline_keyboard' => [
            [['text' => "📚 استعراض الأقسام", 'callback_data' => "view_cats"]],
            [['text' => "📩 طلباتك السابقة", 'callback_data' => "my_orders"]],
            [['text' => "🛠 لوحة التحكم (للمدير)", 'callback_data' => "admin_home"]]
        ]])
    ]);
}

// عرض الأقسام
if($data == "view_cats"){
    $keys = [];
    foreach($db['categories'] as $cat){
        $keys[] = [['text' => $cat, 'callback_data' => "show_cat:$cat"]];
    }
    $keys[] = [['text' => "🔙 رجوع", 'callback_data' => "home_user"]];
    bot('editMessageText', [
        'chat_id' => $chat_id2,
        'message_id' => $message_id,
        'text' => "📌 الأقسام التدريبية المتاحة:",
        'reply_markup' => json_encode(['inline_keyboard' => $keys])
    ]);
}

// العودة للقائمة
if($data == "home_user"){
    bot('editMessageText', [
        'chat_id' => $chat_id2,
        'message_id' => $message_id,
        'text' => "🎓 القائمة الرئيسية:",
        'reply_markup' => json_encode(['inline_keyboard' => [
            [['text' => "📚 استعراض الأقسام", 'callback_data' => "view_cats"]],
            [['text' => "🛠 لوحة التحكم", 'callback_data' => "admin_home"]]
        ]])
    ]);
}

// لوحة التحكم (تظهر فقط للمدير)
if($data == "admin_home"){
    if($chat_id2 == $admin){
        bot('editMessageText', [
            'chat_id' => $chat_id2,
            'message_id' => $message_id,
            'text' => "🛠 **أهلاً بك في لوحة تحكم الإدارة**\nيمكنك إدارة الأقسام والدورات من هنا:",
            'reply_markup' => json_encode(['inline_keyboard' => [
                [['text' => "➕ إضافة قسم", 'callback_data' => "add_cat"], ['text' => "❌ حذف قسم", 'callback_data' => "del_cat"]],
                [['text' => "➕ إضافة دورة", 'callback_data' => "add_course"]],
                [['text' => "📥 طلبات التسجيل", 'callback_data' => "view_regs"]],
                [['text' => "🔙 رجوع", 'callback_data' => "home_user"]]
            ]])
        ]);
    } else {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "❌ عذراً، هذا القسم مخصص لمدير البوت فقط.",
            'show_alert' => true
        ]);
    }
}

// إضافة قسم جديد
if($data == "add_cat" && $chat_id2 == $admin){
    file_put_contents("data/action_$chat_id2.txt", "adding_category");
    bot('editMessageText', [
        'chat_id' => $chat_id2,
        'message_id' => $message_id,
        'text' => "ارسل الآن اسم القسم الجديد الذي تريد إضافته:",
        'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "إلغاء", 'callback_data' => "admin_home"]]]])
    ]);
}

if($text && file_get_contents("data/action_$from_id.txt") == "adding_category"){
    $db['categories'][] = $text;
    save_db($db);
    unlink("data/action_$from_id.txt");
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "✅ تم إضافة القسم ($text) بنجاح.",
        'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "العودة للوحة", 'callback_data' => "admin_home"]]]])
    ]);
}

?>
