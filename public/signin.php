<?php


if(!session_id())
  session_start();

use Iutrds\Tp5\Authentification;
use Iutrds\Tp5\BddConnect;
use Iutrds\Tp5\Exceptions\BddConnectException;
use Iutrds\Tp5\MariaDBUserRepository;
use Iutrds\Tp5\Messages;

require_once 'header.php';
require_once '../vendor/autoload.php';

$bdd = new BddConnect();

try {
  $pdo = $bdd->connexion();
}
catch(BddConnectException $e) {
  Messages::goHome($e->getMessage(), $e->getType(), "index.php");
}

$trousseau = new MariaDBUserRepository($pdo);
$auth = new Authentification($trousseau);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // TODO : À compléter

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';


    if (empty($email) || empty($password)) {
        Messages::goHome("Veuillez remplir tous les champs.", "error", "signin.php");
        exit();
    }
    $user = $auth->authenticate($email, $password);

}


require_once 'footer.php';