FROM php:8.2-apache

COPY . /var/www/html/

# تفعيل موديل rewrite للأباتشي
RUN a2enmod rewrite

# منح صلاحيات الكتابة للمجلدات الضرورية
RUN chmod -R 777 /var/www/html/botmak /var/www/html/user /var/www/html/sudo /var/www/html/wataw


EXPOSE 80


