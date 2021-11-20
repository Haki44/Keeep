<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# KEEEP
## Start

- Pour créer un Virtual Host avec Laragon
- [Lien Notion](https://educated-fruitadens-b47.notion.site/Install-projet-Github-sur-Laragon-e7ff85e7bbbf4a4f96b3a29620133970 "Projet Laravel sur Virtual Host avec Laragon").

- composer update
- Dupliquer .env.example et le renommer en .env à la racine
- Modifier la DB
- php artisan key:generate
- npm install
- npm run dev
- php artisan migrate:refresh --seed

## Update

Pour mettre à jour la DB avec les seeders
- php artisan migrate:refresh --seed

Si ca ne fonctionne pas ou message d'erreur, supprimer à la main toutes les tables de votre DB dans phpmyadmin

## Login

- admin
admin@gmail.com / password

- referent 1
referent1@gmail.com / password

- referent 2
referent2@gmail.com / password

- étudiant 1
student1@gmail.com / password

- étudiant 2
student2@gmail.com / password

# Test d'un ajout Référent

- php artisan migrate:refresh --seed
- Dans .env modifier : 
    * QUEUE_CONNECTION=database 
    * les données MAIL (par ceux de Mailtrap)
    * APP_URL=VotreVirtualHost (si vous en avez un)
- Lancer la commande : php artisan queue:work
- Se logger en tant qu'admin puis aller sur /referents/create
- Une fois le référent créé, se délogger et cliquer le lien reçu par mail
- Remplir le formulaire, le référent a fini son inscription et est connecté

# Test d'un ajout Etudiant

- Lancer la commande : php artisan queue:work
- Se logger en tant que référent puis aller sur /students/create
- Une fois l'étudiant créé, se délogger et cliquer le lien reçu par mail
- Remplir le formulaire, l'étudiant a fini son inscription et est connecté