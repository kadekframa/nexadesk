FROM php:8.1.33-fpm

# Build-time arguments
ARG user
ARG uid
ARG gid
ARG group

USER root

# ───────────────────────────────────────────────────────────────
# Install dependencies
# ───────────────────────────────────────────────────────────────
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip \
    nano \
    libpq-dev \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# ───────────────────────────────────────────────────────────────
# Install PHP extensions
# ───────────────────────────────────────────────────────────────
RUN docker-php-ext-install \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip \
    gd

# ───────────────────────────────────────────────────────────────
# Enable MySQL
# ───────────────────────────────────────────────────────────────
RUN docker-php-ext-install \
    pdo_mysql

# ───────────────────────────────────────────────────────────────
# Install Composer
# ───────────────────────────────────────────────────────────────
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ───────────────────────────────────────────────────────────────
# Create non-root user & group
# ───────────────────────────────────────────────────────────────

# Create Group
RUN groupadd -g ${gid} ${group} || true

# Create User
RUN id -u ${user} >/dev/null 2>&1 || useradd -u ${uid} -g ${group} -G www-data -m -d /home/${user} ${user}
RUN mkdir -p /home/${user}/.composer && \
    chown -R ${user}:${group} /home/${user}

# ───────────────────────────────────────────────────────────────
# Working directory
# ───────────────────────────────────────────────────────────────
WORKDIR /var/www
RUN chown -R ${user}:www-data /var/www && \
    chmod -R 775 /var/www

USER $user

EXPOSE 80

CMD ["php-fpm"]

