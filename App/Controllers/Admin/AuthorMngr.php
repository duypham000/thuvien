<?php

namespace App\Controllers\Admin;

use App\Models\Author;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class AuthorMngr extends \Core\Controller
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
        $name = $_POST['name'];
        $res = Author::insert($name);
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
        $name = $_POST['name'];
        $res = Author::update($id, $name);
        if ($res == true) {
          $type = 'success';
          $notify = "Sửa thông tin user thành công";
        } else {
          $type = 'danger';
          $notify = "Sửa thông tin user thất bại";
        }
      }

      if ($_POST['action'] == "delete") {
        $id = $_POST['id'];
        $res = Author::deleteById($id);
        if ($res == true) {
          $type = 'success';
          $notify = "Xóa user thành công";
        } else {
          $type = 'danger';
          $notify = "Xóa user thất bại";
        }
      }
    }
    $authors = Author::getAll();
    $res = [];
    foreach ($authors as &$value) {
      if (!array_key_exists("q", $_GET)) {
        array_push($res, $value);
      } else if ($_GET["q"] === "" || strlen(strstr($value["name"], $_GET["q"])) > 0) {
        array_push($res, $value);
      }
    }
    View::renderTemplate('AdminDashboard/Author/index.html', [
      'status' => 'OK',
      'notify' => ['type' => $type, 'detail' => $notify],
      'location' => [
        [
          'url' => "/admin/authors",
          'label' => "Quản lý tác giả"
        ],
        [
          'url' => "/admin/authors",
          'label' => "Danh sách tác giả"
        ]
      ],
      'authors' => $res,
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
