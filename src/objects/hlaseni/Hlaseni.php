<?php namespace src\objects\hlaseni;

include_once __DIR__ . '/../BaseDatabaseObject.php';

use src\objects\BaseDatabaseObject;

/** Created by Robert Urmanič. Date: 27.04.2023 */
class Hlaseni extends BaseDatabaseObject
{
   /**
    * @param int $id_hlaseni
    * @param int $id_uzivatel
    * @param string $komentar
    */
   public function __construct(int $id_hlaseni, int $id_uzivatel, string $komentar) {
      parent::__construct();

      $this->id_hlaseni = $id_hlaseni;
      $this->id_uzivatel = $id_uzivatel;
      $this->komentar = $komentar;
   }

   private int $id_hlaseni, $id_uzivatel;
   private string $komentar;


   public function addHlaseni(){
      $this->individualConnection->query('INSERT INTO uzivatel_hlaseni(id_uzivatel, komentar) VALUES (%s, %s)', $this->id_uzivatel, $this->komentar);
   }

   public function getHlaseni(){
      return $this->individualConnection->query('SELECT * FROM uzivatel_hlaseni as uh
                                          INNER JOIN uzivatel as uz
                                          on uz.id_uzivatel = uh.id_uzivatel;');
   }

   public function smazatHlaseni(){
      $this->individualConnection->query('DELETE FROM uzivatel_hlaseni WHERE id_hlaseni = %i', $this->id_hlaseni);
   }
}