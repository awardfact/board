<?php

namespace Controller\Front\Sangyun;

use App;
use Request;
use Component\Sangyun\Board;

class BoardPsController extends \Controller\Front\Controller
{
	public function index(){
        $board = App::load(Board::class);
		$postValue = Request::post()->toArray();
        $board->getInsert($postValue['id'], $postValue['title'], $postValue['content']);
        //gd_debug($postValue);
		//gd_debug($boardInsert);
		exit;
	}
}
?>