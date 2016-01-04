openbooking (DEV)
=================

(Projet 1 - Equipe 2) Plugin WordPress Open Source de réservation/inscription à un événement

## Installation

Copier le dossier `openbooking` dans `wp-content\plugins` et activer le plugin.

## Dev

Pour mettre à jour les submodules : `git submodule update --init --recursive`

## Installation d'un environment de test

Lancer le téléchargement de wordpress et la copie du plugin avec `./dev_wp-install.sh` (windows : utiliser git bash)
Configurer la bdd, wordpress, et activer le plugin.

Lancer la copie des fichiers à chaque modif du plugin `./dev_test.sh`

