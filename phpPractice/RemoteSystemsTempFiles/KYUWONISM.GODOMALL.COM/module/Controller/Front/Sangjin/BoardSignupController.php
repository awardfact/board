<?php 
namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;

class BoardSignupController extends \Controller\Front\Controller
{
    public function index()
    {
        $getValue = Request::request()->toArray();
        $session = App::getInstance('session');
        
        $board = App::load(Board::class);
        
        if($getValue['properId'] && $getValue['mode'] == 'signup'){
            $board->insertMember($getValue);
            echo "<script> alert('회원가입 성공');</script>";
            echo "<script> location.replace('board_list.php')</script>";
        }           
        if($getValue['inputId'] && $getValue['mode'] == 'login'){
            gd_debug($getValue);
            if($board->loginMember($getValue)){
                echo "<script> alert('로그인 성공');</script>";
                $session->set(SESSION_USER_CERTIFICATION, $getValue['inputId']);
                echo "<script> location.replace('board_list.php')</script>";
            }else{
                echo "<script> alert('로그인 실패');</script>";
            }

        }
        
        
        $this->setData('mode', $getValue);
    }
}