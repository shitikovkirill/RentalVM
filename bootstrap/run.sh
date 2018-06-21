#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[31;1mRun django"
cd $PROJECT_DIR/RentalDjango

workon RentalDjango
python manage.py runserver