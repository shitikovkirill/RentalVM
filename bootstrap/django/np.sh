#!/bin/bash
source /home/vagrant/.profile
source /usr/bin/virtualenvwrapper.sh

echo -e "\e[34mInstall pip"
workon RentalDjango
pip install -r $PROJECT_DIR/RentalDjango/requirements.txt

if [ -z $DATABASE_URL ]
then
    echo -e "\e[38;5;11mCreate DATABASE_URL variable"
    echo "export DATABASE_URL=sqlite:///$PROJECT_DIR/RentalDjango/db.sqlite" >> ~/.profile
fi
export DATABASE_URL=sqlite:///$PROJECT_DIR/RentalDjango/db.sqlite

echo -e "\e[34mPrepare Django"
cd $PROJECT_DIR/RentalDjango
python manage.py makemigrations
python manage.py migrate
