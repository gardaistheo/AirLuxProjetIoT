# Gestion des conflits
Les conflits se produisent lorsque deux ou plusieurs développeurs modifient le même segment de code et que Git ne sait pas quelle modification doit prévaloir. Il est préférable que le développeur qui propose une Merge Request (MR) s'assure qu'il n'y a pas de conflits avant de soumettre la MR. Si des conflits existent, ils doivent être résolus localement sur la machine du développeur. Voici comment le faire :

## Résolution des conflits en local
### Mettez à jour votre branche dev :

Assurez-vous que votre branche dev est à jour avec la dernière version du dépôt distant. Pour cela, utilisez les commandes suivantes :
```bash
git checkout dev
git pull origin dev
```
### Basculez sur votre branche de travail :

Changez pour votre branche où vous avez des conflits. Remplacez [branch-name]  par le nom de votre branche.
```bash
git checkout [branch-name]
```
### Fusionnez dev dans votre branche :

Maintenant, tentez de fusionner dev dans votre branche de travail. Cela pourrait déclencher les conflits.
```bash
git merge dev
```
### Résolvez les conflits :

Si des conflits sont détectés, vous devez les résoudre manuellement. Ouvrez les fichiers en conflit dans votre éditeur de code, recherchez les marqueurs de conflit (<<<<<<, ======, et >>>>>>) et décidez quelles modifications conserver.

### Validez et poussez votre branche à jour :

Une fois que vous avez résolu tous les conflits, vous devez commettre et pousser les changements vers le dépôt distant. Voici les commandes correspondantes :

```bash
git add .
git commit --no --init
```
l'otpionn --no --init permet d'accepter le message généré automatiquement,  personnellement le message généré est suffisament compréhensible sinon vous pouvez utiliser   à la place :
```bash
git commit -m "Résolution des conflits suite à la fusion"
```
il nous reste plus que à pousser(transférer)  notre branche en local vers la branche distante 
```bash
git push origin <branch-name>
```
Maintenant, votre **MR** *(Merge Request sur github)* ou **PR**  *(Pull Request sur gitlab)* devrait être à jour et sans conflits. *** Assurez-vous de toujours résoudre les conflits avant de demander une revue de code pour éviter d'interrompre le flux de travail de votre équipe.***
