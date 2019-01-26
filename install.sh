
#!/bin/bash

echo "##\n# Install Payment API Project ###"
cd pay_api/laradock-pay_api/

echo -e "\n# Uploading Application container..."
sudo docker-compose up -d nginx mysql phpmyadmin

echo -e "\n# Create database..."
sudo docker-compose exec mysql sh -c "mysql -u root -proot <<-EOF
	DROP DATABASE IF EXISTS payment_api;
    CREATE DATABASE payment_api;
EOF"

echo -e "\n# Generate key..."
sudo docker-compose exec workspace sh -c "php artisan key:generate"


echo -e "\n# Clear database..."
sudo docker-compose exec workspace sh -c "php artisan migrate:refresh"

echo -e "\n# Make migrations..."
sudo docker-compose exec workspace sh -c "php artisan migrate"

echo -e  "\n# Make seeds..."
sudo docker-compose exec workspace sh -c "php artisan db:seed"

echo -e "\n# Information of new containers..."
sudo docker ps -a 

echo -e "\n# Execute feature and unit tests..."
sudo docker-compose exec workspace sh -c "vendor/bin/phpunit"

echo -e "##\n# Install Complete !!!"
