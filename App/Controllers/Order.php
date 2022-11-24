<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Order extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function indexAction()
  {
    $id = $this->route_params['id'];
    $book = Books::getById($id);

    View::renderTemplate('Order/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "Thanh toán", "url" => ""],
      ],
      'book' => $book,
    ]);
  }

  /**
   * Test post rest-api
   *
   * @return json
   */
  public function testAction()
  {
    // $id = $this->route_params['id'];
    // echo json_encode([
    //   'id' => "jcasoi",
    // ]);
    echo json_encode($_GET);
  }
}
