#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[34mAdd systemctl service"

if [ -f /etc/systemd/system/gunicorn.service ]
then
    echo -e "\e[33;1mRemove service"
    rm /etc/systemd/system/gunicorn.service
fi

echo -e "\e[33;1mCopy service"
cp $PROJECT_DIR/bootstrap/django/system/gunicorn.service /etc/systemd/system/

systemctl daemon-reload
systemctl start gunicorn
systemctl enable gunicorn