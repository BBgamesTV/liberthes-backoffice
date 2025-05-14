# 📘 Liber'Thés - BackOffice de Gestion Comptable

BackOffice développé avec [Laravel](https://laravel.com/) et [Filament](https://filamentphp.com/) pour la gestion comptable du bar-bouquiniste **Le Liber'Thés**, basé à Blois.

Ce projet a pour but de faciliter le suivi des **transactions**, des **revenus**, des **dépenses**, des **catégories** et des **moyens de paiement**, avec une interface claire et intuitive, accessible même aux utilisateurs peu à l’aise avec l’informatique.

---

## 🚀 Fonctionnalités

### 🔐 Authentification sécurisée
- Connexion via un compte administrateur Filament.
- Accès restreint au tableau de bord et à la gestion des données.

### 📊 Tableau de bord dynamique
- Affichage des **revenus**, **dépenses** et du **résultat net**.
- **Graphique hebdomadaire** en ligne des flux financiers (de lundi à dimanche).
- Widget de statistiques synthétiques.

### 🧾 Gestion des transactions
- Création, modification, suppression de transactions.
- Détection automatique du **type** (revenu ou dépense) selon la catégorie sélectionnée.
- Champs :
  - Montant
  - Note
  - Catégorie
  - Moyen de paiement
  - Date (par défaut = aujourd'hui)
- `libelle` de la transaction associé à la **catégorie**.

### 🗂️ Gestion des catégories
- Liste de catégories de **revenus** et de **dépenses**.
- Catégories par défaut créées automatiquement avec un **seeder** :
  - Loyer
  - Stock
  - Vente
  - Fournitures
  - Salaires
  - Dons
  - Autres

### 💳 Moyens de paiement
- Liste et gestion complète des moyens de paiement.
- Moyens par défaut inclus :
  - Carte bancaire
  - Espèces
  - Chèque
  - Virement
  - Lydia

### 📈 Statistiques et graphique
- Widget graphique par semaine.
- Ligne des **dépenses** et **revenus** affichée jour par jour (lun → dim).
- Vue nette de la **santé financière** de la semaine.

---

## 🛠️ Stack technique

- **Laravel 11**
- **Filament PHP 3**
- **Livewire**
- **Tailwind CSS**
- **MySQL**
- **Carbon** (pour manipulation des dates)

---

## 📦 Installation

### Étapes

1. **Cloner le dépôt :**
   ```bash
    git clone https://github.com/ton-utilisateur/liberthes-backoffice.git
    cd liberthes-backoffice
    composer install
    npm install && npm run build
    cp .env.example .env
    php artisan key:generate
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=liberthes_bo
        DB_USERNAME=root
        DB_PASSWORD=
    php artisan migrate --seed
    php artisan make:filament-user
    php artisan serve
    ```

## 🔮 Idées d'amélioration

- **Export des transactions en PDF ou CSV.**
- **Filtres avancés par mois, catégorie, moyen de paiement.**
- **Système de budget mensuel par catégorie.**
- **Historique de modification des transactions.**
- **Notifications (dépassement de budget, solde négatif…).**
- **Multi-utilisateurs avec rôles (ex : manager, bénévole).**
- **Vue mobile optimisée.**


Développé avec ❤️ par Bastien Brousse
👉 **bastienbrousse.pro**