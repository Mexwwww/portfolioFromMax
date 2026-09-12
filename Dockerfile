FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libsqlite3-dev \
    libcurl4-openssl-dev \
    libmagic-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip curl fileinfo \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p database && touch database/database.sqlite

EXPOSE 10000

CMD ["sh", "-c", "php artisan isan serve --host 0.0.0.0 --port ${PORT:-10000}"]