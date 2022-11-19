<?php

namespace App\Controllers\Admin;

use App\Models\User;
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
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $res = User::insert($username, $password, $role);
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
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $res = User::update($id, $username, $password, $role);
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
        $res = User::deleteById($id);
        if ($res == true) {
          $type = 'success';
          $notify = "Xóa user thành công";
        } else {
          $type = 'danger';
          $notify = "Xóa user thất bại";
        }
      }
    }
    $users = User::getAll();
    View::renderTemplate('AdminDashboard/User/index.html', [
      'status' => 'OK',
      'notify' => ['type' => $type, 'detail' => $notify],
      'location' => [
        [
          'url' => "/admin/users",
          'label' => "Quản lý user"
        ],
        [
          'url' => "/admin/users",
          'label' => "Danh sách user"
        ]
      ],
      'users' => $users,
    ]);
  }

  /**
   * Show the index page
   *
   * @return void
   */
  public function updateAction()
  {
    $user = User::getById(9)[0];
    View::renderTemplate('AdminDashboard/User/update.html', [
      'status' => 'OK',
      'location' => [
        [
          'url' => "/admin/users",
          'label' => "Quản lý user"
        ],
        [
          'url' => "/admin/users",
          'label' => "Cập nhật thông tin"
        ]
      ],
      'data' => $user
    ]);
  }

  /**
   * Show the index page
   *
   * @return void
   */
  public function insertAction()
  {
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
        'categories' => ["tiểu thuyết", "âm nhạc", "tình cảm", "giả tưởng"],
        'author' => ["Phạm Khánh Duy", "Đào Cẩm Tú", "Dai Duong Duong"],
      ]
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
    $res = User::update(9, "duypham000", "asd", "user");
    echo json_encode($res);
  }
}
