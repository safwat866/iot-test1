# استخدم PHP-FPM مع Composer
FROM php:8.2-fpm

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# تعيين مجلد العمل
WORKDIR /var/www

# نسخ المشروع بالكامل
COPY . .

# تثبيت dependencies
RUN composer install --optimize-autoloader --no-dev

# توليد مفتاح التطبيق
RUN php artisan key:generate

# Build assets لو عندك Laravel Mix أو Vite
# RUN npm install && npm run build

# فتح البورت الافتراضي
EXPOSE 8000

# تشغيل التطبيق
CMD php artisan serve --host=0.0.0.0 --port=8000