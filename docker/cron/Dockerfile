FROM php:8.1.34-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY crontab /etc/crontabs/root
RUN mkdir -p /var/log/cron

CMD ["crond", "-f"]
