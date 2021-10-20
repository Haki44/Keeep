<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# KEEEP
## Start

- Pour créer un Virtual Host avec Laragon
- [Lien Notion](https://educated-fruitadens-b47.notion.site/Install-projet-Github-sur-Laragon-e7ff85e7bbbf4a4f96b3a29620133970 "Projet Laravel sur Virtual Host avec Laragon").

- composer update
- Créer un fichier .env à la racine
- Modifier la DB
- php artisan key:generate
- npm install
- npm run dev
- php artisan migrate
- php artisan db:seed

## Update

Pour mettre à jour la DB avec les seeders
- php artisan migrate:refresh --seed