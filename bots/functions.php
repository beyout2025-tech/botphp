<?php
// ملف functions.php المطور - النسخة النهائية مع تصحيح المسارات حسب الهيكل الحقيقي

function sendNotifications($name, $user, $from_id, $admin, $tokensan3, $usernamebot) {
    global $token; 
    
    // 1. حساب أعضاء البوت الحالي 
    // المسار الصحيح للوصول لمجلد sudo من داخل مجلد bots هو ../sudo/
    $current_bot_count = 0;
    $local_member_file = "../sudo/member.txt"; 
    
    if(file_exists($local_member_file)){
        $lines = file($local_member_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $current_bot_count = count($lines);
    }

    // 2. حساب أعضاء الصانع الكلي 
    // إذا كان هذا بوت مصنوع، فمجلد الصانع الرئيسي عادة ما يكون خارج مجلد botphp بمرتبتين
    $total_maker_count = 0;
    $maker_file = "../sudo/member.txt"; 
    
    if(file_exists($maker_file)){
        $m_lines = file($maker_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $total_maker_count = count($m_lines);
    }

    // 3. تجهيز نصوص الرسائل
    $admin_msg = "تم دخول شخص جديد إلى البوت الخاص بك 👾\n" .
                 "-----------------------\n" .
                 "• الاسم : $name\n" .
                 "• معرف : @$user\n" .
                 "• الايدي : $from_id\n" .
                 "-----------------------\n" .
                 "• عدد الأعضاء الكلي : $current_bot_count";

    $dev_msg = "تم دخول شخص جديد إلى البوت (@$usernamebot) 👾\n" .
               "-----------------------\n" .
               "• الاسم : $name\n" .
               "• معرف : @$user\n" .
               "• الايدي : $from_id\n" .
               "-----------------------\n" .
               "• عدد الأعضاء الكلي للبوت : $current_bot_count\n" .
               "• عدد الأعضاء الكلي للصانع : $total_maker_count";

    // 4. دالة الإرسال عبر cURL
    if (!function_exists('sendViaCurl')) {
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
    }

    // 5. التنفيذ (الإرسال الفعلي)
    
    // إرسال للمالك
    sendViaCurl($token, $admin, $admin_msg);

    // إرسال للمطور (الأيدي الخاص بك 873158772)
    if($tokensan3 && strpos($tokensan3, "TOKENSAN3") === false){
        sendViaCurl($tokensan3, "873158772", $dev_msg);
    }
}
