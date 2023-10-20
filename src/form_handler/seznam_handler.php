<?php
/** Created by Robert Urmanič. Date: 19.04.2023 */

use src\objects\seznam\Seznam;

print_r($_POST);
include_once '../objects/seznam/Seznam.php';
include_once '../../vendor/autoload.php';
session_start();
$seznam = new Seznam();
if(isset($_POST['id_seznam'])){
   $seznam->deleteUsersMaterial($_POST['id_material'], $_POST['id_seznam']);
   $_SESSION['id_seznam'] = $_POST['id_seznam'];
   header('Location: ../seznam_display/seznamIndividual.php');
} else if(isset($_POST['delete_seznam'])){
   $_SESSION['id_seznam'] = $_POST['delete_seznam'];
   $seznam->deleteUsersSeznam($_POST['delete_seznam']);
   header('Location: ../seznam_display/seznamList.php');
} else if(isset($_POST['jmenoSeznamu'])){
   $seznam->addSeznam($_SESSION['id_uzivatel'], $_POST['jmenoSeznamu']);
   header('Location: ../seznam_display/seznamList.php');
} else if(isset($_POST['seznamSelect'])){
   // TODO CHECK IF MATERIAL DUPLICATE
   $seznam->addMaterialToSeznam($_POST['material_id'], $_POST['seznamSelect']);
   header('Location: ' . $_POST['url']);
}
?>