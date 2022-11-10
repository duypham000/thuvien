<?php

namespace App\Controllers\Admin;

use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class DashBoard extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function indexAction()
  {
    View::renderTemplate('AdminDashboard/index.html', [
      'status' => 'OK',
      'data' => []
    ]);
  }
}
