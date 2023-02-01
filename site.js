setInterval(function(){
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "./generation_automatique.php", true);
    xhttp.send();
}, 5000);