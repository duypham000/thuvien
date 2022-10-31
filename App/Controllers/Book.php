<?php

namespace App\Controllers;

use App\Models\User;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Book extends \Core\Controller
{

  /**
   * Show the index page
   *
   * @return void
   */
  public function indexAction()
  {
    View::renderTemplate('Book/index.html', [
      'status' => 'OK',
      'data' => [
        'detailBook' => [
          "title" => "Hành tinh song song",
          "description" => "
            Yêu, ở đây ở kia và ở đằng xa<br /><br />
            “A walk to remember” (chuyển thể từ tiểu thuyết của nhà văn Nicholas Sparks) là bộ phim theo mình suốt những năm tháng tuổi thơ, gieo ấn tượng đầu đời về tình yêu và phần nào đó, là nhân sinh quan. Một phân cảnh đáng nhớ của phim là lúc Landon (cậu trai) cố gắng hoàn thành chiếc kính viễn vọng để giúp Jamie (cô người yêu – bệnh nặng đang đếm ngược thời gian) quan sát sao chổi trên bầu trời, trước khi biến thành 1 trong những ngôi sao xa xôi trên kia.
            Mình thật sự không rõ lúc ấy Landon đã can đảm thế nào, khi đếm ngược thời gian bên cạnh người yêu nhưng vẫn phải mạnh mẽ làm chỗ dựa cho cô.<br/><br />
            Sau khi Jamie lìa đời, Landon vẫn có thể đi trên con phố cũ, cười đùa với chính…bàn tay mình như thể đó là người yêu. Phải rồi, vì là hành tinh song song nên họ hoàn toàn có thể hẹn hò trên cùng con đường, cùng nơi chốn. Và “hành tinh song song” này là một phương cách làm an lòng người ở lại. Đừng bắt họ phải sống tiếp, bước tiếp, quên đi hoặc tìm người mới. Họ có quyền vẫn được yêu, vẫn thương nhớ, hẹn hò người tình ở hành tinh song song, trong khi vẫn sống và làm tròn trách nhiệm ở hành tinh hiện tại.<br /><br />
            “Em đã từng nghe, lời yêu thương nào buồn đến thế<br />
            Em có từng nghe, lời dặn dò nào đau đến thế”<br />
            Vũ. đã thay mình, viết lời ca về giây phút ấy, về những lời nhắn gửi ấy. “Hành tinh song song” là một cách hy vọng ngây ngô nhưng rất phù hợp với những đôi phải chia cắt âm – dương khi đang yêu nhau nồng nàn nhất. Không phải là thiên đường (vì nó quá lý tưởng), càng không phải địa ngục (ai lại muốn người mình yêu xuống đó bao giờ?) mà chỉ đơn giản là một hành tinh, nơi người mình yêu vẫn có thể sống tiếp một cuộc đời trần thế còn dang dở.<br /><br />
            “Của cậu tất”, dòng chữ ngắn gọn mà An Nguy gửi đến Toàn Shinoda, tầm mươi ngày sau khi anh qua đời ở tuổi 27. Ở đó, An Nguy ngồi một mình cùng dĩa thức ăn to như dành cho 2 người vì cô biết ở thế giới song song, Toàn Shinoda cũng có một nơi chốn đi về như vậy.<br /><br />
            Mình là người nhạy cảm với cái chết và luôn có câu hỏi điên rồ rằng, “Nếu mình không còn, mình rất muốn biết người mình yêu sống thế nào?” hoặc mình sẽ ra sao nếu cô gái mình yêu sớm thức dậy sẽ không còn nữa? Cách đây vài năm, cô gái mình yêu đơn phương suýt bỏ mạng vì đuối nước. Và một màu trắng bệnh viện đã ám ảnh mình rất nhiều, vài tháng trước, khi suýt không còn kịp thấy mặt “cô gái Bắc Kỳ” lần-đầu-tiên.
            ",
          "thumble" => "/assets/images/book-sample.jpg",
          "author" => "Dai Duong Duong",
          "categories" => ["Tiểu thuyết", "Âm nhạc", "Tình cảm", "Giả tưởng"],
          "followCount" => 6,
          "countLeft" => 15,
          "total" => 20,
        ],
      ]
    ]);
  }

  /**
   * Test post rest-api
   *
   * @return json
   */
  public function testAction()
  {
    $id = $this->route_params['id'];
    echo json_encode([
      'id' => $id,
    ]);
  }
}
