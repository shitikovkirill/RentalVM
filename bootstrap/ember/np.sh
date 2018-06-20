#!/bin/bash
source /home/vagrant/.profile

cd $PROJECT_DIR/RentalEmber

echo -e "\e[34mInstall NPM"
npm install

echo -e "\e[34mInstall Bower"
sudo bower install --allow-root