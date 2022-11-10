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
        View::renderTemplate('Home/index.html', [
            'status' => 'OK',
            'data' => [
                'newBook' => [
                    [
                        "title" => "Hành tinh song song",
                        "href" => "/sach/15",
                        "author" => "Duyn",
                        "price" => "125,000 đ",
                        "thumble" => "/assets/images/book-sample.jpg",
                    ], [
                        "title" => "Hành tinh cho kẻ nghĩ nhiều",
                        "href" => "/sach/15",
                        "author" => "Duyn",
                        "price" => "125,000 đ",
                        "thumble" => "/assets/images/book-sample.jpg",
                    ], [
                        "title" => "Hiệu ứng chim mồi",
                        "href" => "/sach/15",
                        "author" => "Duyn",
                        "price" => "125,000 đ",
                        "thumble" => "/assets/images/book-sample.jpg",
                    ], [
                        "title" => "Bạn chẳng thông minh lắm đâu",
                        "href" => "/sach/15",
                        "author" => "Duyn",
                        "price" => "125,000 đ",
                        "thumble" => "/assets/images/book-sample.jpg",
                    ], [
                        "title" => "Thiên nga đen",
                        "href" => "/sach/15",
                        "author" => "Duyn",
                        "price" => "125,000 đ",
                        "thumble" => "/assets/images/book-sample.jpg",
                    ],
                ],
                'categories' => [
                    [
                        "title" => "Kinh dị",
                        "href" => "/danh-sach/theloai/kinhdi",
                        "thumble" => "/assets/images/book-sample.jpg"
                    ],
                    [
                        "title" => "Trinh thám",
                        "href" => "/danh-sach/theloai/trinhtham",
                        "thumble" => "/assets/images/book-sample.jpg"
                    ],
                    [
                        "title" => "Lãng mạn",
                        "href" => "/danh-sach/theloai/langman",
                        "thumble" => "/assets/images/book-sample.jpg"
                    ],
                    [
                        "title" => "Tiểu thuyết ngắn",
                        "href" => "/danh-sach/theloai/tieuthuyetngan",
                        "thumble" => "/assets/images/book-sample.jpg"
                    ]
                ]
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
