#!/bin/bash
#TODO : full auto (db config, etc...) if possible
#mkdir test
cd test
#curl https://fr.wordpress.org/wordpress-4.4-fr_FR.tar.gz -O
#tar -xzvf wordpress-4.4-fr_FR.tar.gz
#mv wordpress/* .
#rm -Rf wordpress wordpress-4.4-fr_FR.tar.gz
echo "Wordpress install�"
#Ancienne m�thode (copie)
#cp -Rv ../openbooking wp-content/plugins
#echo "Plugin copi�"
cd ../
echo "Cr�ation d'un lien symbolique (Windows)"
./dev_makesymlink_win.bat
echo "Cr�ation d'un lien symbolique (Unix)"
./dev_makesymlink_unix.sh
read -p "Appuyer sur [Entr�e] pour quitter ..."