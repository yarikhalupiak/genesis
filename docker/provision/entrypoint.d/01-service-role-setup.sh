#!/usr/bin/env bash

set -e

source /entrypoint.d/functions.sh

if [ $(isServiceRole "web") = "1" ]
then
    echo "Web is set up"
else
    rm -f /etc/supervisor/conf.d/php-fpm.conf

    echo "Web is disabled"
fi

if [ $(isServiceRole "worker") = "1" ]
then
    cp -a /app/docker/supervisor/conf/. /etc/supervisor/conf.d/

    echo "Worker is set up"
else
    echo "Worker is disabled"
fi