<?php

namespace App\Controllers;

use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class ListBook extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function indexAction()
  {
    View::renderTemplate('ListBook/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "danh sách", "url" => "#"],
        ["label" => "tác giả", "url" => ""]
      ],
      'title' => "Danh sách demo",
      'data' => [
        'books' => [
          [
            "title" => "Hành tinh song song",
            "href" => "/sach/15",
            "author" => "Duyn",
            "price" => "125,000 đ",
            "thumble" => "/assets/images/book-sample.jpg",
          ], [
            "title" => "Hành tinh cho kẻ nghĩ nhiều",
            "href" => "/sach/15",
            "author" => "Duyn",
            "price" => "125,000 đ",
            "thumble" => "/assets/images/book-sample.jpg",
          ], [
            "title" => "Hiệu ứng chim mồi",
            "href" => "/sach/15",
            "author" => "Duyn",
            "price" => "125,000 đ",
            "thumble" => "/assets/images/book-sample.jpg",
          ], [
            "title" => "Bạn chẳng thông minh lắm đâu",
            "href" => "/sach/15",
            "author" => "Duyn",
            "price" => "125,000 đ",
            "thumble" => "/assets/images/book-sample.jpg",
          ], [
            "title" => "Thiên nga đen",
            "href" => "/sach/15",
            "author" => "Duyn",
            "price" => "125,000 đ",
            "thumble" => "/assets/images/book-sample.jpg",
          ],
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
