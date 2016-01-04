#!/bin/bash
#TODO : full auto (db config, etc...) if possible
mkdir test
cd test
curl https://fr.wordpress.org/wordpress-4.4-fr_FR.tar.gz -O
tar -xzvf wordpress-4.4-fr_FR.tar.gz
mv wordpress/* .
rm -Rf wordpress wordpress-4.4-fr_FR.tar.gz
echo "Wordpress installé"
cp -Rv ../openbooking wp-content/plugins
echo "Plugin copié"
read -p "Appuyer sur une touche pour quitter ..."