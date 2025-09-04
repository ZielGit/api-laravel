FROM composer:latest

# Configurar usuario y permisos
RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel
USER laravel

# Workdir
WORKDIR /var/www/html

# Entrypoint
ENTRYPOINT [ "composer", "--ignore-platform-reqs" ]
CMD [ "--help" ]
