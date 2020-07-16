<?php 
namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;

class BoardRegController extends \Controller\Front\Controller
{
    public function index()
    {
        $getValue = Request::post()->toArray();
        
        $board = App::load(Board::class);
        
       // 클릭한 글의 sno번호를 넘겨서 글의 댓글을 불러온다 
        $comment = $board->selectComment($getValue['sno']);
        

        $this->setData('comment', $comment);		
        $this->setData('data' , $getValue);

    }
    
    
    
}