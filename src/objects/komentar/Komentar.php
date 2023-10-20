<?php namespace src\objects;

namespace src\objects\komentar;

use src\database\ConnectionClass;
use src\objects\BaseDatabaseObject;

include_once __DIR__ . '/../../objects/BaseDatabaseObject.php';


/** Created by Robert Urmanič. Date: 20.04.2023 */
class Komentar extends BaseDatabaseObject
{
   public function __construct(string $komentar, int $id_uzivatel, int $id_identicky_material, int $hodnoceni) {
      parent::__construct();

      $this->komentar = $komentar;
      $this->id_uzivatel = $id_uzivatel;
      $this->id_identicky_material = $id_identicky_material;
      $this->hodnoceni = $hodnoceni;
   }

   private string $komentar;
   private int $id_uzivatel, $id_identicky_material, $hodnoceni;

   public function addKomentar(){
      $this->individualConnection->query('INSERT INTO uzivatel_komentar(id_uzivatel, komentar, id_identicky_material, hodnoceni) VALUES (%i, %s, %i, %i);', $this->id_uzivatel, $this->komentar, $this->id_identicky_material, $this->hodnoceni);
   }

   public function getKomentare(){
      return $this->individualConnection->query('SELECT * FROM uzivatel_komentar as uk INNER JOIN uzivatel as uz ON uz.id_uzivatel = uk.id_uzivatel WHERE id_identicky_material = %i;', $this->id_identicky_material)->fetchAll();
   }

   public function getKomentareHlasene(){
      return $this->individualConnection->query('SELECT * FROM uzivatel_komentar as uk 
                                                INNER JOIN uzivatel as uz 
                                                ON uz.id_uzivatel = uk.id_uzivatel
                                                INNER JOIN uzivatel_hlaseni_komentar as uhk 
                                                ON uhk.id_komentar = uk.id')->fetchAll();
   }

   public static function smazatKomentar($id_komentar){
      $connection = new ConnectionClass();
      $connection->getConnection()->query('DELETE FROM uzivatel_komentar WHERE id = %i', $id_komentar);
}

}