
<?php 
ob_start();
include("functions.php"); // استدعاء ملف الدوال الموحد

// 1. تعريف التوكنات ومعرف المطور (يتم استبدالها تلقائياً من الصانع)
$token = "[*[TOKEN]*]";
$tokensan3 = "[*[TOKENSAN3]*]";
$admin = file_get_contents("admin.txt");
$sudo = array("$admin","873158772"); // إضافة آيدي المطور الأساسي

define('API_KEY',$token);

// 2. دالة البوت الأساسية (بدونها لن يعمل البوت مستقلاً)
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

// 3. استقبال التحديثات من تليجرام ومعالجة البيانات
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$message_id = $message->message_id;
$name = $message->from->first_name;
$user = $message->from->username;

if(isset($update->callback_query)){
    $up = $update->callback_query;
    $chat_id = $up->message->chat->id;
    $from_id = $up->from->id;
    $user = $up->from->username;
    $name = $up->from->first_name;
    $message_id = $up->message->message_id;
    $data = $up->data;
}


// --- بداية كود الإشعارات الموحد ---
// أولاً: جلب البيانات الضرورية من الملفات
$infobot = explode("\n", file_get_contents("info.txt"));
$usernamebot = $infobot['1']; 
@$infosudo_json = json_decode(file_get_contents("sudo.json"), true);
$tnbih = $infosudo_json["info"]["tnbih"] ?? "✅";
$member = explode("\n", file_get_contents("sudo/member.txt"));

// ثانياً: فحص العضو الجديد وإرسال التنبيهات
if($update and !in_array($from_id, $member)){
    // تسجيل العضو في ملف البوت الحالي
    file_put_contents("sudo/member.txt", "$from_id\n", FILE_APPEND);
    
    // التحقق من تفعيل التنبيهات من لوحة التحكم
    if($tnbih == "✅"){
        // استدعاء الدالة من ملف functions.php الموحد
        sendNotifications($name, $user, $from_id, $admin, $tokensan3, $usernamebot);
    }
}
// --- نهاية كود الإشعارات الموحد ---

# بوت الدورات التدريبية المطور - إعدادات قاعدة البيانات
$db_dir = 'data';
$db_file = $db_dir . '/db.json';
$backup_file = $db_dir . '/courses_backup.txt';

// إنشاء المجلدات اللازمة إذا لم تكن موجودة
if(!is_dir($db_dir)){ mkdir($db_dir, 0777, true); }
if(!is_dir($db_dir . '/stats')){ mkdir($db_dir . '/stats', 0777, true); }

// التأكد من وجود ملف db.json وهيكلته الأولية
if(!file_exists($db_file)){
    $initial_data = [
        'categories' => [],
        'courses' => [],
        'admins' => [],
        'users' => [],
        'registrations' => [],
        'last_reg_id' => 1000000100,
        'users_state' => [], 
        'admin_state' => [],
        'auto_responses' => [],
        'promo_codes' => [],
        'msg_limit' => [],
        'settings' => [
            'maintenance' => 'off',
            'reg_status' => 'open',
            'currency' => '$',
            'notifications' => 'on',
            'start_msg' => "🎓 **مرحباً بك في منصة التدريب والتعليم** 💡",
            'support_link' => "tg://user?id=$admin"
        ]
    ];

    file_put_contents($db_file, json_encode($initial_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}



// تحميل البيانات
$sales = json_decode(file_get_contents($db_file), true);

// دالة الحفظ
function save($array){
    global $db_file;
    file_put_contents($db_file, json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}



// تعريف لوحة التحكم بشكل عام لتجنب أخطاء المتغيرات غير المعرفة
$kb = json_encode([
    'inline_keyboard' => [
        [['text' => '➕ إضافة قسم', 'callback_data' => 'add'], ['text' => '➖ حذف قسم', 'callback_data' => 'del']],
        [['text' => '➕ إضافة دورة', 'callback_data' => 'add_course'], ['text' => '➖ حذف دورة', 'callback_data' => 'add_course_del']],
        [['text' => '📥 طلبات التسجيل', 'callback_data' => 'view_regs']], 
        [['text' => '📂 عرض الأقسام', 'callback_data' => 'view_cats_admin'], ['text' => '📚 عرض الدورات', 'callback_data' => 'view_courses_admin']],
        [['text' => '📢 إذاعة جماعية', 'callback_data' => 'broadcast_msg']],
        [['text' => '📤 جلب نسخة (حفظ)', 'callback_data' => 'pointsfile'], ['text' => '📥 رفع نسخة (استعادة)', 'callback_data' => 'upload_backup']],
        [['text' => '🏷️ أكواد الخصم', 'callback_data' => 'manage_promos']], 
        [['text' => '⚙️ إعدادات البوت', 'callback_data' => 'settings'], ['text' => 'العودة 🔙', 'callback_data' => 'c']]
    ]
]);



// جلب يوزر البوت تلقائياً
$get_me = bot('getme',[]);
$me = $get_me->result->username;


// التحقق من كليشة الترحيب وتعيين نص احترافي افتراضي إذا كانت فارغة
if(!isset($sales['settings']['start_msg']) or empty($sales['settings']['start_msg'])){
    $sales['settings']['start_msg'] = "🎓 **مرحباً بك في منصة التدريب والتعليم الذكية** 💡\n\nيسعدنا انضمامك إلينا! يمكنك الآن استعراض أقوى الدورات التدريبية المتاحة، التسجيل فيها، والحصول على شهاداتك المعتمدة.\n\n👇 **يرجى اختيار القسم الذي تود استكشافه:**";
    save($sales); // حفظ النص الافتراضي في قاعدة البيانات ليعمل دائماً
}



if($sales['settings']['maintenance'] == 'on' and $chat_id != $admin){
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"⚠️ **عذراً، البوت تحت الصيانة حالياً!**\nنحن نقوم ببعض التحديثات، سنعود للعمل قريباً جداً 🛠"]);
    exit;
}


// --- نظام الرد الذكي المطور (نسخة مستقرة) ---
if($chat_id == $admin and isset($message->reply_to_message)){
    $reply_text = $message->reply_to_message->text ?? $message->reply_to_message->caption;
    
    // استخراج الآيدي بدقة من رسائل البحث أو الإيصالات
    if(preg_match('/آيدي التليجرام: `(\d+)`/', $reply_text, $matches)){
        $target_student = $matches[1];
        
        $res = bot('copyMessage', [
            'chat_id' => $target_student,
            'from_chat_id' => $admin,
            'message_id' => $message_id
        ]);
        
        if($res->ok){
            bot('sendMessage', [
                'chat_id' => $admin,
                'text' => "✅ **تم توجيه ردك للطالب بنجاح.**\n🆔 آيدي الطالب: `$target_student`",
                'parse_mode' => "MarkDown",
                'reply_to_message_id' => $message_id
            ]);
        } else {
            bot('sendMessage', ['chat_id'=>$admin, 'text'=>"❌ فشل الإرسال. قد يكون الطالب قد حظر البوت."]);
        }
        exit;
    }
}


// --- محرك الردود الآلية (الرادار) ---
if(isset($sales['auto_responses'][$text]) and $chat_id != $admin){
    bot('sendMessage', [
        'chat_id'=>$chat_id,
        'text'=>$sales['auto_responses'][$text],
        'parse_mode'=>"MarkDown"
    ]);
    exit; 
}





// دالة العودة للقائمة الرئيسية للمطور (c) المحدثة
if($data == 'c'){
  bot('EditMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"مرحــبـاً مطــوري العزيز 🎓 @$user  
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
أنت الآن في لوحة إدارة الأقسام والدورات التدريبية.
الأوامر المتاحة لك كمدير للبوت: 👇
ـ⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁
إرسـال رسالة لطـالب 👁‍🗨 /sendmessage 
إرسـال تـحـذير لـعضو 🔴 /sendwarning 
إحصائيات المـشتركين 📣 /admin
بحث عن طلب 🔍 /search id
ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ",
   'reply_markup'=>$kb // هنا استخدمنا المتغير العام الذي يحتوي على كافة الأزرار
  ]);
  
  // إنهاء أي حالة سابقة للأدمن لضمان عدم حدوث تداخل
  $sales['admin_state'][$chat_id] = null;
  save($sales);
  exit; // إضافة exit لإنهاء العملية فوراً وتوفير موارد السيرفر
}



// تحديث لوحة التحكم لتشمل زر حذف الدورة
if($chat_id == $admin){
 if($text == '/start' or $data == 'c'){
  $text_msg = "مرحــبـاً مطــوري العزيز 🎓 @$user  
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
أنت الآن في لوحة إدارة الأقسام والدورات التدريبية.
الأوامر المتاحة لك كمدير للبوت: 👇
ـ⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁⌁
إرسـال رسالة لطـالب 👁‍🗨 /sendmessage 
إرسـال تـحـذير لـعضو 🔴 /sendwarning 
إحصائيات المـشتركين 📣 /admin
بحث عن طلب 🔍 /search id
ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ";
  
  // نستخدم $kb المعرف في بداية الملف مباشرة
  if($text == '/start'){
      bot('sendMessage',[
          'chat_id'=>$chat_id, 
          'text'=>$text_msg, 
          'reply_markup'=>$kb
      ]);
  } else {
      bot('editMessageText',[
          'chat_id'=>$chat_id, 
          'message_id'=>$message_id, 
          'text'=>$text_msg, 
          'reply_markup'=>$kb
      ]);
  }
  
  // تصفير حالة الأدمن لضمان عدم تداخل الأوامر
  $sales['admin_state'][$chat_id] = null;
  save($sales);
  exit;
 }
}


// البدء بإضافة قسم جديد (يقابل إضافة دولة/سلعة في المتجر)
if($data == 'add'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'أرسل الآن إسم القسم التدريبي الجديد؟
مثال:
علوم الحاسوب والبرمجة 💻',
    'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'- إلغاء الأمر 🚫','callback_data'=>'c']]
      ]
    ])
  ]);
  $sales['admin_state'][$chat_id] = 'add';
  save($sales);
  exit;
}

// استلام اسم القسم وحفظه (يقابل استلام اسم السلعة في المتجر)
if($text != '/start' and $text != null and $sales['admin_state'][$chat_id] == 'add'){
  // إضافة الاسم الجديد إلى مصفوفة الأقسام في ملف db.json
  $sales['categories'][] = $text;
  
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"✅ تم حفظ القسم التدريبي الجديد بنجاح.
   
📌 اسم القسم: $text

يمكنك الآن العودة لإضافة دورات داخل هذا القسم.",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]
      ]
    ])
  ]);
  
  $sales['admin_state'][$chat_id] = null; // إنهاء حالة الإضافة
  save($sales); // حفظ التعديلات في الملف
  exit;
}

// عرض الأقسام المتاحة لحذفها (يقابل طلب كود السلعة في المتجر)
if($data == 'del'){
  $categories = $sales['categories'];
  if(count($categories) > 0){
    $keys = [];
    foreach($categories as $index => $cat){
      // نرسل رقم القسم (index) في callback_data لتعريفه عند الحذف
      $keys[] = [['text'=>$cat, 'callback_data'=>"del_cat:$index"]];
    }
    $keys[] = [['text'=>'- إلغاء الأمر 🚫','callback_data'=>'c']];
    
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'⚠️ اختر القسم الذي تريد حذفه نهائياً من القائمة أدناه:',
      'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
    ]);
  } else {
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'🚫 لا توجد أقسام مضافة حالياً لكي يتم حذفها.',
      'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
    ]);
  }
  exit;
}

// تنفيذ عملية الحذف بعد النقر على الزر
if(strpos($data, "del_cat:") !== false){
  $index = str_replace("del_cat:", "", $data);
  $cat_name = $sales['categories'][$index];
  
  // حذف القسم من المصفوفة
  unset($sales['categories'][$index]);
  // إعادة ترتيب المصفوفة لضمان عدم وجود فراغات في الـ index
  $sales['categories'] = array_values($sales['categories']);
  
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"✅ تم حذف القسم ($cat_name) بنجاح.",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]]])
  ]);
  
  save($sales);
  exit;
}

// دالة عرض الأقسام للمالك فقط
if($data == 'view_cats_admin' and $chat_id == $admin){
  $categories = $sales['categories'];
  if(count($categories) > 0){
    $msg = "📂 **قائمة الأقسام التدريبية المضافة حالياً:**\n\n";
    foreach($categories as $index => $cat){
      $msg .= ($index+1) . "- $cat\n";
    }
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>$msg,
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
    ]);
  } else {
    bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🚫 لا توجد أقسام مضافة بعد.", 'show_alert'=>true]);
  }
  exit;
}




