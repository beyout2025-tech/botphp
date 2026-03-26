# 1. استخدام صورة PHP مع Apache
FROM php:8.2-apache

# 2. تثبيت الإضافات اللازمة (cURL, SSL, ZIP) في أمر واحد لتقليل حجم الحاوية
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install curl zip

# 3. تفعيل مود الـ Rewrite في Apache (ضروري جداً لعمل الروابط و htaccess)
RUN a2enmod rewrite

# 4. نسخ ملفات المشروع إلى الحاوية
COPY . /var/www/html/

# 5. تصحيح تسمية ملف htaccess (لأن تليجرام/ريندر لا يقرأه بدون نقطة)
RUN mv /var/www/html/htaccess /var/www/html/.htaccess || true

# 6. إنشاء المجلدات المطلوبة ومنحها الصلاحيات الكاملة (777)
# هذا يضمن أن السكربت يستطيع إنشاء ملفات الـ 70 بوت بدون أخطاء
RUN mkdir -p /var/www/html/botmak \
             /var/www/html/user \
             /var/www/html/sudo \
             /var/www/html/wataw \
             /var/www/html/from_id \
             /var/www/html/data \
    && chmod -R 777 /var/www/html/botmak \
                    /var/www/html/user \
                    /var/www/html/sudo \
                    /var/www/html/wataw \
                    /var/www/html/from_id \
                    /var/www/html/data

# 7. تغيير مالك الملفات ليكون خادم Apache
RUN chown -R www-data:www-data /var/www/html

# 8. تحديد المنفذ الافتراضي
EXPOSE 80

# 9. أمر التشغيل
CMD ["apache2-foreground"]
