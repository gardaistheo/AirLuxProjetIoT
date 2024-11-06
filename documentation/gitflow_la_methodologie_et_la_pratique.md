# Gitflow : méthodologie et pratique

 

Gitflow est une méthode de travail basée sur le fonctionnement par branches de Git. Elle établit un ensemble de règles simples pour la gestion efficace des projets.

 

## Comprendre Gitflow

 

Notre projet repose sur deux branches principales : ***master*** et ***develop***. Ces deux branches sont strictement interdites en écriture pour les développeurs.

 

- La branche `master` reflète l'état de notre production. Il est donc logique que l'on ne puisse y pousser nos modifications directement.
- La branche `develop` centralise toutes les nouvelles fonctionnalités qui seront livrées dans la prochaine version. Il est important de ne pas y faire de modifications directement.

 

En plus de ces deux branches principales, trois autres types de branches nous permettent de travailler :

 

1. `feature`
2. `release`
3. `hotfix`

 

## Développer une fonctionnalité

 

Pour créer une nouvelle fonctionnalité, on crée une branche `feature` à partir de la branche `develop` :

 

```bash
git checkout -b feature/[nom de la feature] develop
```

 

Une fois la fonctionnalité terminée, on met à jour la branche `develop` :

 

```bash
git checkout develop
git pull
```

 

Si votre branche est à jour, le terminal affichera ***already up to date***. Sinon, retournez sur votre branche `feature` et mettez-la à jour pour résoudre les conflits :

 

```bash
git checkout feature/[nom de la feature]
git merge develop
```

 

Une fois les conflits résolus, vous pouvez vous rendre sur GitHub et créer une ***merge request***.

 

## Préparation d'une nouvelle version pour la mise en production

 

On travaille sur une branche `release`. Créez cette branche à partir de `develop`, afin que l'équipe de développement puisse continuer à travailler :

 

```bash
git checkout -b release/<version> develop
```

 

Une fois la branche `release` créée, préparez-vous pour le déploiement en production :

 

```bash
git checkout master
git merge release/<version> --no-ff
git tag <version>
```

 

Créez un tag sur le dernier commit de la branche de production avec le numéro ou le nom de la branche `release`.

 

## Correction d'un bug en production

 

Si vous devez corriger un bug en production, travaillez sur une branche `hotfix` :

 

```bash
git checkout -b hotfix/<name> master
```

 

Une fois le bug résolu, mettez à jour la branche `develop` :

 

```bash
git checkout develop
git merge hotfix/<name> --no-ff
```

 

Et finalement, mettez à jour la branche `master` :

 

```bash
git checkout master
git merge hotfix/<name> --no-ff
git tag <version>
```

 

Créez une nouvelle version avec un tag sur la branche `master`.