// البدء بإضافة دورة جديدة (طلب اختيار القسم أولاً)
if($data == 'add_course'){
  $categories = $sales['categories'];
  if(count($categories) > 0){
    $keys = [];
    // التصحيح: استخدام $index بدلاً من اسم القسم الكامل لتجنب تجاوز 64 بايت
    foreach($categories as $index => $cat){
      // نرسل رقم القسم (index) في callback_data لتقليل الحجم، ونبقي الاسم في text ليراه الأدمن
      $keys[] = [['text'=>$cat, 'callback_data'=>"set_cat_for_course:$index"]];
    }
    $keys[] = [['text'=>'- إلغاء الأمر 🚫','callback_data'=>'c']];
    
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'📌 اختر القسم الذي تريد إضافة الدورة الجديدة إليه:',
      'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
    ]);
  } else {
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'🚫 لا توجد أقسام مضافة حالياً. يجب إضافة قسم أولاً قبل إضافة الدورات.',
      'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
    ]);
  }
  exit;
}

// استلام القسم وبدء طلب (اسم الدورة)
if(strpos($data, "set_cat_for_course:") !== false){
  $cat_index = str_replace("set_cat_for_course:", "", $data);
  // التصحيح: تحويل الرقم المستلم مرة أخرى إلى اسم القسم الفعلي من مصفوفة الأقسام
  $cat_name = $sales['categories'][$cat_index];
  
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"📂 القسم المختار: $cat_name\n\nأرسل الآن **اسم الدورة** الجديدة:\nمثال: دبلوم الأمن السيبراني",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- إلغاء 🚫','callback_data'=>'c']]]])
  ]);
  
  $sales['admin_state'][$chat_id] = 'add_course_name';
  $sales['temp_cat'] = $cat_name; // حفظ الاسم الفعلي وليس الرقم لضمان سلامة قاعدة البيانات
  save($sales);
  exit;
}
// استلام اسم الدورة وبدء طلب (وصف الدورة)
if($text != '/start' and $text != null and $sales['admin_state'][$chat_id] == 'add_course_name'){
  // حفظ اسم الدورة المكتوب في ذاكرة البوت المؤقتة
  $sales['temp_course_name'] = $text;
  
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"✅ تم حفظ اسم الدورة: $text
   
الآن أرسل **وصفاً مختصراً** للدورة:
مثال: برنامج شامل لتعلم مهارات الاختراق الأخلاقي من الصفر.",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'- إلغاء 🚫','callback_data'=>'c']]
      ]
    ])
  ]);
  
  // الانتقال للحالة التالية: استلام الوصف
  $sales['admin_state'][$chat_id] = 'add_course_desc';
  save($sales);
  exit;
}

// استلام وصف الدورة وبدء طلب (سعر الدورة)
if($text != '/start' and $text != null and $sales['admin_state'][$chat_id] == 'add_course_desc'){
  // حفظ وصف الدورة في ذاكرة البوت المؤقتة
  $sales['temp_course_desc'] = $text;
  
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"✅ تم حفظ وصف الدورة بنجاح.
   
الآن أرسل **سعر الدورة** (بالأرقام فقط):
مثال: 50
ملاحظة: إذا كانت الدورة مجانية أرسل 0",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'- إلغاء 🚫','callback_data'=>'c']]
      ]
    ])
  ]);
  
  // الانتقال للحالة الأخيرة في الإضافة: استلام السعر والحفظ النهائي
  $sales['admin_state'][$chat_id] = 'add_course_price';
  save($sales);
  exit;
}

// استلام السعر والحفظ النهائي للدورة (يقابل حفظ العرض في المتجر)
if($text != '/start' and $text != null and $sales['admin_state'][$chat_id] == 'add_course_price'){
  
  // 1. حساب ID جديد تلقائياً (أكبر ID + 1)
  $max_id = 0;
  if(!empty($sales['courses'])){
      foreach($sales['courses'] as $course){
          if($course['id'] > $max_id) { $max_id = $course['id']; }
      }
  }
  $new_id = $max_id + 1;

  // 2. تجهيز مصفوفة الدورة الجديدة بالمفاتيح المطابقة لـ db.json
  $new_course = [
      "id" => (int)$new_id,
      "name" => $sales['temp_course_name'],
      "description" => $sales['temp_course_desc'],
      "price" => (float)$text,
      "category" => $sales['temp_cat'],
      "active" => true
  ];

  // 3. إضافة الدورة الجديدة إلى قائمة الدورات
  $sales['courses'][] = $new_course;

  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"✅ تم إضافة الدورة بنجاح إلى قاعدة البيانات!
   
🆔 المعرف: $new_id
📂 القسم: ".$sales['temp_cat']."
📖 الاسم: ".$sales['temp_course_name']."
💰 السعر: $text",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]
      ]
    ])
  ]);

  // 📢 إرسال إشعار تلقائي لجميع المشتركين بالدورة الجديدة
  $all_users = $sales['users'];
  foreach($all_users as $u_id){
      bot('sendMessage',[
          'chat_id'=>$u_id,
          'text'=>"🔔 **دورة تدريبية جديدة متاحــة الآن!**
ــــــــــــــــــــــــــــــــــــــــــــــــ
📖 الاسم: ".$sales['temp_course_name']."
📂 القسم: ".$sales['temp_cat']."
💰 السعر: " . ($text == 0 ? "مجانية 🎁" : "$text $") . "

يمكنك الآن استعراض التفاصيل والتسجيل عبر قائمة 'الأقسام' 🎓",
          'parse_mode'=>"MarkDown"
      ]);
  }



  // 4. تنظيف البيانات المؤقتة وإنهاء الحالة
  $sales['admin_state'][$chat_id] = null;
  $sales['temp_cat'] = null;
  $sales['temp_course_name'] = null;
  $sales['temp_course_desc'] = null;
  
  save($sales);
  exit;
}


// --- لوحة إدارة أكواد الخصم ---
if($data == 'manage_promos'){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"🏷️ **إدارة أكواد الخصم:**\nيمكنك إنشاء أكواد لخصم نسبة مئوية من سعر الدورة.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'➕ إضافة كود جديد','callback_data'=>'add_promo']],
            [['text'=>'➖ حذف كود','callback_data'=>'del_promo']],
            [['text'=>'🔙 عودة','callback_data'=>'c']]
        ]])
    ]);
    exit;
}

// بدء إضافة كود
if($data == 'add_promo'){
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"أرسل الآن **اسم الكود** (بالإنجليزي وبدون مسافات):\nمثال: `SAVE50`"]);
    $sales['admin_state'][$chat_id] = 'wait_promo_name';
    save($sales); exit;
}

if($sales['admin_state'][$chat_id] == 'wait_promo_name' and $text != null){
    $sales['temp_promo_name'] = strtoupper($text);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم حفظ الاسم: $text\nالآن أرسل **نسبة الخصم** (أرقام فقط بدون علامة %):\nمثال: 20"]);
    $sales['admin_state'][$chat_id] = 'wait_promo_pct';
    save($sales); exit;
}

//دالة اضافة الكود للخصم 
if($sales['admin_state'][$chat_id] == 'wait_promo_pct' and is_numeric($text)){
    $sales['temp_promo_pct'] = $text;
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"⏳ الآن أرسل تاريخ انتهاء الكود (السنة-الشهر-اليوم)\nمثال: 2026-12-31"]);
    $sales['admin_state'][$chat_id] = 'wait_promo_end'; save($sales); exit;
}
if($sales['admin_state'][$chat_id] == 'wait_promo_end' and $text){
    $sales['temp_promo_end'] = $text;
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"🔢 أرسل الآن الحد الأقصى لعدد مرات استخدام الكود:"]);
    $sales['admin_state'][$chat_id] = 'wait_promo_limit'; save($sales); exit;
}
if($sales['admin_state'][$chat_id] == 'wait_promo_limit' and is_numeric($text)){
    $name = $sales['temp_promo_name'];
    $sales['promo_codes'][$name] = [
        'pct' => $sales['temp_promo_pct'],
        'start' => date("Y-m-d"),
        'end' => $sales['temp_promo_end'],
        'limit' => (int)$text,
        'used' => 0
    ];
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم تفعيل الكود المتطور بنجاح!"]);
    $sales['admin_state'][$chat_id] = null; save($sales); exit;
}


// --- دالة عرض الأكواد لحذفها ---
if($data == 'del_promo'){
    if(!empty($sales['promo_codes'])){
        $keys = [];
        foreach($sales['promo_codes'] as $name => $pct){
            $keys[] = [['text'=>"$name ($pct%) ❌", 'callback_data'=>"exec_del_promo:$name"]];
        }
        $keys[] = [['text'=>'🔙 رجوع','callback_data'=>'manage_promos']];
        bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"⚠️ اختر الكود الذي تريد حذفه نهائياً:", 'reply_markup'=>json_encode(['inline_keyboard'=>$keys])]);
    } else {
        bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🚫 لا توجد أكواد مضافة حالياً.", 'show_alert'=>true]);
    }
    exit;
}

// تنفيذ الحذف النهائي
if(strpos($data, "exec_del_promo:") !== false){
    $p_name = str_replace("exec_del_promo:", "", $data);
    unset($sales['promo_codes'][$p_name]);
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"✅ تم حذف الكود ($p_name) بنجاح.", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للإدارة 🔙','callback_data'=>'manage_promos']]]])]);
    save($sales); exit;
}



//دالة إعدادات البوت 
if($data == 'settings' and $chat_id == $admin){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"⚙️ **لوحة التحكم في إعدادات المنصة:**
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
يرجى اختيار القسم الذي ترغب في تعديله من الأقسام التالية 👇",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            // الصف الأول
            [['text'=>'🛠 وضع الصيانة','callback_data'=>'menu_maintenance'],['text'=>'📝 تحكم التسجيل','callback_data'=>'menu_reg']],
            // الصف الثاني
            [['text'=>'📄 رسالة /start','callback_data'=>'edit_start'],['text'=>'💳 تعليمات الدفع','callback_data'=>'menu_payment'],['text'=>'📞 الدعم الفني','callback_data'=>'menu_support']],
            // الصف الثالث
            [['text'=>'📢 الإشتراك الإجباري','callback_data'=>'menu_force_join'],['text'=>'🔔 نظام التنبيهات','callback_data'=>'menu_notify']],
            // الصف الرابع (الجديد)
            [['text'=>'🤖 الردود الآلية','callback_data'=>'menu_auto_reply']],
            // الصف الخامس
            [['text'=>'💰 تغيير العملة','callback_data'=>'edit_currency'],['text'=>'🔢 الرقم الأكاديمي','callback_data'=>'edit_start_id']],
            // العودة
            [['text'=>'🔙 العودة للوحة الإدارة','callback_data'=>'c']]
        ]])
    ]);
    exit;
}

// استلام الكلمة المفتاحية (Key)
if($sales['admin_state'][$chat_id] == 'wait_reply_key' and $text != null and $chat_id == $admin){
    $sales['temp_key'] = $text;
    bot('sendMessage', ['chat_id'=>$chat_id, 'text'=>"✅ تم حفظ الكلمة: `$text` \nالآن أرسل **نص الرد** الكامل الذي سيظهر للطالب:"]);
    $sales['admin_state'][$chat_id] = 'wait_reply_val';
    save($sales); exit;
}

// استلام نص الرد (Value) والحفظ النهائي
if($sales['admin_state'][$chat_id] == 'wait_reply_val' and $text != null and $chat_id == $admin){
    $key = $sales['temp_key'];
    $sales['auto_responses'][$key] = $text; 
    bot('sendMessage', ['chat_id'=>$chat_id, 'text'=>"✅ تم تفعيل الرد الآلي بنجاح!\n\n🔹 الكلمة: `$key` \n🔸 الرد: `$text`"]);
    $sales['admin_state'][$chat_id] = null;
    $sales['temp_key'] = null;
    save($sales); exit;
}



// 1. البدء بطلب القسم الذي توجد فيه الدورة المراد حذفها
if($data == 'add_course_del'){ // سنغير callback_data ليكون فريداً
  $categories = $sales['categories'];
  if(count($categories) > 0){
    $keys = [];
    foreach($categories as $cat){
      $keys[] = [['text'=>$cat, 'callback_data'=>"list_courses_for_del:$cat"]];
    }
    $keys[] = [['text'=>'- إلغاء الأمر 🚫','callback_data'=>'c']];
    
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'🗑 لحذف دورة، اختر القسم الذي تنتمي إليه أولاً:',
      'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
    ]);
  } else {
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'🚫 قاعدة البيانات فارغة تماماً من الأقسام.',
      'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
    ]);
  }
  exit;
}

// 2. عرض الدورات الموجودة داخل القسم المختار للحذف
if(strpos($data, "list_courses_for_del:") !== false){
  $cat_name = str_replace("list_courses_for_del:", "", $data);
  $keys = [];
  
  foreach($sales['courses'] as $index => $course){
    if($course['category'] == $cat_name){
      // نرسل الـ index الخاص بالمصفوفة للحذف الدقيق
      $keys[] = [['text'=>$course['name'], 'callback_data'=>"final_del_course:$index"]];
    }
  }
  
  $keys[] = [['text'=>'🔙 رجوع للأقسام','callback_data'=>'add_course_del']];
  
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"⚠️ اختر الدورة التي تريد حذفها نهائياً من قسم ($cat_name):",
    'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
  ]);
  exit;
}

