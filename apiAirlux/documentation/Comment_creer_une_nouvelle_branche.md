# Comment créer une nouvelle branche
Créer une nouvelle branche Git est une opération courante lors de la gestion de projets de développement. Elle vous permet de travailler sur une fonctionnalité ou une correction sans affecter la branche principale de votre projet. Voici comment le faire :

## Étapes de création d'une nouvelle branche Git
Vérifiez votre branche actuelle

Avant de créer une nouvelle branche, assurez-vous d'être sur `dev`. Pour cela, utilisez la commande dans votre terminal  :
```bash
git checkout dev
```
pour vérifier si vous êtes sur la  branche `dev` utilisez la commande suivante :
```bash
git branch
```
La liste des branches apparaitra, celle où  vous vous trouvez sera indiquée par un astérisque (*) à côté de son nom.

## Créez une nouvelle branche

Pour créer une nouvelle branche, utilisez la commande suivante, en remplaçant <branch-name> par le nom de votre nouvelle branche :

```bash
git branch <branch-name>
```
Par exemple, si vous voulez créer une branche appelée "feature/awesome-feature", vous utiliserez la commande suivante :
```bash
git branch feature/awesome-feature
```
Basculez sur votre nouvelle branche

Pour commencer à travailler sur votre nouvelle branche, vous devez y basculer. Pour cela, utilisez la commande suivante :

```bash
git checkout <branch-name>
```

En reprenant l'exemple précédent, pour basculer sur la branche "feature/awesome-feature", vous utiliserez la commande suivante :
```bash
git checkout feature/awesome-feature
```

*Astuce : Création et bascule en une seule commande*
Si vous savez que vous voulez immédiatement commencer à travailler sur votre nouvelle branche après sa création, vous pouvez combiner les étapes 2 et 3 en une seule commande :

```bash
git checkout -b <branch-name>
```
Par exemple :
```bash
git checkout -b feature/awesome-feature
```

Cette commande crée une nouvelle branche et bascule automatiquement sur cette nouvelle branche.

Maintenant, vous pouvez commencer à travailler sur votre nouvelle branche en toute sécurité, sans affecter les autres branches de votre projet. Assurez-vous de respecter les conventions de nommage des branches de votre équipe pour une gestion claire et cohérente du projet.