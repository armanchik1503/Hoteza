#!/bin/sh
set -e

if [ $# -gt 0 ]; then
    exec "$@"
else
    if [ ! -f vendor/bin/phing ]; then
        exec php-fpm -F
    else
        vendor/bin/phing start && exec php-fpm -F
    fi
fi
