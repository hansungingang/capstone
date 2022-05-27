#!/bin/bash
set -m

#turn on bash's job control
#Start the primary process and put it in the background
php-fpm -y /usr/local/etc/php-fpm.conf -R &
#Start the helper process
php artisan config:clear
php artisan cache:clear
php artisan migrate
php artisan passport:install


#the my_helper_process might need to know how to wait on the
#primary process to start before it does its work and returns

#now we bring the primary process back into the foreground 
# and leave it there
fg %1