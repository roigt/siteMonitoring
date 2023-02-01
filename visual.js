
/**
 * script pour executer recuperer les donnees de la base de donnees chaque 5 secondes
 */
setInterval(function(){
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "./visualisation.php", true);
    xhttp.send();
    location.reload();
   
}, 5000);








