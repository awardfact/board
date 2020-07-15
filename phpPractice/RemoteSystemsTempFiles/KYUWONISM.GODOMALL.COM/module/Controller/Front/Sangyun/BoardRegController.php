<?php

namespace Controller\Front\Sangyun;

use App;
use Request;
use Component\Sangyun\Board;

class BoardRegController extends \Controller\Front\Controller
{
	public function index(){
		$sno = Request::get()->get('sno');
		

        $this->setData('sno', $sno);

	}
}