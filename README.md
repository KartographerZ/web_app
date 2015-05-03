Utilisation du projet
========================

1) Adapter le fichier des paramètres
--------

Copier le fichier app/config/parameters.yml.dist vers app/config/parameters.yml et indiquer vos paramètres (base de données...).

2) Mettre à jour les vendors
------

Composer :

Il vous suffit de suivre ce tutoriel : http://symfony.com/fr/doc/current/book/installation.html#installation-updating-vendors

Bower (Pour le front-end): 

Télécharger Bower : http://bower.io/#install-bower

à la racine du projet, lancer la commande "bower install". Toutes les dépendances nécessaires vont être installées.


3) Mettre à jour / générer la base de données
------

DD : (supprimer les tables si besoin) et lancer la commande qui créée les tables :

php app/console doctrine:schema:update --force
