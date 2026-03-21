# 1. نسخ ملفات المشروع أولاً
COPY . /var/www/html/

# 2. إنشاء المجلدات يدويًا لضمان وجودها
RUN mkdir -p /var/www/html/botmak \
             /var/www/html/user \
             /var/www/html/sudo \
             /var/www/html/wataw \
             /var/www/html/from_id

# 3. إعطاء الصلاحيات الكاملة للمجلدات
RUN chmod -R 777 /var/www/html/botmak \
                 /var/www/html/user \
                 /var/www/html/sudo \
                 /var/www/html/wataw \
                 /var/www/html/from_id

# 4. تأكيد ملكية الملفات لخادم الأباتشي
RUN chown -R www-data:www-data /var/www/html
