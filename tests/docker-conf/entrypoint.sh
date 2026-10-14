#!/bin/bash

set -e
#set -x
touch /tmp/xdebug_cli.log
chown userphp:groupphp /tmp/xdebug_cli.log
chmod 664 /tmp/xdebug_cli.log
