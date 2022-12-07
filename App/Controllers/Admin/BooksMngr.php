<?php

namespace App\Controllers\Admin;

use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
use App\Models\Location;
use \Core\View;
use LengthException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $description = $_POST['description'];
        $locationId = $_POST['locate'];
        $cate = $_POST['cate'];
        $author = $_POST['author'];
        $quantity = $_POST['quantity'];
        $numOfGood = $_POST['numOfGood'];
        $dateIn = $_POST['dateIn'];

        $res = Books::insert(
          $title,
          $description,
          $filename,
          $cate,
          $author,
          $quantity,
          $numOfGood,
          $locationId,
          $dateIn
        );
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
        $description = $_POST['description'];
        $locationId = $_POST['locate'];
        $cate = $_POST['cate'];
        $author = $_POST['author'];
        $quantity = $_POST['quantity'];
        $numOfGood = $_POST['numOfGood'];
        $dateIn = $_POST['dateIn'];
        $res = Books::update(
          $id,
          $title,
          $description,
          $imageName,
          $cate,
          $author,
          $quantity,
          $numOfGood,
          $locationId,
          $dateIn
        );
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
    $res = [];

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
      $value["locationId"] = Location::getById($value["locationId"])["name"];
      $value["authorId"] = Author::getById($value["authorId"])["name"];
      $value["categories"] = $listCateName;
      if (!array_key_exists("q", $_GET)) {
        array_push($res, $value);
      } else if ($_GET["q"] === "" || strpos($value["title"], $_GET["q"])) {
        array_push($res, $value);
      }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($_POST['action'] == "export") {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'Tựa đề');
        $sheet->setCellValue('C1', 'Nội dung');
        $sheet->setCellValue('D1', 'Ảnh');
        $sheet->setCellValue('E1', 'Thể loại');
        $sheet->setCellValue('F1', 'Tác giả');
        $sheet->setCellValue('G1', 'Số lượng');
        $sheet->setCellValue('H1', 'Vị trí');
        $sheet->setCellValue('I1', 'Số sách còn nguyên vẹn');
        $sheet->setCellValue('J1', 'Ngày nhập');

        for ($i = 0; $i < count($res); $i++) {
          $sheet->setCellValue('A' . ($i + 2), $res[$i]["id"]);
          $sheet->setCellValue('B' . ($i + 2), $res[$i]["title"]);
          $sheet->setCellValue('C' . ($i + 2), $res[$i]["description"]);
          $sheet->setCellValue('D' . ($i + 2), $res[$i]["image"]);
          $sheet->setCellValue('E' . ($i + 2), $res[$i]["categories"]);
          $sheet->setCellValue('F' . ($i + 2), $res[$i]["authorId"]);
          $sheet->setCellValue('G' . ($i + 2), $res[$i]["quantity"]);
          $sheet->setCellValue('H' . ($i + 2), $res[$i]["locationId"]);
          $sheet->setCellValue('I' . ($i + 2), $res[$i]["numOfGood"]);
          $sheet->setCellValue('J' . ($i + 2), $res[$i]["dateIn"]);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('books.xlsx');
        $type = 'success';
        $notify = "Xuất thành công, nhấn <a href=\"/books.xlsx\" style=\"color: blue\">vào đây</a> để tải về";
      }
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
      'books' => $res,
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
    $locations = Location::getAll();
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
        'locations' => $locations,
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
    $locations = Location::getAll();
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
        'locations' => $locations,
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
