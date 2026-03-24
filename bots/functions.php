<?php
// ملف functions.php المطور 

function sendNotifications($name, $user, $from_id, $admin, $tokensan3, $usernamebot) {
    global $token; // جلب التوكن الحالي للبوت

    // 1. حساب أعضاء البوت الحالي (المسار الصحيح من داخل مجلد bots هو ../sudo/)
    $current_bot_count = 0;
    $local_member_file = "../sudo/member.txt"; 
    if(file_exists($local_member_file)){
        $lines = file($local_member_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $current_bot_count = count($lines);
    }

    // 2. حساب أعضاء الصانع الكلي
    $total_maker_count = 0;
    $maker_file = "../../sudo/member.txt"; // المسار من البوت المصنوع إلى الصانع
    if(file_exists($maker_file)){
        $m_lines = file($maker_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $total_maker_count = count($m_lines);
    }

    // 3. نصوص الرسائل
    $admin_msg = "تم دخول شخص جديد إلى البوت الخاص بك 👾\n" .
                 "-----------------------\n" .
                 "• الاسم : $name\n" .
                 "• المعرف : @$user\n" .
                 "• الايدي : $from_id\n" .
                 "-----------------------\n" .
                 "• أعضاء بوتك : $current_bot_count";

    $dev_msg = "دخل شخص جديد للبوت (@$usernamebot) 👾\n" .
               "-----------------------\n" .
               "• الاسم : $name\n" .
               "• المعرف : @$user\n" .
               "• الايدي : $from_id\n" .
               "-----------------------\n" .
               "• أعضاء البوت : $current_bot_count\n" .
               "• أعضاء الصانع : $total_maker_count";

    // دالة الإرسال
    function curlSend($token, $chat_id, $text) {
        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=".urlencode($text)."&parse_mode=markdown";
        return file_get_contents($url);
    }

    // تنفيذ الإرسال
    // للمالك
    curlSend($token, $admin, $admin_msg);

    // لك كمطور (معرفك 873158772)
    if($tokensan3 && strpos($tokensan3, "TOKENSAN3") === false){
        curlSend($tokensan3, "873158772", $dev_msg);
    }
}
