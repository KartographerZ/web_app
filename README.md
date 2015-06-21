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

Erreur bower liée à git : http://stackoverflow.com/questions/21789683/howto-fix-bower-ecmderr


3) Mettre à jour / générer la base de données
------

DD : (supprimer les tables si besoin) et lancer la commande qui créée les tables :

php app/console doctrine:schema:update --force

Insérer les données de test dans la base de données :

php app/console doctrine:fixtures:load --fixtures=src/Kartographerz/UserBundle/DataFixtures/ORM --append

4) Déploiement en environnement de production (en local)
------

Vider le cache : php app/console cache:clear --env=prod
Exporter les ressources en environnement de prod : php app/console assetic:dump --env=prod --no-debug

Architecture du projet
========================
Le projet étant basé sur Symfony 2, l'architecture est celle du framework :
* app/: La configuration de l'application,
* src/: Le code PHP du projet,
* vendor/: Les bibliothèques tierces (notamment FOsUserBundle et SonataAdmin),
* web/: Le répertoire Web racine (contient les js / css / images déployés par Assetic).

Nous avons créé deux bundles pour notre application :
* CartographyBundle : La gestion des cartographies,
* UserBundle : La gestion de l'authentification des utilisateurs.

