<?php

session_start();
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



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/visual.css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../javascript/visual.js"></script>
    <script src="../javascript/site.js"></script>
    <title>Document</title>
</head>
<body>
       <div class="entete">
        <div class="image"><img src="../images/android-chrome-512x512.png" alt="" width="50px" height="50px"class="src"></div>
        <div class="lien">
            <div class="acceuil"><a href="../index.html">Acceuil</a></div>
            <div class="visualisation"><a href="./visualisation.php" >Visualisation de module</a></div>
        </div>
     </div>
      <script>
                
                setInterval(function(){ 

                          // Requête PHP pour récupérer les données de la base de données 
                    <?php  
                                // Traitement des données récupérées 
                                $results = $database->query("SELECT nom,type,etat,valeur_mesure,duree_fonctionnement,donnee_envoye  FROM modules ;");
                                $variable = $results->fetchAll(PDO::FETCH_ASSOC);


                            $data = array();
                                foreach ($variable as $ligne) {
                                $data[] = $ligne;
                                }


                                    //var_dump($data);
                                    // Renvoi des données au format JSON

                                    $jsonData = json_encode($data);
                                   //les donnees son en json et mis dans une variable session 
                                    $_SESSION['data'] = $jsonData;

                                
                    ?>
              }, 5000); // Exécute la fonction toutes les 5 secondes
          
   
                        var data = <?php echo $_SESSION['data']; ?>;
                      //Utilisation des données dans le script JavaScript
                    console.log(data);
                    

                   
                   

                    //debut Graphique JS
                    google.charts.load('upcoming', {'packages': ['vegachart']}).then(drawChart);

                            function drawChart() {
                            const dataTable = new google.visualization.DataTable();
                            dataTable.addColumn({type: 'string', 'id': 'category'});
                            dataTable.addColumn({type: 'number', 'id': 'amount'});
                            dataTable.addRows([
                                ['Module 1', parseInt(data[0]['valeur_mesure'])],
                                ['Module 2', parseInt(data[1]['valeur_mesure'])],
                                ['Module 3', parseInt(data[2]['valeur_mesure'])],
                                ['Module 4', parseInt(data[3]['valeur_mesure'])],
                                ['Module 5', parseInt(data[4]['valeur_mesure'])],
                                ['Module 6', parseInt(data[5]['valeur_mesure'])],
                                ['Module 7', parseInt(data[6]['valeur_mesure'])],
                                ['Module 8', parseInt(data[7]['valeur_mesure'])],
                                ['Module 9', parseInt(data[8]['valeur_mesure'])],
                                ['Module 10', parseInt(data[9]['valeur_mesure'])],
                            ]);

                            const options = {
                                "vega": {
                                "$schema": "https://vega.github.io/schema/vega/v4.json",
                                "width": 500,
                                "height": 200,
                                "padding": 5,

                                'data': [{'name': 'table', 'source': 'datatable'}],

                                "signals": [
                                    {
                                    "name": "tooltip",
                                    "value": {},
                                    "on": [
                                        {"events": "rect:mouseover", "update": "datum"},
                                        {"events": "rect:mouseout",  "update": "{}"}
                                    ]
                                    }
                                ],

                                "scales": [
                                    {
                                    "name": "xscale",
                                    "type": "band",
                                    "domain": {"data": "table", "field": "category"},
                                    "range": "width",
                                    "padding": 0.05,
                                    "round": true
                                    },
                                    {
                                    "name": "yscale",
                                    "domain": {"data": "table", "field": "amount"},
                                    "nice": true,
                                    "range": "height"
                                    }
                                ],

                                "axes": [
                                    { "orient": "bottom", "scale": "xscale" },
                                    { "orient": "left", "scale": "yscale" }
                                ],

                                "marks": [
                                    {
                                    "type": "rect",
                                    "from": {"data":"table"},
                                    "encode": {
                                        "enter": {
                                        "x": {"scale": "xscale", "field": "category"},
                                        "width": {"scale": "xscale", "band": 1},
                                        "y": {"scale": "yscale", "field": "amount"},
                                        "y2": {"scale": "yscale", "value": 0}
                                        },
                                        "update": {
                                        "fill": {"value": "steelblue"}
                                        },
                                        "hover": {
                                        "fill": {"value": "red"}
                                        }
                                    }
                                    },
                                    {
                                    "type": "text",
                                    "encode": {
                                        "enter": {
                                        "align": {"value": "center"},
                                        "baseline": {"value": "bottom"},
                                        "fill": {"value": "#333"}
                                        },
                                        "update": {
                                        "x": {"scale": "xscale", "signal": "tooltip.category", "band": 0.5},
                                        "y": {"scale": "yscale", "signal": "tooltip.amount", "offset": -2},
                                        "text": {"signal": "tooltip.amount"},
                                        "fillOpacity": [
                                            {"test": "datum === tooltip", "value": 0},
                                            {"value": 1}
                                        ]
                                        }
                                    }
                                    }
                                ]
                                }
                            };

                            const chart = new google.visualization.VegaChart(document.getElementById('chart-div'));
                            chart.draw(dataTable, options);
                            }


                    //fin  Graphique JS
                   
   </script>
   
    <div id="module-status">
        <h1>Etat de fonctionnement des modules</h1>
        <table id="mytable">
            <thead>
                <tr>
                    <th>Nom du Module</th>
                    <th>type Module</th>
                    <th>Etat</th>
                    <th>Valeur mesurée</th>
                    <th>Durée de fonctionnement</th>
                    <th>Données envoyées</th>
                    
                </tr>
            </thead>
            <tbody id="module-data">
                <!-- les lignes de tableau seront ajoutées ici via javascript en php -->
                <?php foreach($variable as $ligne):  ?>
               <tr class="ligne">
                    <td class="colonne"><?php echo  $ligne['nom'] ;  ?></td>
                    <td class="colonne"><?php echo  $ligne['type'] ;  ?></td>
                    <td class="colonne"><?php echo  $ligne['etat'] ;  ?></td>
                    <td class="colonne"><?php echo  $ligne['valeur_mesure'] ;  ?></td>
                    <td class="colonne"><?php echo  $ligne['duree_fonctionnement'] ;  ?></td>
                    <td class="colonne"><?php echo  $ligne['donnee_envoye'] ;  ?></td>
                    

              </tr>
                  <?php  endforeach  ?>
            </tbody>
        </table>
    </div>
    

     <script>
        //script pour changer la couleur des cellules en fonction de la valeur active ou inactive
        let table=document.getElementById("mytable");
        let cells = table.getElementsByTagName("td");
  
        for (let i = 0; i < cells.length; i++) {
            if (cells[i].innerHTML === "inactive") {
            cells[i].style.backgroundColor = "red";
            
            }else if(cells[i].innerHTML === "active"){
                cells[i].style.backgroundColor = "green";
            }
        }
     </script>

     
      <!-- GRAPHIQUE  -->
    <div id="chart-div" style="width: 600px; height: 250px;"></div>
    <div class="titre">Variation de la temperature des modules</div>
    
    <div class="footer"> Copyright 2.10 Module graphique</div>
</body>
</html>