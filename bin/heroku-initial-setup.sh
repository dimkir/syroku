#!/bin/sh
heroku config:set    \
    SYMFONY_ENV=prod \
    MONOLOG_PROD_PATH="php://stderr"  \
    "$@"

heroku buildpacks:set https://github.com/heroku/heroku-buildpack-multi "$@"


