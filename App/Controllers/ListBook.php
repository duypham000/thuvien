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

  public function categoryAction()
  {
    $id = $this->route_params['id'];
    $books = Books::getAll();
    $listBook = [];
    foreach ($books as $book) {
      $idCateArray =  explode(",", $book["categories"]);
      if (in_array($id, $idCateArray)) {
        array_push($listBook, [
          "title" => $book["title"],
          "href" => "/sach/" . $book["id"],
          "author" => Author::getById($book["authorId"])["name"],
          "price" => number_format($book["price"], 0, ",", ".") . "đ",
          "thumble" => "/assets/images/" . $book["image"],
        ]);
      }
    }
    $cateName = Category::getById($id)["name"];
    View::renderTemplate('ListBook/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "thể loại", "url" => ""],
        ["label" => $cateName, "url" => ""]
      ],
      'title' => "Sách thuộc thể loại " . $cateName,
      'data' => [
        'books' => $listBook,
      ]
    ]);
  }

  public function authorAction()
  {
    $id = $this->route_params['id'];
    $books = Books::getAll();
    $authorName = Author::getById($id)["name"];
    $listBook = [];
    foreach ($books as $book) {
      if ($book["authorId"] === $id) {
        array_push($listBook, [
          "title" => $book["title"],
          "href" => "/sach/" . $book["id"],
          "author" => $authorName,
          "price" => number_format($book["price"], 0, ",", ".") . "đ",
          "thumble" => "/assets/images/" . $book["image"],
        ]);
      }
    }
    View::renderTemplate('ListBook/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "tác giả", "url" => ""],
        ["label" => $authorName, "url" => ""]
      ],
      'title' => "Sách do tác giả " . $authorName . " viết",
      'data' => [
        'books' => $listBook,
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
