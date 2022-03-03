<?php

require ('actions/database.php');

//Validation du formulaire

if(isset($_POST['validate'])){
    
    //Vérifier si l'user a bien complété tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['mdp'])){

        //Les données de l'user 
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        //Vérifier si l'utilisateur existe déjà sur le site
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        if($checkIfUserAlreadyExists->rowCount() == 0){

            //Insérer l'utilisateur dans la bdd
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, lastname, firstname, mdp)VALUE(?, ?, ?, ?)'); 
            $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));

            //Récuperer les informations de l'utilisateur
            $getInfosOfThisUserReq = $bb->prepare('SELECT id, pseudo, lastname, firstname FROM users WHERE lastname = ?, AND firstname = ? AND pseudo = ?');
            $getInfosOfThisUserReq = $bb->execute(array($user_lastname, $user_firstname, $user_pseudo));

            $userInfos = $getInfosOfThisUserReq->fetch();

            //Authentifier l'utilisateur sur le site et récuperer ses données dans des variables globales sessions
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userInfos['id'];
            $_SESSION['lastname'] = $userInfos['lastname'];
            $_SESSION['firstname'] = $userInfos['firstname'];
            $_SESSION['pseudo'] = $userInfos['pseudo'];

            //Rediriger l'utilisateur vers la page d'accueil
            header('Location: index.php');

        }else{
            $errorMsg = "L'utilisateur existe déjà sur le site";
        }

    }else{
        $errorMsg = "veuillez compléter tous les champs...";
    }

}