<h1>Rapport de projet web</h1>
<h2>Librairies utilisées</h2>
<h4>PHP</h4>
<ul>
<li>Laravel Passport</li>
</ul>
<h4>JS</h4>
<ul>
<li>vue-carousel</li>
<li>vue-session</li>
<li>vue-multiselect</li>
</ul>
<h2>Installation du projet</h2>
<p>Ouvrez un terminal de commande et déplacez-vous à la racine du projet.</p>
<p>Utilisez les commandes suivantes :</p>
<ul>
    <li>cp .env.example .env</li>
    <li>touch database/database.sqlite</li>
    <li>composer install</li>
    <li>npm install</li>
    <li>php artisan migrate:fresh --seed</li>
    <li>php artisan passport:install</li>
    <li>npm run prod</li>
    <li>php artisan serve</li>
</ul>

<h2>Parties Implémentées</h2>
<p>Toutes les parties du TP2 ont été implémentées,
en plus de quelques fonctionnalités supplémentaires :</p>

<h4>Gestion des commentaires + AJAX avec Vue + Gestion des commentaires (Suppression) par Admin ou Modérateur</h4>
<p>En tant qu'invité, vous pouvez ajouter un commentaire sous n'importe quel article. Connectez-vous 
en tant que Modérateur, Administrateur ou auteur de l'article et vous pourrez supprimer les commentaires qui 
ne vous plaisent pas.</p>

<h4>CRUD des articles protégé par authentification et insertion en Ajax</h4>
<p>En étant connecté, vous pouvez vous rendre sur la page Articles, et vous verrez un bouton "ajouter un post". 
Ici vous pourrez écrire votre propre post et y joindre autant d'images que vous voulez.</p>
<p>En tant qu'Administrateur, rendez-vous dans le tableau de bord Admin et sélectionnez "Post", ici vous pourrez 
intéragir avec tous les posts présents en base de données.</p>

<h4>Authentification qui protège l'accès au back-end sans Laravel Voyager</h4>
<p>En tant qu'invité, essayez de rejoindre l'url /admin, vous serez automatiquement redirigé vers la page de connexion. 
Si vous n'avez pas le rôle correspondant, vous verrez une page 404.</p>
<p>En tant qu'admin, vous aurez accès à toute l'application et vous pourrez modifier les rôles, users et posts</p>
<p>Il ya aussi un CRUD Users, permettant de modifier les informations, comme l'email ou le nom</p>
<p>Pour ajouter un utilisateur, on passera par la route /register et non par le CRUD.</p>

<h4>Ajout des rôles utilisateurs + CRUD rôles</h4>
<p>Dans le CRUD User, il est possible de lier des rôles et des permissions aux utilisateurs.</p>
<p>Au lancement de l'application, il y a 3 rôles, User, Moderator et Administrator</p>
<p>Ces rôles sont accompagnés de permissions déjà écrites</p>
<ul>
    <li>
        manage-users (Permet de gérer les utilisateurs)
    </li>
    <li>
        manage-posts (Permet de gérer les posts)
    </li>
    <li>
        create-posts (Permet de créer des posts)
    </li>
    <li>
        manage-comments (Permet de gérer les commentaires)
    </li>
    <li>
        manage-roles (Permet de gérer les rôles)
    </li>
</ul>
<p>Si l'on souhaite créer de nouveaux rôles, il faut le nommer, donner un slug pour que ce soit comprit 
par l'application et choisir les permissions liées à ce rôle. On peut aussi donner des permissions spéciales aux
 utilsateurs.</p>

<h4>Ajout des fichiers médias pour les posts avec Multi-upload</h4>
<p>Lors de l'ajout de post, deux inputs sont présents : </p>
<ul>
    <li>Le multiselect, permettant de choisir plusieures images depuis la base de données.</li>
    <li>L'input files, permettant de choisir plusieures images depuis son ordinateur</li>
</ul>
<p>En suivant le schéma de base de données du TP2, les medias sont stockés dans la table Post
et reliés avec une table de liaison posts_posts.</p>

<h4>Utilisation de la version Sass de Foundation</h4>
<p>Seulement un seul fichier CSS est utilisé dans l'application, et c'est celui généré par la compilation de Sass</p>

<h4>Utilisation du Framework VueJs</h4>
<p>Plusieurs composants Vue ont été crée et utilisé dans toute l'application :</p>
<ul>
    <li>Les formulaires d'ajout/édition</li>
    <li>Les listes des tables du back-end</li>
    <li>La top-bar</li>
    <li>Le profil de l'utilisateur connecté</li>
    <li>L'ajout et listing des commentaires</li>
    <li>Le slider d'images (libraire vue-slider)</li>
    <li>Le multiselect (libraire vue-multiselect)</li>
</ul>

<h4>Développement penché côté API</h4>
<p>La majeure partie d'ajout, edition, suppression et selection en base est effectuée en Ajax</p>
<p>Pour faciliter l'interaction, le développement d'une API s'est imposé.</p>

<h4>API protégée avec Laravel Passport</h4>
<p>Pour éviter la possibilité d'un ajout depuis l'exterieur de l'application, j'ai utilisé Laravel Passport afin de 
générer des Tokens d'authentification, avec des scopes propres aux permissions des utilisateur</p>
<p>Se connecter à l'exterieur de l'application (avec Postman, par exemple), n'est pas possible.</p>


<h2>Remarques</h2>
<p>Pour développer les rôles et permissions, j'ai préféré ne pas utiliser Policies de Laravel mais une gestion personnalisée
en suivant un tutoriel se rapprochant plus de ce que je voulais faire, mais aussi que la sécurité
soit uniforme à la fois pour l'API et pour le site.</p>
<p>Pour ma part, j'aurais préféré plus me concentrer sur ce projet que sur d'autres.</p>
<p>Je trouve que c'était un très bon module, mais je n'ai pas développer mes fonctionnalités aussi proprement
que je l'aurais souhaité.</p>
<p>De plus, l'alliance Vue/Laravel aurait pu être mieux gérée pour ma part, j'aurais souhaiter 
faire la partie Laravel en Api pure, et Vue pour l'affichage complet au lieu du système de Laravel.
Mais faute de temps, et peur d'être à côté de la plaque dans le rendu, j'ai préféré rester sur mon système actuel.</p>

<h2>Sources pour le code </h2>
<ul>
    <li><a href="https://laravel.com/docs/7.x">Laravel</a></li>
    <li><a href="https://www.larashout.com/laravel-roles-and-permissions">Tutoriel Permissions/Rôles</a></li>
</ul>
