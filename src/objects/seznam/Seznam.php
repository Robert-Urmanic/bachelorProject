<?php namespace src\objects\seznam;

use src\objects\BaseDatabaseObject;

include_once __DIR__ . '/../../objects/BaseDatabaseObject.php';

/** Created by Robert Urmanič. Date: 19.04.2023 */
class Seznam extends BaseDatabaseObject
{
   public function __construct() {
      parent::__construct();
   }

   public function addSeznam($id_uzivatel, $seznam_nazev) {
      $this->individualConnection->query('INSERT INTO uzivatel_seznam(id_uzivatel, nazev) VALUES (%i, %s)', $id_uzivatel, $seznam_nazev);
   }

   public function addMaterialToSeznam($id_material, $id_seznam) {
      $this->individualConnection->query('INSERT INTO material_seznam(id_material, id_seznam) VALUES (%i, %i)', $id_material, $id_seznam);
   }

   public function getSeznamListByUser(int $id_user) {
      return $this->individualConnection->query('SELECT ms.id_seznam, us.id_seznam, count(ms.id_material) as countMaterial, nazev FROM uzivatel_seznam AS us
LEFT JOIN material_seznam as ms
ON ms.id_seznam = us.id_seznam
where id_uzivatel = %i
group by us.id_seznam;', $id_user)->fetchAll();
   }

   public function getSeznamMaterialByUser(int $id_seznam) {
      return $this->individualConnection->query('SELECT * FROM material_seznam
         INNER JOIN material
         ON material.id_material = material_seznam.id_material
         WHERE id_seznam = %i;', $id_seznam)->fetchAll();
   }

   public function getSeznamByID(int $id_seznam) {
      return $this->individualConnection->query('SELECT nazev FROM material_seznam
         RIGHT JOIN uzivatel_seznam
         ON uzivatel_seznam.id_seznam = material_seznam.id_seznam
         WHERE uzivatel_seznam.id_seznam = %i;', $id_seznam)->fetchSingle();
   }

   public function deleteUsersMaterial(int $id_material, int $id_seznam) {
      $this->individualConnection->query('DELETE FROM material_seznam
         WHERE id_material = %i
         AND id_seznam = %i;', $id_material, $id_seznam);
   }

   public function deleteUsersSeznam(int $id_seznam) {
      $this->individualConnection->query('DELETE FROM material_seznam
         WHERE material_seznam.id_seznam = %i;', $id_seznam);
      $this->individualConnection->query('DELETE FROM uzivatel_seznam
         WHERE uzivatel_seznam.id_seznam = %i;', $id_seznam);
   }
}