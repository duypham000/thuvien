<?php

namespace App\Controllers\Admin;

use App\Models\Location;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class LocationMngr extends \Core\Controller
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
        $locate = $_POST['location'];
        $res = Location::insert($name, $locate);
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
        $locate = $_POST['location'];
        $res = Location::update($id, $name, $locate);
        if ($res == true) {
          $type = 'success';
          $notify = "Sửa thông tin thành công";
        } else {
          $type = 'danger';
          $notify = "Sửa thông tin thất bại";
        }
      }

      if ($_POST['action'] == "delete") {
        $id = $_POST['id'];
        $res = Location::deleteById($id);
        if ($res == true) {
          $type = 'success';
          $notify = "Xóa thành công";
        } else {
          $type = 'danger';
          $notify = "Xóa thất bại";
        }
      }
    }
    $Locations = Location::getAll();
    $res = [];
    foreach ($Locations as &$value) {
      if (!array_key_exists("q", $_GET)) {
        array_push($res, $value);
      } else if ($_GET["q"] === "" || strpos($value["name"], $_GET["q"]) || strpos($value["location"], $_GET["q"])) {
        array_push($res, $value);
      }
    }
    View::renderTemplate('AdminDashboard/Location/index.html', [
      'status' => 'OK',
      'notify' => ['type' => $type, 'detail' => $notify],
      'location' => [
        [
          'url' => "/admin/locations",
          'label' => "Quản lý kho"
        ],
        [
          'url' => "/admin/locations",
          'label' => "Danh sách kho"
        ]
      ],
      'locations' => $res,
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
