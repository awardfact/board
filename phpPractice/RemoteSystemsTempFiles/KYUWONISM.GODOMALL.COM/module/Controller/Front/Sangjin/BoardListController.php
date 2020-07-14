<?php 
namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;

class BoardListController extends \Controller\Front\Controller
{
    public function index()
    {
        $board = App::load(Board::class);
        $boardData = $board->getBoardList();
        
        $this->setData('boardList', $boardData);
    }
    
    
    
}