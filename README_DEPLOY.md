# Meubles Tozeur - Laravel E-commerce

Ce projet est une application e-commerce moderne construite avec Laravel, intégrant un Dashboard Admin premium et un système de panier dynamique.

## 🚀 Déploiement sur Railway

Pour déployer ce projet sur Railway, suivez ces étapes :

### 1. Préparer le code
Le projet est déjà configuré avec :
- `Procfile` : Indique à Railway comment démarrer le serveur.
- `nixpacks.toml` : Automatise l'installation de PHP, Node.js et les migrations.
- `AppServiceProvider` : Correction pour la compatibilité MySQL.

### 2. Pousser sur GitHub
```bash
git add .
git commit -m "Ready for deployment"
git branch -M main
git remote add origin https://github.com/VOTRE_NOM/meubles-tozeur.git
git push -u origin main
```

### 3. Configurer Railway
1. Connectez votre compte GitHub à [Railway](https://railway.app).
2. Créez un nouveau projet à partir du dépôt `meubles-tozeur`.
3. Ajoutez une base de données **MySQL** à votre projet Railway.
4. Dans les variables d'environnement (`Variables`), ajoutez :
   - `APP_KEY` : (Copiez la valeur de votre fichier `.env` local)
   - `APP_ENV` : `production`
   - `APP_DEBUG` : `false`
   - `APP_URL` : (L'URL fournie par Railway)
   - `DB_CONNECTION` : `mysql`
   - `DB_HOST` : `${{MySQL.MYSQL_HOST}}`
   - `DB_PORT` : `${{MySQL.MYSQL_PORT}}`
   - `DB_DATABASE` : `${{MySQL.MYSQL_DATABASE}}`
   - `DB_USERNAME` : `${{MySQL.MYSQL_USER}}`
   - `DB_PASSWORD` : `${{MySQL.MYSQL_PASSWORD}}`

### 4. Finalisation
Railway détectera automatiquement le fichier `nixpacks.toml` et lancera :
1. `composer install`
2. `npm run build` (Vite)
3. `php artisan migrate --force`

Votre site sera alors en ligne ! 🌍