// 3. التنفيذ النهائي لحذف الدورة من مصفوفة courses
if(strpos($data, "final_del_course:") !== false){
  $index = str_replace("final_del_course:", "", $data);
  $course_name = $sales['courses'][$index]['name'];
  
  // حذف الدورة باستخدام الـ index
  unset($sales['courses'][$index]);
  // إعادة ترتيب المصفوفة للحفاظ على نظافة ملف db.json
  $sales['courses'] = array_values($sales['courses']);
  
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"✅ تم حذف الدورة ($course_name) بنجاح من قاعدة البيانات.",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]]])
  ]);
  
  save($sales);
  exit;
}


// عرض طلبات التسجيل الواردة من الطلاب
if($data == 'view_regs'){
  $regs = $sales['registrations'];
  if(count($regs) > 0){
    $msg = "📥 **قائمة طلبات التسجيل المستلمة:**\n(اضغط على زر الجرس للتذكير بالدفع)\n\n";
    $keys = []; // مصفوفة لتجميع أزرار التذكير
    
    foreach($regs as $index => $req){
      $msg .= "🆔 طلب: `".$req['order_id']."`\n";
      $msg .= "👤 الطالب: ".$req['student_name']."\n";
      $msg .= "📚 الدورة: ".$req['course_name']."\n";
      $msg .= "ــــــــــــــــــــــــــــــــــــــــ\n";
      
      // إضافة زر تذكير مخصص لهذا الطلب تحديداً
      $keys[] = [['text'=>"🔔 تذكير للطلب: ".$req['order_id'], 'callback_data'=>"remind_pay:".$req['student_id'].":".$req['order_id']]];
    }
    
    // إضافة أزرار التحكم العامة في نهاية القائمة
    $keys[] = [['text'=>'تنظيف القائمة 🗑','callback_data'=>'clear_regs']];
    $keys[] = [['text'=>'العودة للوحة 🔙','callback_data'=>'c']];
    
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>$msg,
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
    ]);
  } else {
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>'📭 لا توجد طلبات تسجيل جديدة حالياً.',
      'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
    ]);
  }
  exit;
}


// دالة تنظيف قائمة الطلبات
if($data == 'clear_regs'){
    $sales['registrations'] = [];
    save($sales);
    bot('answerCallbackQuery',['callback_query_id'=>$update->callback_query->id, 'text'=>"✅ تم مسح جميع الطلبات.", 'show_alert'=>true]);
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>'📭 القائمة فارغة الآن.', 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])]);
}

if($chat_id != $admin and isset($sales['settings']['channels'])){
    foreach($sales['settings']['channels'] as $chan){
        $get = bot('getChatMember',['chat_id'=>$chan, 'user_id'=>$chat_id]);
        $status = $get->result->status;
        if($status == 'left' or $status == 'kicked' or !$get->ok){
            bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"⚠️ عذراً، يجب عليك الإشتراك في قناة المنصة أولاً لتتمكن من استخدام البوت:\n\n$chan\n\nبعد الإشتراك أرسل /start مجدداً."]);
            exit;
        }
    }
}


// رسالة الترحيب للطلاب والمستخدمين (واجهة المستخدم)
if($chat_id != $admin){
 if(preg_match('/\/(start)(.*)/', $text)){
  
  // التأكد من وجود المستخدم في الإحصائيات (نفس منطق المتجر)
  if(!in_array($chat_id, $sales['users'])){
      $sales['users'][] = $chat_id;
      save($sales);
  }

  bot('sendmessage',[
   'chat_id'=>$chat_id,
'text'=>$sales['settings']['start_msg'],
   'parse_mode'=>"MarkDown",
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
     // السطر الأول: الزر الأساسي (كبير)
     [['text'=>'📚 استعراض الأقسام التدريبية','callback_data'=>'user_cats']],
     [['text'=>'📥 طلباتي','callback_data'=>'my_orders'], ['text'=>'💬 رسائل خاصة','callback_data'=>'contact_admin']],
     [['text'=>'ℹ️ عن المنصة','callback_data'=>'about_us'], ['text'=>'📞 الدعم الفني','url'=>"tg://user?id=$admin"]]
]

    
   ])
  ]);
  
  $sales['users_state'][$chat_id] = null;
  save($sales);
  exit;
 }
}


// عرض الأقسام التدريبية للمستخدم بشكل أزرار
if($data == 'user_cats'){
  $categories = $sales['categories'];
  
  if(count($categories) > 0){
    $keys = [];
    $rows = []; // مصفوفة لتجميع الأزرار
    
    foreach($categories as $index => $cat){
      // التصحيح: نرسل $index (رقم القسم) بدلاً من الاسم $cat لتوفير المساحة ومنع التهنيج
      $rows[] = ['text'=>$cat, 'callback_data'=>"show_courses:$index"];
    }
    
    // تقسيم الأقسام ليكون كل زرين في صف واحد
    $chunks = array_chunk($rows, 2); 
    $keys = $chunks;
    
    // إضافة زر العودة للقائمة الرئيسية للمستخدم
    $keys[] = [['text'=>'🔙 العودة للرئيسية','callback_data'=>'home_user']];
    
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>"📚 **الأقسام التدريبية المتاحة:**\nــــــــــــــــــــــــــــــــــــــــــــــــ\nيرجى اختيار القسم الذي ترغب في استعراض دوراته:",
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
    ]);
  } else {
    bot('answerCallbackQuery',[
      'callback_query_id'=>$up->id,
      'text'=>"🚫 لا توجد أقسام متوفرة حالياً.",
      'show_alert'=>true
    ]);
  }
  exit;
}


// دالة العودة للرئيسية للمستخدم (home_user)
if($data == 'home_user'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"🎓 **مرحباً بك في منصة التدريب والتعليم** 💡
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
يرجى اختيار القسم الذي تود استكشافه من القائمة أدناه 👇",
    'parse_mode'=>"MarkDown",
    'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'📚 استعراض الأقسام التدريبية','callback_data'=>'user_cats']],
      [['text'=>'📥 طلباتي','callback_data'=>'my_orders']],
      [['text'=>'ℹ️ عن المنصة','callback_data'=>'about_us'],['text'=>'📞 الدعم الفني','url'=>"tg://user?id=$admin"]],
     ] 
    ])
  ]);
  exit;
}


// عرض الدورات التدريبية المتاحة داخل القسم المختار
if(strpos($data, "show_courses:") !== false){
  $cat_index = str_replace("show_courses:", "", $data);
  
  // التصحيح الجوهري: تحويل الرقم المستلم إلى الاسم الفعلي من المصفوفة
  $cat_name = $sales['categories'][$cat_index]; 
  
  $courses = $sales['courses'];
  $keys = [];
  
  foreach($courses as $course){
    if($course['category'] == $cat_name && $course['active'] == true){
      $keys[] = [['text'=>$course['name'], 'callback_data'=>"course_info:".$course['id']]];
    }
  }
  
  if(count($keys) > 0){
    $keys[] = [['text'=>'🔙 العودة للأقسام','callback_data'=>'user_cats']];
    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>"📚 **دورات قسم ($cat_name):**\nــــــــــــــــــــــــــــــــــــــــــــــــ\nاختر الدورة التي ترغب في معرفة تفاصيلها والتسجيل بها 👇",
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode(['inline_keyboard'=>$keys])
    ]);
  } else {
    bot('answerCallbackQuery',[
      'callback_query_id'=>$up->id,
      'text'=>"🚫 عذراً، لا توجد دورات متاحة في هذا القسم حالياً.",
      'show_alert'=>true
    ]);
  }
  exit;
}




// دالة عرض تفاصيل الدورة بناءً على المعرف (ID)
if(strpos($data, "course_info:") !== false){
  $course_id = (int)str_replace("course_info:", "", $data);
  $courses = $sales['courses'];
  $selected_course = null;
  $cat_index = null; // متغير جديد لتحديد رقم القسم للعودة الصحيحة

  // البحث عن الدورة المطابقة للـ ID في مصفوفة db.json
  foreach($courses as $course){
    if($course['id'] == $course_id){
      $selected_course = $course;
      // البحث عن ترتيب القسم (Index) في مصفوفة الأقسام لضمان عمل زر العودة
      $cat_index = array_search($course['category'], $sales['categories']);
      break;
    }
  }

  if($selected_course){
    $name = $selected_course['name'];
    $desc = $selected_course['description'];
    $price = $selected_course['price'];
    $cat = $selected_course['category'];
    
    // تنسيق السعر (إذا كان 0 يظهر "مجانية")
    $price_text = ($price == 0) ? "مجانية 🎁" : "$price " . $sales['settings']['currency'];

    $text_msg = "📖 **تفاصيل الدورة التدريبية:**\n";
    $text_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $text_msg .= "📌 **الاسم:** $name\n";
    $text_msg .= "📂 **القسم:** $cat\n";
    $text_msg .= "📝 **الوصف:** $desc\n";
    $text_msg .= "💰 **رسوم الاشتراك:** $price_text\n";
    $text_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $text_msg .= "💡 هل تود التسجيل في هذه الدورة الآن؟";

    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>$text_msg,
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode([
        'inline_keyboard'=>[
          [['text'=>'✅ اشتراك في الدورة','callback_data'=>"register_course:".$course_id]],
          // التصحيح: إرسال $cat_index بدلاً من $cat ليتوافق مع دالة show_courses
          [['text'=>'🔙 العودة للدورات','callback_data'=>"show_courses:".$cat_index]]
        ]
      ])
    ]);
  }
  exit;
}


// بدء عملية التسجيل (المرحلة 1: طلب الاسم واللقب)
if(strpos($data, "register_course:") !== false){
  $course_id = (int)str_replace("register_course:", "", $data);
  $courses = $sales['courses'];
  $course_name = "";

  foreach($courses as $course){
    if($course['id'] == $course_id){
      $course_name = $course['name'];
      break;
    }
  }

  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"📝 **استمارة التسجيل في دورة:**\n📌 $course_name\n\nالتقدم: [■□□□□□] 1/6\n\nخطوة (1): يرجى إرسال **الاسم الثلاثي مع اللقب** باللغة العربية 👇",
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>'- إلغاء التسجيل 🚫','callback_data'=>'user_cats']]
      ]
    ])
  ]);

  // وضع المستخدم في حالة انتظار الاسم وحفظ ID الدورة
  $sales['users_state'][$chat_id] = 'wait_full_name';
  $sales[$chat_id]['temp_reg_id'] = $course_id;
  $sales[$chat_id]['temp_reg_name'] = $course_name;
  save($sales);
  exit;
}


// --- دالة العودة للخطوات السابقة (نظام التراجع الذكي) ---
if(strpos($data, "back_to_") !== false){
    $target = str_replace("back_to_", "", $data);
    
    if($target == 'name'){
        $course_name = $sales[$chat_id]['temp_reg_name'];
        bot('editMessageText',[
            'chat_id'=>$chat_id, 'message_id'=>$message_id,
            'text'=>"📝 **استمارة التسجيل:**\n📌 $course_name\n\nالتقدم: [■□□□□□] 1/6\n\nخطوة (1): يرجى إرسال **الاسم الثلاثي واللقب** 👇",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- إلغاء 🚫','callback_data'=>'user_cats']]]])
        ]);
        $sales['users_state'][$chat_id] = 'wait_full_name';
    }
    
    if($target == 'gender'){
        bot('editMessageText',[
            'chat_id'=>$chat_id, 'message_id'=>$message_id,
            'text'=>"التقدم: [■■□□□□] 2/6\n\nخطوة (2): يرجى اختيار **الجنس** 👇",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'ذكر 👨‍💼','callback_data'=>'set_gender:ذكر'],['text'=>'أنثى 👩‍💼','callback_data'=>'set_gender:أنثى']],[['text'=>'🔙 رجوع','callback_data'=>'back_to_name']]]])
        ]);
        $sales['users_state'][$chat_id] = 'wait_gender';
    }

    if($target == 'age'){
        bot('editMessageText',[
            'chat_id'=>$chat_id, 'message_id'=>$message_id,
            'text'=>"التقدم: [■■■□□□] 3/6\n\nخطوة (3): يرجى إرسال **العمر** (أرقام فقط) 👇",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'🔙 رجوع','callback_data'=>'back_to_gender']]]])
        ]);
        $sales['users_state'][$chat_id] = 'wait_age';
    }

    if($target == 'country'){
        bot('editMessageText',[
            'chat_id'=>$chat_id, 'message_id'=>$message_id,
            'text'=>"التقدم: [■■■■□□] 4/6\n\nخطوة (4): يرجى إرسال **اسم البلد** 👇",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'🔙 رجوع','callback_data'=>'back_to_age']]]])
        ]);
        $sales['users_state'][$chat_id] = 'wait_country';
    }

    if($target == 'phone'){
        bot('editMessageText',[
            'chat_id'=>$chat_id, 'message_id'=>$message_id,
            'text'=>"التقدم: [■■■■■□] 5/6\n\nخطوة (5): يرجى إرسال **رقم الهاتف** مع المفتاح الدولي 👇",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'🔙 رجوع','callback_data'=>'back_to_country']]]])
        ]);
        $sales['users_state'][$chat_id] = 'wait_phone';
    }
    
    save($sales);
    exit;
}




