<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
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
        $listBook = [];
        $books = Books::getAll();
        foreach ($books as &$book) {
            array_push($listBook, [
                "title" => $book["title"],
                "href" => "/sach/" . $book["id"],
                "author" => Author::getById($book["authorId"])["name"],
                "thumble" => "/assets/images/" . $book["image"],
            ]);
        }
        $categories = Category::getAll();
        $listCate = [];
        foreach ($categories as &$cate) {
            array_push($listCate, [
                "title" => $cate["name"],
                "href" => "/danh-sach/the-loai/" . $cate["id"],
                "thumble" => "/assets/images/book-sample.jpg"
            ]);
        }
        View::renderTemplate('Home/index.html', [
            'status' => 'OK',
            'data' => [
                'newBook' => $listBook,
                'categories' => $listCate,
            ]
        ]);
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
                'data' => [
                    'sampleBook' => [
                        [
                            "title" => "Hành tinh song song",
                            "href" => "#",
                            "thumble" => "/assets/images/book-sample.jpg",
                        ], [
                            "title" => "Hành tinh cho kẻ nghĩ nhiều",
                            "href" => "#",
                            "thumble" => "/assets/images/book-sample.jpg",
                        ], [
                            "title" => "Hiệu ứng chim mồi",
                            "href" => "#",
                            "thumble" => "/assets/images/book-sample.jpg",
                        ], [
                            "title" => "Bạn chẳng thông minh lắm đâu",
                            "href" => "#",
                            "thumble" => "/assets/images/book-sample.jpg",
                        ], [
                            "title" => "Thiên nga đen",
                            "href" => "#",
                            "thumble" => "/assets/images/book-sample.jpg",
                        ],
                    ]
                ]
            ]);
        }
    }
}
