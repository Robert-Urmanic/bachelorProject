<?php
session_start();

use src\user\User;

include_once '..\objects\user\User.php';

/** Created by Robert Urmanič. Date: 20.03.2023 */
$user = new User($_POST['email'], '', '', $_POST['heslo']);
if($user->login($_POST['heslo']) === 'false'){
   $_SESSION["temp_post_form"]['email'] = $_POST['email'];
   $_SESSION["temp_post_form"]["errorMessageLogin"] = 'Nesprávné přihlašovací údaje';
   header('location: ../user_forms/login.php');
} else if($user->login($_POST['heslo']) === 'blocked'){
   $_SESSION["temp_post_form"]["errorMessageLogin"] = 'Příliš mnoho pokusů o přihlášení, zkuste to později';
   $_SESSION["temp_post_form"]['email'] = $_POST['email'];
   header('location: ../user_forms/login.php');
} else{
   $_SESSION = $user->login($_POST['heslo'])->toArray();
   header('location: ../index.php');
}