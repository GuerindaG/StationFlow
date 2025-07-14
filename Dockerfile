# Image PHP avec FPM
FROM php:8.2-fpm

# Installe les paquets système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev libpq-dev libxml2-dev \
    libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip xml gd

# Installe Composer (à partir de l'image officielle)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le dossier de travail dans le conteneur
WORKDIR /var/www

# Copie tous les fichiers du projet dans le conteneur
COPY . .

# Installe les dépendances Laravel (prod uniquement)
RUN composer install --no-dev --optimize-autoloader

# Donne les bons droits aux dossiers nécessaires
RUN chmod -R 775 storage bootstrap/cache

# Expose le port 8000 utilisé par le serveur Laravel
EXPOSE 8000

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=8000
