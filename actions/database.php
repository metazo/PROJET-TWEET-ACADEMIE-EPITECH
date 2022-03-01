<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=tweetacademie;charset=utf8;', 'metazo', 'password')
}catch(Exception $e){
    die('une erreur a ete trouvee' $e->getMessage());
}







?>