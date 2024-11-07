# Développement de fonctionnalités
Pour collaborer  efficacement sur le projet et assurer une bonne organisation des tâches, définissons une procédure de travail spécifique en utilisant github. Voici les étapes détaillées pour ouvrir et travailler sur une Pull Request (PR):

## Création de la branche
depuis votre environnement de développement (IDE) vous allez créer la branche en étant `sur la branche dev` :
```bash 
-git checkout -b feature/[nom de la branche]
```
si vous voulez [créer une branche depuis github](https://docs.github.com/fr/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-and-deleting-branches-within-your-repository) , veuillez suivre les instructions du lien .

## Création de la Pull Request

1. Aller sur [github](https://github.com/) ;
1. Cliquer sur votre profil en haut à droite
1. Puis sur "your repositories"
1. Récupérer le projet , cliquez sur pull request , créer une nouvelle PR

### Comparer les changements

5. `base` sera la branche dev  et `compare`  notre branche feature/[nom de la branche].
1. Cliquer sur `create pull Request`
2. Ensuite appuyer sur la fléche à droite du *bouton create pull request* 
3. choisir et appuyer sur `create draft pull request` , permet la création d'un projet d'une PR 
4. Assurez-vous  de vous assigner le projet de la pr  en cliquant sur  `assignee` situé sur la droite , Cela permettra aux autres membres de l'équipe de voir que vous travaillez sur cette fonctionnalité.
5. Ajoutez-moi en tant que reviewer de votre PR en  cliquant sur `reviewer` situé sur la droite . Je serai alors notifié lorsque votre travail sera prêt à être revu.

## Travail sur la Merge Request
Vous pouvez  maintenant travailler sur la nouvelle branche pour résoudre le problème décrit dans le ticket.
 
Une fois que vous avez terminé votre travail et que vous pensez avoir résolu le problème, rendez-vous sur github revenez sur la page de votre draft PR et cliquez sur `ready for review` qui devrait me notifier que  vous avez fini votre tâche. Laissez la branche et informez-moi en doublons avec un message sur discord. Nous examinerons ensemble votre travail, procéderons à une revue de code et discuterons de la façon dont vous avez résolu le problème.

En suivant ces étapes, nous pouvons travailler de manière plus organisée et efficace tout en nous assurant que chaque membre de l'équipe comprend et suit le même processus.