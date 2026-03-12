FROM php:8.0.30-fpm

WORKDIR /var/www/html

ARG USER_ID
ARG GROUP_ID

ENV USERNAME=admin

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y git curl zip unzip

# Remover pacotes não utilizados, limpa cache e apagar arquivos temporários
RUN apt-get autoremove -y && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

RUN groupadd -g ${GROUP_ID} ${USERNAME} \
    && useradd -u ${USER_ID} -g ${USERNAME} -m ${USERNAME}

    # Altera o pool www do PHP-FPM para rodar com o usuário criado
RUN sed -i "s/^user = .*/user = ${USERNAME}/g" /usr/local/etc/php-fpm.d/www.conf \
    # Evita rodar PHP como www-data ou root
    && sed -i "s/^group = .*/group = ${USERNAME}/g" /usr/local/etc/php-fpm.d/www.conf \
    # Força log de erros do PHP
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN chown -R ${USERNAME}:${USERNAME} /var/www/html

USER ${USERNAME}

EXPOSE 9000

CMD ["php-fpm"]
