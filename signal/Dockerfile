FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    nginx \
    vim \
    sudo \
    curl \
    && apt-get clean

WORKDIR /var/www/html

COPY ./src /var/www/html
COPY ./tmp /tmp

COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

COPY ./flags/fake_flag /flag

RUN mkdir -p /tmp/whereflag/ && \
    echo "flag{Maybe_you_should_get_permissions}" > /tmp/whereflag/flagIsHere

RUN echo "www-data ALL=(root) NOPASSWD:/bin/cat /tmp/whereflag/*" >> /etc/sudoers

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN echo "session.upload_progress.enabled = Off" > /usr/local/etc/php/conf.d/99-custom.ini

RUN sed -i 's|listen = 127.0.0.1:9000|listen = 0.0.0.0:9000|' /usr/local/etc/php-fpm.d/www.conf

EXPOSE 80

COPY ./flags/true_flag.sh /root/true_flag.sh
RUN chmod +x /root/true_flag.sh

CMD ["sh", "-c", "/root/true_flag.sh  && unset GZCTF_FLAG && php-fpm -D && nginx -g 'daemon off;'"]

