#!/bin/bash

echo "Install nginx"
sudo pacman -Syyu --noconfirm
pacman -S nginx --noconfirm