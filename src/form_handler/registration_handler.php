<?php
/** Created by Robert Urmanič. Date: 20.03.2023 */
session_start();

use src\user\User;

include_once __DIR__ . '\..\objects\user\User.php';
include_once __DIR__ . '/../objects/user/User.php';

$user = new User($_POST['email'],$_POST['jmeno'], $_POST['prijmeni'], $_POST['heslo']);
if($user->isUserDuplicate() || (!isset($_POST["heslo"]) || !isset($_POST["jmeno"]) || !isset($_POST["prijmeni"]))){
   $_SESSION["temp_post_form"]['heslo'] = $_POST["heslo"];
   $_SESSION["temp_post_form"]["jmeno"] = $_POST["jmeno"];
   $_SESSION["temp_post_form"]["prijmeni"] = $_POST["prijmeni"];
   $_SESSION["temp_post_form"]["errorMessageRegistration"] = "Email je již registrovaný, nebo jste nezadali všechny údaje!";
   header('location: ../user_forms/register.php');
} else{
   $user->addUser();
   $_SESSION["temp_post_form"]["successMessageLogin"] = "Uživatel byl registrován, přihlaste se prosím.";
   header('location: ../user_forms/login.php');
}
