#!/bin/bash

apt update
apt install -y gpg curl zip git wget
apt install -y lsb-release apt-transport-https ca-certificates

# PHP (repository)
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list
wget -qO - https://packages.sury.org/php/apt.gpg | gpg --dearmor -o /etc/apt/trusted.gpg.d/repository.gpg

# PHP (PHP 7.2 packages)
apt update
apt install -y php7.2 php7.2-cli php7.2-fpm php7.2-xml php7.2-pgsql php7.2-mbstring php7.2-curl

# Composer (dependency manager)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'ed0feb545ba87161262f2d45a633e34f591ebb3381f2e0063c345ebea4d228dd0043083717770234ec00c5a9f9593792') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer

# Laravel (installer)
composer global require laravel/installer
