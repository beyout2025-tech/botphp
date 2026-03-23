<?php 
ob_start();

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
        'users_state' => [], // لتخزين حالات الطلاب
        'admin_state' => []  // لتخزين حالات المديرين
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

// جلب يوزر البوت تلقائياً
$get_me = bot('getme',[]);
$me = $get_me->result->username;

// التحقق من كليشة الترحيب
if($start=="non"){
    $start="لم يتم تعيين كليشة /start من قبل الادمن ";
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
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
       [['text'=>'➕ إضافة قسم','callback_data'=>'add'],['text'=>'➖ حذف قسم','callback_data'=>'del']],
       [['text'=>'➕ إضافة دورة','callback_data'=>'add_course'],['text'=>'➖ حذف دورة','callback_data'=>'add_course_del']],
       [['text'=>'📥 طلبات التسجيل','callback_data'=>'view_regs'],['text'=>'نسخة احتياطية 🔊','callback_data'=>'pointsfile']]
      ]
    ])
  ]);
  $sales['admin_state'][$chat_id] = null;
  save($sales);
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
  
// تحديث قائمة الأزرار لتشمل زر الرفع
$kb = json_encode([
     'inline_keyboard'=>[
       [['text'=>'➕ إضافة قسم','callback_data'=>'add'],['text'=>'➖ حذف قسم','callback_data'=>'del']],
       [['text'=>'➕ إضافة دورة','callback_data'=>'add_course'],['text'=>'➖ حذف دورة','callback_data'=>'add_course_del']],
       [['text'=>'📥 طلبات التسجيل','callback_data'=>'view_regs'],['text'=>'📂 عرض الأقسام','callback_data'=>'view_cats_admin']],
       [['text'=>'📢 إذاعة جماعية','callback_data'=>'broadcast_msg']],
       [['text'=>'📤 جلب نسخة (حفظ)','callback_data'=>'pointsfile'],['text'=>'📥 رفع نسخة (استعادة)','callback_data'=>'upload_backup']],
       [['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]
      ]
    ]);



  if($text == '/start'){
      bot('sendMessage',['chat_id'=>$chat_id, 'text'=>$text_msg, 'reply_markup'=>$kb]);
  } else {
      bot('editMessageText',['chat_id'=>$chat_id, 'message_id'=>$message_id, 'text'=>$text_msg, 'reply_markup'=>$kb]);
  }
  
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
   'text'=>"🎓 **مرحباً بك في منصة التدريب والتعليم** 💡
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
عزيزي المستخدم، يمكنك من خلال هذا البوت استعراض أفضل الدورات التدريبية والدبلومات الأكاديمية والتسجيل فيها بكل سهولة.

يرجى اختيار القسم الذي تود استكشافه من القائمة أدناه 👇",
   'parse_mode'=>"MarkDown",
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
     [['text'=>'📚 استعراض الأقسام التدريبية','callback_data'=>'user_cats']],
     [['text'=>'📥 طلباتي (قيد التنفيذ)','callback_data'=>'my_orders']],
     [['text'=>'ℹ️ عن المنصة','callback_data'=>'about_us'],['text'=>'📞 الدعم الفني','url'=>"tg://user?id=$admin"]],
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

  // البحث عن الدورة المطابقة للـ ID في مصفوفة db.json
  foreach($courses as $course){
    if($course['id'] == $course_id){
      $selected_course = $course;
      break;
    }
  }

  if($selected_course){
    $name = $selected_course['name'];
    $desc = $selected_course['description'];
    $price = $selected_course['price'];
    $cat = $selected_course['category'];
    
    // تنسيق السعر (إذا كان 0 يظهر "مجانية")
    $price_text = ($price == 0) ? "مجانية 🎁" : "$price $";

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
          [['text'=>'🔙 العودة للدورات','callback_data'=>"show_courses:".$cat]]
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



// استلام البريد الإلكتروني -> توليد المعرف -> عرض المراجعة النهائية
if($text != '/start' and $text != null and $sales['users_state'][$chat_id] == 'wait_email'){
  
  // 🛡️ نظام التحقق الذكي من البريد الإلكتروني (إضافة تصحيحية)
  // نتأكد من أن النص المرسل يتبع صيغة الإيميلات العالمية
  if(!filter_var($text, FILTER_VALIDATE_EMAIL)){
      bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"⚠️ **عذراً، البريد الإلكتروني غير صحيح!**\nيرجى إرسال بريد إلكتروني صالح ليتم التواصل معك من خلاله.\nمثال: `student@gmail.com`"
      ]);
      exit;
  }

  // 1. توليد معرف الطلب (ID) تلقائياً (الحفاظ على وظيفتك الأصلية)
  if(!isset($sales['last_reg_id'])){
      $sales['last_reg_id'] = 1000000100; // القيمة الابتدائية
  } else {
      $sales['last_reg_id']++; // زيادة تلقائية فريدة لكل طلب
  }
  $order_id = $sales['last_reg_id'];

  // 2. حفظ البريد الإلكتروني والمعرف المؤقت في ذاكرة الطالب
  $sales[$chat_id]['temp_student_email'] = $text;
  $sales[$chat_id]['temp_order_id'] = $order_id;
  
  // 3. تجميع البيانات للعرض على الطالب للتأكد (الحفاظ على الوظيفة بالكامل)
  $full_name = $sales[$chat_id]['temp_student_name'];
  $gender    = $sales[$chat_id]['temp_student_gender'];
  $age       = $sales[$chat_id]['temp_student_age'];
  $country   = $sales[$chat_id]['temp_student_country'];
  $phone     = $sales[$chat_id]['temp_student_phone'];
  $email     = $text;
  $course    = $sales[$chat_id]['temp_reg_name'];

  $review_msg = "📝 **مراجعة بيانات التسجيل النهائية:**\n";
  $review_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $review_msg .= "🆔 **رقم الطلب:** `$order_id`\n";
  $review_msg .= "📚 **الدورة:** $course\n";
  $review_msg .= "👤 **الاسم:** $full_name\n";
  $review_msg .= "🚻 **الجنس:** $gender\n";
  $review_msg .= "🎂 **العمر:** $age\n";
  $review_msg .= "🌍 **البلد:** $country\n";
  $review_msg .= "📞 **الهاتف:** $phone\n";
  $review_msg .= "📧 **الإيميل:** $email\n";
  $review_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
  $review_msg .= "⚠️ **هل جميع البيانات أعلاه صحيحة؟**";

  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>$review_msg,
   'parse_mode'=>"MarkDown",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'✅ نعم، البيانات صحيحة','callback_data'=>'confirm_reg']],
      [['text'=>'❌ لا، إعادة إدخال البيانات','callback_data'=>"register_course:".$sales[$chat_id]['temp_reg_id']]]
      ]
    ])
  ]);
  
  // تغيير الحالة لانتظار التأكيد النهائي
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

  // 4. إرسال رسالة نجاح للطالب
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"✅ **تم إرسال طلبك بنجاح!**\n\n🆔 رقم الطلب الخاص بك: `$order_id`\n📚 الدورة: $course\n\nسيقوم القسم المختص بمراجعة بياناتك والتواصل معك قريباً عبر الهاتف أو الإيميل. شكراً لثقتك بنا 🎓",
    'parse_mode'=>"MarkDown",
    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'العودة للرئيسية 🔙','callback_data'=>'home_user']]]])
  ]);

