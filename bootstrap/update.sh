#!/bin/bash

echo -e "\e[34mUpdate system"
pacman -Sy --noconfirm
sudo pacman -S htop --noconfirm