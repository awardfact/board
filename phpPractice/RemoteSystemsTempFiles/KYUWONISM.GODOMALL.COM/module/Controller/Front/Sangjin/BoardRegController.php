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
        $session = App::getInstance('session');
        $board = App::load(Board::class);
        
        if($getValue['writer'] != $session->get(SESSION_USER_CERTIFICATION) && $getValue['mode'] == 'update'){
            echo "<script> alert('자신이 작성한 게시글만 수정할 수 있습니다.');</script>";
            echo "<script> history.back();</script>";
        }
        gd_debug($session->get(SESSION_USER_CERTIFICATION));
        if(!$session->get(SESSION_USER_CERTIFICATION) && $getValue['mode'] == 'write'){
            gd_debug($session->get(SESSION_USER_CERTIFICATION));
            echo "<script> alert('로그인을 해야 글을 쓸 수 있습니다.');</script>";
            echo "<script> history.back();</script>";
            
        }
        
        $getValue['writer'] = $session->get(SESSION_USER_CERTIFICATION);
       // 클릭한 글의 sno번호를 넘겨서 글의 댓글을 불러온다 
        $comment = $board->selectComment($getValue['sno']);
        
        
        $this->setData('comment', $comment);		
        $this->setData('data' , $getValue);

    }
    
    
    
}