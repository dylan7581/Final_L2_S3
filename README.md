# Final_L2_S3

## Utilisation de Git

Utiliser compte github sur git:

	$ git config --global user.name "nom_d'utilisateur"
	$ git config --global user.email "adresse_mail"

Commande ajout du dossier dans dossier personnel:

	$ git clone https://github.com/dylan7581/Final_L2_S3_Web.git

Voir le Status des fichiers :

	~/Final_L2_S3_Web$ git status

Mettre à jour le dossier:

	~/Final_L2_S3_Web$ git pull

Publier fichier ajouter dans le dossier:

	~/Final_L2_S3_Web$ git add nom_du_fichier
	~/Final_L2_S3_Web$ git commit -m "Message qui sera affichier à côté du fichier"
	
	## Même commande que les 2 précédentes, mais sert à publier TOUT les fichiers modifiés ##
	~/Final_L2_S3_Web$ git commit -a -m "Message qui sera affichier à côté du fichier"
	##-------------------------------------------------------------------------------------##
	
	~/Final_L2_S3_Web$ git push

Site d'aide:

[Aide commande git](https://gist.github.com/acquelito/8596717)


[Une aide plus fournis](https://git-scm.com/book/fr/v2)
