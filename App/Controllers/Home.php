<?php

namespace App\Controllers;

use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html', []);
    }

    /**
     * Test post rest-api
     *
     * @return json
     */
    public function testPostApi()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo json_encode([
                'status' => 'OK',
                'data' => []
            ]);
        }
    }
}
