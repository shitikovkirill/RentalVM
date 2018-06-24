#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[34mInstall nginx"
pacman -S nginx --noconfirm

systemctl stop nginx

echo -e "\e[35;4m=========================================================="
if [ -f /etc/nginx/nginx.conf ]
then
    echo -e "\e[33;1mRemove nginx conf"
    rm /etc/nginx/nginx.conf
fi

echo -e "\e[33;1mCopy nginx conf"
cp $PROJECT_DIR/bootstrap/nginx/config/nginx.conf /etc/nginx/nginx.conf

mkdir -p /etc/nginx/sites-enabled/
mkdir -p /home/vagrant/EmberDist
echo "You mast deploy ember project here;" > /home/vagrant/EmberDist/index.html

echo -e "\e[35;4m=========================================================="
if [ -f /etc/nginx/sites-enabled/ember.conf ]
then
    echo -e "\e[33;1mRemove ember conf"
    rm /etc/nginx/sites-enabled/ember.conf
fi

echo -e "\e[33;1mCopy ember conf"
cp $PROJECT_DIR/bootstrap/nginx/config/ember.conf /etc/nginx/sites-enabled/

echo -e "\e[35;4m=========================================================="
if [ -f /etc/nginx/sites-enabled/django.conf ]
then
    echo -e "\e[33;1mRemove gjango conf"
    rm /etc/nginx/sites-enabled/django.conf
fi

echo -e "\e[33;1mCopy django conf"
cp $PROJECT_DIR/bootstrap/nginx/config/django.conf /etc/nginx/sites-enabled/

systemctl enable nginx
systemctl start nginx