<?php require ('actions/loginAction.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php';?>
<body>
<form class="container" method="POST">

<?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>';} ?>
<br><br>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nom d'utilisateur</label>
    <input type="text" class="form-control" name="pseudo">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" name="mdp">
  </div>
  <button type="submit" class="btn btn-primary" name="validate">Se connecter</button>
  <br><br>
  <a href="signup.php"><p>Pas encore de compte ? inscrivez-vous</p></a>
</form>
</body>
</html>