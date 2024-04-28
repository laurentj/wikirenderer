#!/bin/bash

PHP_VERSION="8.3"
JELIX_USER_ID=${JELIX_USER_ID:-$(id -u)}
JELIX_GROUP_ID=${JELIX_GROUP_ID:-$(id -g)}

docker run -it --rm \
 --env APP_USER_ID=$JELIX_USER_ID \
 --env APP_GROUP_ID=$JELIX_GROUP_ID \
 -v $(pwd)/../:/app \
 --workdir /app/tests \
 --name wikirenderer-tests \
 3liz/liz-php-cli:$PHP_VERSION \
 /app/vendor/bin/phpunit
