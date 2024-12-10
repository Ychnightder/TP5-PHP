<?php

namespace Iutrds\Tp5;

use AuthentificationException;

class Authentification {

  public function __construct(private IUserRepository $userRepository) { }

  /**
   * @throws AuthentificationException
   */
  public function register(string $email, string $password, string $repeat) : bool {
    // TODO : À compléter en appellant les exceptions AuthentificationException

      try {
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)  ) {
              throw new AuthentificationException("E-mail n'est pas valide" , "warning");
          }

//          $checkPwd = "SELECT * FROM tp5.users where password =  :password AND email = :email";
//          $stmt  = $checkPwd->prepare($checkPwd);
//          $stmt->bindParam(':email', $email);
//          $stmt->bindParam(':password', $password);
//          $stmt->execute();
//
//          if ($stmt->rowCount() < 0 ) {
          if (findUserByEmail($email)){
              throw new AuthentificationException("Le user existe déjà !" , "warning");
          }
          else {
                $user = new User($email, $password);
                return $this->userRepository->saveUser($user);
          }
      } catch (AuthentificationException $e) {
            echo $e->getMessage();
      }

  }
  /**
   * @throws AuthentificationException
   */
  public function authenticate(string $email, string $password) : string {
    // TODO : À compléter
      try {
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)  ) {
              throw new AuthentificationException("E-mail n'est pas valide" , "warning");
          }
          if (findUserByEmail($email)){
              throw new AuthentificationException("Le user existe déjà !" , "warning");
          }
        return "Authentification OK" ;
      }
      catch (AuthentificationException $e) {
          echo $e->getMessage();
      }

  }

}