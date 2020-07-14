<?php

namespace Controller\Front\Sangyun;

use App;
use Request;
use Component\Sangyun\Board;

class TestController extends \Controller\Front\Controller
{
    public function index() {

        $board = App::load(Board::class);

        //$boardData = $board->getBoardList();
		$boardSelect = $board->getSelect();

        //gd_debug($boardData);
		gd_debug($boardSelect);
        //$this->setData('boardList', $boardData);
		$this->setData('boardSelect', $boardSelect);


    }
}