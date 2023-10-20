<?php
/** Created by Robert Urmanič. Date: 26.03.2023 */

session_start();
error_reporting(E_ERROR | E_PARSE);
include_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../simple_html_dom.php';
include_once __DIR__ . '/../objects/eshop/Eshop.php';
include_once __DIR__ . '/../objects/material/Material.php';

use src\objects\eshop\Eshop;
use src\objects\material\Material;

unset($_SESSION["testVariableGet"]);
unset($_SESSION["testVariable"]);


if(isset($materialToUpdate)){
   foreach($materialToUpdate as $material){
      $html = file_get_html($material['odkaz']);
      $urlParsed = parse_url($material['odkaz'], PHP_URL_SCHEME) . '://' . parse_url($material['odkaz'], PHP_URL_HOST);
      $base_url = trim($urlParsed, '/');

      $eshopForUpdate = new Eshop("", "", "", "", "", $base_url);

      $resultSetEshop = $eshopForUpdate->getEshopByUrl();

      $cena = $html->find($resultSetEshop['promennaCena'])[0]->plaintext;

      $cena = preg_replace("/[^0-9\,\.]/", "", $cena);
      $cena = str_replace(',', '.', $cena);

      $materialForUpdate = new Material();

      $materialForUpdate->updateMaterialCena($cena, $material['id_material']);
   }
} else{
   $url = $_GET['odkaz'];
   $html = file_get_html($_GET['odkaz']);
   $urlParsed = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
   $base_url = trim($urlParsed, '/');

   $eshopForUpdate = new Eshop("", "", "", "", "", $base_url);

   $resultSetEshop = $eshopForUpdate->getEshopByUrl();


   $cena = $html->find($resultSetEshop['promennaCena'])[0]->plaintext;

   $cena = preg_replace("/[^0-9\,\.]/", "", $cena);
   $cena = str_replace(',', '.', $cena);

   $nazev = $html->find($resultSetEshop['promennaNadpis'])[0]->plaintext;;
   $popis = $html->find($resultSetEshop['promennaPopis'])[0]->innertext;
   if(!isset($html->find($resultSetEshop['promennaObrazek'])[0]->href)){
      $obrazek = $html->find($resultSetEshop['promennaObrazek'])[0]->src;
   } else $obrazek = $html->find($resultSetEshop['promennaObrazek'])[0]->href;
   $id_eshopu = $resultSetEshop['id_eshop'];
   $material = $_GET['materialSelect'];
   $materialDuo = explode('|', $material);

   switch($base_url){
      case 'https://www.levnestavebniny.cz':
         $obrazek = 'https://www.levnestavebniny.cz' . $obrazek;
         break;
   }

   $materialInsert = new Material();

   $materialInsert->insertMaterial($cena, $nazev, $popis, $id_eshopu, $_GET['materialDuplicate'], $materialDuo[0], $materialDuo[1], $_GET['odkaz'], $obrazek);
   $materialInsert->triggerInsert();
   $_SESSION["message"] = 'Úspěšné uložení materiálu';

   header('Location: http://localhost/bachelor4/src/objects/user/admin/adminSite.php');
}