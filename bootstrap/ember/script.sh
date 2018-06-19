#!/bin/bash

echo "Install node"

pacman -S nodejs npm --noconfirm

npm install -g ember-cli
npm install -g bower