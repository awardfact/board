<?php 

namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;
use ..\data\sangjin;

class BoardPsController extends \Controller\Front\Controller
{
    public function index()
    {

        $postValue = Request::get()->toArray();
        gd_debug($postValue);
        $board = App::load(Board::class);
        $target_dir = "\";
        switch($postValue['mode']){
            case 'write' :
                $board->makeList($postValue);
                break;
            case 'update' :
                $board->updateList($postValue);
                break;
            case 'delete' :
                    
                $board->deleteList($postValue);
                break;
            default :
                break;
        }
        
        //echo "<script> location.replace('board_list.php')</script>";
        //exit;
    }
    

}