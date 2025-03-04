# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем расширение redis
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && pecl install redis \
    && docker-php-ext-enable redis

# Копируем файлы приложения
COPY . /var/www/html/

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Открываем порт
EXPOSE 80

# Запускаем Apache
CMD ["apache2-foreground"]