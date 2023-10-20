<?php namespace src\objects\material;

use src\objects\BaseDatabaseObject;

include_once __DIR__ . '/../BaseDatabaseObject.php';

/** Created by Robert Urmanič. Date: 28.04.2023 */
class Material extends BaseDatabaseObject
{
   public function __construct() {
      parent::__construct();
   }

   public function getLatestSeznamMaterial() {
      return $this->individualConnection->query('SELECT distinct ms.id_material, ma.obrazek, ma.nazev, ma.cena, ma.odkaz
                                          FROM material_seznam as ms
                                          JOIN material as ma
                                          ON ms.id_material = ma.id_material
                                          order by ms.cas_vlozeni
                                          limit 8;')->fetchAll();
   }

   public function getMaterialByTypPodmaterialu($typ_podmaterialu) {
      return $this->individualConnection->query('SELECT AVG(cena), nazev, obrazek, id_identicky, aktualizace, odkaz, id_material FROM material WHERE typ_podmaterialu = %s GROUP BY ID_identicky', $typ_podmaterialu)->fetchAll();
   }

   public function getMaterial($typ_podmaterialu) {
      return $this->individualConnection->query('SELECT nazev, obrazek, id_identicky, aktualizace, odkaz, id_material FROM material WHERE typ_podmaterialu = %s', $typ_podmaterialu)->fetchAll();
   }

   public function getMaterialByTypPodmaterialuCheapest($typ_podmaterialu) {
      return $this->individualConnection->query('SELECT AVG(cena), nazev, obrazek, id_identicky FROM material WHERE typ_podmaterialu = %s GROUP BY ID_identicky ORDER BY AVG(cena)', $typ_podmaterialu)->fetchAll();
   }

   public function getMaterialByTypPodmaterialuBestRating($typ_podmaterialu) {
      return $this->individualConnection->query('SELECT AVG(cena), nazev, obrazek, id_identicky, avg(hodnoceni) FROM material
                                                LEFT JOIN uzivatel_komentar
                                                ON  uzivatel_komentar.id_identicky_material = material.ID_identicky
                                                WHERE typ_podmaterialu = %s 
                                                GROUP BY ID_identicky
                                                ORDER BY avg(hodnoceni) desc', $typ_podmaterialu)->fetchAll();
   }

   public function getMaterialGroupByIdenticky() {
      return $this->individualConnection->query('SELECT nazev, popis, id_material FROM material GROUP BY id_identicky')->fetchAll();
   }

   public function updateMaterial($typ_podmaterialu) {
      $materialToUpdate = $this->getMaterial($typ_podmaterialu);
      if((strtotime("now") - strtotime(date($this->individualConnection->query('SELECT aktualizace FROM material WHERE typ_podmaterialu = %s limit 1', $typ_podmaterialu)->fetchSingle()))) / 60 > 60){
            extract([$materialToUpdate]);
            include __DIR__ . '/../../form_handler/materialCreationHandler.php';
      }
   }

   public function updateForCreationHandler($typ_podmaterialu) {
      return $this->individualConnection->query('SELECT AVG(cena), nazev, obrazek, id_identicky, avg(hodnoceni) FROM material
                                                LEFT JOIN uzivatel_komentar
                                                ON  uzivatel_komentar.id_identicky_material = material.ID_identicky
                                                WHERE typ_podmaterialu = %s 
                                                GROUP BY ID_identicky
                                                ORDER BY avg(hodnoceni) desc', $typ_podmaterialu)->fetchAll();
   }

   public function defaultMaterialSelect($id_identicky) {
      return $this->individualConnection->query('SELECT mat.cena, mat.nazev as matnazev, mat.odkaz, mat.id_material, mat.obrazek, mat.id_identicky, mat.popis, mat.ID_eshopu, esh.id_eshop, esh.nazev as eshnazev, esh.logo FROM appbakalar.material as mat INNER JOIN appbakalar.eshop as esh on esh.id_eshop = mat.ID_eshopu WHERE id_identicky = %s', $id_identicky)->fetchAll();
   }

   public function cheapestMaterialSelect($id_identicky) {
      return $this->individualConnection->query('SELECT mat.cena, mat.nazev as matnazev, mat.odkaz, mat.id_material, mat.obrazek, mat.id_identicky, mat.popis, mat.ID_eshopu, esh.id_eshop, esh.nazev as eshnazev, esh.logo FROM appbakalar.material as mat INNER JOIN appbakalar.eshop as esh on esh.id_eshop = mat.ID_eshopu WHERE id_identicky = %s order by mat.cena ASC', $id_identicky)->fetchAll();
   }

   public function updateMaterialCena($cena, $id_material) {
      $this->individualConnection->query('UPDATE material SET cena = %f, aktualizace = NOW() WHERE id_material = %i', $cena, $id_material);
   }

   public function insertMaterial($cena, $nazev, $popis, $id_eshopu, $materialDuplicate, $materialDuo0, $materialDuo1, $odkaz, $obrazek) {
      $this->individualConnection->query('INSERT INTO material(cena, nazev, popis, ID_eshopu, ID_identicky, typ_materialu, typ_podmaterialu, odkaz, obrazek) VALUES(%f, %s, %s, %i, %i, %s, %s, %s, %s)', $cena, $nazev, $popis, $id_eshopu, $materialDuplicate, $materialDuo0, $materialDuo1, $odkaz, $obrazek);
   }

   

   public function triggerInsert() {
      $this->individualConnection->query('CALL insertTriggerId();');
   }
}