#!/bin/bash

if [ "$PHP_VERSION" == "" ]; then
  PHP_VERSION=8.5
fi

JELIX_USER_ID=${JELIX_USER_ID:-$(id -u)}
JELIX_GROUP_ID=${JELIX_GROUP_ID:-$(id -g)}

CMD="$1"

if [ "$CMD" != "" ]; then
  shift
else
      echo "Error: command is missing"
      echo "Possible commands: "
      echo "- build: build the docker image to launch tests"
      echo "- tests: launch tests into the built image"
      echo "- composer-install: install composer packages"
      echo "- composer-update: update composer packages"
      exit 1;
fi

function launch() {

  docker run -it --rm \
   --env APP_USER_ID=$JELIX_USER_ID \
   --env APP_GROUP_ID=$JELIX_GROUP_ID \
   -v $(pwd)/../:/app \
   --workdir /app/tests \
   --name wikirenderer-tests \
   --add-host host.docker.internal:host-gateway \
   jelix/wikirenderer-tests:$PHP_VERSION \
   $COMMAND
}


case $CMD in
  build)
    docker buildx build \
      --build-arg phpversion=$PHP_VERSION \
      --pull \
      --tag jelix/wikirenderer-tests:$PHP_VERSION \
      docker-conf/
    ;;
  tests)
    COMMAND="/app/vendor/bin/phpunit $@"
    launch
  ;;
  exec)
    COMMAND="$@"
    launch
  ;;
  composer-update)
    COMMAND="composer --working-dir=/app --no-interaction update "
    launch
    ;;

  composer-install)
    COMMAND="composer --working-dir=/app --no-interaction install "
    launch
    ;;
  *)
      echo "wrong command"
      exit 2
      ;;
esac
