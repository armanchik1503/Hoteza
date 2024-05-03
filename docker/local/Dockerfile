FROM docker.adata.kz:443/adata-stack/docker-images/php:8.2-fpm

WORKDIR /var/www

COPY --chown=www-data:www-data ./ /var/www

RUN mkdir /var/www/vendor && chown www-data:www-data -R /var/www && \
    composer install && \
    chgrp -R www-data /var/www/storage /var/www/bootstrap/cache || true && \
    chmod -R ug+rwx /var/www/storage /var/www/bootstrap/cache || true && \
    chmod -R +x vendor/bin/* || true && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY docker/local/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

CMD ["/usr/local/bin/entrypoint"]
