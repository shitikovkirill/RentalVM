#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[34mSetting virtualenvwrapper"
if [ -z $WORKON_HOME ]
then
    echo -e "\e[38;5;11mCreate WORKON_HOME variable"
    echo "export WORKON_HOME=~/.virtualenvs" >> ~/.profile
    echo "source /usr/bin/virtualenvwrapper.sh" >> ~/.profile

    export WORKON_HOME=~/.virtualenvs;
    source /usr/bin/virtualenvwrapper.sh
else
    source /usr/bin/virtualenvwrapper.sh
fi

echo -e "\e[34mCreate virtualenv"
mkvirtualenv --python=python3 RentalDjango