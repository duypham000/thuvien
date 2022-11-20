<?php

namespace App\Controllers\Admin;

use App\Models\Author;
use App\Models\Category;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class CategoryMngr extends \Core\Controller
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
        $res = Category::insert($name);
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
        $res = Category::update($id, $name);
        if ($res == true) {
          $type = 'success';
          $notify = "Sửa thông tin thể loại thành công";
        } else {
          $type = 'danger';
          $notify = "Sửa thông tin thể loại thất bại";
        }
      }

      if ($_POST['action'] == "delete") {
        $id = $_POST['id'];
        $res = Category::deleteById($id);
        if ($res == true) {
          $type = 'success';
          $notify = "Xóa thể loại thành công";
        } else {
          $type = 'danger';
          $notify = "Xóa thể loại thất bại";
        }
      }
    }
    $categories = Category::getAll();
    View::renderTemplate('AdminDashboard/Category/index.html', [
      'status' => 'OK',
      'notify' => ['type' => $type, 'detail' => $notify],
      'location' => [
        [
          'url' => "/admin/categories",
          'label' => "Quản lý thể loại"
        ],
        [
          'url' => "/admin/categories",
          'label' => "Danh sách thể loại"
        ]
      ],
      'categories' => $categories,
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
