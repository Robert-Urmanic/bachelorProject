<?php
/** Created by Robert Urmanič. Date: 02.04.2023 */

session_start();

include_once '../../vendor/autoload.php';
require_once '../../simple_html_dom.php';

$html = file_get_html($_GET['link']);
// header('Location: http://localhost/bachelor4/src/objects/user/admin/adminSite.php');

//echo 'AAAAAAAAAAAAAAAAAAA' . $_GET['promennaCena'];
$test = $html->find('<p>');
foreach($test as $item){
   //echo $item;
}
$cena = $html->find($_GET['promennaCena'])[0]->plaintext;
$cena = preg_replace("[^0-9\.,]", "", $cena);
$cena = str_replace(',', '.', $cena);
$nazev = $html->find($_GET['promennaNadpis'])[0]->plaintext;
$popis = $html->find($_GET['promennaPopis'])[0]->innertext;
if(!isset($html->find($_GET['promennaObrazek'])[0]->href)){
   $obrazek = $html->find($_GET['promennaObrazek'])[0]->src;
} else $obrazek = $html->find($_GET['promennaObrazek'])[0]->href;

$_SESSION['testVariable']['promennaCena'] = $cena;
$_SESSION['testVariable']['promennaNadpis'] = $nazev;
$_SESSION['testVariable']['promennaPopis'] = $popis;
$_SESSION['testVariable']['promennaObrazek'] = $obrazek;

$_SESSION['testVariableGet']['promennaCena'] = htmlspecialchars($_GET['promennaCena']);
$_SESSION['testVariableGet']['promennaNadpis'] = htmlspecialchars($_GET['promennaNadpis']);
$_SESSION['testVariableGet']['promennaPopis'] = htmlspecialchars($_GET['promennaPopis']);
$_SESSION['testVariableGet']['promennaObrazek'] = htmlspecialchars($_GET['promennaObrazek']);

header('Location: http://localhost/bachelor4/src/objects/user/admin/adminSite.php');