# Utilise l'image officielle PHP avec FPM
FROM php:8.2-fpm

# Installe les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev libpq-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip xml

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le dossier de travail
WORKDIR /var/www

# Copie tout le projet dans le conteneur
COPY . .

# Installe les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Donne les bons droits aux dossiers nécessaires
RUN chmod -R 775 storage bootstrap/cache

# Expose le port 8000 pour Laravel
EXPOSE 8000

# Démarre le serveur Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
