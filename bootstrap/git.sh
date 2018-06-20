#!/bin/bash

cd $PROJECT_DIR

echo -e "\e[34mGIT"
git submodule init
git submodule update


cd $PROJECT_DIR/RentalEmber
git checkout master

cd $PROJECT_DIR/RentalDjango
git checkout master