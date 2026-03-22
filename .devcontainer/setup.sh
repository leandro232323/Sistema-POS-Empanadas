#!/bin/bash
set -e

echo "==> Instalando dependencias PostgreSQL..."
sudo apt-get install -y libpq-dev libpcre2-dev bison re2c
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get install -y php8.3-pgsql --allow-unauthenticated

echo "==> Copiando pdo_pgsql.so al PHP del Codespace..."
sudo cp /usr/lib/php/20230831/pdo_pgsql.so /usr/local/php/8.3.14/extensions/

echo "==> Compilando pgsql.so desde codigo fuente..."
cd /tmp
wget -q https://www.php.net/distributions/php-8.3.14.tar.gz
tar -xzf php-8.3.14.tar.gz
cd php-8.3.14/ext/pgsql
/usr/local/php/8.3.14/bin/phpize
./configure --with-php-config=/usr/local/php/8.3.14/bin/php-config --with-pgsql
make
sudo cp modules/pgsql.so /usr/local/php/8.3.14/extensions/

echo "==> Activando extensiones en php.ini..."
PHP_INI=/usr/local/php/8.3.14/ini/php.ini
grep -q "extension=pdo_pgsql.so" $PHP_INI || echo "extension=pdo_pgsql.so" | sudo tee -a $PHP_INI
grep -q "extension=pgsql.so" $PHP_INI || echo "extension=pgsql.so" | sudo tee -a $PHP_INI

echo "==> Instalando dependencias de Laravel..."
cd /workspaces/Sistema-POS-Empanadas
composer install



echo "==> Generando archivo .env..."
cat > /workspaces/Sistema-POS-Empanadas/.env << ENVEOF
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}
DB_SSLMODE=${DB_SSLMODE}
ENVEOF

php artisan key:generate

echo "==> Listo! Driver PostgreSQL instalado correctamente."
