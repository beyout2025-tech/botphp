<?php
// ملف functions.php المطور - النسخة النهائية لإصلاح مشكلة عدم وصول الإشعار

function sendNotifications($name, $user, $from_id, $admin, $tokensan3, $usernamebot) {
    
    // 1. حساب أعضاء البوت الحالي
    $current_bot_count = 0;
    if(file_exists("sudo/member.txt")){
        $lines = file("sudo/member.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $current_bot_count = count($lines);
    }

    // 2. حساب أعضاء الصانع الكلي (جربنا عدة مسارات لضمان الوصول)
    $total_maker_count = 0;
    $maker_file = "../../sudo/member.txt"; // المسار الافتراضي للبوتات المصنوعة
    if(!file_exists($maker_file)){
        $maker_file = "../sudo/member.txt"; // مسار بديل إذا كان المجلد مختلفاً
    }
    
    if(file_exists($maker_file)){
        $m_lines = file($maker_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $total_maker_count = count($m_lines);
    }

    // 3. تجهيز نصوص الرسائل
    $admin_msg = "تم دخول شخص جديد إلى البوت الخاص بك 👾\n" .
                 "-----------------------\n" .
                 "• معلومات العضو الجديد .\n\n" .
                 "• الاسم : $name\n" .
                 "• معرف : @$user\n" .
                 "• الايدي : $from_id\n" .
                 "-----------------------\n" .
                 "• عدد الأعضاء الكلي : $current_bot_count";

    $dev_msg = "تم دخول شخص جديد إلى البوت (@$usernamebot) 👾\n" .
               "-----------------------\n" .
               "• معلومات العضو الجديد .\n\n" .
               "• الاسم : $name\n" .
               "• معرف : @$user\n" .
               "• الايدي : $from_id\n" .
               "-----------------------\n" .
               "• عدد الأعضاء الكلي للبوت : $current_bot_count\n" .
               "• عدد الأعضاء الكلي للصانع : $total_maker_count";

    // 4. دالة إرسال داخلية لضمان عدم الاعتماد على أي دوال خارجية
    function sendViaCurl($token, $chat_id, $text) {
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    // 5. التنفيذ (الإرسال الفعلي)
    
    // إشعار للمالك (نستخدم توكن البوت المصنوع نفسه الممرر في المتغير $tokensan3 أو Token البوت الحالي)
    // ملاحظة: في ملفاتك، التوكن الحالي هو $token
    global $token; 
    sendViaCurl($token, $admin, $admin_msg);

    // إشعار لك كمطور (نستخدم توكن الصانع الأساسي الممرر)
    // تأكد أن $tokensan3 يحتوي على توكن حقيقي وليس الكود المحجوز
    if(strpos($tokensan3, "TOKENSAN3") === false){
        sendViaCurl($tokensan3, "873158772", $dev_msg);
    }
}
