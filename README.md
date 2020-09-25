# historia

Ceci est le guide expliquant le déploiement du projet :

1. Pour commencer, clonez la branche <b>experiment/improve-features</b> du projet avec <b>git clone</b>

2. Ensuite, pour faire fonctionner le projet en local, vous devez télécharger et installer plusieurs outils :

    * Un serveur web (WAMP, MAMP, XAMPP...). De préférence, choisissez <b>XAMPP</b>, c'est d'expérience le plus facile à installer !
    * Le gestionnaire de dépendances <b>Composer</b> pour récupérer les dépendances du projet

3. Quand tout est correctement installé, il vous reste encore à :

    * Importer la BDD avec phpMyAdmin. La BDD se trouve à la racine du projet dans le fichier <b>historia.sql</b>
    * Installer les dépendances. Pour se faire, ouvrez votre terminal, placez-vous à la racine du projet et faites <b>composer install</b>
