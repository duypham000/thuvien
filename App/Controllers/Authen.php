<?php

namespace App\Controllers;

use App\Models\User;
use \Core\View;

/**
 * Authen controller
 *
 * PHP version 7.0
 */
class Authen extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function loginAction()
  {
    View::renderTemplate('Authen/login.html', [
      'status' => 'OK',
    ]);
  }

  /**
   * Login
   *
   * @return void
   */
  public function loginCheckingAction()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $user = User::getByUsernameAndPassword($username, $password);
      echo json_encode([
        'status' => 200,
        'data' => $user,
      ]);
    }
  }

  /**
   * Test post rest-api
   *
   * @return json
   */
  public function testAction()
  {
    $id = $this->route_params['id'];
    echo json_encode([
      'id' => $id,
    ]);
  }
}
