<?php

namespace Iutrds\Tp5;

use Iutrds\Tp5\Exceptions\BddConnectException;

class BddConnect {
  public \PDO $pdo;
  protected string $host;
  protected string $login;
  protected string $password;
  protected string $dbname;

  public function __construct() {
    // TODO : Configurer avec vos valeurs de connexions
     $this->login = "root";
     $this->password = "ychnightder";
     $this->host = "localhost";
     $this->dbname = "tp5";
  }

  /**
   * @throws BddConnectException
   */
  public function connexion() : \PDO {
    try {
      $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
      $this->pdo = new \PDO($dsn, $this->login, $this->password);
      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }
    catch(\PDOException $e) {
      throw new BddConnectException("Erreur de connexion BDD : il faut configurer la classe BDDConnect avec les bonnes valeurs");
    }
    return $this->pdo;
  }
}