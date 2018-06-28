#!/bin/bash
source /home/vagrant/.profile

echo -e "\e[95mPROJECT_DIR=$PROJECT_DIR"
cd $PROJECT_DIR

echo -e "\e[34mGIT"
git submodule init
git submodule update


cd $PROJECT_DIR/RentalEmber
git checkout master
git pull

cd $PROJECT_DIR/RentalDjango
git checkout master
git pull