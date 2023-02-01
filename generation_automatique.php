<?php

 /*CONNEXION A LA BASE DE DONNEE*/
 try
 {
 /** 
  *  mysql:nom de la machine
  * dbname: nom de la base de donnee mysql
  * le nom d'utilisateur de la base de donnee, a modifie en fonction de votre base de donnee
  * le mot de passe de la base de donnee , a modifie en fonction de votre base de donnee
  */
     $database = new PDO('mysql:host=localhost; dbname=modules', 'root', '');
     $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }
 catch(Exception $e)
 {
     die('ERROR:' . $e->getMessage());
 }


 //boucle de generation automatique de donnee

    for ($i = 1; $i <= 10; $i++) {
        /**
         * Recuperation des donnees envoyes 
         */
        $nom = "Module " . $i;
        $type = "Temperature";
        $indice = rand(0, 1);
        if ($indice == 0) {
            $etat = "active";
        } else {
            $etat = "inactive";
        }

        $heure = rand(1, 24);
        $minutes = rand(20, 59);
        $secondes = rand(0, 59);
        $duree = "$heure:$minutes:$secondes";
        $valeur = rand(15, 40);
        $donnee = rand(100, 1000);
        /** 
         * envoie des donnees dans la base de donnees de maniere automatique tout les 10secondes
         */
        $results = $database->query("UPDATE  modules SET nom='$nom',
                                                              type='$type',
                                                              etat='$etat',
                                                              valeur_mesure='$valeur',
                                                              duree_fonctionnement='$duree',
                                                              donnee_envoye='$donnee'   where nom='$nom' ; ");
        $variable = $results->fetchAll(PDO::FETCH_ASSOC);
        /*   $results = $database->query("INSERT INTO modules(nom,type,etat,valeur_mesure,duree_fonctionnement,donnee_envoye) VALUES('$nom','$type','$etat','$valeur','$duree','$donnee'); ");
        $variable = $results->fetchAll(PDO::FETCH_ASSOC);*/
    }
    // attendre 5 secondes avant de generer une nouvelle donnee
    sleep(5);




?>