//دالة الرد على الطالب 
if($sales['users_state'][$chat_id] == 'wait_msg_to_admin' and $text != null and $text != "/start"){
    $today = date("Y-m-d");
    
    // تحديث عداد الرسائل
    if(!isset($sales['msg_limit'][$chat_id]) or $sales['msg_limit'][$chat_id]['date'] != $today){
        $sales['msg_limit'][$chat_id] = ['date' => $today, 'count' => 1];
    } else {
        $sales['msg_limit'][$chat_id]['count']++;
    }

    // 1. إشعار الطالب بالنجاح
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ **تم إرسال رسالتك بنجاح.**\nسيصلك الرد هنا قريباً.\n\nالرسائل المتبقية لك اليوم: " . (5 - $sales['msg_limit'][$chat_id]['count']),
        'parse_mode'=>"MarkDown"
    ]);

    // 2. توجيه الرسالة للأدمن (بتنسيق يدعم الرد الذكي)
    $msg_to_admin = "📬 **رسالة خاصة جديدة من طالب:**\n";
    $msg_to_admin .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $msg_to_admin .= "👤 **الاسم:** $name\n";
    $msg_to_admin .= "🆔 آيدي التليجرام: `".$chat_id."`\n";
    $msg_to_admin .= "💬 **الرسالة:**\n$text\n";
    $msg_to_admin .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $msg_to_admin .= "💡 يمكنك الرد مباشرة على هذه الرسالة للتواصل مع الطالب.";

    bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>$msg_to_admin,
        'parse_mode'=>"MarkDown"
    ]);

    // إنهاء الحالة وحفظ البيانات
    $sales['users_state'][$chat_id] = null;
    save($sales);
    exit;
}



// استلام الاسم الثلاثي واللقب -> طلب الجنس (أزرار)
if($text != '/start' and $text != null and $sales['users_state'][$chat_id] == 'wait_full_name'){
  // حفظ الاسم في ذاكرة المستخدم المؤقتة
  $sales[$chat_id]['temp_student_name'] = $text;
  
        bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"✅ تم حفظ الاسم بنجاح.\n\nالتقدم: [■■□□□□] 2/6\n\nخطوة (2): يرجى اختيار **الجنس** من الأزرار أدناه 👇",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
  [['text'=>'ذكر 👨‍💼','callback_data'=>'set_gender:ذكر'],['text'=>'أنثى 👩‍💼','callback_data'=>'set_gender:أنثى']],
  [['text'=>'🔙 رجوع','callback_data'=>'back_to_name'],['text'=>'- إلغاء 🚫','callback_data'=>'user_cats']]
]

    ])
  ]);
  
  // تغيير الحالة لانتظار اختيار الجنس من الأزرار
  $sales['users_state'][$chat_id] = 'wait_gender';
  save($sales);
  exit;
}

// استلام الجنس من الأزرار -> طلب العمر (كتابة)
if(strpos($data, "set_gender:") !== false and $sales['users_state'][$chat_id] == 'wait_gender'){
  $gender = str_replace("set_gender:", "", $data);
  
  // حفظ الجنس في ذاكرة الطالب المؤقتة
  $sales[$chat_id]['temp_student_gender'] = $gender;
  
  bot('editMessageText',[
   'chat_id'=>$chat_id,
   'message_id'=>$message_id,
  'text'=>"✅ تم تحديد الجنس بنجاح.\n\nالتقدم: [■■■□□□] 3/6\n\nخطوة (3): يرجى إرسال **العمر** (بالأرقام فقط) 👇",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
  [['text'=>'🔙 رجوع للخطوة السابقة','callback_data'=>'back_to_gender']],
  [['text'=>'- إلغاء التسجيل 🚫','callback_data'=>'user_cats']]
]


    ])
  ]);
  
  // الانتقال لحالة انتظار العمر
  $sales['users_state'][$chat_id] = 'wait_age';
  save($sales);
  exit;
}

// استلام العمر -> طلب البلد (كتابة)
if($text != '/start' and $text != null and $sales['users_state'][$chat_id] == 'wait_age'){
  
  // 🛡️ بداية نظام التحقق الذكي
  if(!is_numeric($text) or $text < 5 or $text > 100){
      bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"⚠️ **عذراً، يرجى إدخال العمر بالأرقام فقط (مثال: 25)**\nويجب أن يكون عمرك بين 5 و 100 عام."       
      ]);
      exit; // نتوقف هنا ولا نحفظ البيانات الخاطئة
  }
  // 🛡️ نهاية نظام التحقق

  // إذا اجتاز الاختبار، نكمل الحفظ الطبيعي
  $sales[$chat_id]['temp_student_age'] = $text;
  
  bot('sendMessage',[
   'chat_id'=>$chat_id,
  'text'=>"✅ تم حفظ العمر بنجاح.\n\nالتقدم: [■■■■□□] 4/6\n\nخطوة (4): يرجى إرسال **اسم البلد** المقيم فيه حالياً 👇",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
  [['text'=>'🔙 رجوع للخطوة السابقة','callback_data'=>'back_to_age']],
  [['text'=>'- إلغاء التسجيل 🚫','callback_data'=>'user_cats']]
]

    ])
  ]);
  
  $sales['users_state'][$chat_id] = 'wait_country';
  save($sales);
  exit;
}


// استلام البلد -> طلب رقم الهاتف (كتابة)
if($text != '/start' and $text != null and $sales['users_state'][$chat_id] == 'wait_country'){
  
  // 🛡️ بداية نظام التحقق الذكي من اسم البلد
  // التحقق من طول النص (بين 3 و 30 حرف) ومنع الأرقام
  if(mb_strlen($text, 'UTF-8') < 3 or mb_strlen($text, 'UTF-8') > 30 or preg_match('~[0-9]~', $text)){
      bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"⚠️ **اسم البلد غير منطقي!**\nيرجى كتابة اسم البلد بشكل صحيح باللغة العربية أو الإنجليزية (مثلاً: اليمن) بدون استخدام أرقام أو رموز."
      ]);
      exit; // توقف هنا
  }
  // 🛡️ نهاية نظام التحقق

  // حفظ البلد في ذاكرة الطالب المؤقتة
  $sales[$chat_id]['temp_student_country'] = $text;
  
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"✅ تم حفظ البلد بنجاح.\n\nالتقدم: [■■■■■□] 5/6\n\nخطوة (5): يرجى إرسال **رقم الهاتف** مع مفتاح الدولي 👇",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
  [['text'=>'🔙 رجوع للخطوة السابقة','callback_data'=>'back_to_country']],
  [['text'=>'- إلغاء التسجيل 🚫','callback_data'=>'user_cats']]
]

    ])
  ]);
  
  // الانتقال لحالة انتظار رقم الهاتف
  $sales['users_state'][$chat_id] = 'wait_phone';
  save($sales);
  exit;
}


// استلام رقم الهاتف -> طلب البريد الإلكتروني (كتابة)
if($text != '/start' and $text != null and $sales['users_state'][$chat_id] == 'wait_phone'){
  
  // 🛡️ نظام التحقق الذكي من رقم الهاتف (Validation)
  // يسمح بعلامة + اختيارية ويتبعها من 7 إلى 15 رقم فقط
  if(!preg_match('/^\+?[0-9]{7,15}$/', $text)){
      bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"⚠️ **رقم الهاتف غير صحيح!**\nيرجى إرسال رقم هاتف حقيقي (أرقام فقط) مع مفتاح الدولي.\nمثال: `+967770000000`"
      ]);
      exit; // توقف ولا تحفظ البيانات الخاطئة
  }
  // 🛡️ نهاية نظام التحقق

  // حفظ رقم الهاتف في ذاكرة الطالب المؤقتة بعد التأكد من صحته
  $sales[$chat_id]['temp_student_phone'] = $text;
  
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"✅ تم حفظ رقم الهاتف بنجاح.\n\nالتقدم: [■■■■■■] 6/6\n\nالخطوة الأخيرة (6): يرجى إرسال **بريدك الإلكتروني (الإيميل)** 👇",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
  [['text'=>'🔙 رجوع للخطوة السابقة','callback_data'=>'back_to_phone']],
  [['text'=>'- إلغاء التسجيل 🚫','callback_data'=>'user_cats']]
]

    ])
  ]);
  
  // الانتقال لحالة انتظار البريد الإلكتروني (الختام)
  $sales['users_state'][$chat_id] = 'wait_email';
  save($sales);
  exit;
}

// استلام البريد الإلكتروني -> طلب كود الخصم (بدلاً من المراجعة الفورية)
if($text != '/start' and $text != null and $sales['users_state'][$chat_id] == 'wait_email'){
  
  // 🛡️ التحقق من صحة الإيميل
  if(!filter_var($text, FILTER_VALIDATE_EMAIL)){
      bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"⚠️ **عذراً، البريد الإلكتروني غير صحيح!**\nيرجى إرسال بريد إلكتروني صالح.\nمثال: `student@gmail.com`"
      ]);
      exit;
  }

  // 1. حفظ البريد الإلكتروني في ذاكرة الطالب
  $sales[$chat_id]['temp_student_email'] = $text;
  
  // 2. إرسال رسالة طلب كود الخصم مع زر التخطي
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"🎁 **هل تمتلك كود خصم (برومو كود)؟**\n\nإذا كان لديك كود خصم أرسله الآن للحصول على تخفيض، أو اضغط على الزر أدناه لتخطي هذه الخطوة 👇",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'تخطي هذه الخطوة ⏩','callback_data'=>'skip_promo']]
      ]
    ])
  ]);
  
  // 3. تغيير الحالة لانتظار كود الخصم
  $sales['users_state'][$chat_id] = 'wait_promo_code';
  save($sales);
  exit;
}



// --- معالجة (الرقم الأكاديمي الإجباري + كود الخصم الاختياري المتطور) ---
if(($sales['users_state'][$chat_id] == 'wait_promo_code' and $text != null) or $data == 'skip_promo'){
    
    // 1. جلب بيانات الدورة والسعر
    $course_id = $sales[$chat_id]['temp_reg_id'];
    $course_name = $sales[$chat_id]['temp_reg_name'];
    $original_price = 0;
    foreach($sales['courses'] as $c){ 
        if($c['id'] == $course_id) $original_price = (float)$c['price']; 
    }
    
    // 2. حساب الخصم المتطور (التاريخ + العدد)
    $discount_pct = 0;
    $promo_applied = "لا يوجد (سعر كامل)";
    $current_date = date("Y-m-d");

    if($text != null and $data != 'skip_promo'){
        $input_code = strtoupper(trim($text));
        
        if(isset($sales['promo_codes'][$input_code])){
            $p_data = $sales['promo_codes'][$input_code];
            
            // التحقق من الصلاحية (التاريخ والعدد)
            $is_started = ($current_date >= $p_data['start']);
            $is_expired = ($current_date > $p_data['end']);
            $has_limit  = ($p_data['used'] < $p_data['limit']);

            if($is_started and !$is_expired and $has_limit){
                $discount_pct = (int)$p_data['pct'];
                $promo_applied = "✅ كود ($input_code) خصم $discount_pct%";
                // ملاحظة: زيادة عدد الاستخدام تتم عند التأكيد النهائي (confirm_reg) لضمان عدم ضياع الكود
            } else {
                $promo_applied = "❌ الكود ($input_code) منتهي الصلاحية أو استنفد حد الاستخدام";
            }
        } else {
            $promo_applied = "❌ الكود ($input_code) غير صحيح";
        }
    }

    $discount_amount = ($original_price * $discount_pct) / 100;
    $final_price = $original_price - $discount_amount;

    // 3. توليد الرقم الأكاديمي الإجباري (يولد دائماً لكل طالب)
    if(!isset($sales['last_reg_id'])) $sales['last_reg_id'] = 1000000100;
    $sales['last_reg_id']++;
    $academic_id = $sales['last_reg_id'];

    // 4. حفظ النتائج النهائية وجميع بيانات الطالب (دمج الوظائف)
    $sales[$chat_id]['temp_order_id'] = $academic_id;
    $sales[$chat_id]['final_price']   = $final_price;
    $sales[$chat_id]['promo_info']    = $promo_applied;
    $sales[$chat_id]['used_promo']    = ($discount_pct > 0) ? $input_code : null; // لحفظ الكود المستخدم

    // 5. تجميع بيانات المراجعة الكاملة (بدون نقص أي معلومة كما طلبت)
    $full_name = $sales[$chat_id]['temp_student_name'];
    $gender    = $sales[$chat_id]['temp_student_gender'];
    $age       = $sales[$chat_id]['temp_student_age'];
    $country   = $sales[$chat_id]['temp_student_country'];
    $phone     = $sales[$chat_id]['temp_student_phone'];
    $email     = $sales[$chat_id]['temp_student_email'];

    $review_msg = "📝 **مراجعة بيانات التسجيل النهائية الشاملة:**\n";
    $review_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $review_msg .= "🆔 **الرقم الأكاديمي:** `$academic_id`\n";
    $review_msg .= "📚 **الدورة:** $course_name\n";
    $review_msg .= "👤 **الاسم:** $full_name\n";
    $review_msg .= "🚻 **الجنس:** $gender\n";
    $review_msg .= "🎂 **العمر:** $age\n";
    $review_msg .= "🌍 **البلد:** $country\n";
    $review_msg .= "📞 **الهاتف:** `$phone`\n";
    $review_msg .= "📧 **الإيميل:** $email\n";
    $review_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $review_msg .= "🎫 **حالة الخصم:** $promo_applied\n";
    $review_msg .= "💵 **السعر الأصلي:** `" . $original_price . " " . $sales['settings']['currency'] . "`\n";
    $review_msg .= "💵 **المبلغ المطلوب:** `" . $final_price . " " . $sales['settings']['currency'] . "`\n";
    $review_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $review_msg .= "⚠️ **هل جميع البيانات والسعر أعلاه صحيحة؟**";

    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$review_msg,
        'parse_mode'=>"MarkDown",
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'✅ نعم، البيانات صحيحة','callback_data'=>'confirm_reg']],
                [['text'=>'❌ إعادة إدخال البيانات','callback_data'=>"register_course:".$course_id]]
            ]
        ])
    ]);
    
    $sales['users_state'][$chat_id] = 'wait_confirmation';
    save($sales);
    exit;
}


