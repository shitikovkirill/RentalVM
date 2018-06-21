#!/bin/bash
source /home/vagrant/.profile
source /usr/bin/virtualenvwrapper.sh

echo -e "\e[31;1mRun django"
cd $PROJECT_DIR/RentalDjango

workon RentalDjango
python manage.py runserver 0.0.0.0:8000