#!/bin/bash

echo -e "\e[34mInstall node"
pacman -S nodejs npm --noconfirm

echo -e "\e[34mGlobal npm dependency"
npm install -g ember-cli
npm install -g bower

echo -e "\e[34mInstall watchman"
yaourt -S watchman --noconfirm