<?php

namespace App\Controllers\Admin;

use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class BooksMngr extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function indexAction()
  {
    $notify = NULL;
    $type = NULL;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($_POST['action'] == "add") {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./assets/images/" . $filename;
        $uploadFileRes = move_uploaded_file($tempname, $folder);

        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $cate = $_POST['cate'];
        $author = $_POST['author'];
        $res = Books::insert($title, $description, $price, $filename, $cate, $author);
        if ($res == true) {
          $type = 'success';
          $notify = "Thêm mới thành công";
        } else {
          $type = 'danger';
          $notify = "Thêm mới thất bại";
        }
      }
      if ($_POST['action'] == "update") {
        $id = $_POST['id'];
        $imageName = Books::getById($id)["image"];
        if ($_FILES["image"]["name"] !== "") {
          $imageName = $_FILES["image"]["name"];
          $tempname = $_FILES["image"]["tmp_name"];
          $folder = "./assets/images/" . $imageName;
          $uploadFileRes = move_uploaded_file($tempname, $folder);
        }

        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $cate = $_POST['cate'];
        $author = $_POST['author'];
        $res = Books::update($id, $title, $description, $price, $imageName, $cate, $author);
        if ($res == true) {
          $type = 'success';
          $notify = "Cập nhật thành công";
        } else {
          $type = 'danger';
          $notify = "Cập nhật thất bại";
        }
      }

      if ($_POST['action'] == "delete") {
        $id = $_POST['id'];
        $res = Books::deleteById($id);
        if ($res == true) {
          $type = 'success';
          $notify = "Xóa thành công";
        } else {
          $type = 'danger';
          $notify = "Xóa thất bại";
        }
      }
    }
    $books = Books::getAll();

    foreach ($books as &$value) {
      $listCateName = "";
      $listIdCategories =  explode(",", $value["categories"]);
      foreach ($listIdCategories as $keyCate => $valueCate) {
        if ($keyCate !== 0) {
          $listCateName .= ",";
        }
        $cateName = Category::getById($valueCate)["name"];
        $listCateName .= $cateName;
      }
      $value["authorId"] = Author::getById($value["authorId"])["name"];
      $value["categories"] = $listCateName;
    }

    View::renderTemplate('AdminDashboard/Books/index.html', [
      'status' => 'OK',
      'notify' => ['type' => $type, 'detail' => $notify],
      'location' => [
        [
          'url' => "/admin/books",
          'label' => "Quản lý sách"
        ],
        [
          'url' => "/admin/books",
          'label' => "Danh sách đầu sách"
        ]
      ],
      'books' => $books,
    ]);
  }

  /**
   * Show the index page
   *
   * @return void
   */
  public function insertAction()
  {
    $categories = Category::getAll();
    $authors = Author::getAll();
    View::renderTemplate('AdminDashboard/Books/insert.html', [
      'status' => 'OK',
      'location' => [
        [
          'url' => "/admin/books",
          'label' => "Quản lý sách"
        ],
        [
          'url' => "/admin/books/them-moi",
          'label' => "Thêm sách"
        ]
      ],
      'data' => [
        'categories' => $categories,
        'author' => $authors,
      ]
    ]);
  }

  /**
   * Show the index page
   *
   * @return void
   */
  public function updateAction()
  {
    $id = $this->route_params['id'];
    $categories = Category::getAll();
    $authors = Author::getAll();
    $book = Books::getById($id);
    View::renderTemplate('AdminDashboard/Books/update.html', [
      'status' => 'OK',
      'location' => [
        [
          'url' => "/admin/books",
          'label' => "Quản lý sách"
        ],
        [
          'url' => "",
          'label' => "Sửa thông tin sách"
        ]
      ],
      'book' => $book,
      'data' => [
        'categories' => $categories,
        'author' => $authors,
      ],
    ]);
  }

  /**
   * Show the index page
   *
   * @return void
   */
  public function testAction()
  {
    // $users = User::getAll();
    // echo json_encode($users);
    // $res = User::update(9, "duypham000", "asd", "user");
    // echo json_encode($res);
  }
}
