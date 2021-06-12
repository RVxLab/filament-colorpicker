FROM php:8.0.7-cli-alpine

ARG PUID=1000
ARG PGID=1000

# Install needed packages
RUN apk add -u --no-cache \
    # Curl for HTTP requests
    curl \
    # Zip utilities for Composer
    zip unzip \
    # Git for... you know... git
    git \
    # libpng for GD
    libpng-dev \
    # python2 for node-gyp
    python2 \
    # Build utilities
    autoconf g++ make

# Install PHP extensions
RUN pecl install pcov \
    && docker-php-ext-enable pcov

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Node
COPY --from=node:15-alpine /usr/local/bin/node /usr/local/bin/node
COPY --from=node:15-alpine /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

# Set up non-root
RUN addgroup -g $PGID app \
    && adduser -D -h /home/app -G app -u $PUID app

# Custom PHP config
COPY php.ini /usr/local/etc/php/conf.d/

# Create directory for code coverage within PhpStorm
RUN mkdir /opt/phpstorm-coverage && chown app:app /opt/phpstorm-coverage

# Let's do this
USER app
WORKDIR /var/www/html
