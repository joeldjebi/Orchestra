# Orchestra - Digital Transformation Agency

Une application Laravel complète pour une agence de transformation digitale avec un panneau d'administration moderne.

## 🚀 Fonctionnalités

### Site Public
- **Page d'accueil** avec carousel dynamique
- **Section Leadership** avec équipe de direction
- **Blog/Press** avec articles et sidebar
- **Our Values** avec valeurs d'entreprise
- **Work** avec projets clients
- **Our Agencies** avec agences
- **Footer/Contact** avec informations de contact

### Panneau d'Administration
- **Dashboard** avec statistiques en temps réel
- **Gestion du Carousel** - Slides de la page d'accueil
- **Gestion du Leadership** - Équipe de direction
- **Gestion du Blog** - Articles et contenu
- **Gestion des Valeurs** - Valeurs d'entreprise
- **Gestion des Projets** - Réalisations clients
- **Gestion des Agences** - Informations des agences
- **Gestion des Contacts** - Informations de contact
- **Gestion des Utilisateurs** - Utilisateurs et administrateurs
- **Paramètres** - Configuration du système

## 🛠️ Technologies Utilisées

- **Laravel 11** - Framework PHP
- **MySQL** - Base de données
- **Blade** - Moteur de templates
- **Bootstrap 5** - Framework CSS
- **Font Awesome** - Icônes
- **JavaScript** - Interactivité
- **CSS3** - Animations et transitions

## 📦 Installation

### Prérequis
- PHP 8.1+
- Composer
- MySQL
- Node.js & NPM

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/joeldjebi/Orchestra.git
cd Orchestra
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configuration de la base de données**
Modifier le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=orchestra
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Exécuter les migrations et seeders**
```bash
php artisan migrate
php artisan db:seed
```

6. **Compiler les assets**
```bash
npm run build
```

7. **Démarrer le serveur**
```bash
php artisan serve
```

## 👤 Comptes par défaut

### Administrateur
- **Email** : `admin@orchestra.com`
- **Mot de passe** : `password`

## 📁 Structure du Projet

```
orchestra/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Contrôleurs admin
│   │   └── Auth/           # Authentification
│   └── Models/             # Modèles Eloquent
├── database/
│   ├── migrations/         # Migrations
│   └── seeders/           # Seeders
├── resources/
│   └── views/
│       ├── admin/          # Vues admin
│       ├── auth/           # Vues d'authentification
│       └── layouts/        # Layouts
├── public/
│   └── images/            # Images uploadées
└── routes/
    └── web.php            # Routes web
```

## 🎨 Fonctionnalités du Design

- **Design responsive** pour tous les appareils
- **Animations CSS** fluides et modernes
- **Interface admin** intuitive et professionnelle
- **Carousel interactif** avec navigation
- **Menu hamburger** fixe et responsive
- **Dashboard** avec statistiques en temps réel

## 🔧 Gestion du Contenu

### Carousel
- Ajout/modification/suppression de slides
- Gestion des images et textes
- Ordre d'affichage personnalisable
- Activation/désactivation

### Leadership
- Gestion des membres de l'équipe
- Photos et informations personnelles
- Ordre d'affichage
- Statut actif/inactif

### Blog
- Création d'articles avec images
- Layout alterné (titre gauche/droite)
- Contenu structuré en paragraphes
- Sidebar personnalisable

### Autres Sections
- **Valeurs** : Définition des valeurs d'entreprise
- **Projets** : Portfolio des réalisations
- **Agences** : Informations des agences
- **Contact** : Configuration du footer

## 🚀 Déploiement

### Production
1. Configurer les variables d'environnement
2. Optimiser l'application : `php artisan optimize`
3. Compiler les assets : `npm run production`
4. Configurer le serveur web (Apache/Nginx)

### Variables d'environnement importantes
```env
APP_URL=https://your-domain.com
DB_CONNECTION=mysql
MAIL_MAILER=smtp
```

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :
1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commit vos changements
4. Push vers la branche
5. Ouvrir une Pull Request

## 📞 Support

Pour toute question ou support, contactez :
- **Email** : contact@orchestra.com
- **GitHub** : [joeldjebi/Orchestra](https://github.com/joeldjebi/Orchestra)

---

**Orchestra** - Transformant l'Afrique par la technologie digitale 🚀