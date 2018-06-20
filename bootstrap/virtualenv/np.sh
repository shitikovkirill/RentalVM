#!/bin/bash

echo -e "\e[34mSetting virtualenvwrapper"
if [ -z $WORKON_HOME ]
then
    echo -e "\e[34mCreate WORKON_HOME variable"
    echo "export WORKON_HOME=~/.virtualenvs; source /usr/bin/virtualenvwrapper.sh" >> ~/.bashrc
    export WORKON_HOME=~/.virtualenvs;
    source /usr/bin/virtualenvwrapper.sh
fi

echo -e "\e[34mCreate virtualenv"
mkvirtualenv --python=python3 RentalDjango

echo -e "\e[34mInstall pip"
echo -e "\e[34mPrint PROJECT_DIR - $PROJECT_DIR"
workon RentalDjango
pip install -r $PROJECT_DIR/RentalDjango/requirements.txt