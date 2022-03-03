<?php
session_start();
if(!isset($_POST['auth'])){ 
    header('Location: index.php');
}