// دالة التأكيد النهائي وحفظ البيانات في قاعدة البيانات
if($data == 'confirm_reg' and $sales['users_state'][$chat_id] == 'wait_confirmation'){
  
  // 1. تجميع البيانات النهائية من ذاكرة الطالب المؤقتة
  $order_id  = $sales[$chat_id]['temp_order_id'];
  $full_name = $sales[$chat_id]['temp_student_name'];
  $gender    = $sales[$chat_id]['temp_student_gender'];
  $age       = $sales[$chat_id]['temp_student_age'];
  $country   = $sales[$chat_id]['temp_student_country'];
  $phone     = $sales[$chat_id]['temp_student_phone'];
  $email     = $sales[$chat_id]['temp_student_email'];
  $course    = $sales[$chat_id]['temp_reg_name'];
  $date_now  = date("Y-m-d H:i:s");

  // 2. تجهيز مصفوفة التسجيل (مطابقة لتنسيق db.json المطلوب)
  $registration_entry = [
      "order_id"     => $order_id,
      "student_id"   => $chat_id,
      "student_name" => $full_name,
      "gender"       => $gender,
      "age"          => $age,
      "country"      => $country,
      "phone"        => $phone,
      "email"        => $email,
      "course_name"  => $course,
      "date"         => $date_now
  ];

  // 3. الحفظ في مصفوفة registrations الأساسية
  $sales['registrations'][] = $registration_entry;

  // تحديث عداد استخدام كود الخصم
  if(isset($sales[$chat_id]['used_promo'])){
      $p_code = $sales[$chat_id]['used_promo'];
      if(isset($sales['promo_codes'][$p_code])){
          $sales['promo_codes'][$p_code]['used']++;
      }
  }

  // 4. إرسال رسالة نجاح للطالب
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"✅ **تم إرسال طلبك بنجاح!**\n\n🆔 رقم الطلب الخاص بك: `$order_id`\n📚 الدورة: $course\n\nسيقوم القسم المختص بمراجعة بياناتك والتواصل معك قريباً عبر الهاتف أو الإيميل. شكراً لثقتك بنا 🎓",
    'parse_mode'=>"MarkDown",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للرئيسية 🔙','callback_data'=>'home_user']]]])
  ]);

// إشعار المطور المطور
$final_p = $sales[$chat_id]['final_price'];
$promo_n = $sales[$chat_id]['promo_info'];
$email_s = $sales[$chat_id]['temp_student_email']; 

$admin_msg = "🔔 **طلب تسجيل جديد ورد الآن:**\n";
$admin_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
$admin_msg .= "🆔 رقم الطلب: `$order_id`\n";
$admin_msg .= "👤 الطالب: $full_name\n";
$admin_msg .= "📚 الدورة: $course\n";
$admin_msg .= "🎫 الخصم: $promo_n\n";
$admin_msg .= "💵 **المبلغ المطلوب:** `" . $final_p . " " . $sales['settings']['currency'] . "`\n";
$admin_msg .= "📞 الهاتف: $phone\n";
$admin_msg .= "📧 البريد: $email_s\n";
$admin_msg .= "🆔 آيدي التليجرام: `".$chat_id."` \n"; // ضروري لعمل الرد الذكي
$admin_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ";



bot('sendMessage',[
  'chat_id'=>$admin,
  'text'=>$admin_msg,
  'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
      [['text'=>'✅ قبول الطلب','callback_data'=>"approve_reg:$chat_id:$order_id"]],
      [['text'=>'❌ رفض الطلب','callback_data'=>"reject_reg:$chat_id:$order_id"]]
    ]
  ])
]);

// 6. تنظيف ذاكرة المستخدم المؤقتة وإغلاق الحالة
$sales['users_state'][$chat_id] = null; // نحذف الحالة فقط ونبقي بيانات الـ ID إذا احتجنا
save($sales);
exit;
}


// 1. حالة النقر على "قبول الطلب"
if(strpos($data, "approve_reg:") !== false){
  $ex = explode(":", $data);
  $student_id = $ex[1];
  $order_id   = $ex[2];

  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"✅ **قبول الطلب رقم:** `$order_id`
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
لقد اخترت قبول الطالب، كيف ترغب في إرسال تعليمات الدفع له؟ 👇",
    'parse_mode'=>"MarkDown",
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>'📄 إرسال التعليمات الجاهزة','callback_data'=>"send_saved_pay:$student_id:$order_id"]],
        [['text'=>'✍️ كتابة رسالة يدوية مخصصة','callback_data'=>"type_manual_pay:$student_id:$order_id"]],
        [['text'=>'🔙 تراجع','callback_data'=>'c']]
      ]
    ])
  ]);
  exit;
}

// --- 1. تنفيذ إرسال التعليمات الجاهزة (من الإعدادات) ---
if(strpos($data, "send_saved_pay:") !== false){
  $ex = explode(":", $data);
  $student_id = $ex[1];
  $order_id   = $ex[2];
  
  $saved_info = $sales['settings']['pay_info'] ?? "يرجى التواصل مع الإدارة لإتمام الدفع.";

  $full_message = "✅ **تهانينا! تم قبول طلب تسجيلك في الدورة.**\n\n";
  $full_message .= "🆔 رقم الطلب: `$order_id`\n";
  $full_message .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $full_message .= "$saved_info\n"; 
  $full_message .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $full_message .= "📝 **الآن، الرجاء إرسال إيصال الدفع هنا.**";

  bot('sendMessage',['chat_id'=>$student_id, 'text'=>$full_message, 'parse_mode'=>"MarkDown"]);
  
  bot('editMessageText',[
    'chat_id'=>$chat_id, 'message_id'=>$message_id, 
    'text'=>"✅ تم إرسال التعليمات الجاهزة للطالب بنجاح.",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
  ]);
  exit;
}

// --- 2. طلب كتابة رسالة يدوية ---
if(strpos($data, "type_manual_pay:") !== false){
  $ex = explode(":", $data);
  $student_id = $ex[1];
  $order_id   = $ex[2];

  bot('editMessageText',[
    'chat_id'=>$chat_id, 'message_id'=>$message_id,
    'text'=>"✍️ **كتابة رسالة يدوية:**\nأرسل الآن النص الذي تريد أن يصله مع طلب الإيصال:",
  ]);

  $sales['admin_state'][$chat_id] = 'wait_accept_text';
  $sales['target_student'] = $student_id;
  $sales['target_order'] = $order_id;
  save($sales);
  exit;
}


// 2. استلام نص القبول من المطور وإرساله للطالب
// استلام نص القبول من المطور وإرساله للطالب بالتنسيق الإجباري
if($text != null and $sales['admin_state'][$chat_id] == 'wait_accept_text' and $chat_id == $admin){
  $student_id = $sales['target_student'];
  $order_id   = $sales['target_order'];

  // التنسيق الإجباري (رأس + نصك + تذييل)
  $full_message = "✅ **تهانينا! تم قبول طلب تسجيلك في الدورة.**\n\n";
  $full_message .= "🆔 رقم الطلب: `$order_id`\n";
  $full_message .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $full_message .= "$text\n"; 
  $full_message .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $full_message .= "📝 **الآن، الرجاء إرسال إيصال الدفع هنا.**";

  bot('sendMessage',[
    'chat_id'=>$student_id,
    'text'=>$full_message,
    'parse_mode'=>"MarkDown"
  ]);

  bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"✅ تم إرسال إشعار القبول للطالب بالتنسيق المعتمد.",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
  ]);

 $sales['admin_state'][$chat_id] = null;
  save($sales);
  exit;
}


// 3. حالة النقر على "رفض الطلب"
if(strpos($data, "reject_reg:") !== false){
  $ex = explode(":", $data);
  $student_id = $ex[1];
  $order_id   = $ex[2];

  bot('sendMessage',[
    'chat_id'=>$student_id,
    'text'=>"❌ **نعتذر منك.. تم رفض طلب التسجيل**\n🆔 رقم الطلب: `$order_id`\n\nيمكنك التواصل مع الدعم الفني للاستفسار عن الأسباب.",
    'parse_mode'=>"MarkDown"
  ]);

  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"🔴 تم رفض الطلب رقم `$order_id` وإشعار الطالب بذلك.",
    'parse_mode'=>"MarkDown"
  ]);
  exit;
}

// --- دالة تنفيذ التذكير بالدفع (ترسل للطالب وتُشعر الآدمن) ---
if(strpos($data, "remind_pay:") !== false){
    $ex = explode(":", $data);
    $student_id = $ex[1];
    $order_id   = $ex[2];

    // 1. إرسال الرسالة للطالب
    bot('sendMessage',[
        'chat_id'=>$student_id,
        'text'=>"⚠️ **تذكير من إدارة المنصة:**

لقد قمت بالتسجيل في إحدى دوراتنا وحصلت على الرقم الأكاديمي: `$order_id`

يرجى التكرم بإرسال إيصال الدفع هنا لكي نتمكن من تفعيل اشتراكك النهائي والبدء في الدراسة. إذا واجهت أي مشكلة تواصل معنا عبر الدعم الفني 🎓",
        'parse_mode'=>"MarkDown"
    ]);

    // 2. إظهار إشعار سريع للمالك (Pop-up) بأنه تم الإرسال
    bot('answerCallbackQuery',[
        'callback_query_id'=>$up->id,
        'text'=>"✅ تم إرسال تنبيه للطالب بالدفع بنجاح.",
        'show_alert'=>false // اجعلها true إذا أردتها نافذة منبثقة كبيرة
    ]);
    exit;
}



// دالة استقبال الإيصال وتحويله للمطور مع أزرار المصادقة
if(($message->photo or $message->document) and $chat_id != $admin){
  
  // جلب الرقم الأكاديمي الذي تم توليده سابقاً
  $academic_id = $sales[$chat_id]['temp_order_id'] ?? "1000000XXX";

  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ **تم إرسال سند الإيصال الخاص بك بنجاح.**\n\nيرجى الانتظار حتى يتم مراجعته والمصادقة عليه من قبل الإدارة.",
    'parse_mode'=>"MarkDown"
  ]);
  
  

  // 2. إشعار المطور مع أزرار (قبول الإيصال / رفض الإيصال)
  $caption = "🧾 **وصل إيصال دفع جديد للمراجعة:**\n";
  $caption .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $caption .= "🆔 **الرقم الأكاديمي:** `$academic_id`\n";
  $caption .= "👤 الطالب: [$user](tg://user?id=$chat_id)\n";
  $caption .= "🆔 آيدي التليجرام: `$chat_id`\n";
  $caption .= "ــــــــــــــــــــــــــــــــــــــــــــــــ";

  $receipt_keyboard = json_encode([
    'inline_keyboard'=>[
      [['text'=>'✅ قبول الإيصال','callback_data'=>"confirm_receipt:$chat_id:$academic_id"]],
      [['text'=>'❌ رفض الإيصال','callback_data'=>"decline_receipt:$chat_id:$academic_id"]]
    ]
  ]);

  if($message->photo){
      $file_id = $message->photo[count($message->photo)-1]->file_id;
      bot('sendPhoto',['chat_id'=>$admin, 'photo'=>$file_id, 'caption'=>$caption, 'parse_mode'=>"MarkDown", 'reply_markup'=>$receipt_keyboard]);
  } elseif($message->document){
      $file_id = $message->document->file_id;
      bot('sendDocument',['chat_id'=>$admin, 'document'=>$file_id, 'caption'=>$caption, 'parse_mode'=>"MarkDown", 'reply_markup'=>$receipt_keyboard]);
  }
  exit;
}


