#!/bin/bash

echo -e "\e[34mInstall node"
pacman -S nodejs npm yarn --noconfirm

echo -e "\e[34mGlobal npm dependency"
npm install -g ember-cli
npm install -g bower

echo "fs.inotify.max_user_watches = 100000" > /etc/sysctl.d/watchman.conf