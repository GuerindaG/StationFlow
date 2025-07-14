FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache

CMD ["/start.sh"]
