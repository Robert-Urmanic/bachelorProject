<?php namespace src\objects\hlaseni;

use src\objects\BaseDatabaseObject;

include_once __DIR__ . '/../BaseDatabaseObject.php';

/** Created by Robert Urmanič. Date: 27.04.2023 */
class HlaseniKomentar extends BaseDatabaseObject
{
   /**
    * @param int $id_hlaseni_komentar
    * @param int $id_komentar
    * @param int $id_uzivatel_hlaseni
    */
   public function __construct(int $id_hlaseni_komentar, int $id_komentar, int $id_uzivatel_hlaseni) {
      parent::__construct();

      $this->id_hlaseni_komentar = $id_hlaseni_komentar;
      $this->id_komentar = $id_komentar;
      $this->id_uzivatel_hlaseni = $id_uzivatel_hlaseni;
   }

   private int $id_hlaseni_komentar, $id_komentar, $id_uzivatel_hlaseni;

   public function pridatHlaseni(){
      $this->individualConnection->query('INSERT INTO uzivatel_hlaseni_komentar(id_uzivatel_hlaseni, id_komentar) VALUES (%i, %i)', $this->id_uzivatel_hlaseni, $this->id_komentar);
   }

   public function odebratHlaseniPodleKomentare(){
      $this->individualConnection->query('DELETE FROM uzivatel_hlaseni_komentar WHERE id_komentar = %i', $this->id_komentar);
   }
}