// 1. حالة قبول الإيصال والمصادقة عليه
if(strpos($data, "confirm_receipt:") !== false){
  $ex = explode(":", $data);
  $student_id  = $ex[1];
  $academic_id = $ex[2];

  // 1. تحديث الرسالة عند المطور لطلب الرابط
  bot('editMessageCaption',[
    'chat_id'=>$admin,
    'message_id'=>$message_id,
    'caption'=>"✅ **تم اختيار قبول الإيصال للرقم الأكاديمي:** `$academic_id`
    
الآن، يرجى إرسال (رابط مجموعة الدورة) أو (بيانات تسجيل الدخول) التي تريد وصولها للطالب فوراً 👇",
    'parse_mode'=>"MarkDown"
  ]);

  // 2. وضع المطور في حالة انتظار الرابط وحفظ بيانات الطالب المستهدف
  $sales['admin_state'][$chat_id] = 'wait_course_link';
  $sales['target_student'] = $student_id;
  $sales['target_academic_id'] = $academic_id;
  save($sales);
  exit;
}

if($text != null and $sales['admin_state'][$chat_id] == 'wait_course_link' and $chat_id == $admin){
  $student_id  = $sales['target_student'];
  $academic_id = $sales['target_academic_id'];

  // 1. إرسال الرسالة النهائية للطالب متضمنة الرابط الذي أرسله المطور
  $final_msg = "✅ **تم المصادقة على إيصال الدفع الخاص بك بنجاح.**\n\n";
  $final_msg .= "🆔 رقمك الأكاديمي: `$academic_id`\n";
  $final_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $final_msg .= "🔗 **بيانات الانضمام والدخول:**\n$text\n"; // هنا النص الذي كتبه المطور (الرابط)
  $final_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $final_msg .= "تم تفعيل اشتراكك النهائي بنجاح. نتمنى لك رحلة تعليمية ممتعة 🎓";

  bot('sendMessage',[
    'chat_id'=>$student_id,
    'text'=>$final_msg,
    'parse_mode'=>"MarkDown"
  ]);

  // 2. إشعار المطور بالنجاح
  bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"✅ تم إرسال بيانات التفعيل ورابط الدورة للطالب بنجاح، وإغلاق الطلب.",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]]])
  ]);

  // 3. تنظيف البيانات المؤقتة وإنهاء الحالة
  unset($sales[$student_id]); // مسح بيانات الطالب المؤقتة
  $sales['admin_state'][$chat_id] = null; // إنهاء حالة المطور
  save($sales);
  exit;
}

// 2. حالة رفض الإيصال (مثلاً إذا كانت الصورة غير واضحة)
if(strpos($data, "decline_receipt:") !== false){
  $ex = explode(":", $data);
  $student_id  = $ex[1];
  $academic_id = $ex[2];

  bot('sendMessage',[
    'chat_id'=>$student_id,
    'text'=>"❌ **عذراً، تعذر قبول إيصال الدفع الخاص بك.**\n🆔 الرقم الأكاديمي: `$academic_id`\n\nيرجى إعادة إرسال صورة واضحة للإيصال أو التواصل مع الدعم الفني.",
    'parse_mode'=>"MarkDown"
  ]);

  bot('editMessageCaption',[
    'chat_id'=>$admin,
    'message_id'=>$message_id,
    'caption'=>"🔴 تم رفض الإيصال للرقم الأكاديمي `$academic_id` وإخطار الطالب.",
    'parse_mode'=>"MarkDown"
  ]);
  exit;
}



// دالة عرض "طلباتي" للطالب (المضافة)
if($data == 'my_orders'){
  $found = false; $msg = "📥 **سجل طلباتك التدريبية:**\n\n";
  foreach($sales['registrations'] as $req){
    if($req['student_id'] == $chat_id){
      $found = true; $msg .= "📚 الدورة: ".$req['course_name']."\n🆔 الرقم الأكاديمي: `".$req['order_id']."`\n📅 التاريخ: ".$req['date']."\nــــــــــــــــــــــــــــــــــــــــ\n";
    }
  }
  if(!$found){ $msg = "📭 ليس لديك أي طلبات تسجيل حالياً."; }
  bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>$msg, 'parse_mode'=>"MarkDown", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'🔙 العودة للرئيسية','callback_data'=>'home_user']]]])]);
  exit;
}

// دالة "عن المنصة" (المضافة)
if($data == 'about_us'){
  bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"ℹ️ **عن منصة التدريب:**\nنحن منصة تعليمية تهدف لتسهيل عملية التسجيل الأكاديمي للطلاب عبر تقنيات البوت الذكية.", 'parse_mode'=>"MarkDown", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'🔙 العودة للرئيسية','callback_data'=>'home_user']]]])]);
  exit;
}


//دالة تفقد عدد الرسائل 
if($data == 'contact_admin'){
    // تفقد عدد الرسائل المرسلة اليوم
    $today = date("Y-m-d");
    $user_msg_data = $sales['msg_limit'][$chat_id] ?? ['date' => $today, 'count' => 0];

    if($user_msg_data['date'] == $today and $user_msg_data['count'] >= 5){
        bot('answerCallbackQuery',[
            'callback_query_id'=>$up->id,
            'text'=>"⚠️ عذراً، لقد استنفدت حد المراسلة اليومي (5 رسائل). يمكنك المراسلة غداً.",
            'show_alert'=>true
        ]);
    } else {
        bot('editMessageText',[
            'chat_id'=>$chat_id, 'message_id'=>$message_id,
            'text'=>"📥 **قسم المراسلة الخاصة بالإدارة:**\n\nأرسل الآن رسالتك (سؤال، اقتراح، أو مشكلة) وسيقوم القسم المختص بالرد عليك قريباً.\n\n⚠️ **ملاحظة:** مسموح بـ 5 رسائل فقط في اليوم الواحد.",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء 🔙','callback_data'=>'home_user']]]])
        ]);
        $sales['users_state'][$chat_id] = 'wait_msg_to_admin';
        save($sales);
    }
    exit;
}



// دالة عرض إحصائيات البوت الشاملة للمطور فقط
if($chat_id == $admin and ($text == '/admin' or $data == 'admin_stats')){
  
  // 1. حساب عدد المشتركين الإجمالي في البوت
  $count_users = count($sales['users'] ?? []);

  // 2. حساب عدد الأقسام التدريبية
  $count_cats = count($sales['categories'] ?? []);

  // 3. حساب عدد الدورات المضافة
  $count_courses = count($sales['courses'] ?? []);

  // 4. حساب إجمالي طلبات التسجيل (المقبولة والقيد الانتظار)
  $count_regs = count($sales['registrations'] ?? []);

  // 5. تنسيق رسالة الإحصائيات
  $stats_msg = "📊 **إحصائيات منصة التدريب الشاملة:**\n";
  $stats_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n\n";
  $stats_msg .= "👥 **عدد المشتركين:** `$count_users` عضو\n";
  $stats_msg .= "📂 **الأقسام التدريبية:** `$count_cats` قسم\n";
  $stats_msg .= "📚 **الدورات المتاحة:** `$count_courses` دورة\n";
  $stats_msg .= "📥 **طلبات التسجيل الكلية:** `$count_regs` طلب\n\n";
  $stats_msg .= "📅 **التاريخ الحالي:** " . date("Y-m-d") . "\n";
  $stats_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ";

  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>$stats_msg,
    'parse_mode'=>"MarkDown",
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]
      ]
    ])
  ]);
  exit;
}



// --- 🛠 قائمة وضع الصيانة ---
if($data == 'menu_maintenance'){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"🛠 **إعدادات وضع الصيانة:**\nعند التفعيل، سيتم قفل البوت عن جميع الطلاب وتظهر لهم رسالة 'نحن في صيانة'.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'✅ تفعيل وضع الصيانة','callback_data'=>'maintenance_on'],['text'=>'❌ إلغاء الصيانة','callback_data'=>'maintenance_off']],
            [['text'=>'🔙 رجوع','callback_data'=>'settings']]
        ]])
    ]);
}

// --- 📝 قائمة تحكم التسجيل ---
if($data == 'menu_reg'){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"📝 **تحكم التسجيل في الدورات:**\nيمكنك إيقاف أو فتح استقبال طلبات التسجيل الجديدة.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'🔒 قفل التسجيل','callback_data'=>'reg_lock'],['text'=>'🔓 فتح التسجيل','callback_data'=>'reg_open']],
            [['text'=>'🔙 رجوع','callback_data'=>'settings']]
        ]])
    ]);
}

// قائمة الدعم الفني
if($data == 'menu_support' and $chat_id == $admin){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"📞 **إعدادات الدعم الفني:**\nالرابط الحالي: " . ($sales['settings']['support_link'] ?? "غير محدد"),
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'📝 تعديل رابط الدعم','callback_data'=>'edit_support_link']],
            [['text'=>'🔙 رجوع','callback_data'=>'settings']]
        ]])
    ]);
    exit;
}
if($data == 'edit_support_link'){
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"🔗 أرسل الآن رابط الدعم الجديد (مثال: https://t.me/yourname):"]);
    $sales['admin_state'][$chat_id] = 'wait_support_link'; save($sales); exit;
}
if($sales['admin_state'][$chat_id] == 'wait_support_link' and $text){
    $sales['settings']['support_link'] = $text; $sales['admin_state'][$chat_id] = null; save($sales);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم تحديث رابط الدعم بنجاح."]); exit;
}



// --- 💳 قائمة تعليمات الدفع ---
if($data == 'menu_payment'){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"💳 **إدارة تعليمات الدفع:**\nهذا النص يظهر للطالب عند قبول طلبه لإرسال المال.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'➕ إضافة','callback_data'=>'add_pay_info'],['text'=>'📝 تعديل','callback_data'=>'edit_pay_info'],['text'=>'🗑 حذف','callback_data'=>'del_pay_info']],
            [['text'=>'🔙 رجوع','callback_data'=>'settings']]
        ]])
    ]);
}

// إضافة أو تعديل تعليمات الدفع
if(($data == 'add_pay_info' or $data == 'edit_pay_info') and $chat_id == $admin){
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"💳 أرسل الآن نص تعليمات الدفع الجديد:\n(هذا النص هو ما سيصل للطالب عند قبول طلبه لإرسال الأموال)"]);
    $sales['admin_state'][$chat_id] = 'wait_pay_text';
    save($sales); exit;
}
// حفظ النص المستلم
if($sales['admin_state'][$chat_id] == 'wait_pay_text' and $text != null and $chat_id == $admin){
    $sales['settings']['pay_info'] = $text;
    $sales['admin_state'][$chat_id] = null;
    save($sales);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم حفظ تعليمات الدفع بنجاح."]);
    exit;
}
// حذف تعليمات الدفع
if($data == 'del_pay_info' and $chat_id == $admin){
    $sales['settings']['pay_info'] = "لم يتم تحديد تعليمات الدفع بعد.";
    save($sales);
    bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🗑 تم حذف تعليمات الدفع.", 'show_alert'=>true]);
    exit;
}



// --- 📢 قائمة الإشتراك الإجباري ---
if($data == 'menu_force_join'){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"📢 **إعدادات الإشتراك الإجباري:**\nلن يتمكن الطالب من استخدام البوت إلا بعد الإشتراك في القنوات المضافة هنا.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'➕ إضافة قناة','callback_data'=>'add_channel'],['text'=>'🗑 حذف قناة','callback_data'=>'del_channel']],
            [['text'=>'🔙 رجوع','callback_data'=>'settings']]
        ]])
    ]);
}





//دالة اضافة قناة
if($data == 'add_channel'){
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"📢 أرسل الآن معرف القناة مع الـ @ (مثال: @GeminiChannel):"]);
    $sales['admin_state'][$chat_id] = 'wait_chan'; save($sales); exit;
}
if($sales['admin_state'][$chat_id] == 'wait_chan' and $text){
    $sales['settings']['channels'][] = $text; $sales['admin_state'][$chat_id] = null; save($sales);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم إضافة القناة بنجاح."]); exit;
}


