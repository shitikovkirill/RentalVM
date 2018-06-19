#!/bin/bash

echo "Install node"

pacman -S node --noconfirm
npm install -g ember-cli
npm install -g bower

cd /home/vagrant/RentalVM/RentalEmber
npm install
bower install