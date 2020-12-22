FROM jobnotifier/php74-ubuntu18:v0.0.1

ENV SERVICE_ROLE=web,worker

COPY . /app

RUN mkdir -p /entrypoint.d \
    && cp -R /app/docker/provision/entrypoint.d/* /entrypoint.d/ \
    && mkdir -p /etc/php/7.4/conf.d \
    && cp /app/docker/php/app.ini /etc/php/7.4/conf.d/app.ini \
    && cp /app/docker/php/www.conf /etc/php/7.4/fpm/pool.d/www.conf

WORKDIR /app

EXPOSE 9000

CMD ["/app/docker/provision/supervisord.sh"]
