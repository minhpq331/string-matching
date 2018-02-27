#!/bin/bash
#
# !!! PLEASE RUN THIS SCRIPT FROM PROJECT ROOT !!!
# eg: bash ci_cd/initial_setup.sh
#
# This script will run after git pull to init all dependencies, create server ref log
# eg: install composer, npm, bower
#

set -e

# Initial setup all environment
if [ ! -f src/composer.phar ] && [ -f src/composer.json ]; then
    cd src;
    curl -sS https://getcomposer.org/installer | php
    cd ..;
fi
if [ -f src/composer.phar ] && [ -f src/composer.json ]; then
    (cd src; php composer.phar install --optimize-autoloader; cd ..)
fi
if [[ -f src/package.json ]]; then
    (cd src; npm install; cd ..)
fi
if [[ -f src/bower.json ]]; then
    (cd src; bower install; cd ..)
fi


# Initial setup all environment
WEB_ROOT=src;
if [[ ! -f "server_log/nfo.txt" ]]; then
    touch server_log/nfo.txt
fi
if [ ! -f "$WEB_ROOT/nfo.txt" ] && [ -f "server_log/nfo.txt" ]; then
    ln -s `pwd`/server_log/nfo.txt `pwd`/$WEB_ROOT
fi