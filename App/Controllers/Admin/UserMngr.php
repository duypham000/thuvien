<?php

namespace App\Controllers\Admin;

use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class UserMngr extends \Core\Controller
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
    $res = [];
    foreach ($users as &$value) {
      if (!array_key_exists("q", $_GET)) {
        array_push($res, $value);
      } else if ($_GET["q"] === "" || strlen(strstr($value["username"], $_GET["q"])) > 0) {
        array_push($res, $value);
      }
    }
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
      'users' => $res,
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
    $user = User::getById($id);
    View::renderTemplate('AdminDashboard/User/update.html', [
      'status' => 'OK',
      'location' => [
        [
          'url' => "/admin/users",
          'label' => "Quản lý user"
        ],
        [
          'url' => "#",
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
    View::renderTemplate('AdminDashboard/User/insert.html', [
      'status' => 'OK',
      'location' => [
        [
          'url' => "/admin/users",
          'label' => "Quản lý user"
        ],
        [
          'url' => "/admin/users/them-moi",
          'label' => "Thêm user"
        ]
      ],
      'data' => [
        "username" => "duyn"
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