// عرض القنوات لحذفها
if($data == 'del_channel' and $chat_id == $admin){
    if(!empty($sales['settings']['channels'])){
        $keys = [];
        foreach($sales['settings']['channels'] as $index => $chan){
            $keys[] = [['text'=>"❌ حذف: $chan", 'callback_data'=>"exec_del_chan:$index"]];
        }
        $keys[] = [['text'=>'🔙 رجوع','callback_data'=>'menu_force_join']];
        bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"⚠️ اختر القناة المراد حذفها من الإشتراك الإجباري:", 'reply_markup'=>json_encode(['inline_keyboard'=>$keys])]);
    } else {
        bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🚫 لا توجد قنوات مضافة.", 'show_alert'=>true]);
    }
    exit;
}

if(strpos($data, "exec_del_chan:") !== false and $chat_id == $admin){
    $index = str_replace("exec_del_chan:", "", $data);
    unset($sales['settings']['channels'][$index]);
    $sales['settings']['channels'] = array_values($sales['settings']['channels']);
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"✅ تم حذف القناة بنجاح.", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة 🔙','callback_data'=>'menu_force_join']]]])]);
    save($sales); exit;
}



// قائمة نظام التنبيهات
if($data == 'menu_notify' and $chat_id == $admin){
    $status = $sales['settings']['notifications'] ?? 'on';
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"🔔 **نظام تنبيهات الإدارة:**\nالحالة الحالية: " . ($status == 'on' ? "✅ مفعلة" : "❌ معطلة"),
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'✅ تفعيل','callback_data'=>'notify_on'],['text'=>'❌ تعطيل','callback_data'=>'notify_off']],
            [['text'=>'🔙 رجوع','callback_data'=>'settings']]
        ]])
    ]);
    exit;
}
if($data == 'notify_on'){ $sales['settings']['notifications'] = 'on'; save($sales); bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🔔 تم تفعيل التنبيهات"]); }
if($data == 'notify_off'){ $sales['settings']['notifications'] = 'off'; save($sales); bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🔕 تم تعطيل التنبيهات"]); }





// تنفيذ تغييرات الإعدادات
if($data == 'maintenance_on'){ $sales['settings']['maintenance'] = 'on'; save($sales); bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"⚠️ تم تفعيل وضع الصيانة"]); }
if($data == 'maintenance_off'){ $sales['settings']['maintenance'] = 'off'; save($sales); bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"✅ تم إلغاء وضع الصيانة"]); }
if($data == 'reg_lock'){ $sales['settings']['reg_status'] = 'close'; save($sales); bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🔒 تم قفل التسجيل"]); }
if($data == 'reg_open'){ $sales['settings']['reg_status'] = 'open'; save($sales); bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🔓 تم فتح التسجيل"]); }

// تغيير العملة (طلب النص)
if($data == 'edit_currency'){
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"💰 أرسل الآن رمز العملة الجديد (مثال: ريال يمني أو $):"]);
    $sales['admin_state'][$chat_id] = 'wait_curr'; save($sales); exit;
}




// --- دالة تعديل رسالة الترحيب /start ---
if($data == 'edit_start'){
    bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"📄 أرسل الآن رسالة الترحيب الجديدة التي ستظهر للطلاب عند الدخول:"]);
    $sales['admin_state'][$chat_id] = 'wait_new_start_msg'; save($sales); exit;
}
if($sales['admin_state'][$chat_id] == 'wait_new_start_msg' and $text){
    $sales['settings']['start_msg'] = $text; $sales['admin_state'][$chat_id] = null; save($sales);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم تحديث رسالة الترحيب بنجاح."]); exit;
}
//استجابة الضغط لتغيير الرقم الأكاديمي 
if($data == 'edit_start_id' and $chat_id == $admin){
    bot('editMessageText',[
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"🔢 **تحديد بداية الرقم الأكاديمي:**
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
يرجى إرسال الرقم الذي تريد أن يبدأ منه عداد الطلاب الجديد.
مثلاً: إذا أرسلت `2026000` فإن أول طالب يسجل بعد الآن سيحصل على الرقم `2026001`.

⚠️ **تنبيه:** يرجى إرسال أرقام فقط."
    ]);
    $sales['admin_state'][$chat_id] = 'wait_start_id';
    save($sales);
    exit;
}



// --- قائمة إدارة الردود الآلية ---
if($data == 'menu_auto_reply' and $chat_id == $admin){
    bot('editMessageText', [
        'chat_id'=>$chat_id, 'message_id'=>$message_id,
        'text'=>"🤖 **إدارة الردود الآلية:**\nيمكنك هنا إضافة كلمات مفتاحية يرد عليها البوت تلقائياً فور إرسالها من قبل الطالب.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'➕ إضافة رد جديد','callback_data'=>'add_reply']],
            [['text'=>'🗑 حذف رد','callback_data'=>'del_reply']],
            [['text'=>'🔙 رجوع للإعدادات','callback_data'=>'settings']]
        ]])
    ]);
    exit;
}

// زر البدء بإضافة رد
if($data == 'add_reply' and $chat_id == $admin){
    bot('editMessageText', ['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"أرسل الآن **الكلمة المفتاحية** (التي سيرسلها الطالب):\nمثال: `رقم الحساب`"]);
    $sales['admin_state'][$chat_id] = 'wait_reply_key';
    save($sales); exit;
}

//استلام الرقم الأكاديمي وحفظة
if($sales['admin_state'][$chat_id] == 'wait_start_id' and $text != null and $chat_id == $admin){
    global $kb;
    if(is_numeric($text)){
        // يتم التخزين مباشرة، وعند التسجيل القادم سيقوم البوت بزيادته +1
        $sales['last_reg_id'] = (int)$text; 
        $sales['admin_state'][$chat_id] = null;
        save($sales);
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"✅ **تم ضبط بداية الرقم الأكاديمي بنجاح.**
أول طالب يسجل من الآن سيحصل على الرقم: `" . ($sales['last_reg_id'] + 1) . "`",
            'reply_markup'=>$kb
        ]);
    } else {
        bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"❌ **خطأ:** يرجى إرسال أرقام فقط!"]);
    }
    exit;
}
 

// معالج حفظ العملة الجديدة
if($sales['admin_state'][$chat_id] == 'wait_curr' and $text != null and $chat_id == $admin){
    global $kb;
    $sales['settings']['currency'] = $text;
    $sales['admin_state'][$chat_id] = null;
    save($sales);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم تحديث العملة إلى: `$text`", 'reply_markup'=>$kb]);
    exit;
}

// معالج حفظ تعليمات الدفع
if($sales['admin_state'][$chat_id] == 'wait_pay_text' and $text != null and $chat_id == $admin){
    $sales['settings']['pay_info'] = $text;
    $sales['admin_state'][$chat_id] = null;
    save($sales);
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"✅ تم حفظ تعليمات الدفع الجديدة بنجاح.", 'reply_markup'=>$kb]);
    exit;
}


// عرض قائمة الحذف
if($data == 'del_reply' and $chat_id == $admin){
    if(!empty($sales['auto_responses'])){
        $keys = [];
        foreach($sales['auto_responses'] as $key => $val){
            $keys[] = [['text'=>"❌ حذف: $key", 'callback_data'=>"exec_del_reply:$key"]];
        }
        $keys[] = [['text'=>'🔙 رجوع','callback_data'=>'menu_auto_reply']];
        bot('editMessageText', ['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"⚠️ اختر الرد الذي تريد حذفه نهائياً:", 'reply_markup'=>json_encode(['inline_keyboard'=>$keys])]);
    } else {
        bot('answerCallbackQuery', ['callback_query_id'=>$up->id, 'text'=>"🚫 لا توجد ردود مضافة.", 'show_alert'=>true]);
    }
    exit;
}

// تنفيذ الحذف الفعلي
if(strpos($data, "exec_del_reply:") !== false and $chat_id == $admin){
    $key_to_del = str_replace("exec_del_reply:", "", $data);
    unset($sales['auto_responses'][$key_to_del]);
    bot('editMessageText', ['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>"✅ تم حذف الرد الآلي الخاص بـ ($key_to_del).", 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة 🔙','callback_data'=>'menu_auto_reply']]]])]);
    save($sales); exit;
}






// 🔍 أمر البحث السريع المطور (يدعم الرد الذكي)
if($chat_id == $admin and strpos($text, "/search") !== false){
    $search_id = trim(str_replace("/search", "", $text));
    
    if($search_id == ""){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"⚠️ **يرجى إدخال رقم الطلب بعد الأمر.**\nمثال: `/search 1000000105`",
            'parse_mode'=>"MarkDown"
        ]);
        exit;
    }

    $found = false;
    foreach($sales['registrations'] as $reg){
        if($reg['order_id'] == $search_id){
            $found = true;
            $res_msg = "🔍 **بيانات الطلب رقم:** `$search_id`\n";
            $res_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
            $res_msg .= "👤 **اسم الطالب:** ".$reg['student_name']."\n";
            $res_msg .= "📚 **الدورة:** ".$reg['course_name']."\n";
            $res_msg .= "🚻 **الجنس:** ".$reg['gender']."\n";
            $res_msg .= "🎂 **العمر:** ".$reg['age']."\n";
            $res_msg .= "🌍 **البلد:** ".$reg['country']."\n";
            $res_msg .= "📞 **الهاتف:** `".$reg['phone']."`\n";
            $res_msg .= "📧 **الإيميل:** ".$reg['email']."\n";
            $res_msg .= "📅 **التاريخ:** ".$reg['date']."\n";
            // السطر الأهم لعمل ميزة الرد الذكي 👇
            $res_msg .= "🆔 آيدي التليجرام: `".$reg['student_id']."`\n"; 
            $res_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ";
            
            bot('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>$res_msg,
                'parse_mode'=>"MarkDown",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'✅ قبول الطلب','callback_data'=>"approve_reg:".$reg['student_id'].":$search_id"]],
                        [['text'=>'❌ رفض الطلب','callback_data'=>"reject_reg:".$reg['student_id'].":$search_id"]],
                        [['text'=>'إغلاق البحث 🔙','callback_data'=>'c']]
                    ]
                ])
            ]);
            break;
        }
    }

    if(!$found){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ **عذراً، لم يتم العثور على أي طلب يحمل الرقم:** `$search_id`",
            'parse_mode'=>"MarkDown"
        ]);
    }
    exit;
}



// أمر المراسلة اليدوي /sendmessage ID
if($chat_id == $admin and strpos($text, "/sendmessage") !== false){
    $target_id = trim(str_replace("/sendmessage", "", $text));
    if($target_id == ""){
        bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"⚠️ **خطأ!** أرسل الأمر مع الآيدي.\nمثال: `/sendmessage 123456`"]);
        exit;
    }
    bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"👤 الطالب المختار: `$target_id`\n\nأرسل الآن رسالتك (نص، صورة، ملف..) ليتم توجيهها له:"]);
    $sales['admin_state'][$chat_id] = 'wait_manual_msg';
    $sales['target_user_id'] = $target_id;
    save($sales);
    exit;
}

// تنفيذ المراسلة اليدوية
if($sales['admin_state'][$chat_id] == 'wait_manual_msg' and $chat_id == $admin){
    $target = $sales['target_user_id'];
    bot('copyMessage',['chat_id' => $target, 'from_chat_id' => $admin, 'message_id' => $message_id]);
    bot('sendMessage',['chat_id'=>$admin, 'text'=>"✅ تم إرسال رسالتك للطالب."]);
    $sales['admin_state'][$chat_id] = null;
    save($sales);
    exit;
}




//اوامر التحذير
if($chat_id == $admin and strpos($text, "/sendwarning") !== false){
    $target_id = trim(str_replace("/sendwarning", "", $text));
    if($target_id == "") { /* رسالة الخطأ */ exit; }

    $warn_msg = "⚠️ **إشعار إداري هام (تحذير)** ⚠️\n";
    $warn_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $warn_msg .= "عزيزي المستخدم، نود إبلاغك بأنه تم رصد نشاط مخالف في حسابك.\n\n";
    $warn_msg .= "🛑 **الإجراء المطلوب:** الالتزام بقواعد المنصة فوراً.\n";
    $warn_msg .= "🚫 **تنبيه:** تكرار المخالفات سيؤدي لحظر حسابك نهائياً.\n";
    $warn_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $warn_msg .= "💡 إذا كان هذا الخطأ غير مقصود، يرجى التواصل مع الدعم.";

    bot('sendMessage',[
        'chat_id'=>$target_id,
        'text'=>$warn_msg,
        'parse_mode'=>"MarkDown",
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'📩 التواصل مع الإدارة','url'=>"tg://user?id=$admin"]]]])
    ]);

    bot('sendMessage',['chat_id'=>$admin, 'text'=>"✅ تم إرسال التحذير الرسمي للعضو `$target_id`."]);
    exit;
}









