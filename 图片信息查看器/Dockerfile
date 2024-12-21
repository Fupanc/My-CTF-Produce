FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
    vim \
    sudo \
    curl \
    && apt-get clean

COPY ./src/* /var/www/html/

ADD ./tmp /tmp
RUN chmod 777 /tmp/rootscripts
RUN chmod 755 /tmp/rootscripts/check.sh
RUN chmod 755 /tmp/rootscripts/groups/run.sh
RUN chmod 755 /tmp/rootscripts/users/run.sh
RUN echo "www-data ALL=(root) NOPASSWD:/tmp/rootscripts/check.sh" >> /etc/sudoers

RUN mkdir -p /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html/uploads && \
    chmod -R 777 /var/www/html/uploads

COPY ./flag/flag.sh /flag.sh
RUN chmod +x /flag.sh

EXPOSE 80

CMD ["sh", "-c", "/flag.sh && unset GZCTF_FLAG && apache2-foreground"]