// 5. إشعار المطور مع أزرار القبول والرفض
$admin_msg = "🔔 **طلب تسجيل جديد ورد الآن:**\n";
$admin_msg .= "ــــــــــــــــــــــــــــــــــــــــــــــــ\n";
$admin_msg .= "🆔 رقم الطلب: `$order_id`\n";
$admin_msg .= "👤 الطالب: $full_name\n";
$admin_msg .= "📚 الدورة: $course\n";
$admin_msg .= "📞 الهاتف: $phone\n";
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
    'text'=>"✅ تم اختيار **قبول الطلب** رقم: `$order_id`\n\nالآن أرسل (نص الرسالة أو التعليمات) التي ستصل للطالب مع طلب الإيصال:",
    'parse_mode'=>"MarkDown",
  ]);

  // وضع المطور في حالة انتظار نص القبول
  
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


// 🔍 أمر البحث السريع عن طلب بواسطة ID
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

// معالجة الملف المرفوع واستبدال قاعدة البيانات
if($message->document and $chat_id == $admin and $sales['admin_state'][$chat_id] == 'wait_backup_file'){
    $file_id = $message->document->file_id;
    $file_name = $message->document->file_name;
    
    if(pathinfo($file_name, PATHINFO_EXTENSION) == 'json' or pathinfo($file_name, PATHINFO_EXTENSION) == 'txt'){
        
        $get_file = bot('getFile',['file_id'=>$file_id]);
        // تصحيح: التحقق من نجاح طلب getFile قبل الوصول للنتيجة لمنع الخطأ البرمجي
        if($get_file->ok){
            $file_path = $get_file->result->file_path;
            $file_url = "https://api.telegram.org/file/bot".API_KEY."/".$file_path;
            
            $new_data_content = file_get_contents($file_url);
            $check_json = json_decode($new_data_content, true);
            
            if(isset($check_json['courses']) or isset($check_json['categories'])){
                file_put_contents($db_file, $new_data_content);
                
                bot('sendMessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"✅ **تم استعادة النسخة الاحتياطية بنجاح!**\n\nتم تحديث كافة الأقسام، الدورات، وطلبات التسجيل بناءً على الملف المرفوع.",
                    'reply_markup'=>json_encode([
                        'inline_keyboard'=>[[['text'=>'العودة للوحة التحكم 🔙','callback_data'=>'c']]]
                    ])
                ]);
                
                $sales = json_decode($new_data_content, true);
                $sales['admin_state'][$chat_id] = null;

                save($sales);
            } else {
                bot('sendMessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"❌ **خطأ في بنية الملف!**\nالملف الذي أرسلته لا يبدو أنه نسخة احتياطية صحيحة لهذا البوت.",
                    'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء الأمر 🚫','callback_data'=>'c']]]])
                ]);
            }
        }
    } else {
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"⚠️ **عذراً، نوع الملف غير مدعوم.**\nيرجى إرسال ملف النسخة الاحتياطية الأصلي بصيغة JSON.",
            'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'إلغاء الأمر 🚫','callback_data'=>'c']]]])
        ]);
    }
    exit;
}

// 2. تنفيذ عملية الإرسال لجميع الأعضاء
// تصحيح: إضافة دعم للصور والوسائط (Media) وحماية البوت من إذاعة الأوامر مثل /start
if($sales['admin_state'][$chat_id] == 'wait_broadcast' and $chat_id == $admin and $text != "/start"){
  $all_users = $sales['users'];
  $count = count($all_users);
  $success = 0;
  $fail = 0;

  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"⏳ جاري بدء الإرسال إلى `$count` مشترك، يرجى الانتظار...",
    'parse_mode'=>"MarkDown"
  ]);

  foreach($all_users as $user_id){
    // تصحيح: استخدام copyMessage لدعم (نص، صورة، أو توجيه) كما طلبت في رسالة الإذاعة
    if($text){
        $res = bot('sendMessage',[
          'chat_id'=>$user_id,
          'text'=>"📢 **رسالة إدارية هامة:**\n\n$text",
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
  }

  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ **اكتملت عملية الإذاعة بنجاح:**\n\n🟢 تم الإرسال لـ: `$success` عضو\n🔴 فشل الإرسال لـ: `$fail` عضو (قاموا بحظر البوت)\n\nإجمالي المستهدفين: `$count`",
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



