#!/bin/bash

cp ./ci/filesender-config.php ./config/config.php
echo "$DB"

# sh -c "if [ '$DB' = 'mysql' ]; then sudo sed -e "s?usemysql=0?usemysql=1?g" --in-place ./config/config.php  ; fi "
# - sudo sed -e "s?%TRAVIS_BUILD_DIR%?$(pwd)?g" --in-place ./config/config.php
# - chmod -R a+x ./travis/scripts
# - phpenv config-add ./travis/php-config.ini
# install:
# - mkdir ./log
# - mkdir ./tmp
# - mkdir ./files
# - sh -c "if [ '$DB' = 'pgsql' ]; then ./travis/scripts/postgresql-setup.sh ; fi "
# - sh -c "if [ '$DB' = 'mysql' ]; then ./travis/scripts/mariadb-setup.sh ; fi "
# - "./travis/scripts/simplesamlphp-setup.sh"
# - php scripts/upgrade/database.php
# - sh -c "if [ '$TESTSUITE' = 'dataset' ]; then php scripts/upgrade/database.php --db_database filesenderdataset ; fi "
# - echo "Sauce connect will start soon if this is a browser test session"
# - echo " otherwise it will close early, "
# - echo "  but that is ok as we will not need it in this VM "
# before_script:
# - sudo apt-get update
# - sudo apt-get install curl
# - sudo apt-get install apache2 libapache2-mod-fastcgi
# - sudo a2enmod rewrite actions fastcgi alias ssl headers
# - sudo sed -i "s/host    all             all             127.0.0.1\/32            trust/host    all             all             127.0.0.1\/32            md5/"
#   /etc/postgresql/9.2/main/pg_hba.conf
# - sudo sed -i "s/host    all             all             ::1\/128                 trust/host    all             all             ::1\/128                 md5/"
#   /etc/postgresql/9.2/main/pg_hba.conf
# - sudo sed -i "s/NameVirtualHost \*:80/# NameVirtualHost \*:80/" /etc/apache2/ports.conf
# - sudo sed -i "s/Listen 80/# Listen 80/" /etc/apache2/ports.conf
# #- sudo echo '<?php'      >| $TRAVIS_BUILD_DIR/www/info.php
# #- sudo echo 'phpinfo();' >> $TRAVIS_BUILD_DIR/www/info.php
# #- sudo chown www-data       $TRAVIS_BUILD_DIR/www/info.php
# - sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/certs/filesender_test.key
#   -out /etc/ssl/certs/filesender_test.crt -subj "/C=US/ST=Denial/L=Springfield/O=Dis/CN=file_sender.app"
# - sudo cp -f travis/apache2.conf /etc/apache2/sites-enabled/000-default.conf
# - sudo sed -e "s?%TRAVIS_BUILD_DIR%?$(pwd)?g" --in-place /etc/apache2/sites-enabled/000-default.conf
# - sudo service postgresql restart
# # enable php-fpm
# - sudo sed -i "s/error_reporting = E_ALL/error_reporting = E_ALL \& ~E_DEPRECATED
#   \& ~E_STRICT/" ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
# - sudo cp ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf.default ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
# - sudo a2enmod rewrite actions fastcgi alias
# - echo "cgi.fix_pathinfo = 1" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
# - sudo sed -i -e "s,www-data,travis,g" /etc/apache2/envvars
# - sudo chown -R travis:travis /var/lib/apache2/fastcgi
# - sudo cp ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.d/www.conf.default ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.d/www.conf
# #- sudo sed -i -e "s,nobody,travis,g " ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.d/www.conf
# - ~/.phpenv/versions/$(phpenv version-name)/sbin/php-fpm
# - sudo cat /etc/apache2/sites-enabled/000-default.conf
# - echo "... making sure sauce connect doesn't redefine ..."
# - sudo  sed -i -e "s,define('SAUCE_HOST',if(\!defined('SAUCE_HOST')) define('SAUCE_HOST',g" /home/travis/build/filesender/filesender/vendor/sauce/sausage/src/Sauce/Sausage/SauceAPI.php
# - sudo  sed -i -e "s,define('SAUCE_HOST',if(\!defined('SAUCE_HOST')) define('SAUCE_HOST',g" /home/travis/build/filesender/filesender/vendor/sauce/sausage/src/Sauce/Sausage/SauceConfig.php
# - sudo service apache2 restart
# #- curl -k https://localhost/filesender/info.php || sudo cat /var/log/apache2/*.log
# # stop the database we are not planning to use
# # to catch bad configurations that might use the wrong database by mistake
# - sh -c "if [ '$DB' = 'pgsql' ]; then sudo service mysql stop  ; fi "
# - sh -c "if [ '$DB' = 'mysql' ]; then sudo service postgresql stop  ; fi "
# - sh -c "if [ '$TESTSUITE' = 'cron' ]; then echo testing cron job ; fi "
# - sh -c "if [ '$TESTSUITE' = 'cron' ]; then php scripts/task/cron.php --testing-mode ; fi "
# after_failure:
# - sudo cat /var/log/apache2/error.log
# - sudo cat /var/log/apache2/access.log
# - find ./log -type f -exec cat {} +
