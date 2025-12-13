# Locamax Scraper – Plateforme de Collecte de Sources Immobilières

## Description
Locamax Scraper est une application Laravel 11 destinée à collecter, centraliser et qualifier des sources d’annonces immobilières (agences et particuliers) à partir de pages HTML.  
L’objectif est de constituer une base de données exploitable pour l’analyse du marché locatif.

L’application permet :
- le scraping automatisé de sources immobilières,
- le stockage structuré des données en base MySQL,
- l’affichage filtré des résultats par ville,
- l’élimination des doublons via l’URL source.

---

## Fonctionnalités principales
- Scraping HTML (sources locales ou distantes)
- Détection des agences / particuliers
- Extraction : téléphone, email, type de bien, ville, quartier
- Stockage en base MySQL
- Interface web de consultation
- Commande Artisan personnalisée
- Déploiement Dockerisé (Render)

---

## Stack technique
- **Backend** : Laravel 11 (PHP 8.2)
- **Base de données** : MySQL (Aiven)
- **Scraping** : Symfony DomCrawler
- **Serveur** : Apache (Docker)
- **Hébergement** : Render
- **ORM** : Eloquent

---

## Installation locale

### Prérequis
- PHP ≥ 8.2
- Composer
- MySQL
- Docker (optionnel)

### Étapes
```bash
git clone https://github.com/Ilabarry/locamax-scraper.git
cd locamax-scraper
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan app:scrape-rentals
php artisan serve
