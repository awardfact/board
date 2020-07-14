<?php 
namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;

class TestController extends \Controller\Front\Controller
{
    /*
     * 
     * 
     */
   
    public function index()
    {
        //board컴포넌트를 로드합니다.
        //상단 use 부분에 선언을 해주어야합니다.
        //선언을 안하고 사용하는 방법은
        //$board = App::load(\Component\Kyuwon\Board::class);
        //전체 경로를 입력해주면 됩니다.
        $board = App::load(Board::class);
        
        //$board변수는 Component\Kyuwon\Board class의 객체이기 때문에 board class 내부의 함수를 사용하여 게시판 내용을 가져옵니다.
        $boardData = $board->getBoardfieldList();
        
        $this->setData('boardList', $boardData);
        
    }
    

    
}
