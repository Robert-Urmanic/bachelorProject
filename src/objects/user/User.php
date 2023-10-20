<?php namespace src\user;

include_once __DIR__ . '/../../../vendor/autoload.php';
include_once __DIR__ . '/../../database/ConnectionClass.php';
include_once __DIR__ . '/../../objects/BaseDatabaseObject.php';

use Dibi;
use src\database\ConnectionClass;
use src\objects\BaseDatabaseObject;

/** Created by Robert Urmanič. Date: 20.03.2023 */
class User extends BaseDatabaseObject
{


   /**
    * @param string $email
    * @param string $jmeno
    * @param string $prijmeni
    * @param string $heslo
    * @param string $isAdmin
    */
   public function __construct(string $email, string $jmeno, string $prijmeni, ?string $heslo, int $isAdmin = 0) {
      parent::__construct();

      $this->email = $email;
      $this->jmeno = $jmeno;
      $this->prijmeni = $prijmeni;
      $this->heslo = $heslo ??= '0';
      $this->isAdmin = $isAdmin;
   }


   private int $id_uzivatel, $isAdmin;
   private string $email, $jmeno, $prijmeni, $heslo;

   private static ConnectionClass $connection;

   public function addUser() {
      $this->individualConnection->query('INSERT INTO uzivatel(email, heslo, jmeno, prijmeni) VALUES (%s, %s, %s, %s)', $this->email, password_hash($this->heslo, PASSWORD_DEFAULT), $this->jmeno, $this->prijmeni);
   }

   public function isUserDuplicate() :bool {
      if($this->individualConnection->query('SELECT email FROM uzivatel WHERE email = %s', $this->email)->fetchSingle() === $this->email){
         return true;
      } else return false;
   }

   public function login(string $postHeslo) {
      if(password_verify($postHeslo, $this->individualConnection->query('SELECT heslo, email FROM uzivatel WHERE email = %s', $this->email)->fetchSingle())){
         $this->individualConnection->query('UPDATE uzivatel SET loginNum = %i WHERE email = %s', 0, $this->email);
         return $this->individualConnection->query('SELECT jmeno, prijmeni, email, isAdmin, id_uzivatel FROM uzivatel WHERE email = %s', $this->email)->fetch();
      } else{
         $numberOfLogins = $this->individualConnection->query('SELECT loginNum FROM uzivatel WHERE email = %s', $this->email)->fetchSingle();
         if($numberOfLogins < 10){
            $this->individualConnection->query('UPDATE uzivatel SET loginNum = %i WHERE email = %s', $numberOfLogins + 1, $this->email);
            return 'false';
         } else{
            $lastFailedLogin = $this->individualConnection->query('SELECT lastIncorrectLogin FROM uzivatel WHERE email = %s', $this->email)->fetchSingle();
            if((strtotime("now") - strtotime(date($lastFailedLogin)))/60 > 5){
               $this->individualConnection->query('UPDATE uzivatel SET loginNum = %i WHERE email = %s', 0, $this->email);
               return $this->login($postHeslo);
            } else return 'blocked';
         }
      }
   }
}