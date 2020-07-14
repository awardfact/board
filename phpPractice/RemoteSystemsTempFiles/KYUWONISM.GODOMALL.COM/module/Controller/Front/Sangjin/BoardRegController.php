<?php 
namespace Controller\Front\Sangjin;

use App;
use Request;
use Component\Sangjin\Board;

class BoardRegController extends \Controller\Front\Controller
{
    public function index()
    {
        $getValue = Request::get()->toArray();
        $this->setData('data' , $getValue);
    }
    
    
    
}