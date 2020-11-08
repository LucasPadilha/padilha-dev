#!/bin/bash

find /var/www/html/tmp/assets-cache -mindepth 1 -maxdepth 1 -type d -exec rm -r {} \;
find /var/www/html/public/cache/*.css -type f -exec rm -r {} \;
find /var/www/html/public/cache/*.js -type f -exec rm -r {} \;

chown -R www-data:www-data /var/www/html/tmp/assets-cache
chown -R www-data:www-data /var/www/html/public/cache