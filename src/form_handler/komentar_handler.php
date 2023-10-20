<?php
/** Created by Robert Urmanič. Date: 20.04.2023 */

use src\objects\hlaseni\HlaseniKomentar;
use src\objects\komentar\Komentar;
use src\objects\hlaseni\Hlaseni;

include_once '../objects/komentar/Komentar.php';
include_once '../objects/hlaseni/HlaseniKomentar.php';
include_once '../objects/hlaseni/Hlaseni.php';
include_once '../../vendor/autoload.php';

session_start();

if(isset($_POST['hlaseniKomentar'])){
   $hlaseniKomentar = new HlaseniKomentar(0, $_POST['hlaseniKomentar'], $_POST['uzivatelHlaseni']);
   $hlaseniKomentar->pridatHlaseni();
   header('Location: ' . $_POST['url']);
   die();
} else if(isset($_POST['mazaniKomentar'])){
   Komentar::smazatKomentar($_POST['mazaniKomentar']);
   $hlaseniKomentar = new HlaseniKomentar(0, $_POST['mazaniKomentar'],0);
   $hlaseniKomentar->odebratHlaseniPodleKomentare();
   header('Location: ' . $_POST['url']);
   die();
} else if(isset($_POST['hlaseni'])){
   $hlaseni = new Hlaseni(0, $_POST['submitHlaseni'], $_POST['hlaseni']);
   $hlaseni->addHlaseni();
   header('Location: ' . $_POST['url']);
   die();
} else if(isset($_POST['odebratHlaseni'])){
   $hlaseniKomentar = new HlaseniKomentar(0, $_POST['odebratHlaseni'],0);
   $hlaseniKomentar->odebratHlaseniPodleKomentare();
   header('Location: ' . $_POST['url']);
   die();
} else if(isset($_POST['mazaniHlaseni'])){
   $hlaseni = new Hlaseni($_POST['mazaniHlaseni'], 0, "");
   echo $_POST['mazaniHlaseni'];
   $hlaseni->smazatHlaseni();
   header('Location: ' . $_POST['url']);
   die();
}

$komentar = new Komentar($_POST['komentar'], $_SESSION['id_uzivatel'], $_POST['id_identicky'], $_POST['doporuceni']);
$komentar->addKomentar();
header('Location: ' . $_POST['url']);