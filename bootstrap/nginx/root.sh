#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[34mInstall nginx"
pacman -S nginx --noconfirm

systemctl stop nginx

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

if [ -f /etc/nginx/sites-enabled/ember.conf ]
then
    echo -e "\e[33;1mRemove ember conf"
    rm /etc/nginx/sites-enabled/ember.conf
fi

echo -e "\e[33;1mCopy ember conf"
cp $PROJECT_DIR/bootstrap/nginx/config/ember.conf /etc/nginx/sites-enabled/

systemctl enabled nginx
systemctl start nginx