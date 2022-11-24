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
class Book extends \Core\Controller
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

    $listCateName = [];
    $listIdCategories =  explode(",", $book["categories"]);
    foreach ($listIdCategories as $keyCate => $valueCate) {
      $cateName = Category::getById($valueCate)["name"];
      array_push($listCateName, ["id" => $valueCate, "name" => $cateName]);
    }
    $author = Author::getById($book["authorId"])["name"];

    View::renderTemplate('Book/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "sách", "url" => "/danh-sach/sach"],
        ["label" => "hành tinh song song", "url" => ""]
      ],
      'data' => [
        'detailBook' => [
          "title" => $book["title"],
          "description" => nl2br($book["description"]),
          "thumble" => "/assets/images/" . $book["image"],
          "author" => $author,
          "authorId" => $book["authorId"],
          "categories" => $listCateName,
          "followCount" => $book["followCount"],
          "countLeft" => $book["quantityLeft"],
          "total" => $book["quantity"],
          "totalGet" => $book["orderCount"],
        ],
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
    // $id = $this->route_params['id'];
    // echo json_encode([
    //   'id' => "jcasoi",
    // ]);
    echo json_encode($_GET);
  }
}
