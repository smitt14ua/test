FROM library/php:7.4.13-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    zip \
    tar \
    libzip-dev \
    libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install \
    pdo_mysql \
    opcache \
    zip \
    intl
# RUN pecl install xdebug-2.9.8 \
#     && docker-php-ext-enable xdebug
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Install PHPUnit
#RUN wget https://phar.phpunit.de/phpunit-9.phar \
#    && chmod +x phpunit-9.phar \
#    && mv phpunit-9.phar /usr/local/bin/phpunit
# Install Codeception
#RUN wget http://codeception.com/codecept.phar \
#        && chmod +x codecept.phar \
#        && mv codecept.phar /usr/local/bin/codecept

WORKDIR /var/www/symfony

# Install Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

EXPOSE 9000
# ENTRYPOINT ["composer", "install", "-n"]
ENTRYPOINT ["php-fpm"]
