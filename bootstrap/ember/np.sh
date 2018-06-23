#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[34mInstall nvm"
yaourt -S nvm --noconfirm

if [ -z $(grep "init-nvm.sh" ~/.bashrc) ]
then
    echo 'source /usr/share/nvm/init-nvm.sh' >> /home/vagrant/.bashrc
fi

echo -e "\e[34mInstall watchman"
yaourt -S watchman --noconfirm

source /usr/share/nvm/init-nvm.sh

echo -e "\e[34mInstall NVM"
nvm install 9 --lts
nvm use 9
nvm alias default 9

echo -e "\e[34mGlobal npm dependency"
npm install -g ember-cli
npm install -g bower

cd $PROJECT_DIR/RentalEmber

echo -e "\e[34mInstall NPM"
npm install

echo -e "\e[34mInstall Bower"
sudo bower install --allow-root