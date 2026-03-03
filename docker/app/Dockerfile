FROM php:8.0.30-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y git curl zip unzip

EXPOSE 9000

CMD ["php-fpm"]
