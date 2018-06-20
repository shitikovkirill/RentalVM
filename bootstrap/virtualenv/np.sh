#!/bin/bash

echo -e "\e[34mSetting virtualenvwrapper"
if [ -z $WORKON_HOME ]
then
    echo -e "\e[38;5;11mCreate WORKON_HOME variable"
    echo "export WORKON_HOME=~/.virtualenvs; source /usr/bin/virtualenvwrapper.sh" >> ~/.profile
    export WORKON_HOME=~/.virtualenvs;
    source /usr/bin/virtualenvwrapper.sh
fi

echo -e "\e[34mCreate virtualenv"
mkvirtualenv --python=python3 RentalDjango

echo -e "\e[34mInstall pip"
workon RentalDjango
pip install -r $PROJECT_DIR/RentalDjango/requirements.txt

if [ -z $DATABASE_URL ]
then
    echo -e "\e[38;5;11mCreate DATABASE_URL variable"
    echo "export DATABASE_URL=sqlite:///$PROJECT_DIR/RentalDjango/db.sqlite" >> ~/.profile
fi