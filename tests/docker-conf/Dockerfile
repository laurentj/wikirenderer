ARG php_version=8.5

FROM 3liz/liz-php-cli:${php_version}

ARG php_version
ARG DEBIAN_FRONTEND=noninteractive
ENV PHP_VERSION=${php_version}

RUN set -e; apt-get update; \
    apt-get -y -o Dpkg::Options::='--force-confdef' -o Dpkg::Options::='--force-confold' upgrade; \
    apt-get -y -o Dpkg::Options::='--force-confdef' -o Dpkg::Options::='--force-confold' install \
    git \
    php${PHP_VERSION}-xdebug \
    ; \
    apt-get clean

COPY xdebug_cli.ini  /etc/php/${PHP_VERSION}/cli/conf.d/90-xdebug.ini
COPY profile.start /etc/profile.d/start
COPY entrypoint.sh /bin/entrypoint.d/
RUN chmod 755 /bin/entrypoint.d/entrypoint.sh
RUN git config --global --add safe.directory /app
WORKDIR /app/tests/
