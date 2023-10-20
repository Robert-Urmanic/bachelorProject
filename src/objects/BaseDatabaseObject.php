<?php namespace src\objects;

include_once __DIR__ . '/../database/ConnectionClass.php';

use src\database\ConnectionClass;
use Dibi;

/** Created by Robert Urmanič. Date: 26.03.2023 */
class BaseDatabaseObject
{
   private static ConnectionClass $connection;

   public static function getConnection() :Dibi\Connection {
      $connection = new ConnectionClass();
      return $connection->getConnection();
   }

   public function __construct() {
      $this->individualConnection = self::getConnection();
   }
}