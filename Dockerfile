FROM php:7.4-fpm

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    npm \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN npm i -g n && n install lts

# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .
RUN cp .env.example .env
RUN composer update
RUN rm -rf node_modules && rm package-lock.json && npm i && npm run dev

CMD php artisan route:cache && php artisan config:cache && php artisan serve --host 0.0.0.0 --port $PORT
