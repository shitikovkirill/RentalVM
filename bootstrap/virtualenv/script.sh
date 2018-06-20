#!/bin/bash

echo -e "\e[34mInstall virtualenv"
pacman -S python-virtualenv --noconfirm

echo -e "\e[34mInstall virtualenvwrapper"
yaourt -S python-virtualenvwrapper --noconfirm

echo -e "\e[34mCreate virtualenv"
mkvirtualenv --python=python3 RentalDjango
workon RentalDjango

echo -e "\e[34mInstall pip"
pip install -r $PROJECT_DIR/RentalDjango