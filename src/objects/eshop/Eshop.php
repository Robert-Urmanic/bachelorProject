<?php namespace src\objects\eshop;

use src\database\ConnectionClass;
use src\objects\BaseDatabaseObject;

include_once __DIR__ . '../BaseDatabaseObject.php';

/** Created by Robert Urmanič. Date: 26.03.2023 */
class Eshop extends BaseDatabaseObject
{


   /**
    * @param string $nazev
    * @param string $promennaCena
    * @param string $promennaPopis
    * @param string $promennaObrazek
    * @param string $promennaNadpis
    * @param string $link
    */
   public function __construct(string $nazev, string $promennaCena, string $promennaPopis, string $promennaObrazek, string $promennaNadpis, string $link) {
      parent::__construct();

      $this->nazev = $nazev;
      $this->promennaCena = $promennaCena;
      $this->promennaPopis = $promennaPopis;
      $this->promennaObrazek = $promennaObrazek;
      $this->promennaNadpis = $promennaNadpis;
      $this->link = $link;
   }

   private string $nazev, $promennaCena, $promennaPopis, $promennaObrazek, $promennaNadpis, $link;

   private static ConnectionClass $connection;

   public function addEshop(){
      $this->individualConnection->query('INSERT INTO eshop(nazev, promennaCena, promennaPopis, promennaObrazek, promennaNadpis, link) VALUES (%s, %s, %s, %s, %s, %s)', $this->nazev, $this->promennaCena, $this->promennaPopis, $this->promennaObrazek, $this->promennaNadpis, $this->link);
   }

   public function getEshopByUrl() {
      return $this->individualConnection->query('SELECT id_eshop, promennaCena, promennaPopis, promennaObrazek, promennaNadpis FROM eshop WHERE link = %s', $this->link)->fetchAll();
   }
}