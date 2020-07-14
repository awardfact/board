<?php 

namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;


class BoardPsController extends \Controller\Front\Controller
{
    public function index()
    {
        $postValue = Request::post()->toArray();
        
        $board = App::load(Board::class);
        
        if($boardData = $board->makeList($postValue)){
            gd_debug("입력완료");
        }
        else{
            gd_debug("입력실패");
        }
        gd_debug($postValue);
        exit;
    }
    

}