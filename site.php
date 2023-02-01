<?php
   /*CONNEXION A LA BASE DE DONNEE*/
   try
    {
    /** 
     *  mysql:nom de la machine
     * dbname: nom de la base de donnee mysql
     * le nom d'utilisateur de la base de donnee, a modifie en fonction de votre base de donnee pour le tester
     * le mot de passe de la base de donnee , a modifie en fonction de votre base de donnee
     */
        $database = new PDO('mysql:host=localhost; dbname=modules', 'root', '');
        $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
        die('ERROR:' . $e->getMessage());
    }
     
    /**
     * Recuperation des donnees envoyes 
     */
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $etat = $_POST['etat'];
    $duree = $_POST['duree'];
    $valeur = $_POST['valeur'];
    $donnee = $_POST['donnee'];
 
        // send the request
       if($_POST['nom']==" "){
            if($_POST['type']==" "){
                 if($_POST['etat']==" "){
                      if($_POST['duree']==" "){
                           if($_POST['valeur']==" "){
                                if($_POST['donnee']==" "){
                                    $nom = test_input($_POST["nom"]);
                                    $type = test_input($_POST["type"]);
                                    $etat = test_input($_POST["etat"]);
                                    $duree = test_input($_POST["duree"]);
                                    $valeur = test_input($_POST["valeur"]);
                                    $donnee = test_input($_POST["donnee"]);
                                    
                                    /** 
                                 * envoie des donnees dans la base de donnees
                                 */
                                    $results = $database->query("INSERT INTO modules(nom,type,etat,valeur_mesure,duree_fonctionnement,donnee_envoye) VALUES('$nom','$type','$etat','$valeur','$duree','$donnee'); ");
                                    $variable = $results->fetchAll(PDO::FETCH_ASSOC);
                               
                                    
                                }else{
                                   echo "veuillez choisir le nombre de donnee";
                                }
                           }else{
                             echo "veuillez choisir une valeur ";
                           }
                      }else{
                        echo "veuillez choisir une duree";
                      }
                 }else{
                   echo "veuillez choisir un etat";
                 }
            }else{
            echo "veuillez entrer le type du module";
            }
       }else{
         echo "veuillez entrer le nom du module ou renseignez tous les champs";
         header('Location:../index.html');
       }
       
         
   


     
    
   

 // Redirection vers la page HTML
 header('Location:../index.html');






 
 /**
  * Summary of test_input
  *Supprimez les caractères inutiles (espace supplémentaire, tabulation, saut de ligne) des données d'entrée de l'utilisateur (avec la fonction PHP trim())
  * Supprimez les barres obliques inverses (\) des données d'entrée de l'utilisateur (avec la fonction PHP stripslashes())
  * @param mixed $data la chaine ou le nombre choisie par l utilisateur
  * @return string  la chaine soumise par l' utilisateur apres avoir rendu la chaine propre avec la fonction test_input
  */
 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>