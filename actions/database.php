<?php
try{
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=twacademie;charset=utf8;', 'root', 'root');
}catch(Exception $e){
    die('une erreur a ete trouve:' . $e->getMessage());
}
