FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev libpq-dev libxml2-dev \
    libjpeg62-turbo-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip xml gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /var/www

# Copier les fichiers du projet Laravel
COPY . .

# Installer les dépendances PHP (production uniquement)
RUN composer install --no-dev --optimize-autoloader

# Donne les bons droits
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port pour Laravel (si on utilise `php artisan serve`)
EXPOSE 8000

# Commande de démarrage (dev)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
