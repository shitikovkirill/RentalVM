#!/bin/bash
source /home/vagrant/.profile

if [ -z $(which watchman) ]
then
    echo -e "\e[34mInstall watchman"
    yaourt -S watchman --noconfirm
else
    w
fi

cd $PROJECT_DIR/RentalEmber

echo -e "\e[34mInstall yarn"
yarn install

echo -e "\e[34mInstall Bower"
sudo bower install --allow-root