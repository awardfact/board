<?php 
namespace Controller\Front\Minsang; 

use App;
use Request;
use Component\Minsang\Board;

class BoardListController extends \Controller\Front\Controller
{
    public function index() {
        $board = App::load(Board::class);
        
        $boardData = $board->getBoardList();
        //변수를 가지고 온 데이터를 확인합니다.
        //gd_debug($boardData);
        
        $this->setData('boardList', $boardData);
        
        $boardDataTest = $board->getBoardListTest();

    }
    
    
    
    
}






?>