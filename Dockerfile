FROM php:7.4-cli

RUN apt-get update && apt-get install -y nano wget libpng-dev libzip-dev libicu-dev libmagickwand-dev g++ --no-install-recommends
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install zip gd exif opcache intl fileinfo
RUN pecl install apcu && docker-php-ext-enable opcache zip intl fileinfo apcu gd exif

RUN wget https://getcomposer.org/composer.phar && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
# RUN wget https://phar.phpunit.de/phpunit-5.7.21.phar && chmod +x phpunit-5.7.21.phar && mv phpunit-5.7.21.phar /usr/local/bin/phpunit && phpunit --version

RUN apt-get -y install libfontenc1 xfonts-encodings xfonts-utils xfonts-base xfonts-75dpi
RUN curl "https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6.1-2/wkhtmltox_0.12.6.1-2.bullseye_amd64.deb" -L -o "wkhtmltopdf.deb" \
    && dpkg -i wkhtmltopdf.deb

WORKDIR /var/www/html/
