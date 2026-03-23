<?php
// ملف bots/functions.php

function sendNotifications($name, $user, $from_id, $admin, $tokensan3, $usernamebot) {
    // 1. جلب إحصائيات الصانع الكلية
    $main_members = explode("\n", file_get_contents("../../sudo/member.txt"));
    $total_maker_count = count($main_members) - 1;
    
    // 2. إحصائيات البوت الحالي 
    $current_bot_members = explode("\n", file_get_contents("sudo/member.txt"));
    $current_bot_count = count($current_bot_members) - 1;

    // 3. إشعار المالك
    bot("sendmessage",[
        "chat_id" => $admin,
        "text" => "تم دخول شخص جديد إلى البوت الخاص بك 👾\n-----------------------\n• معلومات العضو الجديد .\n\n• الاسم : $name\n• معرف : @$user\n• الايدي : $from_id\n-----------------------\n• عدد الأعضاء الكلي : $current_bot_count",
        'disable_web_page_preview' => 'true',
        'parse_mode' => "markdown",
    ]);

    // 4. إشعار المطور (أنت)
    $dev_notify_text = "تم دخول شخص جديد إلى البوت (@$usernamebot) 👾\n-----------------------\n• معلومات العضو الجديد .\n\n• الاسم : $name\n• معرف : @$user\n• الايدي : $from_id\n-----------------------\n• عدد الأعضاء الكلي للبوت : $current_bot_count\n• عدد الأعضاء الكلي للصانع : $total_maker_count";
    
    file_get_contents("https://api.telegram.org/bot".$tokensan3."/sendMessage?chat_id=873158772&text=".urlencode($dev_notify_text)."&parse_mode=markdown");
}