// 1. طلب ملف النسخة الاحتياطية من المطور
if($data == "upload_backup" and $chat_id == $admin){
    bot('EditMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$message_id,
        'text'=>"📥 **قسم استعادة البيانات:**\n\nيرجى إرسال ملف النسخة الاحتياطية الآن بصيغة (JSON).\n\n⚠️ **تنبيه:** سيتم استبدال كافة البيانات الحالية بالبيانات الموجودة في الملف المرفوع.",
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء الأمر 🚫','callback_data'=>'c']]]])
    ]);
    $sales['admin_state'][$chat_id] = 'wait_backup_file';
    save($sales);
    exit;
}



// 1. بدء طلب نص الإذاعة من المطور
// 1. بدء طلب نص الإذاعة من المطور
if($chat_id == $admin and ($text == '/send' or $data == 'broadcast_msg')){
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"📢 **قسم الإذاعة الجماعية:**\n\nيرجى إرسال الرسالة التي تريد توجيهها لجميع المشتركين حالياً (نص، صورة، أو توجيه) 👇",
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>'إلغاء الأمر 🚫','callback_data'=>'c']]
      ]
    ])
  ]);
  
  $sales['admin_state'][$chat_id] = 'wait_broadcast';
  save($sales);
  exit;
}

// 2. معالجة الملف المرفوع واستبدال قاعدة البيانات
if($message->document and $chat_id == $admin and $sales['admin_state'][$chat_id] == 'wait_backup_file'){
    $file_id = $message->document->file_id;
    $file_name = $message->document->file_name;
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    
    if($ext == 'json' or $ext == 'txt'){
        $get_file = bot('getFile',['file_id'=>$file_id]);
        
        if($get_file->ok){
            $file_path = $get_file->result->file_path;
            $file_url = "https://api.telegram.org/file/bot".API_KEY."/".$file_path;
            
            $new_data_content = file_get_contents($file_url);
            $check_json = json_decode($new_data_content, true);
            
            // التحقق من صحة هيكلة الملف قبل الاستبدال
            if(is_array($check_json) and (isset($check_json['courses']) or isset($check_json['categories']))){
                file_put_contents($db_file, $new_data_content);
                
                bot('sendMessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"✅ **تم استعادة النسخة الاحتياطية بنجاح!**\n\nتم تحديث كافة الأقسام، الدورات، وطلبات التسجيل بناءً على الملف المرفوع.",
                    'reply_markup'=>json_encode([
                        'inline_keyboard'=>[[['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]]
                    ])
                ]);
                
                // تحديث المتغير الحالي في الذاكرة
                $sales = $check_json;
                $sales['admin_state'][$chat_id] = null;
                save($sales);
            } else {
                bot('sendMessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"❌ **خطأ في بنية الملف!**\nالملف الذي أرسلته لا يحتوي على مفاتيح البيانات المطلوبة.",
                    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء الأمر 🚫','callback_data'=>'c']]]])
                ]);
            }
        }
    } else {
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"⚠️ **عذراً، نوع الملف غير مدعوم.**\nيرجى إرسال ملف بصيغة JSON.",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء الأمر 🚫','callback_data'=>'c']]]])
        ]);
    }
    exit;
}

// 3. تنفيذ عملية الإرسال لجميع الأعضاء (الإصدار المستقر)
if($sales['admin_state'][$chat_id] == 'wait_broadcast' and $chat_id == $admin and isset($text) and $text != "/start"){
  $all_users = $sales['users'];
  $count = count($all_users);
  $success = 0;
  $fail = 0;

  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"⏳ جاري بدء الإرسال إلى `$count` مشترك...\nيرجى عدم إرسال أوامر أخرى حتى انتهاء العملية.",
    'parse_mode'=>"MarkDown"
  ]);

  foreach($all_users as $index => $user_id){
    // إذا كان المدخل نصاً فقط نرسله مع كليشة، وإذا كان وسائط نستخدم النسخ
    if(isset($message->text)){
        $res = bot('sendMessage',[
          'chat_id'=>$user_id,
          'text'=>"📢 **رسالة إدارية هامة:**\n\n".$message->text,
          'parse_mode'=>"MarkDown"
        ]);
    } else {
        $res = bot('copyMessage',[
            'chat_id'=>$user_id,
            'from_chat_id'=>$chat_id,
            'message_id'=>$message_id
        ]);
    }
    
    if($res->ok){ $success++; } else { $fail++; }

    // حماية السيرفر وتجنب حظر تليجرام (Flood Wait)
    usleep(100000); // انتظار 0.1 ثانية
    if($index % 25 == 0){ sleep(1); } // توقف ثانية كل 25 رسالة
  }

  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ **اكتملت عملية الإذاعة بنجاح:**\n\n🟢 تم الإرسال لـ: `$success` عضو\n🔴 فشل الإرسال لـ: `$fail` عضو\n\nإجمالي المستهدفين: `$count`",
    'parse_mode'=>"MarkDown",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للوحة 🔙','callback_data'=>'c']]]])
  ]);

  $sales['admin_state'][$chat_id] = null;
  save($sales);
  exit;
}






// دالة النسخ الاحتياطي الموحدة (دمج الإرسال مع الحفظ المحلي)
if($data == "pointsfile"){
    if(file_exists($db_file)){
        $data_to_backup = file_get_contents($db_file);
        file_put_contents($backup_file, $data_to_backup);

        bot('sendDocument',[
            'chat_id'=>$chat_id,
            'document'=>new CURLFile($db_file),
            'caption'=>"▪ نسخة احتياطية لبيانات الدورات 📂\n📅 التاريخ: " . date("Y-m-d"),
        ]);

        bot('EditMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>"
    ▪ تم عمل نسخة احتياطية لبيانات (الدورات التدريبية) بنجاح ✅
    تم الحفظ في: $backup_file
    وتم إرسال نسخة من الملف إليك عبر الخاص.",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]
                ]
            ])
        ]);
    } else {
        bot('EditMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>"❌ خطأ: ملف بيانات الدورات غير موجود حالياً ليتم نسخه.",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]
                ]
            ])
        ]);
    }
    exit;
}



// 1. عرض قائمة الدورات بنظام (صفحتين + دورتين في الصف) للأدمن
if(isset($data) and strpos($data, 'view_courses_admin') !== false and $chat_id == $admin){
  // تحديد الصفحة الحالية (إذا لم تكن محددة تبدأ من 0)
  $ex_data = explode(":", $data);
  $current_page = isset($ex_data[1]) ? (int)$ex_data[1] : 0;
  $limit = 20; // عدد الدورات في الصفحة
  $offset = $current_page * $limit;
  
  $all_courses = $sales['courses'];
  $total_courses = count($all_courses);
  
  if($total_courses > 0){
    // قص مصفوفة الدورات لعرض 20 فقط حسب الصفحة
    // ملاحظة: نستخدم true للحفاظ على الـ index الأصلي للدورة لضمان عمل التعديل والحذف
    $paged_courses = array_slice($all_courses, $offset, $limit, true);
    
    $buttons = [];
    $temp_row = [];
    
    foreach($paged_courses as $index => $course){
        $temp_row[] = ['text'=>$course['name'], 'callback_data'=>"manage_c:".$index];
        
        // إذا امتلأ الصف بدورتين، نقوم بإضافته للمصفوفة الأساسية وتفريغه
        if(count($temp_row) == 2){
            $buttons[] = $temp_row;
            $temp_row = [];
        }
    }
    // إضافة آخر دورة إذا كان العدد فردياً
    if(!empty($temp_row)){ $buttons[] = $temp_row; }

    // --- بناء أزرار التنقل (الرموز) ---
    $nav_buttons = [];
    // زر الصفحة السابقة ◀️
    if($current_page > 0){
        $nav_buttons[] = ['text'=>'◀️', 'callback_data'=>"view_courses_admin:".($current_page - 1)];
    }
    // زر الصفحة التالية ▶️
    if(($offset + $limit) < $total_courses){
        $nav_buttons[] = ['text'=>'▶️', 'callback_data'=>"view_courses_admin:".($current_page + 1)];
    }
    
    if(!empty($nav_buttons)){ $buttons[] = $nav_buttons; }

    $buttons[] = [['text'=>'🔙 العودة للوحة التحكم','callback_data'=>'c']];
    
    $msg = "📚 **إدارة الدورات (صفحة: ".($current_page + 1)."):**\n";
    $msg .= "إجمالي الدورات: `$total_courses`\n\nإختر دورة للتحكم بها 👇";

    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>$msg,
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode(['inline_keyboard'=>$buttons])
    ]);
  } else {
    bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"🚫 لا توجد دورات مضافة حالياً.", 'show_alert'=>true]);
  }
  exit;
}


// 2. عرض تفاصيل الدورة المختارة للأدمن (مع خيارات التحكم)
if(isset($data) and strpos($data, "manage_c:") !== false and $chat_id == $admin){
  $index = str_replace("manage_c:", "", $data);
  
  if(isset($sales['courses'][$index])){
    $course = $sales['courses'][$index];
    $price_text = ($course['price'] == 0) ? "مجانية 🎁" : $course['price'] . " " . $sales['settings']['currency'];
    
    $msg = "📖 **بيانات الدورة (عرض الإدارة):**\n";
    $msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $msg .= "📌 **الاسم:** ".$course['name']."\n";
    $msg .= "📂 **القسم:** ".$course['category']."\n";
    $msg .= "📝 **الوصف:** ".$course['description']."\n";
    $msg .= "💰 **السعر:** $price_text\n";
    $msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
    $msg .= "💡 اختر الإجراء المطلوب أدناه:";

    bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>$msg,
      'parse_mode'=>"MarkDown",
      'reply_markup'=>json_encode([
        'inline_keyboard'=>[
          [['text'=>'🗑 حذف الدورة','callback_data'=>"final_del_course:".$index], ['text'=>'📝 تعديل البيانات','callback_data'=>"edit_course_info:".$index]],
          [['text'=>'🔙 رجوع للقائمة','callback_data'=>'view_courses_admin']]
        ]
      ])
    ]);
  } else {
      bot('answerCallbackQuery',['callback_query_id'=>$up->id, 'text'=>"❌ خطأ: لم يتم العثور على الدورة.", 'show_alert'=>true]);
  }
  exit;
}

// 3. قائمة خيارات التعديل (تظهر عند الضغط على "تعديل")
if(isset($data) and strpos($data, "edit_course_info:") !== false and $chat_id == $admin){
    $index = str_replace("edit_course_info:", "", $data);
    if(isset($sales['courses'][$index])){
        $course = $sales['courses'][$index];

        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>"📝 **تعديل الدورة:** (".$course['name'].")\n\nما الذي تود تعديله في هذه الدورة؟ 👇",
            'reply_markup'=>json_encode(['inline_keyboard'=>[
                [['text'=>'✏️ تعديل الاسم','callback_data'=>"edit_c_name:$index"], ['text'=>'📝 تعديل الوصف','callback_data'=>"edit_c_desc:$index"]],
                [['text'=>'💰 تعديل السعر','callback_data'=>"edit_c_price:$index"]],
                [['text'=>'🔙 تراجع','callback_data'=>"manage_c:$index"]]
            ]])
        ]);
    }
    exit;
}

// 4. معالجة طلبات التعديل (بدء الحالة)
if(isset($data) and preg_match('/^edit_c_(name|desc|price):(\d+)$/', $data, $matches) and $chat_id == $admin){
    $field = $matches[1];
    $index = $matches[2];
    
    $labels = ['name'=>'الاسم الجديد', 'desc'=>'الوصف الجديد', 'price'=>'السعر الجديد'];
    
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$message_id,
        'text'=>"أرسل الآن **" . $labels[$field] . "** للدورة:\n\nـ لإلغاء التعديل أرسل /start",
    ]);
    
    $sales['admin_state'][$chat_id] = "waiting_edit_$field";
    $sales['target_course_index'] = $index;
    save($sales);
    exit;
}

// 5. استلام القيمة الجديدة والحفظ النهائي
$states = ['waiting_edit_name' => 'name', 'waiting_edit_desc' => 'description', 'waiting_edit_price' => 'price'];

if(isset($sales['admin_state'][$chat_id]) and isset($states[$sales['admin_state'][$chat_id]]) and $text != null and $text != "/start" and $chat_id == $admin){
    $field_key = $states[$sales['admin_state'][$chat_id]];
    $index = $sales['target_course_index'];
    
    if($field_key == 'price'){
        $sales['courses'][$index][$field_key] = (float)$text;
    } else {
        $sales['courses'][$index][$field_key] = $text;
    }
    
    $c_name = $sales['courses'][$index]['name'];
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ تم تحديث بيانات الدورة بنجاح!\n\n📌 الدورة: $c_name\n⚙️ الحقل المعدل: $field_key",
        'reply_markup'=>$kb
    ]);
    
    $sales['admin_state'][$chat_id] = null;
    $sales['target_course_index'] = null;
    save($sales);
    exit;
}
