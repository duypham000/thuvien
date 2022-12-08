<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use \Core\View;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Date;

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
    $listBook = [];
    $books = Books::getAll();
    foreach ($books as $book) {
      $checked = true;

      if (array_key_exists("keyword", $_GET) && !($_GET["keyword"] === "" || strlen(strstr($book["title"], $_GET["keyword"])) > 0)) {
        $checked = false;
      }

      if ((array_key_exists("keyword", $_GET)) && !($_GET["keyword"] === "" || strlen(strstr($book["description"], $_GET["keyword"])) > 0)) {
        $checked = false;
      }

      if ((array_key_exists("author", $_GET)) && !($_GET["author"] === "-1"  || $_GET["author"] === "" || ($book["authorId"] === $_GET["author"]) > 0)) {
        $checked = false;
      }

      if ((array_key_exists("locate", $_GET)) && !($_GET["locate"] === "-1"  || $_GET["locate"] === "" || ($book["locationId"] === $_GET["locate"]))) {
        $checked = false;
      }

      if ((array_key_exists("cate", $_GET)) && !($_GET["cate"] === "")) {
        foreach (explode("a", $_GET["cate"]) as $value) {
          if (!in_array($value, explode(",", $book["categories"]))) {
            $checked = false;
          }
        }
      }

      if ((array_key_exists("dateFrom", $_GET)) && !($_GET["dateFrom"] === "" || strtotime($_GET["dateFrom"]) < strtotime($book["dateIn"]))) {
        $checked = false;
      }
      if ((array_key_exists("dateTo", $_GET)) && !($_GET["dateTo"] === "" || strtotime($_GET["dateTo"]) > strtotime($book["dateIn"]))) {
        $checked = false;
      }

      if ($checked === true) {
        array_push($listBook, [
          "title" => $book["title"],
          "href" => "/sach/" . $book["id"],
          "author" => Author::getById($book["authorId"])["name"],
          "thumble" => "/assets/images/" . $book["image"],
        ]);
      }
    }
    $categories = Category::getAll();
    $author = Author::getAll();
    $locations = Location::getAll();
    View::renderTemplate('ListBook/index.html', [
      'status' => 'OK',
      'title' => "Tất cả sách",
      'temp' => $_GET,
      'data' => [
        'books' => $listBook,
        "categories" => $categories,
        "author" => $author,
        "locations" => $locations,
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
          "thumble" => "/assets/images/" . $book["image"],
        ]);
      }
    }
    $cateName = Category::getById($id)["name"];
    View::renderTemplate('ListBook/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "thể loại", "url" => "/danh-sach"],
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
          "thumble" => "/assets/images/" . $book["image"],
        ]);
      }
    }
    View::renderTemplate('ListBook/index.html', [
      'status' => 'OK',
      'location' => [
        ["label" => "tác giả", "url" => "/danh-sach"],
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
