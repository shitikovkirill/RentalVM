#!/bin/bash

echo -e "\e[34mInstall virtualenv"
pacman -S python-virtualenv --noconfirm

echo -e "\e[34mInstall virtualenvwrapper"
yaourt -S python-virtualenvwrapper --noconfirm