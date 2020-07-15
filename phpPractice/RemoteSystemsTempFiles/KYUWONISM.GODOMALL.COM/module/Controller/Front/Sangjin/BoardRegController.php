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
        
       
        $comment = $board->selectComment($getValue['sno']);
        

        $this->setData('comment', $comment);		
        $this->setData('data' , $getValue);

    }
    
    
    
}