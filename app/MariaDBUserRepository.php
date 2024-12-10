<?php

namespace Iutrds\Tp5;

class MariaDBUserRepository implements IUserRepository {

  public function __construct(private \PDO $dbConnexion) {
  }

  /**
   * Effectue l'enregistrement d'un utilisateur (email/password) dans la base MariaDB
   * retourne true en cas de succès et false en cas d'erreur
   * @param User $user
   * @return bool
   */
  public function saveUser(User $user) : bool {
    // TODO: Implement saveUser() method.
    $sql = "INSERT INTO tp5.users (email, password) VALUES (:email, :password)";
    $stmt = $this->dbConnexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
  }



  /**
   * Recherche un utilisateur à partir de son email dans la base MariaDB.
   * Retourne l'utilisateur si l'utilisateur est enregistré. Sinon null
   * @param string $email
   * @return User|null
   */
  public function findUserByEmail(string $email) : ?User {
    // TODO: Implement findUserByEmail() method.
    $sql = "SELECT * FROM tp5.users WHERE email = :email";
    $stmt = $this->dbConnexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    if ( $stmt->execute()){
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($data){
            return new User($data['email'], $data['password']);
        }
    };
      return null;
  }
}