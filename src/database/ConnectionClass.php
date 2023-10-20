<?php namespace src\database;

include_once __DIR__ . '/ConnectionClass.php';
use Dibi;


/** Created by Robert Urmanič. Date: 20.03.2023 */
class ConnectionClass
{
   private Dibi\Connection $connection;

   public function __construct() {
      try{
         $this->connection = new Dibi\Connection([
            'driver' => 'mysqli',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'appbakalar',
         ]);
      } catch(\Dibi\Exception $e){
         echo 'not connected ' . $e->getMessage();
      }
   }

   public function getConnection() :Dibi\Connection {
      return $this->connection;
   }
}