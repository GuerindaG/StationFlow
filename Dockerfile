### Étape 1 : Build (Composer, dépendances)
FROM php:8.2-fpm AS builder

# Dépendances système
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev libpq-dev libxml2-dev \
    libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip xml gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /var/www

# Copier les fichiers Laravel
COPY . .

# Installer les dépendances PHP (prod)
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Donne les bons droits
RUN chmod -R 775 storage bootstrap/cache

### Étape 2 : Conteneur final (plus léger)
FROM php:8.2-fpm

# Installer seulement les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev libpq-dev libxml2-dev \
    libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip xml gd

WORKDIR /var/www

# Copier les fichiers depuis l'étape de build
COPY --from=builder /var/www /var/www

# Exposer le port
EXPOSE 9000

# Laisser PHP-FPM gérer les requêtes (pas php artisan serve)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

