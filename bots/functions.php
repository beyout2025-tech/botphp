<?php
// ملف functions.php المطور والمصحح

function sendNotifications($name, $user, $from_id, $admin, $tokensan3, $usernamebot) {
    // 1. حساب إحصائيات البوت الحالي
    $current_bot_file = "sudo/member.txt";
    $current_bot_count = 0;
    if(file_exists($current_bot_file)){
        $current_bot_members = explode("\n", file_get_contents($current_bot_file));
        $current_bot_count = count(array_filter($current_bot_members));
    }

    // 2. حساب إحصائيات الصانع الكلي (تأكد من المسار حسب استضافتك)
    $main_maker_file = "../../sudo/member.txt"; 
    $total_maker_count = 0;
    if(file_exists($main_maker_file)){
        $main_members = explode("\n", file_get_contents($main_maker_file));
        $total_maker_count = count(array_filter($main_members));
    }

    // 3. تجهيز النصوص
    $admin_text = "تم دخول شخص جديد إلى البوت الخاص بك 👾\n" .
                  "-----------------------\n" .
                  "• الاسم : $name\n" .
                  "• معرف : @$user\n" .
                  "• الايدي : $from_id\n" .
                  "-----------------------\n" .
                  "• عدد الأعضاء الكلي : $current_bot_count";

    $dev_text = "تم دخول شخص جديد إلى البوت (@$usernamebot) 👾\n" .
                "-----------------------\n" .
                "• الاسم : $name\n" .
                "• معرف : @$user\n" .
                "• الايدي : $from_id\n" .
                "-----------------------\n" .
                "• أعضاء البوت : $current_bot_count\n" .
                "• أعضاء الصانع : $total_maker_count";

    // 4. الإرسال باستخدام curl لضمان السرعة وعدم التوقف
    // إرسال للمالك (باستخدام توكن البوت الحالي الممرر في المتغير $tokensan3 أو جلب التوكن من الملف)
    // ملاحظة: نستخدم التوكن الممرر في ملف البوت المصنوع
    $current_token = file_get_contents("token.txt") ?? $tokensan3; 

    // إرسال للمالك
    file_get_contents("https://api.telegram.org/bot".$tokensan3."/sendMessage?chat_id=".$admin."&text=".urlencode($admin_text)."&parse_mode=markdown");

    // إرسال لك كمطور (معرفك 873158772)
    file_get_contents("https://api.telegram.org/bot".$tokensan3."/sendMessage?chat_id=873158772&text=".urlencode($dev_text)."&parse_mode=markdown");
}
