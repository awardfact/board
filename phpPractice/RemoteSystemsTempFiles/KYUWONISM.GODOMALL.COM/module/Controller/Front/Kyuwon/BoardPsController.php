<?php 
namespace Controller\Front\Kyuwon;

use App;
use Request;
use Component\Kyuwon\Board;

class BoardPsController extends \Controller\Front\Controller
{
    public function index() {

        $postValue = Request::post()->toArray();
        $getValue = Request::get()->toArray();
        $allValue = Request::request()->all();

        $board = App::load(Board::class);

        switch($postValue['mode']) {
            case 'boardReg' :
                $board->insertBoardData($postValue);
                break;
            case 'boradMod' :
                $board->updateBoardData($postValue);
                break;
            case 'boardDel' :
                $board->deleteBoardData($postValue['sno']);
                break;
        }

        gd_debug($postValue);
        gd_debug($getValue);
        gd_debug($allValue);
        exit;
    }
}