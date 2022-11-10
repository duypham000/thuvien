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
    View::renderTemplate('AdminDashboard/User/index.html', [
      'status' => 'OK',
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
      'data' => []
    ]);
  }

  /**
   * Show the index page
   *
   * @return void
   */
  public function updateAction()
  {
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
      'data' => [
        "username" => "duyn"
      ]
    ]);
  }
}
