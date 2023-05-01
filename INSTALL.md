# Installation

## Serveur

TaskStep nécéssite un serveur avec :
- Apache 2.4
- PHP 8.1
- MySQL 8.0

Le serveur apache a besoin d'être configuré avec `AllowOverride` mis à `All` pour la racine web.
Si l'application va être déployée sur Internet, SSL doit être activé pour protéger les informations sensibles.

## Installation

1. Déposez tous les fichiers de l'archive à la racine web du serveur.
2. Exécutez le script `install/setup.sql` pour mettre en place la base de données.
3. Créez une copie de `config-example.ini` nommée `config.ini` et remplissez les informations nécessaires.
4. Allez à l'URL `monsite.fr/app/register` Pour vous créer un compte
5. Et voilà, TaskStep est prêt à être utilisé !  
