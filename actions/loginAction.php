<?php
require ('actions/database.php');

//Validation du formulaire

if(isset($_POST['validate'])){
    
    //Vérifier si l'user a bien complété tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){

        //Les données de l'user (si le pseudo est correct)
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['mdp'], PASSWORD_DEFAULT);


        //Vérifier si l'utilisateur existe
        $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        if($checkIfUserExists->rowCount() > 0){

            //Récupération des de données de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();

            //Vérifier si le mot de passe est correct 
            if(password_verify($user_password, $usersInfos['mdp'])){

                 //Authentifier l'utilisateur sur le site et récuperer ses données dans des variables globales sessions
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['lastname'] = $userInfos['lastname'];
                $_SESSION['firstname'] = $userInfos['firstname'];
                $_SESSION['pseudo'] = $userInfos['pseudo'];

                //Rediriger l'utilisateur vers la page d'accueil
                header('Location: index.php');

            }else{
                $errorMsg = "Mot de passe incorrect...";
            }

        }else{
            $errorMsg = "Nom d'utilisateur incorrect...";
        }

    }else{
        $errorMsg = "veuillez compléter tous les champs...";
    }

}