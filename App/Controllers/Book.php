<?php

namespace App\Controllers;

use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Book extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function indexAction()
  {
    View::renderTemplate('Book/index.html', [
      'status' => 'OK',
      'data' => [
        'detailBook' => [
          "title" => "Hành tinh song song",
          "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente, adipisci ipsam ut reiciendis, numquam quisquam amet iure neque cum odio ea officiis rem nihil. Excepturi!",
          "thumble" => "/assets/images/book-sample.jpg",
          "author" => "Phạm Khánh Duy",
          "followCount" => 6,
          "countLeft" => 15,
          "total" => 20,
        ],
      ]
    ]);
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
